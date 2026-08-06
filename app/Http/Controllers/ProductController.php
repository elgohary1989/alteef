<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index($locale = 'ar')
    {
        $products = Product::where('is_active', true)
            ->latest()
            ->paginate(12);


        return view('product.index', compact('products'));
    }

    public function show($locale = 'ar', $product)
    {
        $product = Product::with('images')
            ->where('slug', $product)
            ->where('is_active', true)
            ->firstOrFail();

        return view('product.show', compact('product'));
    }
}
