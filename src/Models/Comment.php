<?php

namespace Fawad\LaravelComments\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'attachments' => 'array',
    ];

    /**
     * Comment belongs to a user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(config('comments.user_model', \App\Models\User::class));
    }

    /**
     * Parent comment (for nested replies).
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Replies (children).
     */
    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Replies (children).
     */
    public function attachments(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    /**
     * Votes on this comment.
     */
    public function votes(): HasMany
    {
        return $this->hasMany(CommentVote::class);
    }

    /**
     * Sum of votes (cached or on the fly).
     */
    public function getVotesSumAttribute(): int
    {
        return $this->votes()->sum('value');
    }

}
