@extends('layouts.app')

@section('title', 'Edit Community Creation')

@section('content')
<div class="container" style="max-width:760px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.community.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Edit Community Creation</h1>
    </div>

    <form method="POST" action="{{ route('admin.community.update', $community) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-ku p-4 rounded-3 mb-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-secondary">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $community->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Author / Handle</label>
                    <input type="text" name="author" class="form-control @error('author') is-invalid @enderror"
                           value="{{ old('author', $community->author) }}" placeholder="e.g. DragonFan123">
                    @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Order</label>
                    <input type="number" name="order" class="form-control @error('order') is-invalid @enderror"
                           value="{{ old('order', $community->order) }}">
                    @error('order')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                           accept="image/*">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    <div class="mt-2">
                        <img src="{{ Storage::url($community->image) }}" height="80"
                             class="rounded" style="object-fit:cover" alt="Current image">
                        <small class="text-secondary ms-2">Current image</small>
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                              rows="4">{{ old('description', $community->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="active" id="active" value="1"
                               {{ old('active', $community->active) ? 'checked' : '' }}>
                        <label class="form-check-label text-secondary" for="active">Active (visible publicly)</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ku fw-bold px-4">
                <i class="bi bi-floppy-fill me-1"></i>Save Changes
            </button>
            <a href="{{ route('admin.community.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
