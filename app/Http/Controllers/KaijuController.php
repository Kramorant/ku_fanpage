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
        $kaiju->load(['stats', 'attacks', 'speeds', 'regen', 'comments.user']);

        return view('wiki.show', compact('kaiju'));
    }
}
