@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();

        $relatedProjects = \App\Models\Project::where('id', '!=', $project->id)
            ->where('sector_id', $project->sector_id)
            ->active()
            ->take(3)
            ->get();
    @endphp

    {{-- =========================================
    Hero
    ========================================= --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-black">

        {{-- Glow --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-[520px] h-[520px] bg-orange-500/10 rounded-full blur-[140px]"></div>
            <div class="absolute bottom-0 left-0 w-[420px] h-[420px] bg-white/5 rounded-full blur-[120px]"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                {{-- LEFT --}}
                <div>

                    @if($project->sector)

                        <span
                            class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 text-orange-400 font-semibold mb-6">

                        <svg class="w-5 h-5"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 13l4 4L19 7"/>

                        </svg>

                        {{ $project->sector->trans('title') }}

                    </span>

                    @endif

                    <h1 class="text-5xl lg:text-6xl font-black leading-tight mb-6">

                        {{ $project->trans('title') }}

                    </h1>

                    <p class="text-lg text-slate-300 leading-9">

                        {{ $project->trans('summary') }}

                    </p>

                    <div class="flex flex-wrap gap-4 mt-10">

                        @if($project->project_url)

                            <a href="{{ $project->project_url }}"
                               target="_blank"
                               class="inline-flex items-center gap-3 bg-orange-500 hover:bg-orange-600 px-8 py-4 rounded-xl font-bold transition">

                                {{ $locale=='ar'
                                    ? 'زيارة المشروع'
                                    : 'Visit Website' }}

                            </a>

                        @endif

                        <a href="{{ route('contact.index',['locale'=>$locale]) }}"
                           class="inline-flex items-center gap-3 border border-white/20 hover:bg-white/10 px-8 py-4 rounded-xl font-bold transition">

                            {{ $locale=='ar'
                                ? 'اطلب مشروعاً مشابهاً'
                                : 'Request Similar Project' }}

                        </a>

                    </div>

                </div>

                {{-- RIGHT IMAGE --}}
                <div>

                    @if($project->cover_image)

                        <img
                            src="{{ asset('storage/'.$project->cover_image) }}"
                            alt="{{ $project->trans('title') }}"
                            class="w-full h-[520px] object-cover rounded-[36px] shadow-2xl">

                    @else

                        <div
                            class="w-full h-[520px] rounded-[36px] bg-slate-700 flex items-center justify-center">

                            <svg class="w-20 h-20 text-slate-500"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.5"
                                      d="M4 16l4-4 4 4 8-8"/>

                            </svg>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </section>

    {{-- =========================================
    Project Info
    ========================================= --}}
    <section class="bg-slate-50 py-16">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 xl:grid-cols-4 gap-8">

                {{-- Client --}}
                <div
                    class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition p-8">

                    <div class="text-orange-500 text-sm font-bold uppercase">

                        {{ $locale=='ar' ? 'العميل' : 'Client' }}

                    </div>

                    <div class="text-2xl font-black mt-4 text-slate-900">

                        {{ $project->client_name ?: '-' }}

                    </div>

                </div>

                {{-- Sector --}}
                <div
                    class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition p-8">

                    <div class="text-orange-500 text-sm font-bold uppercase">

                        {{ $locale=='ar' ? 'القطاع' : 'Sector' }}

                    </div>

                    <div class="text-2xl font-black mt-4 text-slate-900">

                        {{ $project->sector?->trans('title') }}

                    </div>

                </div>

                {{-- Year --}}
                <div
                    class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition p-8">

                    <div class="text-orange-500 text-sm font-bold uppercase">

                        {{ $locale=='ar' ? 'السنة' : 'Year' }}

                    </div>

                    <div class="text-2xl font-black mt-4 text-slate-900">

                        {{ $project->project_year ?: '-' }}

                    </div>

                </div>

                {{-- Type --}}
                <div
                    class="bg-white rounded-3xl border border-slate-200 shadow-sm hover:shadow-xl transition p-8">

                    <div class="text-orange-500 text-sm font-bold uppercase">

                        {{ $locale=='ar'
                            ? 'نوع المشروع'
                            : 'Project Type' }}

                    </div>

                    <div class="text-2xl font-black mt-4 text-slate-900">

                        {{ $project->project_type ?: '-' }}

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- =========================================
    Overview
    ========================================= --}}
    <section class="py-24 bg-white">

        <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-[36px] shadow-xl border border-slate-200 p-10 lg:p-14">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar'
                    ? 'نبذة عن المشروع'
                    : 'PROJECT OVERVIEW' }}

            </span>

                <h2 class="text-4xl font-black text-slate-900 mt-4 mb-10">

                    {{ $project->trans('title') }}

                </h2>

                <div class="prose prose-lg max-w-none prose-headings:text-slate-900 prose-p:text-slate-700">

                    {!! $project->trans('content') !!}

                </div>

            </div>

        </div>

    </section>
    {{-- =========================================
Core Modules
========================================= --}}
    @if(!empty($project->modules))

        <section class="py-24 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar'
                    ? 'الوحدات الأساسية'
                    : 'CORE MODULES' }}

            </span>

                    <h2 class="text-4xl font-black text-slate-900 mt-4">

                        {{ $locale=='ar'
                            ? 'مكونات المشروع'
                            : 'Project Components' }}

                    </h2>

                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

                    @foreach($project->modules as $module)

                        <div class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200 hover:border-orange-300 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

                            <div class="absolute -top-20 -right-20 w-48 h-48 rounded-full bg-orange-100 blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>

                            <div class="relative p-8">

                                @if(!empty($module['icon']))

                                    <div class="w-20 h-20 rounded-2xl bg-orange-100 flex items-center justify-center mb-6 group-hover:bg-orange-500 transition">

                                        <img
                                            src="{{ asset('storage/'.$module['icon']) }}"
                                            class="w-10 h-10 object-contain">

                                    </div>

                                @endif

                                <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-orange-500 transition">

                                    {{ $locale=='ar'
                                        ? $module['title_ar']
                                        : $module['title_en'] }}

                                </h3>

                                <p class="text-slate-600 leading-8">

                                    {{ $locale=='ar'
                                        ? $module['description_ar']
                                        : $module['description_en'] }}

                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =========================================
    Gallery
    ========================================= --}}
    @if(!empty($project->gallery) && count($project->gallery))

        <section class="py-24 bg-white">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar'
                    ? 'معرض الصور'
                    : 'PROJECT GALLERY' }}

            </span>

                    <h2 class="text-4xl font-black text-slate-900 mt-4">

                        {{ $locale=='ar'
                            ? 'صور المشروع'
                            : 'Gallery' }}

                    </h2>

                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

                    @foreach($project->gallery as $image)

                        <div class="group overflow-hidden rounded-3xl shadow-lg">

                            <img
                                src="{{ asset('storage/'.$image) }}"
                                alt="{{ $project->trans('title') }}"
                                class="w-full h-80 object-cover transition duration-700 group-hover:scale-110">

                        </div>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =========================================
    Related Projects
    ========================================= --}}
    @if($relatedProjects->count())

        <section class="py-24 bg-slate-50">

            <div class="max-w-7xl mx-auto px-6">

                <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar'
                    ? 'مشاريع مشابهة'
                    : 'RELATED PROJECTS' }}

            </span>

                    <h2 class="text-4xl font-black text-slate-900 mt-4">

                        {{ $locale=='ar'
                            ? 'قد يعجبك أيضاً'
                            : 'You May Also Like' }}

                    </h2>

                </div>

                <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

                    @foreach($relatedProjects as $item)

                        <a href="{{ route('portfolio.show',[
                    'locale'=>$locale,
                    'project'=>$item->slug
                ]) }}"
                           class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200 hover:border-orange-300 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

                            <div class="absolute -top-20 -right-20 w-48 h-48 rounded-full bg-orange-100 blur-3xl opacity-0 group-hover:opacity-100 transition"></div>

                            @if($item->cover_image)

                                <div class="overflow-hidden">

                                    <img
                                        src="{{ asset('storage/'.$item->cover_image) }}"
                                        class="w-full h-72 object-cover group-hover:scale-110 transition duration-700">

                                </div>

                            @endif

                            <div class="relative p-8">

                                @if($item->sector)

                                    <span class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-xs font-bold mb-4">

                                {{ $item->sector->trans('title') }}

                            </span>

                                @endif

                                <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-orange-500 transition">

                                    {{ $item->trans('title') }}

                                </h3>

                                <p class="text-slate-600 leading-8 line-clamp-3">

                                    {{ $item->trans('summary') }}

                                </p>

                                <div class="flex items-center justify-between border-t border-slate-100 pt-5 mt-8">

                            <span class="font-bold text-orange-500">

                                {{ $locale=='ar'
                                    ? 'عرض المشروع'
                                    : 'View Project' }}

                            </span>

                                    <svg class="w-5 h-5 text-orange-500 group-hover:translate-x-2 transition"
                                         fill="none"
                                         stroke="currentColor"
                                         viewBox="0 0 24 24">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>

                                    </svg>

                                </div>

                            </div>

                        </a>

                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- =========================================
    CTA
    ========================================= --}}
    <section class="py-24 bg-slate-900">

        <div class="max-w-5xl mx-auto px-6">

            <div class="rounded-[32px] bg-gradient-to-r from-orange-500 to-orange-600 p-14 text-center shadow-2xl">

                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">

                    {{ $locale=='ar'
                        ? 'هل لديك مشروع مشابه؟'
                        : 'Have a Similar Project?' }}

                </h2>

                <p class="text-orange-100 text-lg mb-10 max-w-2xl mx-auto">

                    {{ $locale=='ar'
                        ? 'يسعدنا تنفيذ مشروعك بنفس الجودة والاحترافية. تواصل معنا الآن.'
                        : 'Let us build your next successful project.' }}

                </p>

                <a href="{{ route('contact.index',['locale'=>$locale]) }}"
                   class="inline-flex items-center gap-3 bg-white text-orange-600 px-8 py-4 rounded-xl font-bold hover:bg-slate-100 transition">

                    {{ $locale=='ar'
                        ? 'اطلب عرض سعر'
                        : 'Request Quote' }}

                    <svg class="w-5 h-5"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M13 7l5 5m0 0l-5 5m5-5H6"/>

                    </svg>

                </a>

            </div>

        </div>

    </section>

@endsection
