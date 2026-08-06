@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    <section class="py-16 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-12">

                <h1 class="text-4xl font-extrabold mb-4">
                    {{ $locale == 'ar' ? 'المدونة' : 'Blog' }}
                </h1>

                <p class="text-slate-600">
                    {{ $locale == 'ar'
                        ? 'آخر المقالات والنصائح التقنية'
                        : 'Latest articles and technical insights' }}
                </p>

            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse($posts as $post)

                    <a href="{{ route('blog.show', [
        'locale' => $locale,
        'post' => $post->slug
    ]) }}"
                       class="block">

                        <article class="bg-white rounded-2xl overflow-hiddensition h-full">

                            @if($post->featured_image)
                                <img
                                    src="{{ asset('storage/' . $post->featured_image) }}"
                                    class="w-full h-56 object-cover">
                            @endif

                            <div class="p-6">

                                <h2 class="text-xl font-bold mb-3">
                                    {{ $post->trans('title') }}
                                </h2>

                                <p class="text-slate-600 mb-4">
                                    {{ $post->trans('excerpt') }}
                                </p>

                                <span class="text-blue-600 font-semibold">
                {{ $locale == 'ar' ? 'اقرأ المزيد' : 'Read More' }}
            </span>

                            </div>

                        </article>

                    </a>

                @empty

                    <div class="col-span-3 text-center text-slate-500">
                        {{ $locale == 'ar'
                            ? 'لا توجد مقالات حالياً'
                            : 'No blog posts found.' }}
                    </div>


                    <div class="col-span-3 text-center text-slate-500">
                        {{ $locale == 'ar'
                            ? 'لا توجد مقالات حالياً'
                            : 'No blog posts found.' }}
                    </div>

                @endforelse

            </div>

            <div class="mt-10">
                {{ $posts->links() }}
            </div>

        </div>

    </section>

@endsection
