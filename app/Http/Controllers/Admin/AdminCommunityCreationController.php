<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CommunityCreation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCommunityCreationController extends Controller
{
    public function index(): View
    {
        $creations = CommunityCreation::orderBy('order')->get();

        return view('admin.community.index', compact('creations'));
    }

    public function create(): View
    {
        return view('admin.community.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'author'      => ['nullable', 'string', 'max:255'],
            'image'       => ['required', 'image', 'max:8192'],
            'active'      => ['nullable', 'boolean'],
            'order'       => ['nullable', 'integer'],
        ]);

        $validated['image'] = $request->file('image')->store('community_creations', 'public');
        $validated['active'] = $request->boolean('active');

        CommunityCreation::create($validated);

        return redirect()->route('admin.community.index')->with('success', 'Community creation added.');
    }

    public function edit(CommunityCreation $communityCreation): View
    {
        return view('admin.community.edit', ['community' => $communityCreation]);
    }

    public function update(Request $request, CommunityCreation $communityCreation): RedirectResponse
    {
        $validated = $request->validate([
            'title'       => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'author'      => ['nullable', 'string', 'max:255'],
            'image'       => ['nullable', 'image', 'max:8192'],
            'active'      => ['nullable', 'boolean'],
            'order'       => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($communityCreation->image);
            $validated['image'] = $request->file('image')->store('community_creations', 'public');
        }

        $validated['active'] = $request->boolean('active');

        $communityCreation->update($validated);

        return redirect()->route('admin.community.index')->with('success', 'Community creation updated.');
    }

    public function destroy(CommunityCreation $communityCreation): RedirectResponse
    {
        Storage::disk('public')->delete($communityCreation->image);
        $communityCreation->delete();

        return redirect()->route('admin.community.index')->with('success', 'Community creation deleted.');
    }
}
