<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\SiteSetting;

class ServiceController extends Controller
{
    public function index()
    {
        return view('services.index', [
            'settings' => SiteSetting::instance(),
            'services' => Service::active()->get(),
        ]);
    }

    public function show($locale, Service $service)
    {
        return view('services.show', [
            'settings' => SiteSetting::instance(),
            'service' => $service,
        ]);
    }
}
