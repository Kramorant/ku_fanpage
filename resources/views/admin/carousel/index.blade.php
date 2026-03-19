@extends('layouts.app')

@section('title', 'Manage Carousel')

@section('content')
<div class="container">
    <h1 class="fw-bold mb-4" style="color:var(--ku-accent)">
        <i class="bi bi-images me-2"></i>Carousel Images
    </h1>

    {{-- Upload form --}}
    <div class="card-ku p-4 rounded-3 mb-5">
        <h5 class="fw-bold mb-3" style="color:var(--ku-accent)">Upload New Image</h5>
        <form method="POST" action="{{ route('admin.carousel.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label text-secondary">Image *</label>
                    <input type="file" name="image_path" class="form-control" accept="image/*" required>
                </div>
                <div class="col-md-4">
                    <label class="form-label text-secondary">Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="Optional caption">
                </div>
                <div class="col-md-2">
                    <label class="form-label text-secondary">Order</label>
                    <input type="number" name="order" class="form-control" value="0" min="0">
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-ku w-100 fw-bold">
                        <i class="bi bi-upload"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Images table --}}
    @if($images->isEmpty())
        <p class="text-secondary text-center py-5">No carousel images uploaded yet.</p>
    @else
    <div class="row g-4">
        @foreach($images as $img)
        <div class="col-md-4 col-lg-3">
            <div class="card-ku rounded-3 overflow-hidden {{ $img->active ? 'border-warning' : '' }}">
                <div class="position-relative">
                    <img src="{{ Storage::url($img->image_path) }}"
                         class="w-100" style="height:150px; object-fit:cover"
                         alt="Carousel image {{ $img->id }}">
                    @if($img->active)
                    <span class="badge position-absolute top-0 end-0 m-2"
                          style="background:var(--ku-accent); color:#111">Active</span>
                    @endif
                </div>

                <div class="p-3">
                    @if($img->caption)
                        <p class="text-secondary small mb-2">{{ $img->caption }}</p>
                    @endif

                    {{-- Reorder & toggle form --}}
                    <form method="POST" action="{{ route('admin.carousel.update', $img) }}"
                          class="mb-2">
                        @csrf @method('PUT')
                        <div class="d-flex gap-2 mb-2">
                            <input type="number" name="order" class="form-control form-control-sm"
                                   value="{{ $img->order }}" min="0" style="width:70px">
                            <div class="form-check form-switch d-flex align-items-center ms-1">
                                <input class="form-check-input" type="checkbox"
                                       name="active" value="1" role="switch"
                                       id="activeToggle{{ $img->id }}"
                                       {{ $img->active ? 'checked' : '' }}>
                                <label class="form-check-label text-secondary ms-2"
                                       for="activeToggle{{ $img->id }}">Active</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-outline-warning w-100">
                            <i class="bi bi-floppy me-1"></i>Update
                        </button>
                    </form>

                    {{-- Delete --}}
                    <form method="POST" action="{{ route('admin.carousel.destroy', $img) }}"
                          onsubmit="return confirm('Delete this image?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                            <i class="bi bi-trash me-1"></i>Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection
