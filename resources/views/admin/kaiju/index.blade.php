@extends('layouts.app')

@section('title', 'Admin – Kaijus')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-tornado me-2"></i>Kaijus
        </h1>
        <a href="{{ route('admin.kaijus.create') }}" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Kaiju
        </a>
    </div>

    @if($kaijus->isEmpty())
        <p class="text-secondary text-center py-5">No kaijus yet.</p>
    @else
    <div class="table-responsive">
        <table class="table table-dark-ku align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kaijus as $kaiju)
                <tr style="border-color:#3a3a3a">
                    <td>
                        @if($kaiju->image)
                            <img src="{{ Storage::url($kaiju->image) }}"
                                 width="60" height="40"
                                 style="object-fit:cover; border-radius:4px"
                                 alt="{{ $kaiju->name }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center rounded"
                                 style="width:60px;height:40px;background:#111">
                                <i class="bi bi-tornado text-secondary"></i>
                            </div>
                        @endif
                    </td>
                    <td class="fw-bold">{{ $kaiju->name }}</td>
                    <td class="text-secondary">{{ $kaiju->slug }}</td>
                    <td class="text-end">
                        <a href="{{ route('wiki.show', $kaiju->slug) }}" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.kaijus.edit', $kaiju) }}"
                           class="btn btn-sm btn-outline-warning me-1" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.kaijus.destroy', $kaiju) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete {{ addslashes($kaiju->name) }}?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
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
