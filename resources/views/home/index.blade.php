@extends('layouts.app')

@section('content')
    @php $locale = app()->getLocale(); @endphp


    {{-- ================= HERO ================= --}}
    @php
        $slide = $slides->first();
    @endphp

    @if($slides->count())

        <section class="sk-hero-slider">

            <div class="swiper heroSwiper">

                <div class="swiper-wrapper">

                    @foreach($slides as $slide)

                        @php
                            $title = $slide->trans('title');

                            $highlight = app()->getLocale() == 'ar'
                                ? $slide->highlight_word_ar
                                : $slide->highlight_word_en;

                            if ($highlight) {
                                $title = str_replace(
                                    $highlight,
                                    '<span class="hero-highlight">'.$highlight.'</span>',
                                    $title
                                );
                            }

                            $primaryText = app()->getLocale() == 'ar'
                                ? $slide->button_text_ar
                                : $slide->button_text_en;

                            $secondaryText = app()->getLocale() == 'ar'
                                ? $slide->secondary_button_text_ar
                                : $slide->secondary_button_text_en;
                        @endphp

                        <div class="swiper-slide">

                            <div class="sk-hero"
                                 style="background-image:url('{{ asset('storage/'.$slide->image) }}')">
                                <div class="sk-container">

                                    <div
                                        class="sk-hero-content"
                                        data-aos="fade-up"
                                        data-aos-duration="1200">

                                        @if($slide->trans('eyebrow'))
                                            <div class="sk-badge">
                                                {{ $slide->trans('eyebrow') }}
                                            </div>
                                        @endif

                                        <h1 class="sk-hero-title">
                                            {!! $title !!}
                                        </h1>

                                        @if($slide->trans('subtitle'))
                                            <p class="sk-hero-desc">
                                                {{ $slide->trans('subtitle') }}
                                            </p>
                                        @endif

                                        <div class="sk-hero-actions">

                                            @if($primaryText)
                                                <a href="{{ $slide->button_link }}"
                                                   class="sk-btn-primary">
                                                    {{ $primaryText }}
                                                </a>
                                            @endif

                                            @if($secondaryText)
                                                <a href="{{ $slide->secondary_button_link }}"
                                                   class="sk-btn-secondary">
                                                    {{ $secondaryText }}
                                                </a>
                                            @endif

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

                <!-- Pagination -->
                <div class="swiper-pagination"></div>

                <!-- Navigation -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>

            </div>

        </section>

    @endif





    {{-- ===== الخدمات ===== --}}
    @if($services->count())
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="max-w-3xl mx-auto text-center mb-16">
                    <div class="section-eyebrow text-center">
                        {{ $locale == 'ar' ? 'خدماتنا' : 'Our services' }}
                    </div>
                    <h2 class="text-3xl md:text-4xl font-extrabold">{{ $locale === 'ar' ? 'حلول هندسية وصناعية متكاملة' : 'Complete solutions for your business' }}</h2>
                </div>
                <div class="grid md:grid-cols-2 gap-6">

                    @foreach($services as $service)

                        <a
                            href="{{ route('services.show', ['locale'=>$locale,'service'=>$service->slug]) }}"
                            class="service-card group relative overflow-hidden bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

                            <div class="w-16 h-16 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">

                                @svg($service->icon ?: 'heroicon-o-squares-2x2','w-8 h-8')

                            </div>

                            <h3 class="text-xl font-bold mb-4 group-hover:text-orange-500 transition">
                                {{ $service->trans('title') }}
                            </h3>

                            <p class="text-slate-500 leading-8">
                                {{ $service->trans('summary') }}
                            </p>

                        </a>

                    @endforeach

                </div>
            </div>
        </section>
    @endif
    @if($stats->count())

        <div class="sk-hero-stats">

            @foreach($stats->take(4) as $stat)

                <div class="sk-hero-stat">

                    <strong>

                        {{ $stat->number }}{{ $stat->suffix }}

                    </strong>

                    <span>

                                {{ $stat->trans('label') }}

                            </span>

                </div>

            @endforeach

        </div>

    @endif
    {{-- ================= OUR CLIENTS ================= --}}
    @if($clients->count())

        <section class="py-24 bg-white overflow-hidden"
                 data-aos="fade-up">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar'
                    ? 'عملاؤنا'
                    : 'OUR CLIENTS' }}

            </span>

                    <h2 class="text-4xl font-black text-slate-900 mt-4">

                        {{ $locale=='ar'
                            ? 'شركاء النجاح'
                            : 'Trusted By Leading Companies' }}

                    </h2>

                </div>

            </div>

            <div class="clients-marquee">

                <div class="clients-track">

                    @foreach($clients as $client)

                        <div class="client-item">

                            @if($client->url)
                                <a href="{{ $client->url }}" target="_blank">
                                    @endif

                                    <img
                                        src="{{ asset('storage/'.$client->logo) }}"
                                        alt="{{ $client->name }}">

                                    @if($client->url)
                                </a>
                            @endif

                        </div>

                    @endforeach


                    {{-- تكرار مرة ثانية للحركة اللانهائية --}}

                    @foreach($clients as $client)

                        <div class="client-item">

                            @if($client->url)
                                <a href="{{ $client->url }}" target="_blank">
                                    @endif

                                    <img
                                        src="{{ asset('storage/'.$client->logo) }}"
                                        alt="{{ $client->name }}">

                                    @if($client->url)
                                </a>
                            @endif

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif
    {{--


        {{-- ===== شريط إحصائيات إضافي ===== --}}
    @if($stats->count() > 3)
        <section class="bg-ink text-white py-16">
            <div class="max-w-7xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                @foreach($stats as $stat)
                    <div>
                        <div class="font-mono text-4xl font-bold text-signal">{{ $stat->number }}{{ $stat->suffix }}</div>
                        <div class="text-white/60 text-sm mt-2">{{ $stat->trans('label') }}</div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- ===== أعمالنا ===== --}}
    @if($projects->count())

        <section class="py-28 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                {{-- Header --}}
                <div class="max-w-3xl mx-auto text-center mb-16"
                     data-aos="fade-up">

                    <div class="section-eyebrow text-center">
                        {{ $locale == 'ar' ? 'أعمالنا' : 'Portfolio' }}
                    </div>

                    <h2 class="text-4xl md:text-5xl font-black mt-4 mb-5">

                        {{ $locale === 'ar'
                            ? 'مشاريع نفخر بتنفيذها'
                            : 'Projects We Are Proud Of' }}

                    </h2>

                    <p class="text-slate-500 text-lg leading-8">

                        {{ $locale === 'ar'
                            ? 'تعرف على أبرز المشاريع التي قمنا بتنفيذها في مجالات الصناعات الهندسية والهياكل الفولاذية والتصنيع المعدني.'
                            : 'Explore our latest engineering and industrial projects.' }}

                    </p>

                </div>

                {{-- Projects --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($projects as $project)

                        <a
                            href="{{ route('portfolio.show',[
        'locale'=>$locale,
        'project'=>$project->slug
    ]) }}"
                            class="project-card group bg-white rounded-3xl overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                            {{-- الصورة --}}
                            <div class="relative h-64 overflow-hidden bg-gray-100">

                                @if($project->cover_image)

                                    <img
                                        src="{{ asset('storage/'.$project->cover_image) }}"
                                        alt="{{ $project->trans('title') }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700">

                                @else

                                    <div class="w-full h-full flex items-center justify-center bg-slate-100 text-6xl">
                                        🏗️
                                    </div>

                                @endif

                            </div>

                            {{-- المحتوى --}}
                            <div class="p-6">

                                @if($project->sector)

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-xs font-bold mb-4">

                        {{ $project->sector->trans('title') }}

                    </span>

                                @endif

                                <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-orange-500 transition">

                                    {{ $project->trans('title') }}

                                </h3>

                                @if($project->trans('excerpt'))

                                    <p class="text-slate-500 text-sm leading-7 mb-6">

                                        {{ \Illuminate\Support\Str::limit($project->trans('excerpt'), 120) }}

                                    </p>

                                @endif

                                <div class="flex items-center justify-between pt-4 border-t border-slate-100">

                    <span class="text-orange-500 font-semibold">

                        {{ $locale == 'ar'
                            ? 'عرض المشروع'
                            : 'View Project' }}

                    </span>

                                    <svg
                                        class="w-5 h-5 text-orange-500 group-hover:translate-x-1 transition"
                                        fill="none"
                                        stroke="currentColor"
                                        viewBox="0 0 24 24">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6"/>

                                    </svg>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

                {{-- View All --}}
                <div class="text-center mt-16">

                    <a href="{{ route('portfolio.index', ['locale' => $locale]) }}"
                       class="inline-flex items-center gap-3 bg-orange-500 hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl transition">

                        {{ $locale == 'ar'
                            ? 'عرض جميع المشاريع'
                            : 'View All Projects' }}

                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>

                    </a>

                </div>

            </div>

        </section>

    @endif

    {{-- ===== آراء العملاء ===== --}}
    @if($testimonials->count())

        <section class="py-28 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="max-w-3xl mx-auto text-center mb-16">

                    <div class="section-eyebrow text-center">
                        {{ $locale == 'ar' ? 'آراء العملاء' : 'Testimonials' }}
                    </div>

                    <h2 class="text-4xl md:text-5xl font-black mt-4 mb-5">
                        {{ $locale == 'ar'
                            ? 'ماذا يقول عملاؤنا'
                            : 'What Our Clients Say' }}
                    </h2>

                    <p class="text-slate-500 text-lg">
                        {{ $locale == 'ar'
                            ? 'نفخر بثقة عملائنا وشركائنا في مختلف القطاعات'
                            : 'Trusted by clients across multiple industries' }}
                    </p>

                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($testimonials->take(6) as $t)

                        <div
                            class="testimonial-card group bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">

                            {{-- Rating --}}
                            <div class="flex items-center mb-6">

                                @for($i = 1; $i <= 5; $i++)

                                    <svg
                                        class="w-5 h-5 text-amber-400"
                                        fill="currentColor"
                                        viewBox="0 0 20 20">

                                        <path d="M9.049.927c.3-.921 1.603-.921 1.902 0l1.562 4.81h5.056c.969 0 1.371 1.24.588 1.81l-4.09 2.972 1.562 4.81c.3.922-.755 1.688-1.539 1.118L10 13.477l-4.09 2.97c-.783.57-1.838-.196-1.539-1.117l1.562-4.81-4.09-2.972c-.783-.57-.38-1.81.588-1.81h5.056L9.05.927z"/>

                                    </svg>

                                @endfor

                            </div>

                            {{-- Content --}}
                            <p class="text-slate-600 leading-8 text-lg mb-8">
                                "{{ $t->trans('content') }}"
                            </p>

                            {{-- Client --}}
                            <div class="flex items-center gap-4 pt-6 border-t border-slate-100">

                                @if($t->avatar)

                                    <img
                                        src="{{ asset('storage/'.$t->avatar) }}"
                                        alt="{{ $t->client_name }}"
                                        class="w-14 h-14 rounded-full object-cover ring-4 ring-orange-100">

                                @else

                                    <div
                                        class="w-14 h-14 rounded-full bg-orange-100 flex items-center justify-center font-bold text-orange-500">

                                        {{ mb_substr($t->client_name, 0, 1) }}

                                    </div>

                                @endif

                                <div>

                                    <h4 class="font-bold text-slate-900">
                                        {{ $t->client_name }}
                                    </h4>

                                    <p class="text-sm text-slate-500">

                                        {{ $t->trans('client_position') }}

                                        @if($t->client_company)
                                            • {{ $t->client_company }}
                                        @endif

                                    </p>

                                </div>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif

    {{-- ===== دعوة للتواصل ===== --}}
    <section class="py-20 bg-amber">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-extrabold text-ink mb-5">
                {{ $locale === 'ar' ? 'جاهز تبدأ مشروعك؟' : 'Ready to start your project?' }}
            </h2>
            <a href="{{ route('contact.index', ['locale'=>$locale]) }}"
               class="inline-block bg-ink text-white font-bold px-8 py-4 rounded-lg hover:bg-black transition">
                {{ $locale === 'ar' ? 'تواصل معنا الآن' : 'Contact us now' }}
            </a>
        </div>
    </section>
@endsection

<script>



        document.addEventListener("DOMContentLoaded", () => {

            const hero = document.querySelector(".sk-hero");
            const dots = document.querySelector(".sk-dot-pattern");

            if (hero && dots) {
                hero.addEventListener("mousemove", (e) => {

                    const rect = hero.getBoundingClientRect();

                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;

                    dots.style.setProperty("--mouse-x", `${x}px`);
                    dots.style.setProperty("--mouse-y", `${y}px`);
                });
            }

        });




</script>
