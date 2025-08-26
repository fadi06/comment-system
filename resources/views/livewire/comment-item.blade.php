<div class="bg-white p-4 rounded-2xl shadow-sm">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-2">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center text-indigo-600 font-semibold">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">{{ $comment->user->name }}</p>
                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    {{-- Content --}}
    <div class="text-gray-700 mb-3">
        {{ $comment->content }}
    </div>

    {{-- Attachments --}}
    @if ($comment->attachments)
        <div class="flex gap-3 flex-wrap mb-3">
            @foreach (json_decode($comment->attachments, true) as $file)
                <img src="{{ asset('storage/' . $file) }}" class="w-20 h-20 object-cover rounded-xl border">
            @endforeach
        </div>
    @endif

    {{-- Actions --}}
    <div class="flex items-center gap-4 text-sm text-gray-600">
        {{-- Vote Component --}}
        @livewire('comment-vote', ['comment' => $comment], key('vote-'.$comment->id))

        {{-- Reply Toggle --}}
        <button wire:click="$emit('replyingTo', {{ $comment->id }})" class="hover:text-indigo-600">
            Reply
        </button>
    </div>

    {{-- Nested Replies --}}
    @if ($comment->replies->count())
        <div class="mt-4 pl-6 border-l border-gray-200 space-y-4">
            @foreach ($comment->replies as $reply)
                @livewire('comment-item', ['comment' => $reply], key('reply-'.$reply->id))
            @endforeach
        </div>
    @endif
</div>
