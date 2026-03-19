@extends('layouts.app')

@section('title', $post->title . ' – Blog')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('blog.index') }}">Blog</a></li>
            <li class="breadcrumb-item active">{{ $post->title }}</li>
        </ol>
    </nav>

    <article class="mb-5">
        @if($post->image)
        <img src="{{ Storage::url($post->image) }}"
             class="img-fluid rounded-3 w-100 mb-4"
             style="max-height:420px; object-fit:cover"
             alt="{{ $post->title }}">
        @endif

        <h1 class="fw-bold mb-2" style="color:var(--ku-accent)">{{ $post->title }}</h1>
        <small class="text-secondary">
            <i class="bi bi-clock me-1"></i>{{ $post->created_at->format('F j, Y') }}
        </small>

        <hr style="border-color:#3a3a3a">

        <div class="blog-content text-secondary" style="line-height:1.9; font-size:1.05rem">
            {!! $post->content !!}
        </div>

        {{-- Embedded video --}}
        @if($embedUrl = $post->getEmbedUrl())
        <div class="mt-4">
            <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">
                <i class="bi bi-play-circle-fill me-2"></i>Video
            </h5>
            <div class="ratio ratio-16x9 rounded-3 overflow-hidden"
                 style="max-width:720px; border:1px solid #3a3a3a">
                <iframe src="{{ $embedUrl }}"
                        title="Embedded video"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            </div>
        </div>
        @endif
    </article>

    @include('components.comment-section', [
        'comments' => $post->comments,
        'postType' => 'blog',
        'postId'   => $post->id,
    ])
</div>
@endsection

@push('styles')
<style>
.blog-content img  { max-width: 100%; border-radius: 6px; }
.blog-content h2,
.blog-content h3   { color: var(--ku-accent); margin-top: 1.5rem; }
.blog-content a    { color: var(--ku-accent); }
.blog-content blockquote {
    border-left: 3px solid var(--ku-accent);
    padding-left: 1rem;
    color: #aaa;
    font-style: italic;
}
</style>
@endpush
