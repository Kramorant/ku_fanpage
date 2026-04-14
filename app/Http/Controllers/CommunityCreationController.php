<?php

namespace App\Http\Controllers;

use App\Models\CommunityCreation;
use Illuminate\View\View;

class CommunityCreationController extends Controller
{
    public function index(): View
    {
        $creations = CommunityCreation::where('active', true)
            ->orderBy('order')
            ->get();

        return view('community.index', compact('creations'));
    }

    public function show(CommunityCreation $communityCreation): View
    {
        abort_unless($communityCreation->active, 404);

        return view('community.show', compact('communityCreation'));
    }
}
