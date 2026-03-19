@extends('layouts.app')

@section('title', 'Admin – Events')

@section('content')
<div class="container">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="fw-bold mb-0" style="color:var(--ku-accent)">
            <i class="bi bi-calendar-event me-2"></i>Events
        </h1>
        <a href="{{ route('admin.events.create') }}" class="btn btn-ku">
            <i class="bi bi-plus-lg me-1"></i>Add Event
        </a>
    </div>

    @if($events->isEmpty())
        <p class="text-secondary text-center py-5">No events yet.</p>
    @else
    <div class="table-responsive">
        <table class="table align-middle" style="background:var(--ku-surface); color:var(--ku-text)">
            <thead style="border-bottom:2px solid var(--ku-accent)">
                <tr>
                    <th>Title</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr style="border-color:#3a3a3a">
                    <td class="fw-bold">{{ $event->title }}</td>
                    <td class="text-secondary">{{ $event->event_date->format('M j, Y H:i') }}</td>
                    <td class="text-end">
                        <a href="{{ route('events.show', $event) }}" target="_blank"
                           class="btn btn-sm btn-outline-secondary me-1">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('admin.events.edit', $event) }}"
                           class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                              class="d-inline"
                              onsubmit="return confirm('Delete this event?')">
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
