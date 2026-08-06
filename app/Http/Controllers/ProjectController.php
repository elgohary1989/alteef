<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sector;
use App\Models\SiteSetting;

class ProjectController extends Controller
{
    public function index()
    {
        return view('portfolio.index', [
            'settings' => SiteSetting::instance(),
            'projects' => Project::active()->get(),
            'sectors' => Sector::active()->get(),
        ]);
    }

    public function show($locale, $project)
    {
        $project = Project::where('slug', $project)->firstOrFail();

        return view('portfolio.show', [
            'settings' => SiteSetting::instance(),
            'project'  => $project,
        ]);
    }
}
