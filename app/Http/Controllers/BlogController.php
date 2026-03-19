<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = BlogPost::latest()->get();

        return view('blog.index', compact('posts'));
    }

    public function show(BlogPost $post): View
    {
        $post->load('comments.user');

        return view('blog.show', compact('post'));
    }
}
