<?php

namespace Fawad\LaravelComments\Http\Livewire;

use Livewire\Component;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Fawad\LaravelComments\Models\Comment;
use Livewire\Attributes\On;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CommentList extends Component
{
    use WithFileUploads;

    public $newComment;
    public $attachments;
    public $post;
    public $commentId = null;
    public $isReplying = false;
    public $replyCommentId = null;
    public $replyText = '';
    public $displayFirstTime = false;


    public function mount($post, $commentId = null, $displayFirstTime = true)
    {
        $this->post = $post;
        $this->commentId = $commentId;
        $this->displayFirstTime = $displayFirstTime;
    }

    #[On('commentAdded')]
    public function refreshComments()
    {
        $this->dispatch('$refresh');
    }


    #[Computed]
    public function comments()
    {
        return Comment::with(['user:id,name', 'replies.user:id,name', 'attachments'])
            ->withCount('votes')
            ->where('post_id', $this->post->id)
            ->when($this->commentId, function ($query) {
                $query->whereId( $this->commentId);
            }, function ($query) {
                $query->whereNull('parent_id');
            })
            ->latest()
            ->get();
    }

    public function replyingTo($commentText, $commentId)
    {
        $this->dispatch('focus-comment-box');
        $this->dispatch('replyComment', ['commentText' => $commentText, 'commentId' => $commentId]);
    }

    public function render()
    {
        return view('comments::livewire.comment-list');
    }
}
