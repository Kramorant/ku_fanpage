@extends('layouts.app')

@section('title', 'Admin – Blog Posts')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-newspaper me-2"></i>Blog Posts
        </h1>
        <a href="{{ route('admin.blog.create') }}" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>New Post
        </a>
    </div>

    @if($posts->isEmpty())
        <p class="text-secondary text-center py-5">No blog posts yet.</p>
    @else
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Title</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr style="border-color:#3a3a3a">
                    <td class="fw-bold">{{ $post->title }}</td>
                    <td class="text-secondary">{{ $post->created_at->format('M j, Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('blog.show', $post) }}" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.blog.edit', $post) }}"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.blog.destroy', $post) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete this post?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
