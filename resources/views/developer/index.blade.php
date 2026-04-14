@extends('layouts.app')

@section('title', 'Developer Media')

@push('styles')
<style>
    .media-card:hover {
        transform: translateY(-4px);
        border-color: var(--ku-accent) !important;
    }
    .media-card { transition: .2s; }
    .badge-media-type {
        font-size:.75rem;
        text-transform:capitalize;
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-2 gap-3">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-camera-fill me-2"></i>Developer Media
        </h1>
        <span class="badge bg-secondary">{{ $mediaItems->count() }} entries</span>
    </div>
    <p class="text-secondary mb-4">Official teasers, renders &amp; previews from the KU development team.</p>

    @if($mediaItems->isEmpty())
        <div class="text-center py-5 text-secondary">
            <i class="bi bi-camera" style="font-size:3rem"></i>
            <p class="mt-3 fs-5">No developer media yet. Check back soon!</p>
        </div>
    @else
    <div class="row g-4">
        @foreach($mediaItems as $item)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('developer.show', $item) }}" class="text-decoration-none">
                <div class="card-ku h-100 rounded-3 overflow-hidden media-card">
                    <div class="position-relative">
                        <img src="{{ Storage::url($item->image) }}"
                             class="w-100" style="height:300px; object-fit:cover"
                             alt="{{ $item->title }}">
                        <span class="position-absolute top-0 end-0 m-2 badge bg-warning text-dark badge-media-type">
                            {{ $item->media_type }}
                        </span>
                    </div>
                    <div class="p-3">
                        <h5 class="fw-bold mb-1" style="color:var(--ku-accent)">{{ $item->title }}</h5>
                        @if($item->published_date)
                            <p class="text-secondary small mb-1">
                                <i class="bi bi-calendar3 me-1"></i>{{ $item->published_date->format('M j, Y') }}
                            </p>
                        @endif
                        @if($item->description)
                            <p class="text-secondary small mb-0" style="
                                display:-webkit-box;
                                -webkit-line-clamp:2;
                                -webkit-box-orient:vertical;
                                overflow:hidden;">
                                {{ $item->description }}
                            </p>
                        @endif
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
