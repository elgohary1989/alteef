<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        URL::forceScheme('https');
        View::composer('*', function ($view) {

            $view->with(
                'serviceCategories',
                ServiceCategory::with('services')
                    ->orderBy('order')
                    ->get()
            );
            View::share('services', Service::active()->get());
            $view->with(
                'settings',
                SiteSetting::first()
            );
            $view->with(
                'headerProducts',
                Product::where('is_active', true)
                    ->latest()
                    ->take(10)
                    ->get()
            );

        });
    }
}
