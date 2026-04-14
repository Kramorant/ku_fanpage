@extends('layouts.app')

@section('title', 'Admin – Developer Media')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-camera-fill me-2"></i>Developer Media
        </h1>
        <a href="{{ route('admin.developer-media.create') }}" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Media
        </a>
    </div>

    @if($mediaItems->isEmpty())
        <p class="text-secondary text-center py-5">No developer media yet.</p>
    @else
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Published</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mediaItems as $item)
                <tr style="border-color:#3a3a3a">
                    <td>
                        <img src="{{ Storage::url($item->image) }}" height="50"
                             class="rounded" style="object-fit:cover; width:70px" alt="{{ $item->title }}">
                    </td>
                    <td class="fw-bold">{{ $item->title }}</td>
                    <td>
                        <span class="badge bg-warning text-dark" style="text-transform:capitalize">
                            {{ $item->media_type }}
                        </span>
                    </td>
                    <td class="text-secondary">
                        {{ $item->published_date ? $item->published_date->format('M j, Y') : '—' }}
                    </td>
                    <td class="text-secondary">{{ $item->order }}</td>
                    <td>
                        @if($item->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('developer.show', $item) }}" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.developer-media.edit', $item) }}"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.developer-media.destroy', $item) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete this media item?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
