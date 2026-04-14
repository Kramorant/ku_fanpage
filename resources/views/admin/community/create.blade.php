@extends('layouts.app')

@section('title', 'Add Community Creation')

@section('content')
<div class="container" style="max-width:760px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.community.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Add Community Creation</h1>
    </div>

    <form method="POST" action="{{ route('admin.community.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="card-ku p-4 rounded-3 mb-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-secondary">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title') }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Author / Handle</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                           value="{{ old('author') }}" placeholder="e.g. DragonFan123">
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Order</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                           value="{{ old('order', 0) }}">
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Image *</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                           accept="image/*" required>
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="4">{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" value="1"
                               {{ old('active', true) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary" for="active">Active (visible publicly)</label>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-ku fw-bold px-4">
            <i class="bi bi-plus-lg me-1"></i>Add Creation
        </button>
    </form>
</div>
@endsection
