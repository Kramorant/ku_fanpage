<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarouselImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCarouselController extends Controller
{
    public function index(): View
    {
        $images = CarouselImage::orderBy('order')->get();

        return view('admin.carousel.index', compact('images'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image_path' => ['required', 'image', 'max:4096'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'order'      => ['nullable', 'integer'],
        ]);

        $path = $request->file('image_path')->store('carousel', 'public');

        CarouselImage::create([
            'image_path' => $path,
            'caption'    => $request->input('caption'),
            'order'      => $request->input('order', 0),
            'active'     => true,
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Image uploaded.');
    }

    public function update(Request $request, CarouselImage $carousel): RedirectResponse
    {
        $request->validate([
            'order'  => ['nullable', 'integer'],
            'active' => ['nullable', 'boolean'],
        ]);

        $carousel->update([
            'order'  => $request->input('order', $carousel->order),
            'active' => $request->boolean('active'),
        ]);

        return redirect()->route('admin.carousel.index')->with('success', 'Carousel image updated.');
    }

    public function destroy(CarouselImage $carousel): RedirectResponse
    {
        Storage::disk('public')->delete($carousel->image_path);
        $carousel->delete();

        return redirect()->route('admin.carousel.index')->with('success', 'Image deleted.');
    }

    // Required by resource but not used
    public function create(): View
    {
        return view('admin.carousel.index', ['images' => CarouselImage::orderBy('order')->get()]);
    }

    public function show(CarouselImage $carousel): RedirectResponse
    {
        return redirect()->route('admin.carousel.index');
    }

    public function edit(CarouselImage $carousel): RedirectResponse
    {
        return redirect()->route('admin.carousel.index');
    }
}
