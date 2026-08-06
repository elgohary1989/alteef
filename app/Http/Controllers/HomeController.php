<?php

namespace App\Http\Controllers;

use App\Models\ClientLogo;
use App\Models\HeroSlide;
use App\Models\Project;
use App\Models\Sector;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\Stat;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'settings' => SiteSetting::instance(),
            'slides' => HeroSlide::active()->get(),
            'services' => Service::active()->take(6)->get(),
            'sectors' => Sector::active()->get(),
            'clients' => ClientLogo::active()->get(),
            'stats' => Stat::ordered()->get(),
            'projects' => Project::active()->where('is_featured', true)->take(6)->get(),
            'testimonials' => Testimonial::active()->get(),
        ]);
    }
}
