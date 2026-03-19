@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-newspaper me-2"></i>Blog
    </h1>

    @if($posts->isEmpty())
        <p class="text-secondary text-center py-5">No blog posts yet.</p>
    @else
    <div class="row g-4">
        @foreach($posts as $post)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('blog.show', $post) }}" class="text-decoration-none">
                <div class="card-ku h-100 rounded-3 overflow-hidden"
                     style="transition:.2s"
                     onmouseover="this.style.transform='translateY(-4px)';this.style.borderColor='var(--ku-accent)'"
                     onmouseout="this.style.transform='none';this.style.borderColor='var(--ku-border)'">

                    @if($post->image)
                        <img src="{{ Storage::url($post->image) }}"
                             class="w-100" style="height:180px; object-fit:cover" alt="{{ $post->title }}">
                    @else
                        <div class="d-flex align-items-center justify-content-center"
                             style="height:140px; background:#111">
                            <i class="bi bi-file-text" style="font-size:3rem; color:var(--ku-border)"></i>
                        </div>
                    @endif

                    <div class="p-3">
                        <small class="text-secondary">
                            <i class="bi bi-clock me-1"></i>{{ $post->created_at->format('M j, Y') }}
                        </small>
                        <h5 class="fw-bold mt-1 mb-0" style="color:var(--ku-accent)">{{ $post->title }}</h5>
                        <p class="text-secondary small mt-1 mb-0" style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;">
                            {{ strip_tags($post->content) }}
                        </p>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
