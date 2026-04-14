@extends('layouts.app')

@section('title', $communityCreation->title . ' – Community Creations')

@section('content')
<div class="container" style="max-width:900px">
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('community.index') }}">Community Creations</a></li>
            <li class="breadcrumb-item active">{{ $communityCreation->title }}</li>
        </ol>
    </nav>

    <div class="card-ku rounded-3 overflow-hidden mb-4">
        <img src="{{ Storage::url($communityCreation->image) }}"
             class="w-100" style="max-height:600px; object-fit:contain; background:#111"
             alt="{{ $communityCreation->title }}">
    </div>

    <h1 class="fw-bold mb-1" style="color:var(--ku-accent)">{{ $communityCreation->title }}</h1>

    @if($communityCreation->author)
        <p class="text-secondary mb-3">
            <i class="bi bi-person me-1"></i>by <strong>{{ $communityCreation->author }}</strong>
        </p>
    @endif

    @if($communityCreation->description)
        <div class="card-ku p-4 rounded-3">
            <p class="mb-0" style="white-space:pre-wrap; line-height:1.7">{{ $communityCreation->description }}</p>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('community.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Community Creations
        </a>
    </div>
</div>
@endsection
