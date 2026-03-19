<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\View\View;

class EventController extends Controller
{
    public function index(): View
    {
        $events = Event::orderByDesc('event_date')->get();

        return view('events.index', compact('events'));
    }

    public function show(Event $event): View
    {
        $event->load('comments.user');

        return view('events.show', compact('event'));
    }
}
