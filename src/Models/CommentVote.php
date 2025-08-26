<?php

namespace Fawad\LaravelComments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentVote extends Model
{
    protected $fillable = [
        'comment_id',
        'user_id',
        'value', // 1 = upvote, -1 = downvote
    ];

    /**
     * A vote belongs to a comment.
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * A vote belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('comments.user_model'));
    }
}
