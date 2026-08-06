@extends('layouts.app')

@section('content')

    <section class="py-16">

        <div class="max-w-4xl mx-auto px-6">

            <h1 class="text-5xl font-extrabold mb-8">

                {{ $post->trans('title') }}

            </h1>

            @if($post->featured_image)

                <section class="py-10 bg-white">

                    <div class="max-w-6xl mx-auto px-6">

                        <div class="relative overflow-hidden rounded-3xl shadow-2xl">

                            <img
                                src="{{ asset('storage/' . $post->featured_image) }}"
                                alt="{{ $post->trans('title') }}"
                                class="w-full h-[400px] lg:h-[550px] object-cover">

                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        </div>

                    </div>

                </section>

            @endif
            @php
                $locale = app()->getLocale();

                $sourceName = $locale === 'ar'
                    ? $post->source_name_ar
                    : ($post->source_name_en ?: $post->source_name_ar);
            @endphp

            <div class="mt-8 flex flex-wrap items-center justify-center gap-8 text-gray-600 border-t border-b border-gray-100 py-6">

            @if($sourceName)
                    <div class="flex items-center gap-3">

                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-signal font-bold">
                            {{ mb_substr($sourceName, 0, 1) }}
                        </div>

                        <div class="text-right">
                            <div class="font-bold text-ink">



                                @if($post->source_url)

                                    {{ $sourceName }}
                                    </a>
                                @else
                                    {{ $sourceName }}
                                @endif
                            </div>


                        </div>

                    </div>
                @endif

                @if($post->published_at)
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>

                        <span>
                {{ $post->published_at->format('Y-m-d') }}
            </span>
                    </div>
                @endif

                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>

                    <span>
            {{ $post->reading_time }}
                        {{ $locale === 'ar' ? 'د. قراءة' : 'min read' }}
        </span>
                </div>

            </div>
            <div class="prose max-w-none">

                {!! $post->trans('content') !!}

            </div>

        </div>

    </section>

@endsection
