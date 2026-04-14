<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DeveloperMedia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminDeveloperMediaController extends Controller
{
    public function index(): View
    {
        $mediaItems = DeveloperMedia::orderBy('order')->get();

        return view('admin.developer.index', compact('mediaItems'));
    }

    public function create(): View
    {
        return view('admin.developer.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'media_type'     => ['required', 'string', 'in:teaser,render,screenshot,artwork,other'],
            'published_date' => ['nullable', 'date'],
            'image'          => ['required', 'image', 'max:8192'],
            'active'         => ['nullable', 'boolean'],
            'order'          => ['nullable', 'integer'],
        ]);

        $validated['image'] = $request->file('image')->store('developer_media', 'public');
        $validated['active'] = $request->boolean('active');

        DeveloperMedia::create($validated);

        return redirect()->route('admin.developer-media.index')->with('success', 'Developer media added.');
    }

    public function edit(DeveloperMedia $developerMedium): View
    {
        return view('admin.developer.edit', ['media' => $developerMedium]);
    }

    public function update(Request $request, DeveloperMedia $developerMedium): RedirectResponse
    {
        $validated = $request->validate([
            'title'          => ['required', 'string', 'max:255'],
            'description'    => ['nullable', 'string'],
            'media_type'     => ['required', 'string', 'in:teaser,render,screenshot,artwork,other'],
            'published_date' => ['nullable', 'date'],
            'image'          => ['nullable', 'image', 'max:8192'],
            'active'         => ['nullable', 'boolean'],
            'order'          => ['nullable', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($developerMedium->image);
            $validated['image'] = $request->file('image')->store('developer_media', 'public');
        }

        $validated['active'] = $request->boolean('active');

        $developerMedium->update($validated);

        return redirect()->route('admin.developer-media.index')->with('success', 'Developer media updated.');
    }

    public function destroy(DeveloperMedia $developerMedium): RedirectResponse
    {
        Storage::disk('public')->delete($developerMedium->image);
        $developerMedium->delete();

        return redirect()->route('admin.developer-media.index')->with('success', 'Developer media deleted.');
    }
}
