@extends('layouts.app')

@section('content')

    @php
        use Illuminate\Support\Str;

        $locale = app()->getLocale();

        $totalResults =
            $services->count() +
            $posts->count() +
            $portfolio->count();
    @endphp

    {{-- Search Header --}}
    <section class="bg-slate-50 border-b py-10">

        <div class="max-w-4xl mx-auto px-6">

            <form action="{{ route('search', ['locale' => $locale]) }}" method="GET">

                <div class="relative">

                    <input
                        type="text"
                        name="q"
                        value="{{ $q }}"
                        placeholder="{{ $locale == 'ar' ? 'ابحث عن خدمة أو منتج...' : 'Search...' }}"
                        class="w-full h-16 rounded-full border-2 border-blue-500 bg-white px-8 text-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <button
                        type="submit"
                        class="absolute {{ $locale == 'ar' ? 'left-6' : 'right-6' }} top-1/2 -translate-y-1/2 text-blue-600 text-xl">

                        🔍

                    </button>

                </div>

            </form>

        </div>

    </section>

    {{-- Results --}}
    <section class="py-10">

        <div class="max-w-7xl mx-auto px-6">

            @php
                $type = request('type', 'all');
            @endphp

            <div class="bg-white rounded-3xl border shadow-sm p-5 mb-10">

                <div class="flex flex-wrap gap-3">

                    <a href="{{ route('search',[
            'locale'=>$locale,
            'q'=>$q,
            'type'=>'all'
        ]) }}"
                       class="px-5 py-2 rounded-full transition
           {{ $type=='all'
                ? 'bg-blue-600 text-white'
                : 'bg-slate-100 hover:bg-slate-200' }}">

                        {{ $locale=='ar' ? 'كل النتائج' : 'All Results' }}
                        ({{ $totalResults }})

                    </a>

                    <a href="{{ route('search',[
            'locale'=>$locale,
            'q'=>$q,
            'type'=>'services'
        ]) }}"
                       class="px-5 py-2 rounded-full transition
           {{ $type=='services'
                ? 'bg-blue-600 text-white'
                : 'bg-slate-100 hover:bg-slate-200' }}">

                        {{ $locale=='ar' ? 'الخدمات' : 'Services' }}
                        ({{ $services->count() }})

                    </a>

                    <a href="{{ route('search',[
            'locale'=>$locale,
            'q'=>$q,
            'type'=>'posts'
        ]) }}"
                       class="px-5 py-2 rounded-full transition
           {{ $type=='posts'
                ? 'bg-blue-600 text-white'
                : 'bg-slate-100 hover:bg-slate-200' }}">

                        {{ $locale=='ar' ? 'المقالات' : 'Articles' }}
                        ({{ $posts->count() }})

                    </a>

                    <a href="{{ route('search',[
            'locale'=>$locale,
            'q'=>$q,
            'type'=>'portfolio'
        ]) }}"
                       class="px-5 py-2 rounded-full transition
           {{ $type=='portfolio'
                ? 'bg-blue-600 text-white'
                : 'bg-slate-100 hover:bg-slate-200' }}">

                        {{ $locale=='ar' ? 'المشروعات' : 'Projects' }}
                        ({{ $portfolio->count() }})

                    </a>

                </div>

            </div>

            {{-- Services --}}
            @if(
       ($type=='all' || $type=='services')
       && $services->count()
   )

                <div class="mb-14">

                    <h2 class="text-3xl font-bold mb-6">
                        {{ $locale == 'ar' ? 'الخدمات' : 'Services' }}
                    </h2>

                    <div class="space-y-5">

                        @foreach($services as $service)

                            <a href="{{ route('services.show', [
                            'locale' => $locale,
                            'service' => $service->slug
                        ]) }}"
                               class="block bg-white border rounded-2xl p-5 hover:shadow-xl transition">

                                <div class="flex gap-5">

                                    @if($service->image)
                                        <img
                                            src="{{ asset('storage/'.$service->image) }}"
                                            alt="{{ $service->trans('title') }}"
                                            class="w-28 h-28 rounded-xl object-cover">
                                    @endif

                                    <div>

                                    <span class="bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full">
                                        {{ $locale == 'ar' ? 'خدمة' : 'Service' }}
                                    </span>

                                        <h3 class="text-xl font-bold mt-3 mb-2">
                                            {{ $service->trans('title') }}
                                        </h3>

                                        <p class="text-slate-600">
                                            {{ Str::limit($service->trans('summary'),180) }}
                                        </p>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- Blog --}}
            @if(
     ($type=='all' || $type=='posts')
     && $posts->count()
 )

                <div class="mb-14">

                    <h2 class="text-3xl font-bold mb-6">
                        {{ $locale == 'ar' ? 'المقالات' : 'Articles' }}
                    </h2>

                    <div class="space-y-5">

                        @foreach($posts as $post)

                            <a href="{{ route('blog.show', [
                            'locale' => $locale,
                            'post' => $post->slug
                        ]) }}"
                               class="block bg-white border rounded-2xl p-5 hover:shadow-xl transition">

                                <div class="flex gap-5">

                                    @if($post->featured_image)
                                        <img
                                            src="{{ asset('storage/'.$post->featured_image) }}"
                                            alt="{{ $post->trans('title') }}"
                                            class="w-28 h-28 rounded-xl object-cover">
                                    @endif

                                    <div>

                                    <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                        {{ $locale == 'ar' ? 'مقال' : 'Article' }}
                                    </span>

                                        <h3 class="text-xl font-bold mt-3 mb-2">
                                            {{ $post->trans('title') }}
                                        </h3>

                                        <p class="text-slate-600">
                                            {{ Str::limit($post->trans('excerpt'),180) }}
                                        </p>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- Portfolio --}}
            @if(
     ($type=='all' || $type=='portfolio')
     && $portfolio->count()
 )

                <div>

                    <h2 class="text-3xl font-bold mb-6">
                        {{ $locale == 'ar' ? 'أعمالنا' : 'Projects' }}
                    </h2>

                    <div class="space-y-5">

                        @foreach($portfolio as $project)

                            <a href="{{ route('portfolio.show', [
                            'locale' => $locale,
                            'project' => $project->slug
                        ]) }}"
                               class="block bg-white border rounded-2xl p-5 hover:shadow-xl transition">

                                <div class="flex gap-5">

                                    @if($project->image)
                                        <img
                                            src="{{ asset('storage/'.$project->image) }}"
                                            alt="{{ $project->trans('title') }}"
                                            class="w-28 h-28 rounded-xl object-cover">
                                    @endif

                                    <div>

                                    <span class="bg-orange-100 text-orange-700 text-xs px-3 py-1 rounded-full">
                                        {{ $locale == 'ar' ? 'مشروع' : 'Project' }}
                                    </span>

                                        <h3 class="text-xl font-bold mt-3 mb-2">
                                            {{ $project->trans('title') }}
                                        </h3>

                                        <p class="text-slate-600">
                                            {{ Str::limit($project->trans('summary'),180) }}
                                        </p>

                                    </div>

                                </div>

                            </a>

                        @endforeach

                    </div>

                </div>

            @endif

            {{-- No Results --}}
            @if($totalResults == 0)

                <div class="max-w-5xl mx-auto">

                    <div class="bg-white rounded-[30px] shadow-sm border p-12 text-center">

                        <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-blue-50 flex items-center justify-center">

                            <svg class="w-10 h-10 text-blue-600"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />

                            </svg>

                        </div>

                        <h2 class="text-4xl font-extrabold mb-4">

                            {{ $locale == 'ar'
                                ? 'لا توجد نتائج'
                                : 'No Results Found' }}

                        </h2>

                        <p class="text-slate-500 text-lg mb-10">

                            {{ $locale == 'ar'
                                ? 'لم نجد أي نتائج مطابقة لبحثك. جرّب كلمات مختلفة أو استخدم إحدى الاقتراحات التالية.'
                                : 'We could not find any matching results. Try another keyword or use one of the suggestions below.' }}

                        </p>

                        <div class="flex flex-wrap justify-center gap-3">

                            @php

                                $popularSearches = $locale == 'ar'
                                    ? [
                                        'تصميم مواقع',
                                        'متاجر إلكترونية',
                                        'تطوير تطبيقات',
                                        'ERP',
                                        'CRM',
                                        'التسويق الرقمي',
                                        'SEO',
                                        'الأمن السيبراني'
                                    ]
                                    : [
                                        'Web Design',
                                        'E-Commerce',
                                        'Mobile App',
                                        'ERP',
                                        'CRM',
                                        'Digital Marketing',
                                        'SEO',
                                        'Cyber Security'
                                    ];

                            @endphp

                            @foreach($popularSearches as $keyword)

                                <a href="{{ route('search', [
            'locale' => $locale,
            'q' => $keyword
        ]) }}"
                                   class="px-4 py-2 bg-white border rounded-full hover:bg-blue-600 hover:text-white transition">

                                    {{ $keyword }}

                                </a>

                            @endforeach

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </section>

@endsection
