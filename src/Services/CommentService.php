<?php

namespace Fawad\Comments\Services;

use Fawad\LaravelComments\Models\Comment;


class CommentService
{
    /**
     * Create a new comment.
     *
     * @param  array  $data
     */
    public function create(array $data)
    {
        return Comment::create($data);
    }

    /**
     * Reply to a comment.
     *
     * @param  Comment  $parent
     * @param  array  $data
     * @return Comment
     */
    public function reply(Comment $parent, array $data): Comment
    {
        $data['parent_id'] = $parent->id;

        return Comment::create($data);
    }

    /**
     * Upvote a comment.
     *
     * @param  Comment  $comment
     * @return void
     */
    public function upvote(Comment $comment): void
    {
        $comment->increment('votes');
    }

    /**
     * Downvote a comment.
     *
     * @param  Comment  $comment
     * @return void
     */
    public function downvote(Comment $comment): void
    {
        $comment->decrement('votes');
    }
}
