@extends('layouts.app')

@section('content')
    @php $locale = app()->getLocale(); @endphp

    {{-- Hero --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-black">

        {{-- Background Glow --}}
        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/10 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/5 blur-[100px] rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="max-w-3xl">

            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 text-orange-400 font-semibold mb-6">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>
                </svg>

                {{ $locale=='ar' ? 'معرض أعمالنا' : 'OUR PORTFOLIO' }}

            </span>

                <h1 class="text-5xl lg:text-6xl font-black leading-tight mb-6">

                    {{ $locale=='ar'
                        ? 'مشاريع نفخر بتنفيذها'
                        : 'Projects We Are Proud Of' }}

                </h1>

                <p class="text-lg lg:text-xl text-slate-300 leading-9 max-w-2xl">

                    {{ $locale=='ar'
                        ? 'استكشف مجموعة من المشاريع التي قمنا بتنفيذها في مختلف القطاعات الصناعية والهندسية بأعلى معايير الجودة والاحترافية.'
                        : 'Explore a selection of engineering and industrial projects successfully delivered with exceptional quality and craftsmanship.' }}

                </p>

            </div>

        </div>

    </section>


    {{-- Portfolio --}}
    <section class="py-24 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar' ? 'أحدث المشاريع' : 'LATEST PROJECTS' }}

            </span>

                <h2 class="text-4xl font-black text-slate-900 mt-4">

                    {{ $locale=='ar'
                        ? 'نماذج من أعمالنا'
                        : 'Featured Portfolio' }}

                </h2>

            </div>

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

                @foreach($projects as $project)

                    <a href="{{ route('portfolio.show',[
                    'locale'=>$locale,
                    'project'=>$project->slug
                ]) }}"
                       class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200 hover:border-orange-300 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

                        {{-- Glow --}}
                        <div class="absolute -top-20 -right-20 w-48 h-48 rounded-full bg-orange-100 blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>

                        {{-- Image --}}
                        <div class="relative overflow-hidden">

                            @if($project->cover_image)

                                <img src="{{ asset('storage/'.$project->cover_image) }}"
                                     class="w-full aspect-[4/3] object-cover group-hover:scale-110 transition duration-700">

                            @else

                                <div class="aspect-[4/3] bg-slate-200"></div>

                            @endif

                        </div>

                        <div class="relative p-8">

                            {{-- Sector --}}
                            @if($project->sector)

                                <span class="inline-flex px-3 py-1 rounded-full bg-orange-100 text-orange-600 text-xs font-bold mb-4">

                                {{ $project->sector->trans('title') }}

                            </span>

                            @endif

                            {{-- Title --}}
                            <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-orange-500 transition">

                                {{ $project->trans('title') }}

                            </h3>

                            {{-- Summary --}}
                            <p class="text-slate-600 leading-8 min-h-[90px]">

                                {{ $project->trans('summary') }}

                            </p>

                            {{-- Footer --}}
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


    {{-- CTA --}}
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
                        : 'Let our engineering team bring your vision to life. Contact us today.' }}

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
