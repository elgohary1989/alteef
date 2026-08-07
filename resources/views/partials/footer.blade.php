@php
    $locale = app()->getLocale();
@endphp

<footer class="relative bg-[#08111f] text-white overflow-hidden mt-24">

    {{-- Background --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-96 h-96 bg-orange-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-6 py-20">

        <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-12">

            {{-- Company --}}
            <div>

                @if($settings->logo)
                    <img src="{{ asset('storage/'.$settings->logo) }}"
                         class="h-14 mb-5"
                         alt="">
                @endif

                <h3 class="text-2xl font-black text-white mb-4">
                    {{ $settings->trans('site_name') }}
                </h3>

                <p class="text-white/70 leading-8 mb-6">
                    {{ $settings->trans('footer_about') }}
                </p>

                <div class="flex gap-3">

                    @if($settings->facebook_url)
                        <a href="{{ $settings->facebook_url }}"
                           target="_blank"
                           class="w-11 h-11 rounded-full bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif

                    @if($settings->linkedin_url)
                        <a href="{{ $settings->linkedin_url }}"
                           target="_blank"
                           class="w-11 h-11 rounded-full bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif

                    @if($settings->twitter_url)
                        <a href="{{ $settings->twitter_url }}"
                           target="_blank"
                           class="w-11 h-11 rounded-full bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-x-twitter"></i>
                        </a>
                    @endif

                    @if($settings->instagram_url)
                        <a href="{{ $settings->instagram_url }}"
                           target="_blank"
                           class="w-11 h-11 rounded-full bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif

                    @if($settings->youtube_url)
                        <a href="{{ $settings->youtube_url }}"
                           target="_blank"
                           class="w-11 h-11 rounded-full bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif

                </div>

            </div>

            {{-- Links --}}
            <div>

                <h4 class="text-xl font-bold text-white mb-6">
                    {{ $locale=='ar' ? 'روابط سريعة' : 'Quick Links' }}
                </h4>

                <ul class="space-y-4">

                    <li>
                        <a href="{{ route('home',$locale) }}" class="hover:text-orange-400 transition">
                            {{ $locale=='ar' ? 'الرئيسية' : 'Home' }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('about',$locale) }}" class="hover:text-orange-400 transition">
                            {{ $locale=='ar' ? 'من نحن' : 'About Us' }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('services.index',$locale) }}" class="hover:text-orange-400 transition">
                            {{ $locale=='ar' ? 'الخدمات' : 'Services' }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('portfolio.index',$locale) }}" class="hover:text-orange-400 transition">
                            {{ $locale=='ar' ? 'المشاريع' : 'Projects' }}
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('contact.index',$locale) }}" class="hover:text-orange-400 transition">
                            {{ $locale=='ar' ? 'اتصل بنا' : 'Contact' }}
                        </a>
                    </li>

                </ul>

            </div>

            {{-- Services --}}
            <div>

                <h4 class="text-xl font-bold text-white mb-6">
                    {{ $locale=='ar' ? 'خدماتنا' : 'Services' }}
                </h4>

                <ul class="space-y-4">

                    @foreach($services->take(5) as $service)

                        <li>

                            <a href="{{ route('services.show',[
                                'locale'=>$locale,
                                'service'=>$service->slug
                            ]) }}"
                               class="hover:text-orange-400 transition">

                                {{ $service->trans('title') }}

                            </a>

                        </li>

                    @endforeach

                </ul>

            </div>

            {{-- Contact --}}
            <div>

                <h4 class="text-xl font-bold text-white mb-6">
                    {{ $locale=='ar' ? 'تواصل معنا' : 'Contact Us' }}
                </h4>

                <div class="space-y-5">

                    @if($settings->phone)
                        <div class="flex gap-3 items-start">
                            <i class="fas fa-phone text-orange-400 mt-1"></i>
                            <span>{{ $settings->phone }}</span>
                        </div>
                    @endif

                    @if($settings->email)
                        <div class="flex gap-3 items-start">
                            <i class="fas fa-envelope text-orange-400 mt-1"></i>
                            <span>{{ $settings->email }}</span>
                        </div>
                    @endif

                    @if($settings->trans('address'))
                        <div class="flex gap-3 items-start">
                            <i class="fas fa-location-dot text-orange-400 mt-1"></i>
                            <span>{{ $settings->trans('address') }}</span>
                        </div>
                    @endif

                </div>

            </div>

        </div>

    </div>

    <div class="border-t border-white/10">

        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col md:flex-row justify-between items-center gap-3">

            <p class="text-sm text-white/60">

                © {{ date('Y') }}

                {{ $settings->trans('site_name') }}

                {{ $locale=='ar'
                    ? 'جميع الحقوق محفوظة.'
                    : 'All Rights Reserved.' }}

            </p>

            <p class="text-sm text-white/50">

                {{ $locale=='ar'
                    ? 'Designed & Developed with Quantum '
                    : 'Designed & Developed with Quantum' }}

            </p>

        </div>

    </div>

</footer>
