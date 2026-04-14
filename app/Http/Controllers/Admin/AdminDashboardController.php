<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\CarouselImage;
use App\Models\CommunityCreation;
use App\Models\DeveloperMedia;
use App\Models\Event;
use App\Models\Kaiju;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'kaijuCount'      => Kaiju::count(),
            'eventCount'      => Event::count(),
            'blogCount'       => BlogPost::count(),
            'carouselCount'   => CarouselImage::count(),
            'communityCount'  => CommunityCreation::count(),
            'developerCount'  => DeveloperMedia::count(),
        ]);
    }
}
