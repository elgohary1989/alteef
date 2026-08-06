@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    {{-- HERO --}}
    <section class="relative overflow-hidden bg-ink text-white">

        <div class="absolute inset-0 opacity-20">
            @if($service->hero_image)
                {{ asset('storage/'.$service->hero_image) }}trans('title') }}"
                class="w-full h-full object-cover">
            @elseif($service->image)
                image) }}"
                alt="{{ $service->trans('title') }}"
                class="w-full h-full object-cover">
            @endif
        </div>

        <div class="absolute inset-0 bg-gradient-to-r from-ink via-ink/90 to-ink/70"></div>

        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="grid lg:grid-cols-2 gap-12 items-center">

                <div>

                    @if($service->category)
                        <div class="eyebrow text-signal text-xs mb-4">
                            {{ $service->category->trans('name') }}
                        </div>
                    @endif

                    <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
                        {{ $service->hero_title ?? $service->trans('title') }}
                    </h1>

                    <p class="text-lg md:text-xl text-white/80 mb-8 leading-relaxed">
                        {{ $service->hero_description ?? $service->trans('summary') }}
                    </p>

                        <div class="flex flex-wrap gap-4">

                            <a href="{{ route('contact.index', ['locale' => $locale]) }}"
                               class="bg-signal text-ink font-bold px-8 py-4 rounded-xl hover:opacity-90 transition">
                                {{ $service->cta_text ?: ($locale == 'ar' ? 'تواصل معنا' : 'Contact Us') }}
                            </a>

                            <a href="{{ route('contact.index', ['locale' => $locale]) }}"
                               class="border border-white/20 px-8 py-4 rounded-xl hover:bg-white hover:text-ink transition">
                                {{ $locale == 'ar' ? 'احجز استشارة' : 'Book Consultation' }}
                            </a>

                        </div>

                </div>

                <div>

                    @if($service->hero_image)

                        hero_image) }}"
                        alt="{{ $service->trans('title') }}"
                        class="w-full rounded-3xl shadow-2xl">

                    @elseif($service->image)

                        image) }}"
                        alt="{{ $service->trans('title') }}"
                        class="w-full rounded-3xl shadow-2xl">

                    @endif

                </div>

            </div>

        </div>

    </section>

    {{-- OVERVIEW --}}
    <section class="py-20">

        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-12">

                <div class="eyebrow text-signal text-xs mb-3">
                    {{ $locale == 'ar' ? 'نبذة عن الخدمة' : 'OVERVIEW' }}
                </div>

                <h2 class="text-4xl font-extrabold">
                    {{ $service->trans('title') }}
                </h2>

            </div>

            <div class="prose prose-lg max-w-none">
                {!! $service->trans('content') !!}
            </div>

        </div>

    </section>

    {{-- FEATURES --}}
    @if(!empty($service->features))

        <section class="bg-slate-50 py-20">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-12">

                    <h2 class="text-4xl font-bold">
                        {{ $locale == 'ar' ? 'المميزات' : 'Features' }}
                    </h2>

                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($service->features as $feature)

                        <div class="bg-white p-8 rounded-2xl shadow-sm border">

                            <h3 class="font-bold text-xl mb-4">
                                {{ $feature['title'] }}
                            </h3>

                            <p class="text-slate-600">
                                {{ $feature['description'] }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

    {{-- BENEFITS --}}
    @if(!empty($service->benefits))

        <section class="py-20">

            <div class="max-w-6xl mx-auto px-6">

                <div class="text-center mb-12">

                    <h2 class="text-4xl font-bold">
                        {{ $locale == 'ar' ? 'الفوائد' : 'Benefits' }}
                    </h2>

                </div>

                <div class="grid md:grid-cols-2 gap-8">

                    @foreach($service->benefits as $benefit)

                        <div class="border rounded-2xl p-8">

                            <h3 class="font-bold text-2xl mb-3">
                                {{ $benefit['title'] }}
                            </h3>

                            <p class="text-slate-600">
                                {{ $benefit['description'] }}
                            </p>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

    {{-- GALLERY --}}
    @if(!empty($service->gallery))

        <section class="bg-slate-50 py-20">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-12">

                    <h2 class="text-4xl font-bold">
                        {{ $locale == 'ar' ? 'معرض الصور' : 'Gallery' }}
                    </h2>

                </div>

                <div class="grid md:grid-cols-3 gap-6">

                    @foreach($service->gallery as $image)

                        }}"
                        alt=""
                        class="rounded-2xl w-full h-80 object-cover shadow-lg">

                    @endforeach

                </div>

            </div>

        </section>

    @endif

    {{-- FAQ --}}
    @if(!empty($service->faqs))

        <section class="py-20">

            <div class="max-w-4xl mx-auto px-6">

                <div class="text-center mb-12">

                    <h2 class="text-4xl font-bold">
                        {{ $locale == 'ar'
                            ? 'الأسئلة الشائعة'
                            : 'Frequently Asked Questions' }}
                    </h2>

                </div>

                <div class="space-y-4">

                    @foreach($service->faqs as $faq)

                        <details class="border rounded-xl p-5">

                            <summary class="cursor-pointer font-bold">
                                {{ $faq['question'] }}
                            </summary>

                            <div class="mt-4 text-slate-600">
                                {{ $faq['answer'] }}
                            </div>

                        </details>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

    {{-- CTA --}}
    <section class="bg-amber py-20">

        <div class="max-w-4xl mx-auto px-6 text-center">

            <h2 class="text-4xl font-extrabold text-ink mb-6">
                {{ $locale == 'ar'
                    ? 'جاهز لتطوير أعمالك؟'
                    : 'Ready To Grow Your Business?' }}
            </h2>

            <p class="text-lg text-ink/70 mb-8">
                {{ $locale == 'ar'
                    ? 'تواصل معنا الآن واحصل على استشارة مجانية.'
                    : 'Contact us today and get a free consultation.' }}
            </p>


            {{ $locale == 'ar'
                ? 'اطلب عرض سعر'
                : 'Request A Quote' }}

            </a>

        </div>

    </section>

@endsection
