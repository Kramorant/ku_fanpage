<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'post_type' => ['required', 'in:kaiju,event,blog'],
            'post_id'   => ['required', 'integer'],
            'content'   => ['required', 'string', 'max:2000'],
        ]);

        Comment::create([
            'user_id'   => auth()->id(),
            'post_type' => $validated['post_type'],
            'post_id'   => $validated['post_id'],
            'content'   => $validated['content'],
        ]);

        return back()->with('success', 'Comment posted successfully.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        if ($comment->user_id !== auth()->id() && ! auth()->user()->isAdmin()) {
            abort(403);
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted.');
    }
}
