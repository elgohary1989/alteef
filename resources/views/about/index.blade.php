@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    {{-- ================= HERO ================= --}}
    <section class="relative h-screen overflow-hidden">

        {{-- Background --}}
        <img
            src="{{ asset('storage/'.$about->image) }}"
            alt="{{ $locale=='ar' ? $about->title_ar : $about->title_en }}"
            class="absolute inset-0 w-full h-full object-cover scale-105">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>

        {{-- Floating Shapes --}}
        <div class="absolute inset-0 overflow-hidden">

            <div
                class="absolute top-24 left-20 w-56 h-56 bg-orange-500/10 rounded-full blur-3xl animate-pulse"></div>

            <div
                class="absolute bottom-20 right-20 w-72 h-72 bg-white/5 rounded-full blur-3xl animate-pulse"></div>

        </div>

        {{-- Content --}}
        <div
            class="relative z-10 flex items-center justify-center h-full text-center px-6">

            <div class="max-w-5xl">

                <div
                    data-aos="fade-down"
                    class="inline-flex items-center px-5 py-2 rounded-full bg-white/10 backdrop-blur-md text-white font-semibold mb-8">

                    {{ $locale=='ar'
       ? $about->hero_title_ar
       : $about->hero_title_en }}

                </div>

                <h1
                    data-aos="fade-up"
                    data-aos-duration="1000"
                    class="text-5xl md:text-7xl lg:text-8xl font-black text-white leading-tight">

                    {{ $locale=='ar'
                        ? $about->title_ar
                        : $about->title_en }}

                </h1>

                <p
                    data-aos="fade-up"
                    data-aos-delay="300"
                    class="mt-8 text-lg md:text-2xl text-gray-200 max-w-3xl mx-auto leading-9">

                    {{ $locale=='ar'
       ? $about->hero_description_ar
       : $about->hero_description_en }}
                </p>

                <div
                    data-aos="zoom-in"
                    data-aos-delay="600"
                    class="mt-12 flex flex-wrap justify-center gap-5">

                    <a href="{{ route('contact.index',['locale'=>$locale]) }}"
                       class="px-8 py-4 rounded-xl bg-orange-500 text-white font-bold hover:bg-orange-600 transition duration-300 hover:scale-105">

                        {{ $locale=='ar'
                            ? 'تواصل معنا'
                            : 'Contact Us' }}

                    </a>

                    <a href="#about-company"
                       class="px-8 py-4 rounded-xl border border-white text-white hover:bg-white hover:text-black transition duration-300">

                        {{ $locale=='ar'
                            ? 'اعرف المزيد'
                            : 'Learn More' }}

                    </a>

                </div>

            </div>

        </div>

    </section>

    {{-- ================================================= --}}
    {{-- SECTION HEADER --}}
    {{-- ================================================= --}}



    {{-- ================= ABOUT ================= --}}
    <section
        id="about-company"
        class="py-28 bg-white overflow-hidden">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-2 gap-20 items-center">

                {{-- Image --}}
                <div
                    data-aos="fade-right"
                    data-aos-duration="1200"
                    class="relative">

                    <img
                        src="{{asset('storage/'.$about->hero_image) }}"
                        alt=""
                        class="rounded-[30px] shadow-2xl w-full h-[650px] object-cover">

                    <div
                        class="absolute -bottom-8 -right-8 bg-orange-500 text-white rounded-3xl p-8 shadow-2xl">

                        <div class="text-5xl font-black">

                            {{ $about->years_experience }}+

                        </div>

                        <div class="text-lg">

                            {{ $locale=='ar'
                                ? 'سنة خبرة'
                                : 'Years Experience' }}

                        </div>

                    </div>

                </div>

                {{-- Text --}}
                <div
                    data-aos="fade-left"
                    data-aos-duration="1200">

                <span
                    class="inline-flex items-center px-5 py-2 rounded-full bg-orange-100 text-orange-500 font-bold mb-6">

                    {{ $locale=='ar'
                        ? 'نبذة عن الشركة'
                        : 'WHO WE ARE' }}

                </span>

                    <h2
                        class="text-4xl md:text-5xl font-black mb-8 leading-tight">

                        {{ $locale=='ar'
                            ? $about->title_ar
                            : $about->title_en }}

                    </h2>

                    <div
                        class="prose max-w-none prose-lg leading-9 text-slate-600">

                        {!! $locale=='ar'
                            ? $about->description_ar
                            : $about->description_en !!}

                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-12">

                        @foreach($about->features as $feature)

                            <div class="group rounded-3xl border border-gray-100 p-10">

                                <i class="fas {{ $feature->icon }}"></i>

                                <h3>

                                    {{ $locale == 'ar'
                                        ? $feature->title_ar
                                        : $feature->title_en }}

                                </h3>

                                <p>

                                    {{ $locale == 'ar'
                                        ? $feature->description_ar
                                        : $feature->description_en }}

                                </p>

                            </div>

                        @endforeach

                    </div>

                </div>

            </div>

        </div>

    </section>
    {{-- ========================================================= --}}
    {{-- CEO MESSAGE --}}
    {{-- ========================================================= --}}

    @if(
        $about &&
        ($locale == 'ar'
            ? $about->manager_message_ar
            : $about->manager_message_en)
    )

        <section class="relative py-24 md:py-28 bg-[#0B1220] overflow-hidden">

            {{-- Background Effects --}}
            <div class="absolute inset-0 pointer-events-none">

                <div
                    class="absolute -top-40 -left-32
                   w-96 h-96
                   bg-orange-500/10
                   rounded-full
                   blur-3xl">
                </div>

                <div
                    class="absolute bottom-0 right-0
                   w-[450px] h-[450px]
                   bg-white/5
                   rounded-full
                   blur-3xl">
                </div>

            </div>


            <div class="relative max-w-7xl mx-auto px-6">


                {{-- SECTION HEADER --}}
                <div
                    class="text-center mb-14 md:mb-20"
                    data-aos="fade-up"
                    data-aos-duration="900">

            <span
                class="inline-flex
                       px-5 py-2
                       rounded-full
                       bg-orange-500/10
                       border border-orange-500/20
                       text-orange-400
                       font-bold">

                {{ $locale == 'ar'
                    ? 'كلمة المدير التنفيذي'
                    : 'CEO Message' }}

            </span>


                    <h2
                        class="text-4xl
                       md:text-5xl
                       lg:text-6xl
                       font-black
                       text-white
                       mt-6
                       leading-tight">

                        {{ $locale == 'ar'
                            ? 'رسالة من الإدارة التنفيذية'
                            : 'Message From Executive Management' }}

                    </h2>

                </div>


                {{-- CEO CARD --}}
                <div
                    class="bg-white/5
                   border border-white/10
                   backdrop-blur-xl
                   rounded-[40px]
                   overflow-hidden
                   shadow-2xl">

                    <div class="grid lg:grid-cols-5">


                        {{-- IMAGE --}}
                        @if($about->manager_image)

                            <div
                                class="lg:col-span-2
                               relative
                               min-h-[450px]
                               lg:min-h-[600px]
                               bg-[#09101C]"
                                data-aos="{{ $locale == 'ar' ? 'fade-left' : 'fade-right' }}"
                                data-aos-duration="1000">

                                <img
                                    src="{{ asset('storage/' . $about->manager_image) }}"
                                    alt="{{ $locale == 'ar'
                                ? $about->manager_name_ar
                                : $about->manager_name_en }}"
                                    class="absolute inset-0
                                   w-full
                                   h-full
                                   object-cover
                                   hover:scale-105
                                   transition-transform
                                   duration-700">

                                <div
                                    class="absolute inset-0
                                   bg-gradient-to-t
                                   from-black/60
                                   via-transparent
                                   to-transparent
                                   pointer-events-none">
                                </div>

                            </div>

                        @endif


                        {{-- CONTENT --}}
                        <div
                            class="{{ $about->manager_image
                        ? 'lg:col-span-3'
                        : 'lg:col-span-5' }}
                           p-8
                           md:p-12
                           lg:p-16"
                            data-aos="{{ $locale == 'ar' ? 'fade-right' : 'fade-left' }}"
                            data-aos-duration="1000"
                            data-aos-delay="150">


                            {{-- Quote --}}
                            <div
                                class="text-orange-500/20
                               text-7xl
                               md:text-8xl
                               leading-none
                               mb-6">

                                <i class="fas fa-quote-right"></i>

                            </div>


                            {{-- Message --}}
                            <div
                                class="prose
                               prose-invert
                               prose-lg
                               max-w-none
                               text-gray-300
                               leading-[2.2]">

                                {!! $locale == 'ar'
                                    ? $about->manager_message_ar
                                    : $about->manager_message_en !!}

                            </div>


                            {{-- Signature --}}
                            <div
                                class="mt-12
                               pt-8
                               border-t
                               border-white/10">

                                <h3
                                    class="text-2xl
                                   md:text-3xl
                                   font-black
                                   text-white">

                                    {{ $locale == 'ar'
                                        ? $about->manager_name_ar
                                        : $about->manager_name_en }}

                                </h3>


                                <div
                                    class="w-20
                                   h-1
                                   bg-orange-500
                                   rounded-full
                                   my-4">
                                </div>


                                <p
                                    class="text-orange-400
                                   font-semibold
                                   text-lg">

                                    {{ $locale == 'ar'
                                        ? $about->manager_position_ar
                                        : $about->manager_position_en }}

                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    @endif


    {{-- ================= VISION & MISSION ================= --}}
    <section class="py-28 bg-slate-50 overflow-hidden">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-20"
                 data-aos="fade-up">

            <span
                class="inline-flex px-5 py-2 rounded-full bg-orange-100 text-orange-500 font-bold">

                {{ $locale=='ar'
                    ? 'رؤيتنا ورسالتنا'
                    : 'VISION & MISSION' }}

            </span>

                <h2 class="text-5xl font-black mt-8">

                    {{ $locale=='ar'
                        ? 'ما الذي يدفعنا للأمام'
                        : 'What Drives Us Forward' }}

                </h2>

            </div>

            <div class="grid lg:grid-cols-2 gap-10">

                {{-- Vision --}}
                <div
                    data-aos="fade-right"
                    class="group bg-white rounded-[32px] shadow-lg p-12 hover:shadow-2xl hover:-translate-y-3 transition duration-500">

                    <div
                        class="w-24 h-24 rounded-full bg-orange-100 flex items-center justify-center mb-8 group-hover:bg-orange-500 group-hover:text-white transition">

                        <i class="fas fa-eye text-4xl"></i>

                    </div>

                    <h3 class="text-4xl font-black mb-8">

                        {{ $locale=='ar'
 ? $about->vision_title_ar
 : $about->vision_title_en }}

                    </h3>

                    <div
                        class="leading-9 text-slate-600 prose max-w-none">

                        {!! $locale=='ar'
                            ? $about->vision_ar
                            : $about->vision_en !!}

                    </div>

                </div>

                {{-- Mission --}}
                <div
                    data-aos="fade-left"
                    class="group bg-white rounded-[32px] shadow-lg p-12 hover:shadow-2xl hover:-translate-y-3 transition duration-500">

                    <div
                        class="w-24 h-24 rounded-full bg-orange-100 flex items-center justify-center mb-8 group-hover:bg-orange-500 group-hover:text-white transition">

                        <i class="fas fa-bullseye text-4xl"></i>

                    </div>

                    <h3 class="text-4xl font-black mb-8">

                        {{ $locale=='ar'
 ? $about->mission_title_ar
 : $about->mission_title_en }}

                    </h3>

                    <div
                        class="leading-9 text-slate-600 prose max-w-none">

                        {!! $locale=='ar'
                            ? $about->mission_ar
                            : $about->mission_en !!}

                    </div>

                </div>

            </div>

        </div>

    </section>
    {{-- ================= STATISTICS ================= --}}
    <section class="relative py-28 bg-[#0B1220] overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">

            <div class="absolute -top-40 -left-32 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl"></div>

            <div class="absolute bottom-0 right-0 w-[450px] h-[450px] bg-white/5 rounded-full blur-3xl"></div>

        </div>

        <div class="relative max-w-7xl mx-auto px-6">

            <div class="text-center mb-16"
                 data-aos="fade-up">

            <span
                class="inline-flex px-5 py-2 rounded-full bg-white/10 text-orange-400 font-bold">

                {{ $locale=='ar'
                    ? 'إنجازاتنا'
                    : 'OUR ACHIEVEMENTS' }}

            </span>

                <h2 class="text-5xl font-black text-white mt-8">

                    {{ $locale=='ar'
                        ? 'أرقام نفتخر بها'
                        : 'Numbers We Are Proud Of' }}

                </h2>

            </div>

            <div class="grid md:grid-cols-3 gap-8">

                {{-- Years --}}
                <div
                    data-aos="zoom-in"
                    data-aos-delay="100"
                    class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 text-center hover:-translate-y-3 hover:bg-white/10 transition duration-500">

                    <div
                        class="w-20 h-20 rounded-full bg-orange-500 text-white flex items-center justify-center mx-auto mb-8 text-3xl">

                        <i class="fas fa-calendar-alt"></i>

                    </div>

                    <h3
                        class="counter text-6xl font-black text-orange-400"
                        data-count="{{ $about->years_experience }}">

                        0

                    </h3>

                    <p class="text-white mt-5 text-lg">

                        {{ $locale=='ar'
                            ? 'سنوات خبرة'
                            : 'Years Experience' }}

                    </p>

                </div>

                {{-- Projects --}}
                <div
                    data-aos="zoom-in"
                    data-aos-delay="250"
                    class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 text-center hover:-translate-y-3 hover:bg-white/10 transition duration-500">

                    <div
                        class="w-20 h-20 rounded-full bg-orange-500 text-white flex items-center justify-center mx-auto mb-8 text-3xl">

                        <i class="fas fa-industry"></i>

                    </div>

                    <h3
                        class="counter text-6xl font-black text-orange-400"
                        data-count="{{ $about->projects_count }}">

                        0

                    </h3>

                    <p class="text-white mt-5 text-lg">

                        {{ $locale=='ar'
                            ? 'مشروع'
                            : 'Projects' }}

                    </p>

                </div>

                {{-- Clients --}}
                <div
                    data-aos="zoom-in"
                    data-aos-delay="400"
                    class="group bg-white/5 backdrop-blur-xl border border-white/10 rounded-3xl p-10 text-center hover:-translate-y-3 hover:bg-white/10 transition duration-500">

                    <div
                        class="w-20 h-20 rounded-full bg-orange-500 text-white flex items-center justify-center mx-auto mb-8 text-3xl">

                        <i class="fas fa-users"></i>

                    </div>

                    <h3
                        class="counter text-6xl font-black text-orange-400"
                        data-count="{{ $about->clients_count }}">

                        0

                    </h3>

                    <p class="text-white mt-5 text-lg">

                        {{ $locale=='ar'
                            ? 'عميل'
                            : 'Clients' }}

                    </p>

                </div>

            </div>

        </div>

    </section>

    {{-- ================= WHY CHOOSE US ================= --}}
    <section class="py-28 bg-white overflow-hidden">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-20"
                 data-aos="fade-up">

            <span
                class="inline-flex px-5 py-2 rounded-full bg-orange-100 text-orange-500 font-bold">

                {{ $locale=='ar'
                    ? 'لماذا نحن'
                    : 'WHY CHOOSE US' }}

            </span>

                <h2 class="text-5xl font-black mt-8">

                    {{ $locale=='ar'
                        ? 'لماذا يثق العملاء بنا؟'
                        : 'Why Customers Trust Us' }}

                </h2>

            </div>

            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">

                @foreach($about->features as $index => $feature)

                    <div
                        class="group rounded-3xl border border-gray-100 p-10 hover:shadow-2xl hover:-translate-y-3 transition duration-500"
                        data-aos="fade-up"
                        data-aos-delay="{{ $index * 120 }}">

                        <div class="w-20 h-20 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center mb-8">

                            <i class="fas {{ $feature->icon }}"></i>

                        </div>

                        <h3 class="text-2xl font-black mb-4">
                            {{ $locale == 'ar'
                                ? $feature->title_ar
                                : $feature->title_en }}
                        </h3>

                        <p class="leading-8 text-slate-500">
                            {{ $locale == 'ar'
                                ? $feature->description_ar
                                : $feature->description_en }}
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </section>



    {{-- ================= CORE VALUES ================= --}}
    <section class="py-28 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-20"
                 data-aos="fade-up">

            <span class="inline-flex px-5 py-2 rounded-full bg-orange-100 text-orange-500 font-bold">

                {{ $locale=='ar'
                    ? 'قيمنا'
                    : 'OUR VALUES' }}

            </span>

                <h2 class="text-5xl font-black mt-8">

                    {{ $locale=='ar'
                        ? 'القيم التي نؤمن بها'
                        : 'Our Core Values' }}

                </h2>

            </div>



                <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">

                    @foreach($about->values as $index => $value)

                        <div
                            data-aos="zoom-in"
                            data-aos-delay="{{ $index * 120 }}"
                            class="bg-white rounded-3xl p-10 text-center shadow hover:shadow-2xl hover:-translate-y-2 transition">

                            <i class="fas {{ $value->icon }} text-5xl text-orange-500 mb-8"></i>

                            <h3 class="font-black text-2xl">
                                {{ $locale == 'ar'
                                    ? $value->title_ar
                                    : $value->title_en }}
                            </h3>

                        </div>

                    @endforeach

                </div>




        </div>

    </section>



    {{-- ================= COMPANY TIMELINE ================= --}}
    <section class="py-28 bg-white">

        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-20"
                 data-aos="fade-up">

            <span class="inline-flex px-5 py-2 rounded-full bg-orange-100 text-orange-500 font-bold">

                {{ $locale=='ar'
                    ? 'رحلتنا'
                    : 'OUR JOURNEY' }}

            </span>

                <h2 class="text-5xl font-black mt-8">

                    {{ $locale=='ar'
                        ? 'محطات نجاحنا'
                        : 'Milestones' }}

                </h2>

            </div>

            <div class="relative">

                <div class="absolute left-1/2 top-0 bottom-0 w-1 bg-orange-200 -translate-x-1/2 hidden md:block"></div>
                @foreach($about->timelines as $index => $timeline)

                    <div
                        class="relative flex items-center mb-16"
                        data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">

                        <div
                            class="hidden md:block w-1/2 {{ $index % 2 == 0 ? 'pr-12' : 'order-2 pl-12' }}">

                            <div class="bg-white rounded-3xl shadow-lg p-8 border">

                                <h3 class="text-2xl font-black text-orange-500 mb-4">
                                    {{ $timeline->year }}
                                </h3>

                                <h4 class="text-xl font-bold mb-4">
                                    {{ $locale == 'ar'
                                        ? $timeline->title_ar
                                        : $timeline->title_en }}
                                </h4>

                                <p class="leading-8 text-slate-600">
                                    {{ $locale == 'ar'
                                        ? $timeline->description_ar
                                        : $timeline->description_en }}
                                </p>

                            </div>

                        </div>

                        <div
                            class="hidden md:flex w-12 h-12 rounded-full bg-orange-500 border-4 border-white shadow absolute left-1/2 -translate-x-1/2 items-center justify-center text-white font-bold">

                            {{ $index + 1 }}

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>
    {{-- ================= CTA ================= --}}
    <section class="relative overflow-hidden py-24 bg-gradient-to-r from-orange-500 to-orange-600">

        <div class="absolute inset-0 opacity-10">
            <div class="absolute -top-24 -left-24 w-72 h-72 bg-white rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -right-24 w-72 h-72 bg-white rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-5xl mx-auto px-6 text-center text-white">

            <span
                data-aos="fade-down"
                class="inline-flex items-center px-5 py-2 rounded-full bg-white/20 backdrop-blur text-sm font-bold mb-6">

                {{ $locale == 'ar'
                    ? 'ابدأ مشروعك معنا'
                    : 'LET’S WORK TOGETHER' }}

            </span>

            <h2
                data-aos="zoom-in"
                class="text-4xl md:text-6xl font-black mb-8 leading-tight">

                {{ $locale=='ar'
 ? $about->cta_title_ar
 : $about->cta_title_en }}

            </h2>

            <p
                data-aos="fade-up"
                class="max-w-2xl mx-auto text-lg text-white/90 leading-9 mb-10">

                {{ $locale=='ar'
 ? $about->cta_description_ar
 : $about->cta_description_en }}
            </p>

            <a
                data-aos="zoom-in-up"
                href="{{ route('contact.index',['locale'=>$locale]) }}"
                class="inline-flex items-center gap-3 bg-white text-orange-600 hover:bg-slate-100 font-bold px-10 py-5 rounded-2xl shadow-2xl transition duration-300 hover:-translate-y-1">
                {{ $locale=='ar'
                ? $about->cta_button_text_ar
                : $about->cta_button_text_en }}

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 7l5 5m0 0l-5 5m5-5H6"/>

                </svg>

            </a>

        </div>

    </section>

@endsection


@push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', function () {

            AOS.init({
                duration: 900,
                easing: 'ease-out-cubic',
                once: true,
                offset: 80,
            });



        });

    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const counters = document.querySelectorAll('.counter');

            counters.forEach(counter => {

                const target = parseInt(counter.dataset.count) || 0;

                let current = 0;

                const increment = Math.max(1, Math.ceil(target / 100));

                const updateCounter = () => {

                    current += increment;

                    if (current >= target) {
                        counter.textContent = target.toLocaleString();
                        return;
                    }

                    counter.textContent = current.toLocaleString();

                    requestAnimationFrame(updateCounter);
                };

                updateCounter();
            });

        });
    </script>
@endpush
