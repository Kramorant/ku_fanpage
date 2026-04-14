@extends('layouts.app')

@section('title', $developerMedia->title . ' – Developer Media')

@section('content')
<div class="container" style="max-width:900px">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('developer.index') }}">Developer Media</a></li>
            <li class="breadcrumb-item active">{{ $developerMedia->title }}</li>
        </ol>
    </nav>

    <div class="card-ku rounded-3 overflow-hidden mb-4">
        <img src="{{ Storage::url($developerMedia->image) }}"
             class="w-100" style="max-height:600px; object-fit:contain; background:#111"
             alt="{{ $developerMedia->title }}">
    </div>

    <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">{{ $developerMedia->title }}</h1>
        <span class="badge bg-warning text-dark" style="font-size:.85rem; text-transform:capitalize">
            {{ $developerMedia->media_type }}
        </span>
    </div>

    @if($developerMedia->published_date)
        <p class="text-secondary mb-3">
            <i class="bi bi-calendar3 me-1"></i>{{ $developerMedia->published_date->format('F j, Y') }}
        </p>
    @endif

    @if($developerMedia->description)
        <div class="card-ku p-4 rounded-3">
            <p class="mb-0" style="white-space:pre-wrap; line-height:1.7">{{ $developerMedia->description }}</p>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('developer.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Developer Media
        </a>
    </div>
</div>
@endsection
