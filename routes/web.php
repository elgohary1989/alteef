<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

// افتراضي: تحويل الزائر للغة المحفوظة في السيشن أو العربي كلغة أساسية
Route::get('/', function () {
    return redirect('/' . (session('locale', 'ar')));
});



Route::prefix('{locale}')->middleware(['setlocale'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/search', [SearchController::class, 'index'])
        ->name('search');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show');


    Route::get('/about', [AboutController::class, 'index'])
        ->name('about');

    Route::get('/products', [ProductController::class, 'index'])
        ->name('products.index');

    Route::get('/products/{product}', [ProductController::class, 'show'])
        ->name('products.show');
    Route::get('/portfolio', [ProjectController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/{project:slug}', [ProjectController::class, 'show'])
        ->name('portfolio.show');

    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    Route::get('/blog', [BlogController::class,'index'])
        ->name('blog.index');


    Route::get('/blog/{post}', [BlogController::class, 'show'])
        ->name('blog.show');


});
