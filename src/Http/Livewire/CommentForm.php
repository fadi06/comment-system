<?php

namespace Fawad\LaravelComments\Http\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use Fawad\LaravelComments\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentForm extends Component
{
    use WithFileUploads;
    public $comment;
    public $guestName = null;
    public $guestEmail = null;
    public $post;
    public $commentId = null;
    public $isReplying = false;
    public $replyCommentId = null;
    public $replyText = '';
    public $displayFirstTime = false;
    public $parent_id = null;
    public $attachments = [];

    public function rules()
    {
        return [
            'comment' => 'required|string|max:1000',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|file|max:'.config('comments.max_upload_size'),
            'guestName' => Auth::id() ? 'nullable' : 'required',
            'guestEmail' => Auth::id() ? 'nullable' : 'required',
        ];
    }

    public function submit()
    {
        $this->validate();
        
        $path = collect($this->attachments)
            ->map(fn($file) => $file->store('attachments', 'public'))
            ->toArray();

        $parent_id = null;
        if ($this->isReplying) {
            $parent_id = $this->replyCommentId;
            $this->isReplying = false;
        }

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
            'parent_id' => $parent_id,
            'guest_name' => $this->guestName,
            'guest_email' => $this->guestEmail,
            'attachments' => json_encode($path),
        ]);

        $this->reset(['comment', 'attachments', 'parent_id', 'guestName', 'guestEmail']);

        $this->dispatch('commentAdded')->to(CommentList::class);
    }

    #[On('replyComment')]
    public function setReply($parameters)
    {
        if(empty($parameters)) return;

        extract($parameters);
        $this->isReplying = true;
        $this->replyCommentId = $commentId;
        $this->replyText = $commentText;
    }

    #[Computed]
    public function checkAllowImageUpload()
    {
        return config('comments.allow_images');
    }

    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function render()
    {
        return view('comments::livewire.comment-form');
    }
}

