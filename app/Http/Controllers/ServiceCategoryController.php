<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;

class ServiceCategoryController extends Controller
{
    /**
     * عرض جميع تصنيفات الخدمات
     */
    public function index()
    {
        $categories = ServiceCategory::active()
            ->with([
                'services' => function ($query) {
                    $query->active();
                }
            ])
            ->get();

        return view('services.index', [
            'settings'   => SiteSetting::instance(),
            'categories' => $categories,
        ]);
    }

    /**
     * عرض خدمات تصنيف معين
     */
    public function show($locale, ServiceCategory $category)
    {
        abort_unless($category->is_active, 404);

        $category->load([
            'services' => function ($query) {
                $query->active();
            }
        ]);

        return view('services.category', [
            'settings' => SiteSetting::instance(),
            'category' => $category,
        ]);
    }
}
