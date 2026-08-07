<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;

class AboutController extends Controller
{
    public function index()
    {
        $about = AboutUs::with([
            'features',
            'values',
            'timelines'
        ])->firstOrFail();

        return view('about/index', compact('about'));
    }
}
