@extends('layouts.app')

@section('title', 'Add Event')

@section('content')
<div class="container" style="max-width:720px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.events.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Add Event</h1>
    </div>

    <form method="POST" action="{{ route('admin.events.store') }}" enctype="multipart/form-data">
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
                    <label class="form-label text-secondary">Event Date & Time *</label>
                    <input type="datetime-local" name="event_date"
                           class="form-control @error('event_date') is-invalid @enderror"
                           value="{{ old('event_date') }}" required>
                    @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Description *</label>
                    <textarea name="description" rows="6"
                              class="form-control @error('description') is-invalid @enderror"
                              required>{{ old('description') }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-ku fw-bold px-4">
            <i class="bi bi-plus-lg me-1"></i>Create Event
        </button>
    </form>
</div>
@endsection
