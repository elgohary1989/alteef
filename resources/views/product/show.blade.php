@extends('layouts.app')

@section('content')

    <section class="bg-gray-50 py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-12 items-start">

                {{-- الصور --}}
                <div>

                    <div class="bg-white rounded-2xl overflow-hidden shadow-lg">

                        @if($product->featured_image)

                            <img
                                id="mainImage"
                                src="{{ asset('storage/'.$product->featured_image) }}"
                                alt="{{ app()->getLocale() == 'ar' ? $product->name_ar : $product->name_en }}"
                                class="w-full h-[520px] object-cover cursor-zoom-in">

                        @else

                            <div class="w-full h-[520px] bg-gray-100 flex items-center justify-center text-6xl">
                                📦
                            </div>

                        @endif

                    </div>

                    {{-- معرض الصور --}}
                    @if($product->images && $product->images->count())

                        <div class="grid grid-cols-4 gap-4 mt-5">

                            @foreach($product->images as $image)

                                <img
                                    src="{{ asset('storage/'.$image->image) }}"
                                    class="gallery-image h-24 w-full object-cover rounded-xl border cursor-pointer hover:opacity-80 transition"
                                    onclick="changeImage(this.src)"
                                    alt="Gallery">

                            @endforeach

                        </div>

                    @endif

                </div>

                {{-- التفاصيل --}}
                <div>

                    <h1 class="text-4xl font-bold text-gray-900 mb-6">

                        {{ app()->getLocale() == 'ar'
                            ? $product->name_ar
                            : $product->name_en }}

                    </h1>

                    @if($product->price)

                        <div class="text-3xl font-bold text-orange-500 mb-6">

                            {{ number_format($product->price,2) }}

                        </div>

                    @endif

                    <div
                        class="product-description"
                        dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

                        {!! app()->getLocale() == 'ar'
                            ? $product->description_ar
                            : $product->description_en !!}

                    </div>

                    <div class="mt-10 flex gap-4">

                        <a href="{{ route('contact.index', ['locale' => app()->getLocale()]) }}"
                           class="inline-flex items-center bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-bold transition">

                            {{ app()->getLocale() == 'ar'
                                ? 'اطلب عرض سعر'
                                : 'Request Quote' }}

                        </a>

                        <a href="{{ route('products.index', ['locale' => app()->getLocale()]) }}"
                           class="inline-flex items-center border border-gray-300 hover:border-orange-500 hover:text-orange-500 px-8 py-4 rounded-xl font-semibold transition">

                            {{ app()->getLocale() == 'ar'
                                ? 'رجوع'
                                : 'Back' }}

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- Lightbox --}}
    <div id="lightbox"
         class="hidden fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-6">

        <button
            onclick="closeLightbox()"
            class="absolute top-5 right-8 text-white text-5xl">
            ×
        </button>

        <img
            id="lightboxImage"
            src=""
            class="max-w-[90%] max-h-[90%] rounded-xl shadow-2xl">

    </div>

@endsection

@push('scripts')

    <script>

        function changeImage(src)
        {
            document.getElementById('mainImage').src = src;
        }

        document.addEventListener("DOMContentLoaded", function () {

            document.getElementById('mainImage')?.addEventListener('click', function () {

                document.getElementById('lightboxImage').src = this.src;

                document.getElementById('lightbox').classList.remove('hidden');

            });

            document.querySelectorAll('.gallery-image').forEach(function(image){

                image.addEventListener('click', function(){

                    document.getElementById('lightboxImage').src = this.src;

                });

            });

        });

        function closeLightbox()
        {
            document.getElementById('lightbox').classList.add('hidden');
        }

        document.getElementById('lightbox').addEventListener('click', function(e){

            if(e.target === this){
                closeLightbox();
            }

        });

    </script>

@endpush
