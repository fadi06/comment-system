<div class="flex items-center gap-4 border-indigo-500 dark:border-indigo-400">
    <div class="flex items-center gap-1">
        {{-- Upvote Button --}}
        <button 
            wire:click="vote('up')" 
            class="px-3 py-2 transition-all duration-300 cursor-pointer hover:border hover:border-indigo-600 dark:hover:border-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-700"
            title="Upvote"
        >
            👍
        </button>
        
        {{-- Downvote Button --}}
        <button 
            wire:click="vote('down')" 
            class="px-3 py-2 transition-all duration-300 cursor-pointer hover:border hover:border-indigo-600 dark:hover:border-indigo-400 hover:bg-indigo-100 dark:hover:bg-indigo-700"
            title="Downvote"
        >
            👎
        </button>

        {{-- Net Vote Count --}}
        <span class="font-medium border-indigo-800 dark:border-indigo-200">
            {{ $this->comment->votes_count ?? 0 }}
        </span>
    </div>
</div>