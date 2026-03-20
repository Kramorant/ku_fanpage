<?php

namespace App\Http\Controllers;

use App\Models\Kaiju;
use Illuminate\View\View;

class KaijuController extends Controller
{
    public function index(): View
    {
        $kaijus = Kaiju::orderBy('name')->get();

        return view('wiki.index', compact('kaijus'));
    }

    public function show(Kaiju $kaiju): View
    {
        $kaiju->load(['baseStat', 'attacks', 'speeds', 'comments.user', 'titles']);

        return view('wiki.show', compact('kaiju'));
    }
}
