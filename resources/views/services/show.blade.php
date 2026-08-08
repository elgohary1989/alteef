@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();
        $isArabic = $locale === 'ar';

        $heroImage = $service->hero_image ?: $service->image;
    @endphp


    {{-- ========================================================= --}}
    {{-- ANIMATION STYLES --}}
    {{-- ========================================================= --}}

    @push('css')

        <style>

            /* =====================================================
               Scroll Reveal
            ===================================================== */

            .service-reveal {
                opacity: 0;
                transform: translateY(45px);
                transition:
                    opacity 0.8s cubic-bezier(.22,1,.36,1),
                    transform 0.8s cubic-bezier(.22,1,.36,1);
                will-change: opacity, transform;
            }

            .service-reveal.is-visible {
                opacity: 1;
                transform: translateY(0);
            }


            .service-reveal-left {
                opacity: 0;
                transform: translateX(-60px);
                transition:
                    opacity 0.9s cubic-bezier(.22,1,.36,1),
                    transform 0.9s cubic-bezier(.22,1,.36,1);
            }

            [dir="rtl"] .service-reveal-left {
                transform: translateX(60px);
            }

            .service-reveal-left.is-visible {
                opacity: 1;
                transform: translateX(0);
            }


            .service-reveal-right {
                opacity: 0;
                transform: translateX(60px);
                transition:
                    opacity 0.9s cubic-bezier(.22,1,.36,1),
                    transform 0.9s cubic-bezier(.22,1,.36,1);
            }

            [dir="rtl"] .service-reveal-right {
                transform: translateX(-60px);
            }

            .service-reveal-right.is-visible {
                opacity: 1;
                transform: translateX(0);
            }


            /* =====================================================
               Hero
            ===================================================== */

            .service-hero-image {
                opacity: 0;
                transform: scale(1.08);
                transition:
                    opacity 1.2s ease,
                    transform 1.4s cubic-bezier(.22,1,.36,1);
            }

            .service-hero-image.loaded {
                opacity: 1;
                transform: scale(1);
            }


            .service-hero-content > * {
                opacity: 0;
                transform: translateY(30px);
                animation: serviceHeroItem .8s cubic-bezier(.22,1,.36,1) forwards;
            }

            .service-hero-content > *:nth-child(1) {
                animation-delay: .1s;
            }

            .service-hero-content > *:nth-child(2) {
                animation-delay: .22s;
            }

            .service-hero-content > *:nth-child(3) {
                animation-delay: .34s;
            }

            .service-hero-content > *:nth-child(4) {
                animation-delay: .46s;
            }

            @keyframes serviceHeroItem {

                to {
                    opacity: 1;
                    transform: translateY(0);
                }

            }


            /* =====================================================
               Stagger Cards
            ===================================================== */

            .service-stagger {
                opacity: 0;
                transform: translateY(35px) scale(.97);
                transition:
                    opacity .7s cubic-bezier(.22,1,.36,1),
                    transform .7s cubic-bezier(.22,1,.36,1);
            }

            .service-stagger.is-visible {
                opacity: 1;
                transform: translateY(0) scale(1);
            }


            /* =====================================================
               Image Hover
            ===================================================== */

            .service-image-wrapper {
                overflow: hidden;
            }

            .service-image-wrapper img {
                transition:
                    transform .8s cubic-bezier(.22,1,.36,1),
                    filter .5s ease;
            }

            .service-image-wrapper:hover img {
                transform: scale(1.06);
            }


            /* =====================================================
               Card Hover
            ===================================================== */

            .service-card {
                transition:
                    transform .5s cubic-bezier(.22,1,.36,1),
                    box-shadow .5s ease,
                    border-color .5s ease;
            }

            .service-card:hover {
                transform: translateY(-8px);
            }


            /* =====================================================
               FAQ
            ===================================================== */

            .service-faq-content {
                display: grid;
                grid-template-rows: 0fr;
                transition: grid-template-rows .4s ease;
            }

            .service-faq-content > div {
                overflow: hidden;
            }

            details[open] .service-faq-content {
                grid-template-rows: 1fr;
            }

            .service-faq-icon {
                transition: transform .4s ease;
            }

            details[open] .service-faq-icon {
                transform: rotate(45deg);
            }


            /* =====================================================
               CTA Animation
            ===================================================== */

            .service-cta-decoration {
                animation: serviceFloat 7s ease-in-out infinite;
            }

            @keyframes serviceFloat {

                0%,
                100% {
                    transform: translate3d(0, 0, 0) scale(1);
                }

                50% {
                    transform: translate3d(0, -20px, 0) scale(1.05);
                }

            }


            /* =====================================================
               Accessibility
            ===================================================== */

            @media (prefers-reduced-motion: reduce) {

                .service-reveal,
                .service-reveal-left,
                .service-reveal-right,
                .service-stagger,
                .service-hero-image,
                .service-hero-content > * {
                    opacity: 1 !important;
                    transform: none !important;
                    animation: none !important;
                    transition: none !important;
                }

                .service-cta-decoration {
                    animation: none !important;
                }

            }

        </style>

    @endpush



    {{-- ========================================================= --}}
    {{-- HERO --}}
    {{-- ========================================================= --}}

    <section class="relative overflow-hidden bg-ink text-white">

        {{-- Background --}}
        @if($heroImage)

            <div class="absolute inset-0">

                <img
                    src="{{ asset('storage/' . $heroImage) }}"
                    alt="{{ $service->trans('title') }}"
                    class="w-full h-full object-cover opacity-30">

            </div>

            <div class="absolute inset-0 bg-ink/85"></div>

            <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/90 to-ink/70"></div>

        @endif


        {{-- Decorative Elements --}}
        <div
            class="absolute -top-40 -right-40
                   w-[500px] h-[500px]
                   rounded-full
                   bg-signal/10
                   blur-3xl
                   pointer-events-none">
        </div>

        <div
            class="absolute -bottom-40 -left-40
                   w-[500px] h-[500px]
                   rounded-full
                   bg-amber-400/10
                   blur-3xl
                   pointer-events-none">
        </div>


        <div class="relative max-w-7xl mx-auto px-6 py-20 md:py-28">

            <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">


                {{-- HERO CONTENT --}}
                <div class="service-hero-content max-w-3xl">

                    {{-- Category --}}
                    @if($service->category)

                        <div class="section-eyebrow text-signal text-xs mb-5">

                            {{ $service->category->trans('name') }}

                        </div>

                    @endif


                    {{-- Title --}}
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black leading-tight">

                        {{ $service->hero_title ?: $service->trans('title') }}

                    </h1>


                    {{-- Description --}}
                    @if($service->hero_description || $service->trans('summary'))

                        <p class="text-lg md:text-xl text-white/75 leading-9 max-w-2xl">

                            {{ $service->hero_description ?: $service->trans('summary') }}

                        </p>

                    @endif


                    {{-- CTA --}}
                    @if($service->cta_text)

                        <div class="flex flex-wrap gap-4">

                            <a
                                href="{{ route('contact.index', ['locale' => $locale]) }}"
                                class="inline-flex items-center justify-center
                                       bg-signal
                                       text-ink
                                       font-bold
                                       px-8 py-4
                                       rounded-xl
                                       hover:opacity-90
                                       hover:-translate-y-1
                                       transition-all duration-300">

                                {{ $service->cta_text }}

                            </a>

                        </div>

                    @endif

                </div>



                {{-- HERO IMAGE --}}
                @if($heroImage)

                    <div class="service-reveal-right">

                        <div class="relative group">

                            <div
                                class="absolute -inset-3
                                       rounded-[2rem]
                                       bg-signal/20
                                       blur-2xl
                                       opacity-50
                                       group-hover:opacity-80
                                       transition-opacity duration-700">
                            </div>

                            <div
                                class="relative
                                       service-image-wrapper
                                       rounded-[2rem]
                                       overflow-hidden
                                       border border-white/10
                                       shadow-2xl">

                                <img
                                    src="{{ asset('storage/' . $heroImage) }}"
                                    alt="{{ $service->trans('title') }}"
                                    class="service-hero-image
                                           w-full
                                           h-[340px]
                                           md:h-[430px]
                                           object-cover">

                            </div>

                        </div>

                    </div>

                @endif

            </div>

        </div>

    </section>



    {{-- ========================================================= --}}
    {{-- CONTENT / OVERVIEW --}}
    {{-- ========================================================= --}}

    @if($service->trans('content'))

        <section class="py-24 bg-white">

            <div class="max-w-5xl mx-auto px-6">

                <div
                    class="service-reveal
                           prose prose-lg
                           max-w-none
                           prose-headings:font-black
                           prose-headings:text-slate-900
                           prose-p:text-slate-600
                           prose-p:leading-8
                           prose-li:text-slate-600">

                    {!! $service->trans('content') !!}

                </div>

            </div>

        </section>

    @endif



    {{-- ========================================================= --}}
    {{-- FEATURES --}}
    {{-- ========================================================= --}}

    @if(!empty($service->features))

        <section class="py-24 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-7">

                    @foreach($service->features as $index => $feature)

                        <div
                            class="service-stagger
                                   service-card
                                   group
                                   bg-white
                                   rounded-3xl
                                   p-8
                                   border border-slate-100
                                   shadow-sm
                                   hover:shadow-2xl
                                   hover:border-signal/20">

                            <div
                                class="w-12 h-12
                                       rounded-2xl
                                       bg-signal/10
                                       text-signal
                                       flex items-center justify-center
                                       font-black
                                       mb-6
                                       group-hover:bg-signal
                                       group-hover:text-ink
                                       transition-all duration-300">

                                {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                            </div>


                            @if(!empty($feature['title']))

                                <h3 class="font-black text-xl text-slate-900 mb-4">

                                    {{ $feature['title'] }}

                                </h3>

                            @endif


                            @if(!empty($feature['description']))

                                <p class="text-slate-600 leading-8">

                                    {{ $feature['description'] }}

                                </p>

                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif



    {{-- ========================================================= --}}
    {{-- BENEFITS --}}
    {{-- ========================================================= --}}

    @if(!empty($service->benefits))

        <section class="py-24 bg-white">

            <div class="max-w-6xl mx-auto px-6">

                <div class="grid md:grid-cols-2 gap-7">

                    @foreach($service->benefits as $index => $benefit)

                        <div
                            class="service-stagger
                                   service-card
                                   group
                                   p-8
                                   rounded-3xl
                                   border border-slate-100
                                   bg-slate-50
                                   hover:bg-white
                                   hover:shadow-xl">

                            <div class="flex items-start gap-5">

                                <div
                                    class="flex-shrink-0
                                           w-12 h-12
                                           rounded-2xl
                                           bg-amber-100
                                           text-amber-600
                                           flex items-center justify-center
                                           font-black">

                                    {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}

                                </div>


                                <div class="min-w-0">

                                    @if(!empty($benefit['title']))

                                        <h3
                                            class="font-black
                                                   text-xl
                                                   text-slate-900
                                                   mb-3">

                                            {{ $benefit['title'] }}

                                        </h3>

                                    @endif


                                    @if(!empty($benefit['description']))

                                        <p class="text-slate-600 leading-8">

                                            {{ $benefit['description'] }}

                                        </p>

                                    @endif

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif



    {{-- ========================================================= --}}
    {{-- GALLERY --}}
    {{-- ========================================================= --}}

    @if(!empty($service->gallery))

        <section class="py-24 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach($service->gallery as $image)

                        @if(!empty($image))

                            <div
                                class="service-stagger
                                       service-image-wrapper
                                       group
                                       relative
                                       overflow-hidden
                                       rounded-3xl
                                       aspect-[4/3]
                                       bg-white
                                       shadow-sm">

                                <img
                                    src="{{ asset('storage/' . $image) }}"
                                    alt="{{ $service->trans('title') }}"
                                    loading="lazy"
                                    class="w-full h-full object-cover">

                                <div
                                    class="absolute inset-0
                                           bg-gradient-to-t
                                           from-black/40
                                           via-transparent
                                           to-transparent
                                           opacity-0
                                           group-hover:opacity-100
                                           transition-opacity duration-500">
                                </div>

                            </div>

                        @endif

                    @endforeach

                </div>

            </div>

        </section>

    @endif



    {{-- ========================================================= --}}
    {{-- FAQ --}}
    {{-- ========================================================= --}}

    @if(!empty($service->faqs))

        <section class="py-24 bg-white">

            <div class="max-w-4xl mx-auto px-6">

                <div class="space-y-4">

                    @foreach($service->faqs as $faq)

                        <details
                            class="service-stagger
                                   group
                                   border border-slate-200
                                   rounded-2xl
                                   bg-white
                                   overflow-hidden
                                   hover:border-signal/30
                                   transition-colors duration-300">

                            <summary
                                class="cursor-pointer
                                       list-none
                                       p-6
                                       flex items-center justify-between
                                       gap-5
                                       font-black
                                       text-slate-900">

                                <span>

                                    {{ $faq['question'] ?? '' }}

                                </span>


                                <span
                                    class="service-faq-icon
                                           flex-shrink-0
                                           w-9 h-9
                                           rounded-full
                                           bg-slate-100
                                           flex items-center justify-center
                                           text-slate-600">

                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 5v14M5 12h14"/>

                                    </svg>

                                </span>

                            </summary>


                            @if(!empty($faq['answer']))

                                <div class="service-faq-content">

                                    <div>

                                        <div class="px-6 pb-6">

                                            <div
                                                class="pt-5
                                                       border-t
                                                       border-slate-100
                                                       text-slate-600
                                                       leading-8">

                                                {{ $faq['answer'] }}

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif

                        </details>

                    @endforeach

                </div>

            </div>

        </section>

    @endif



    {{-- ========================================================= --}}
    {{-- CTA --}}
    {{-- ========================================================= --}}

    @if($service->cta_text)

        <section class="relative overflow-hidden bg-ink py-24">

            {{-- Decoration --}}
            <div
                class="service-cta-decoration
                       absolute
                       -top-40
                       -right-40
                       w-[500px]
                       h-[500px]
                       rounded-full
                       bg-signal/10
                       blur-3xl
                       pointer-events-none">
            </div>

            <div
                class="service-cta-decoration
                       absolute
                       -bottom-40
                       -left-40
                       w-[450px]
                       h-[450px]
                       rounded-full
                       bg-amber-400/10
                       blur-3xl
                       pointer-events-none"
                style="animation-delay: -3s;">
            </div>


            <div
                class="relative
                       max-w-4xl
                       mx-auto
                       px-6
                       text-center
                       service-reveal">

                <a
                    href="{{ route('contact.index', ['locale' => $locale]) }}"
                    class="inline-flex
                           items-center
                           justify-center
                           bg-signal
                           text-ink
                           font-black
                           px-9 py-4
                           rounded-xl
                           hover:opacity-90
                           hover:-translate-y-1
                           transition-all duration-300">

                    {{ $service->cta_text }}

                </a>

            </div>

        </section>

    @endif

@endsection



{{-- ============================================================= --}}
{{-- ANIMATION SCRIPT --}}
{{-- ============================================================= --}}

@push('script')

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            /*
             * =====================================================
             * Scroll Reveal
             * =====================================================
             */

            const revealElements = document.querySelectorAll(
                '.service-reveal, .service-reveal-left, .service-reveal-right, .service-stagger'
            );


            if ('IntersectionObserver' in window) {

                const observer = new IntersectionObserver(

                    function (entries, observer) {

                        entries.forEach(function (entry) {

                            if (!entry.isIntersecting) {
                                return;
                            }


                            const element = entry.target;


                            /*
                             * Stagger animation
                             */

                            if (element.classList.contains('service-stagger')) {

                                const parent = element.parentElement;

                                const siblings = Array.from(
                                    parent.querySelectorAll('.service-stagger')
                                );

                                const index = siblings.indexOf(element);

                                element.style.transitionDelay =
                                    Math.min(index * 90, 600) + 'ms';

                            }


                            element.classList.add('is-visible');

                            observer.unobserve(element);

                        });

                    },

                    {
                        threshold: 0.12,
                        rootMargin: '0px 0px -60px 0px'
                    }

                );


                revealElements.forEach(function (element) {

                    observer.observe(element);

                });

            } else {

                /*
                 * Fallback for old browsers
                 */

                revealElements.forEach(function (element) {

                    element.classList.add('is-visible');

                });

            }



            /*
             * =====================================================
             * Hero Image
             * =====================================================
             */

            const heroImages = document.querySelectorAll(
                '.service-hero-image'
            );


            heroImages.forEach(function (image) {

                if (image.complete) {

                    requestAnimationFrame(function () {

                        image.classList.add('loaded');

                    });

                } else {

                    image.addEventListener(
                        'load',
                        function () {

                            image.classList.add('loaded');

                        },
                        {
                            once: true
                        }
                    );

                }

            });



            /*
             * =====================================================
             * FAQ
             * =====================================================
             */

            const faqItems = document.querySelectorAll(
                'details.group'
            );


            faqItems.forEach(function (item) {

                item.addEventListener('toggle', function () {

                    if (!item.open) {
                        return;
                    }


                    faqItems.forEach(function (otherItem) {

                        if (
                            otherItem !== item &&
                            otherItem.open
                        ) {

                            otherItem.removeAttribute('open');

                        }

                    });

                });

            });

        });

    </script>

@endpush
