<?php

namespace Fawad\LaravelComments\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Fawad\LaravelComments\Models\Comment;
use Fawad\LaravelComments\Http\Requests\StoreCommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a new comment.
     */
    public function store(StoreCommentRequest $request)
    {
        $comment = Comment::create([
            'user_id' => Auth::id() + $request->validated()
        ]);

        return response()->json([
            'success' => true,
            'comment' => $comment->load('user'),
        ]);
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
