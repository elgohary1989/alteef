@extends('layouts.app')

@section('content')

    @php
        $locale = app()->getLocale();
    @endphp

    {{-- =======================================
    Hero
    ======================================= --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-black">

        <div class="absolute inset-0">
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-orange-500/10 blur-[120px] rounded-full"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-white/5 blur-[100px] rounded-full"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-6 py-24">

            <div class="max-w-3xl">

            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-orange-500/10 text-orange-400 font-semibold mb-6">

                <svg class="w-5 h-5"
                     fill="none"
                     stroke="currentColor"
                     viewBox="0 0 24 24">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M21 8V7l-3 2-2-2-8 6"/>

                </svg>

                {{ $locale=='ar'
                    ? 'تواصل معنا'
                    : 'CONTACT US' }}

            </span>

                <h1 class="text-5xl lg:text-6xl font-black leading-tight mb-6">

                    {{ $locale=='ar'
                        ? 'دعنا نناقش مشروعك'
                        : "Let's Build Something Great" }}

                </h1>

                <p class="text-lg text-slate-300 leading-9">

                    {{ $locale=='ar'
                        ? 'يسعد فريقنا بالإجابة على جميع استفساراتك وتقديم أفضل الحلول الهندسية والصناعية المناسبة لمشروعك.'
                        : 'Our engineering team is ready to answer your questions and provide the best industrial solutions.' }}

                </p>

            </div>

        </div>

    </section>

    {{-- =======================================
    Contact Form
    ======================================= --}}
    <section class="py-24 bg-slate-50">

        <div class="max-w-7xl mx-auto px-6">

            <div class="grid lg:grid-cols-5 gap-10">

                {{-- Contact Info --}}
                <div class="lg:col-span-2">

                    <h2 class="text-4xl font-black text-slate-900 mb-8">

                        {{ $locale=='ar'
                            ? 'معلومات التواصل'
                            : 'Contact Information' }}

                    </h2>

                    <div class="space-y-6">

                        @if($settings->phone)

                            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                                <div class="text-orange-500 font-bold mb-2">

                                    {{ $locale=='ar' ? 'الهاتف' : 'Phone' }}

                                </div>

                                <div dir="ltr" class="text-xl font-black">

                                    {{ $settings->phone }}

                                </div>

                            </div>

                        @endif

                        @if($settings->email)

                            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                                <div class="text-orange-500 font-bold mb-2">

                                    {{ $locale=='ar' ? 'البريد الإلكتروني' : 'Email' }}

                                </div>

                                <div class="font-semibold break-all">

                                    {{ $settings->email }}

                                </div>

                            </div>

                        @endif

                        @if($settings->trans('address'))

                            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">

                                <div class="text-orange-500 font-bold mb-2">

                                    {{ $locale=='ar'
                                        ? 'العنوان'
                                        : 'Address' }}

                                </div>

                                <div>

                                    {{ $settings->trans('address') }}

                                </div>

                            </div>

                        @endif

                    </div>

                </div>

                {{-- Form --}}
                <div class="lg:col-span-3">

                    <div class="bg-white rounded-[32px] border border-slate-200 shadow-xl p-10">

                        @if(session('success'))

                            <div class="mb-8 rounded-2xl bg-green-100 text-green-700 border border-green-300 p-5">

                                {{ session('success') }}

                            </div>

                        @endif

                        <form method="POST"
                              action="{{ route('contact.store',['locale'=>$locale]) }}"
                              class="grid md:grid-cols-2 gap-6">

                            @csrf

                            <div>

                                <label class="font-bold mb-2 block">

                                    {{ $locale=='ar' ? 'الاسم' : 'Name' }}

                                </label>

                                <input
                                    type="text"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="w-full rounded-xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">

                                @error('name')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div>

                                <label class="font-bold mb-2 block">

                                    {{ $locale=='ar'
                                        ? 'البريد الإلكتروني'
                                        : 'Email' }}

                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    class="w-full rounded-xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">

                                @error('email')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div>

                                <label class="font-bold mb-2 block">

                                    {{ $locale=='ar'
                                        ? 'الهاتف'
                                        : 'Phone' }}

                                </label>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="w-full rounded-xl border border-slate-300 px-5 py-4">

                            </div>

                            <div>

                                <label class="font-bold mb-2 block">

                                    {{ $locale=='ar'
                                        ? 'الموضوع'
                                        : 'Subject' }}

                                </label>

                                <input
                                    type="text"
                                    name="subject"
                                    value="{{ old('subject') }}"
                                    class="w-full rounded-xl border border-slate-300 px-5 py-4">

                            </div>

                            <div class="md:col-span-2">

                                <label class="font-bold mb-2 block">

                                    {{ $locale=='ar'
                                        ? 'الرسالة'
                                        : 'Message' }}

                                </label>

                                <textarea
                                    rows="7"
                                    name="message"
                                    class="w-full rounded-xl border border-slate-300 px-5 py-4 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">{{ old('message') }}</textarea>

                                @error('message')
                                <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="md:col-span-2">

                                <button
                                    class="bg-orange-500 hover:bg-orange-600 text-white font-bold px-8 py-4 rounded-xl transition">

                                    {{ $locale=='ar'
                                        ? 'إرسال الرسالة'
                                        : 'Send Message' }}

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    {{-- =======================================
    CTA
    ======================================= --}}
    <section class="py-24 bg-slate-900">

        <div class="max-w-5xl mx-auto px-6">

            <div class="rounded-[32px] bg-gradient-to-r from-orange-500 to-orange-600 p-14 text-center shadow-2xl">

                <h2 class="text-4xl md:text-5xl font-black text-white mb-6">

                    {{ $locale=='ar'
                        ? 'جاهز لبدء مشروعك؟'
                        : 'Ready To Start?' }}

                </h2>

                <p class="text-orange-100 text-lg mb-10 max-w-2xl mx-auto">

                    {{ $locale=='ar'
                        ? 'تواصل معنا اليوم ودعنا نحول فكرتك إلى مشروع ناجح.'
                        : 'Contact us today and let us turn your idea into reality.' }}

                </p>

                <a href="tel:{{ $settings->phone }}"
                   class="inline-flex items-center gap-3 bg-white text-orange-600 px-8 py-4 rounded-xl font-bold hover:bg-slate-100 transition">

                    {{ $locale=='ar'
                        ? 'اتصل بنا الآن'
                        : 'Call Us Now' }}

                </a>

            </div>

        </div>

    </section>

@endsection
