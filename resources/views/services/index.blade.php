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
                          d="M19.428 15.341A8 8 0 118.659 4.572m10.769 10.769L15 11"/>
                </svg>

                {{ $locale == 'ar' ? 'خدماتنا' : 'OUR SERVICES' }}

            </span>

                <h1 class="text-5xl lg:text-6xl font-black leading-tight mb-6">

                    {{ $locale == 'ar'
                        ? 'حلول هندسية وصناعية متكاملة'
                        : 'Engineering & Industrial Solutions' }}

                </h1>

                <p class="text-lg lg:text-xl text-slate-300 leading-9 max-w-2xl">

                    {{ $locale == 'ar'
                        ? 'نقدم حلولاً متكاملة في تصنيع الهياكل المعدنية، المقطورات الصناعية، الخزانات، المخيمات المتنقلة، وأعمال التصنيع الهندسي وفق أعلى معايير الجودة العالمية.'
                        : 'We provide complete engineering solutions in steel structures, industrial trailers, tanks, portable camps, and custom metal fabrication with international quality standards.' }}

                </p>

                <div class="mt-10 flex flex-wrap gap-4">





                </div>

            </div>

        </div>

    </section>

    {{-- ================= SERVICES ================= --}}
    <section id="services" class="py-24 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-16">

            <span class="text-orange-500 uppercase tracking-widest font-bold">

                {{ $locale=='ar' ? 'ماذا نقدم' : 'WHAT WE OFFER' }}

            </span>



            </div>

            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">

                @foreach($services as $service)

                    <a href="{{ route('services.show',[
                        'locale'=>$locale,
                        'service'=>$service->slug
                    ]) }}"
                       class="group relative overflow-hidden rounded-3xl bg-white border border-slate-200 hover:border-orange-300 shadow-sm hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">

                        {{-- تأثير الخلفية --}}
                        <div class="absolute -top-20 -right-20 w-48 h-48 rounded-full bg-orange-100 blur-3xl opacity-0 group-hover:opacity-100 transition duration-500"></div>

                        <div class="relative p-8">

                            {{-- Icon --}}
                            <div class="w-20 h-20 rounded-2xl bg-orange-100 text-orange-500 flex items-center justify-center mb-6 group-hover:bg-orange-500 group-hover:text-white transition-all duration-300">

                                @svg($service->icon ?: 'heroicon-o-squares-2x2','w-10 h-10')

                            </div>

                            {{-- Title --}}
                            <h3 class="text-2xl font-black text-slate-900 mb-4 group-hover:text-orange-500 transition">

                                {{ $service->trans('title') }}

                            </h3>

                            {{-- Summary --}}
                            <p class="text-slate-600 leading-8 mb-8 min-h-[90px]">

                                {{ $service->trans('summary') }}

                            </p>

                            {{-- Footer --}}
                            <div class="flex items-center justify-between border-t border-slate-100 pt-5">

                            <span class="font-bold text-orange-500">

                                {{ $locale=='ar'
                                    ? 'اكتشف المزيد'
                                    : 'Discover More' }}

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


    {{-- ================= CTA ================= --}}
    <section class="py-24 bg-slate-900">

        <div class="max-w-5xl mx-auto px-6">

            <div class="rounded-[32px] bg-gradient-to-r from-orange-500 to-orange-600 p-14 text-center shadow-2xl">

                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">

                    {{ $locale=='ar'
                        ? 'هل لديك مشروع جديد؟'
                        : 'Ready To Start Your Project?' }}

                </h2>

                <p class="text-orange-100 text-lg mb-10 max-w-2xl mx-auto">

                    {{ $locale=='ar'
                        ? 'دعنا نحول فكرتك إلى مشروع ناجح. تواصل معنا الآن للحصول على استشارة مجانية.'
                        : 'Let us turn your ideas into reality. Contact us today for a free consultation.' }}

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

