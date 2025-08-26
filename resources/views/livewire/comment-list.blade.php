<div class="space-y-6">
    {{-- Comments --}}
    <div class="mb-2 text-gray-600 dark:text-gray-400">
        {{-- @dd($this->comments->toArray()); --}}
        @foreach ($this->comments as $comment)
            <div wire:key="comment-{{ $comment->id }}" class="bg-white p-4 rounded-2xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700 transition-all duration-300 mb-4">
                
                {{-- Header --}}
                <div class="flex items-center gap-2 mb-2">
                    <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">
                        @php
                            $userName = !empty($comment->user) ? $comment->user->name : $comment->guest_name;
                        @endphp
                        {{ strtoupper(substr($userName, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-800">{{ $userName }}</p>
                        <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                {{-- Body --}}
                <div class="text-gray-700 mb-3 dark:text-gray-300">
                    {{ $comment->comment }}
                </div>

                {{-- Attachments --}}
                @if ($comment->attachments)
                    <div class="flex gap-3 flex-wrap mb-3">
                        @foreach (json_decode($comment->attachments, true) as $index => $file)
                            <img 
                                wire:key="{{ 'image-'.$index }}" 
                                src="{{ asset('storage/' . $file) }}" 
                                class="w-20 h-20 object-cover rounded-xl border cursor-pointer hover:opacity-75"
                                data-images='@json(json_decode($comment->attachments, true))'
                                data-index="{{ $index }}"
                                @click.prevent.stop="
                                    $dispatch('open-slider', { 
                                        images: JSON.parse($el.dataset.images), 
                                        index: Number($el.dataset.index) 
                                    })
                                "
                            >
                        @endforeach
                    </div>
                @endif

                {{-- Actions --}}
                <div class="flex items-center gap-4 text-sm text-gray-600">
                        @auth
                            <livewire:comment-vote :comment="$comment" :key="'vote-'.$comment->id" />
                        @endauth
                        <button wire:click="replyingTo('{{ $comment->comment }}', {{ $comment->id }})" class="hover:text-indigo-600 cursor-pointer">
                            Reply
                        </button>
                    </div>

                {{-- Replies --}}
                @if ($comment->replies->count())
                    <div class="mt-4 pl-6 border-l border-gray-200 space-y-4">
                        @foreach ($comment->replies as $reply)
                            <livewire:comments-list :commentId="$reply->id" :post="$post" :key="'reply-'.$reply->id" />
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    {{-- Empty State --}}
    @if ($this->comments->isEmpty())
        <p class="text-gray-500 text-center text-sm">No comments yet. Be the first one to comment!</p>
    @endif

    {{-- Global Modal --}}
    <div 
        x-data="globalImageSlider()" 
        @open-slider.window="open($event.detail.images, $event.detail.index)"
        @keydown.window.right="if (isOpen) next()"
        @keydown.window.left="if (isOpen) prev()"
        @keydown.window.escape="if (isOpen) close()"

    >
        <template x-if="isOpen">
            <div 
                x-show="isOpen" 
                x-transition.opacity 
                class="fixed inset-0 bg-black bg-opacity-80 flex items-center justify-center z-50"
            >
                <button @click="close" class="absolute top-4 right-4 text-white text-3xl">&times;</button>

                <div class="relative w-11/12 md:w-3/4 lg:w-1/2">
                    <img 
                        :src="imageUrl(images[currentIndex])" 
                        class="max-h-[80vh] mx-auto rounded-xl shadow-lg transition-all duration-500"
                    >

                    <button @click="prev" class="absolute left-0 top-1/2 -translate-y-1/2 text-white text-4xl px-2">
                        &#10094;
                    </button>
                    <button @click="next" class="absolute right-0 top-1/2 -translate-y-1/2 text-white text-4xl px-2">
                        &#10095;
                    </button>
                </div>
            </div>
        </template>
    </div>
</div>

{{-- Alpine helper script --}}
<script>
function globalImageSlider() {
    return {
        images: [],
        currentIndex: 0,
        isOpen: false,

        open(imgs, index) {
            this.images = imgs;
            this.currentIndex = index;
            this.isOpen = true;
        },
        close() {
            this.isOpen = false;
        },
        next() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        prev() {
            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
        },
        imageUrl(path) {
            if (path.startsWith('http')) return path;
            if (path.startsWith('storage/')) return '/' + path;
            return '/storage/' + path;
        }
    }
}
</script>
