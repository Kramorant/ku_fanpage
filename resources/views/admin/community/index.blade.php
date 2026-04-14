@extends('layouts.app')

@section('title', 'Admin – Community Creations')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-people-fill me-2"></i>Community Creations
        </h1>
        <a href="{{ route('admin.community.create') }}" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Creation
        </a>
    </div>

    @if($creations->isEmpty())
        <p class="text-secondary text-center py-5">No community creations yet.</p>
    @else
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Order</th>
                    <th>Active</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($creations as $creation)
                <tr style="border-color:#3a3a3a">
                    <td>
                        <img src="{{ Storage::url($creation->image) }}" height="50"
                             class="rounded" style="object-fit:cover; width:70px" alt="{{ $creation->title }}">
                    </td>
                    <td class="fw-bold">{{ $creation->title }}</td>
                    <td class="text-secondary">{{ $creation->author ?? '—' }}</td>
                    <td class="text-secondary">{{ $creation->order }}</td>
                    <td>
                        @if($creation->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td class="text-end">
                        <a href="{{ route('community.show', $creation) }}" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.community.edit', $creation) }}"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.community.destroy', $creation) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete this creation?')">
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
