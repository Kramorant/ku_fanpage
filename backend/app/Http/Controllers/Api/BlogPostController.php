<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogPostResource;
use App\Models\BlogPost;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BlogPostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $posts = BlogPost::query()->with('author')->latest()->get();

        return BlogPostResource::collection($posts);
    }

    public function show(BlogPost $post): BlogPostResource
    {
        $post->load(['author', 'comments.user']);

        return new BlogPostResource($post);
    }
}
