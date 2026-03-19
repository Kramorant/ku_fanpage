<?php

namespace App\Http\Controllers;

use App\Models\CarouselImage;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $carouselImages = CarouselImage::active()->get();

        return view('home.index', compact('carouselImages'));
    }
}
