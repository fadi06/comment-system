<?php

namespace Fawad\LaravelComments\Http\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Fawad\LaravelComments\Models\Vote;
use Illuminate\Support\Facades\Auth;

class CommentVote extends Component
{
    public $comment;

    public $upvotes;
    public $downvotes;
    public $hasVoted = 'up';

    public function mount($comment)
    {
        $this->comment = $comment;
    }

    public function vote($type)
    {
        $userId = Auth::id();

        $existingVote = $this->comment->votes()->where('user_id', $userId)->first();

        if ($existingVote) {
            $existingVote->delete();
            $existingVote->update(['type' => $type]);
        } else {
            $this->comment->votes()->create([
                'user_id' => $userId,
                'type' => $type,
            ]);
        }

        $this->comment->loadCount('votes');
    }

    public function render()
    {
        return view('comments::livewire.comment-vote', [
            'upvotes' => $this->upvotes,
            'downvotes' => $this->downvotes,
        ]);
    }
}
