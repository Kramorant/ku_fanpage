<?php

namespace App\Http\Controllers;

use App\Models\DeveloperMedia;
use Illuminate\View\View;

class DeveloperMediaController extends Controller
{
    public function index(): View
    {
        $mediaItems = DeveloperMedia::where('active', true)
            ->orderBy('order')
            ->get();

        return view('developer.index', compact('mediaItems'));
    }

    public function show(DeveloperMedia $developerMedia): View
    {
        abort_unless($developerMedia->active, 404);

        return view('developer.show', compact('developerMedia'));
    }
}
