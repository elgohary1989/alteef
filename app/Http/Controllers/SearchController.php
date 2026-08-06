<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Sector;
use App\Models\Post;
use App\Models\Portfolio;

class SearchController extends Controller
{


    public function index(Request $request)
    {
        $locale = app()->getLocale();

        $q = trim($request->get('q', ''));
        $type = $request->get('type', 'all');

        $services = collect();
        $posts = collect();
        $portfolio = collect();
        $sectors = collect();

        if ($q != '') {

            /*
            |----------------------------------
            | Services
            |----------------------------------
            */
            if ($type == 'all' || $type == 'services') {

                $services = Service::query()

                    ->when($locale == 'ar', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_ar', 'like', "%{$q}%")
                                ->orWhere('summary_ar', 'like', "%{$q}%")
                                ->orWhere('content_ar', 'like', "%{$q}%");

                        });

                    })

                    ->when($locale == 'en', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_en', 'like', "%{$q}%")
                                ->orWhere('summary_en', 'like', "%{$q}%")
                                ->orWhere('content_en', 'like', "%{$q}%");

                        });

                    })

                    ->get();
            }

            /*
            |----------------------------------
            | Blog
            |----------------------------------
            */
            if ($type == 'all' || $type == 'posts') {

                $posts = Post::query()

                    ->when($locale == 'ar', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_ar', 'like', "%{$q}%")
                                ->orWhere('excerpt_ar', 'like', "%{$q}%")
                                ->orWhere('content_ar', 'like', "%{$q}%");

                        });

                    })

                    ->when($locale == 'en', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_en', 'like', "%{$q}%")
                                ->orWhere('excerpt_en', 'like', "%{$q}%")
                                ->orWhere('content_en', 'like', "%{$q}%");

                        });

                    })

                    ->get();
            }

            /*
            |----------------------------------
            | Portfolio
            |----------------------------------
            */
            if ($type == 'all' || $type == 'portfolio') {

                $portfolio = Project::query()

                    ->when($locale == 'ar', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_ar', 'like', "%{$q}%")
                                ->orWhere('summary_ar', 'like', "%{$q}%");

                        });

                    })

                    ->when($locale == 'en', function ($query) use ($q) {

                        $query->where(function ($q2) use ($q) {

                            $q2->where('title_en', 'like', "%{$q}%")
                                ->orWhere('summary_en', 'like', "%{$q}%");

                        });

                    })

                    ->get();
            }

            /*
            |----------------------------------
            | Sectors
            |----------------------------------
            */
            $sectors = Sector::query()

                ->when($locale == 'ar', function ($query) use ($q) {

                    $query->where('title_ar', 'like', "%{$q}%");

                })

                ->when($locale == 'en', function ($query) use ($q) {

                    $query->where('title_en', 'like', "%{$q}%");

                })

                ->get();
        }

        return view('search.index', compact(
            'q',
            'type',
            'services',
            'posts',
            'portfolio',
            'sectors'
        ));
    }

}
