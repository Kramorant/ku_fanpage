@extends('layouts.app')

@section('title', $kaiju->name . ' – KU Wiki')

@section('content')
<div class="container">
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('wiki.index') }}">Wiki</a></li>
            <li class="breadcrumb-item active">{{ $kaiju->name }}</li>
        </ol>
    </nav>

    {{-- Header --}}
    <div class="row align-items-start g-4 mb-5">
        <div class="col-md-4">
            @if($kaiju->image)
                <img src="{{ Storage::url($kaiju->image) }}"
                     class="img-fluid rounded-3 w-100"
                     style="max-height:360px; object-fit:cover"
                     alt="{{ $kaiju->name }}">
            @else
                <div class="d-flex align-items-center justify-content-center rounded-3"
                     style="height:300px; background:#111">
                    <i class="bi bi-tornado" style="font-size:6rem; color:var(--ku-border)"></i>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <h1 class="fw-bold" style="color:var(--ku-accent)">{{ $kaiju->name }}</h1>
            @if($kaiju->description)
                <p class="lead text-secondary">{{ $kaiju->description }}</p>
            @endif
        </div>
    </div>

    {{-- Stats Component --}}
    @include('components.kaiju-stats', ['kaiju' => $kaiju])

    {{-- Build Creator --}}
    @include('components.kaiju-build-creator', ['kaiju' => $kaiju])

    {{-- Comments --}}
    <div class="mt-5">
        @include('components.comment-section', [
            'comments'  => $kaiju->comments,
            'postType'  => 'kaiju',
            'postId'    => $kaiju->id,
        ])
    </div>
</div>
@endsection
