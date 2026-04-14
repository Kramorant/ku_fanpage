@extends('layouts.app')

@section('title', 'Community Creations')

@push('styles')
<style>
    .creation-card:hover {
        transform: translateY(-4px);
        border-color: var(--ku-accent) !important;
    }
    .creation-card { transition: .2s; }
</style>
@endpush

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-2 gap-3">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-people-fill me-2"></i>Community Creations
        </h1>
        <span class="badge bg-secondary">{{ $creations->count() }} entries</span>
    </div>
    <p class="text-secondary mb-4">Fan-designed kaiju artwork from the community.</p>

    @if($creations->isEmpty())
        <div class="text-center py-5 text-secondary">
            <i class="bi bi-image" style="font-size:3rem"></i>
            <p class="mt-3 fs-5">No community creations yet. Check back soon!</p>
        </div>
    @else
    <div class="row g-4">
        @foreach($creations as $creation)
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('community.show', $creation) }}" class="text-decoration-none">
                <div class="card-ku h-100 rounded-3 overflow-hidden creation-card">
                    <img src="{{ Storage::url($creation->image) }}"
                         class="w-100" style="height:300px; object-fit:cover"
                         alt="{{ $creation->title }}">
                    <div class="p-3">
                        <h5 class="fw-bold mb-1" style="color:var(--ku-accent)">{{ $creation->title }}</h5>
                        @if($creation->author)
                            <p class="text-secondary small mb-1">by @{{ $creation->author }}</p>
                        @endif
                        @if($creation->description)
                            <p class="text-secondary small mb-0" style="
                                display:-webkit-box;
                                -webkit-line-clamp:2;
                                -webkit-box-orient:vertical;
                                overflow:hidden;">
                                {{ $creation->description }}
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
