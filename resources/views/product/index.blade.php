@extends('layouts.app')

@section('content')

    <section class="py-16 bg-gray-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900">
                    {{ app()->getLocale() == 'ar' ? 'منتجاتنا' : 'Our Products' }}
                </h1>

                <p class="mt-4 text-gray-500 text-lg">
                    {{ app()->getLocale() == 'ar'
                        ? 'اكتشف أحدث منتجاتنا وحلولنا'
                        : 'Discover our latest products and solutions' }}
                </p>

            </div>

            @if($products->count())

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($products as $product)

                        <div class="bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition duration-300 group">

                            @if($product->featured_image)

                                <img
                                    src="{{ asset('storage/'.$product->featured_image) }}"
                                    alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                    class="w-full h-64 object-cover group-hover:scale-105 transition duration-500">

                            @else

                                <div class="w-full h-64 bg-gray-100 flex items-center justify-center text-5xl">
                                    📦
                                </div>

                            @endif

                            <div class="p-6">

                                <h3 class="text-2xl font-bold text-gray-900 mb-3">

                                    {{ app()->getLocale() == 'ar'
                                        ? $product->name_ar
                                        : $product->name_en }}

                                </h3>

                                @if($product->short_description_ar || $product->short_description_en)

                                    <p class="text-gray-600 mb-5 line-clamp-3">

                                        {{ app()->getLocale() == 'ar'
                                            ? $product->short_description_ar
                                            : $product->short_description_en }}

                                    </p>

                                @endif

                                <a href="{{ route('products.show', [
                                    'locale' => app()->getLocale(),
                                    'product' => $product->slug,
                                ]) }}"
                                   class="inline-flex items-center px-5 py-3 rounded-xl bg-orange-500 hover:bg-orange-600 text-white font-semibold transition">

                                    {{ app()->getLocale() == 'ar'
                                        ? 'عرض التفاصيل'
                                        : 'View Details' }}

                                </a>

                            </div>

                        </div>

                    @endforeach

                </div>



            @else

                <div class="text-center py-20">

                    <div class="text-6xl mb-4">📦</div>

                    <h2 class="text-2xl font-bold text-gray-700">

                        {{ app()->getLocale() == 'ar'
                            ? 'لا توجد منتجات حالياً'
                            : 'No products available' }}

                    </h2>

                </div>

            @endif

        </div>

    </section>

@endsection
