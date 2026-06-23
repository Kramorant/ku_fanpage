<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\Kaiju;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeForKaiju(Request $request, Kaiju $kaiju): CommentResource
    {
        return $this->storeComment($request, $kaiju);
    }

    public function storeForBlogPost(Request $request, BlogPost $post): CommentResource
    {
        return $this->storeComment($request, $post);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        abort_unless($comment->user_id === request()->user()->id, 403);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }

    private function storeComment(Request $request, Kaiju|BlogPost $commentable): CommentResource
    {
        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        $comment = $commentable->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $validated['body'],
        ])->load('user');

        return new CommentResource($comment);
    }
}
