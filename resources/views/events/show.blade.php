@extends('layouts.app')

@section('title', $event->title . ' – Events')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('events.index') }}">Events</a></li>
            <li class="breadcrumb-item active">{{ $event->title }}</li>
        </ol>
    </nav>

    <div class="row g-4 mb-5">
        @if($event->image)
        <div class="col-md-5">
            <img src="{{ Storage::url($event->image) }}"
                 class="img-fluid rounded-3 w-100"
                 style="max-height:360px; object-fit:cover"
                 alt="{{ $event->title }}">
        </div>
        @endif
        <div class="{{ $event->image ? 'col-md-7' : 'col-12' }}">
            <div class="mb-2">
                <span class="badge" style="background:var(--ku-accent); color:#111; font-size:.9rem">
                    <i class="bi bi-calendar3 me-1"></i>
                    {{ $event->event_date->format('F j, Y – H:i') }}
                </span>
            </div>
            <h1 class="fw-bold" style="color:var(--ku-accent)">{{ $event->title }}</h1>
            <div class="text-secondary mt-3" style="line-height:1.8">
                {!! nl2br(e($event->description)) !!}
            </div>
        </div>
    </div>

    @include('components.comment-section', [
        'comments' => $event->comments,
        'postType' => 'event',
        'postId'   => $event->id,
    ])
</div>
@endsection
