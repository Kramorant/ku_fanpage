@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<div class="container" style="max-width:860px">
    <div class="d-flex align-items-center gap-3 mb-4">
        <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left"></i>
        </a>
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">Edit Post</h1>
    </div>

    <form method="POST" action="{{ route('admin.blog.update', $post) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="card-ku p-4 rounded-3 mb-4">
            <div class="row g-3">
                <div class="col-12">
                    <label class="form-label text-secondary">Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                           value="{{ old('title', $post->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Featured Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*">
                    @if($post->image)
                    <div class="mt-2">
                        <img src="{{ Storage::url($post->image) }}" height="50" class="rounded">
                        <small class="text-secondary ms-2">Current image</small>
                    </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <label class="form-label text-secondary">Video URL (YouTube)</label>
                    <input type="url" name="video_url" class="form-control @error('video_url') is-invalid @enderror"
                           value="{{ old('video_url', $post->video_url) }}"
                           placeholder="https://youtube.com/watch?v=...">
                    @error('video_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div class="col-12">
                    <label class="form-label text-secondary">Content *</label>
                    <textarea id="tinymce-content" name="content"
                              class="form-control @error('content') is-invalid @enderror"
                              rows="12">{{ old('content', $post->content) }}</textarea>
                    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-ku fw-bold px-4">
                <i class="bi bi-floppy-fill me-1"></i>Save Changes
            </button>
            <a href="{{ route('admin.blog.index') }}" class="btn btn-outline-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@push('scripts')
{{-- Replace 'no-api-key' with your TinyMCE API key from https://www.tiny.cloud (free tier available). --}}
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
    selector: '#tinymce-content',
    skin: 'oxide-dark',
    content_css: 'dark',
    plugins: 'lists link image code table media',
    toolbar: 'undo redo | blocks | bold italic underline | bullist numlist | link image media | table | code',
    height: 420,
    promotion: false,
    branding: false,
    setup: function(editor) {
        editor.on('change', function() {
            editor.save();
        });
    }
});
</script>
@endpush
