<div class="bg-white dark:bg-gray-800 p-4 rounded-2xl shadow-md dark:text-gray-400">
    <form wire:submit.prevent="submit"
        class="space-y-4 bg-white p-4 rounded-2xl shadow-sm dark:bg-gray-800 border border-gray-100 dark:border-gray-700 transition-all duration-300 mb-4"
        x-on:focus-comment-box.window="
            window.scrollTo({ top: 0, behavior: 'smooth' });
            $refs.commentBox.focus();
        ">
        @if ($isReplying)
            <p class="text-lg font-semibold text-gray-800 dark:text-gray-300 mb-2">Replying to comment: {{ $replyText }}</p>
        @else
            <p class="text-lg font-semibold text-gray-800 dark:text-gray-300 mb-2">Comments</p>
        @endif
        <div>
            @if (config('comments.allow_guest_for_commit'))
                @guest
                    <div class="flex gap-3 w-full mb-3">
                        <div class="w-1/2">
                            <input 
                                class="w-full border border-gray-300 rounded-xl p-3 focus:ring focus:ring-indigo-200 focus:border-indigo-400" 
                                wire:model="guestName" 
                                placeholder="Enter your name"
                            />
                            @error('guestName') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                        <div class="w-1/2">
                            <input 
                                class="w-full border border-gray-300 rounded-xl p-3 focus:ring focus:ring-indigo-200 focus:border-indigo-400" 
                                wire:model="guestEmail" 
                                placeholder="Enter your email"
                            />
                            @error('guestEmail') 
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                            @enderror
                        </div>
                    </div>
                @endguest
            @endif

            <textarea
                wire:model.defer="comment"
                x-ref="commentBox"
                rows="3"
                placeholder="Write your comment..."
                class="w-full border border-gray-300 rounded-xl p-3 focus:ring focus:ring-indigo-200 focus:border-indigo-400 resize-none"
            ></textarea>
            @error('comment') 
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
            @enderror
        </div>

        {{-- Attachments --}}
        @if ($this->checkAllowImageUpload)
            <div>
                <input type="file" wire:model="attachments" multiple class="rounded-md dark:bg-indigo-600 bg-gray-600 cursor-pointer px-5 py-2 text-sm leading-5 font-semibold dark:text-white text-gray-100 dark:hover:bg-indigo-700 hover:bg-gray-700 focus:outline-2 focus:outline-offset-2 dark:focus:outline-indigo-500 dark:active:bg-indigo-700 focus:outline-gray-500 active:bg-gray-700">
                @error('attachments.*') 
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                @enderror

                <div class="flex gap-2 mt-2 flex-wrap">
                    @foreach ($attachments as $file)
                        <div class="relative" wire:key="{{ 'image-'.$loop->index }}">
                            <img src="{{ $file->temporaryUrl() }}" class="w-20 h-20 object-cover rounded-xl border cursor-pointer hover:opacity-75" />
                            <button type="button" wire:click="removeAttachment({{ $loop->index }})" class="absolute top-1 right-1 bg-red-300 text-white text-xs rounded-full cursor-pointer hover:bg-red-700 px-1">x</button>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button
                type="submit"
                class="px-4 py-2 bg-gray-600 text-gray-100 dark:bg-indigo-600 dark:text-white rounded-xl hover:bg-gray-700 dark:hover:bg-indigo-700 transition cursor-pointer"
            >
                Post Comment
            </button>
        </div>
    </form>
</div>
