@extends('layouts.app')

@section('title', 'Add Developer Media')

@section('content')
<div class="container" style="max-width:760px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.developer-media.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Add Developer Media</h1>
    </div>

    <form method="POST" action="{{ route('admin.developer-media.store') }}" enctype="multipart/form-data">
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
                    <label class="form-label text-secondary">Media Type *</label>
                    <select name="media_type" class="form-select @error('media_type') is-invalid @enderror" required>
                        @foreach(['teaser','render','screenshot','artwork','other'] as $type)
                            <option value="{{ $type }}" {{ old('media_type', 'render') === $type ? 'selected' : '' }}
                                    style="text-transform:capitalize">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                    @error('media_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Published Date</label>
                    <input type="date" name="published_date"
                           class="form-control @error('published_date') is-invalid @enderror"
                           value="{{ old('published_date') }}">
                    @error('published_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
            <i class="bi bi-plus-lg me-1"></i>Add Media
        </button>
    </form>
</div>
@endsection
