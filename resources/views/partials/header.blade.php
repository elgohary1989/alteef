
@php
    $locale = app()->getLocale();
    $altLocale = $locale === 'ar' ? 'en' : 'ar';

    $routeName = request()->route()?->getName() ?? 'home';
    $routeParams = request()->route()?->parameters() ?? [];
    $routeParams['locale'] = $altLocale;
@endphp

<header class="sticky top-0 z-50 bg-white border-b border-gray-200 shadow-sm relative">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex items-center justify-between h-20">

            {{-- Logo --}}
            <a href="{{ route('home', ['locale' => $locale]) }}"
               class="flex items-center gap-3">

                @if(!empty($settings->logo))
                    <img src="{{ asset('storage/'.$settings->logo) }}"
                         alt="{{ $settings->trans('site_name') }}"
                         class="h-10 w-auto">
                @else
                    <span class="text-2xl font-extrabold text-gray-900">
                        {{ $settings->trans('site_name') ?? 'Company' }}
                    </span>
                @endif

            </a>

            {{-- Desktop Menu --}}
            <nav class="hidden lg:flex items-center gap-8 font-medium text-gray-700">

                <a href="{{ route('home', ['locale'=>$locale]) }}"
                   class="{{ request()->routeIs('home') ? 'text-blue-600' : '' }} hover:text-blue-600 transition">
                    {{ $locale == 'ar' ? 'الرئيسية' : 'Home' }}
                </a>
                <a href="{{ route('blog.index', ['locale' => $locale]) }}"
                   class="{{ request()->routeIs('blog.*') ? 'text-blue-600' : '' }} hover:text-blue-600 transition">
                    {{ $locale == 'ar' ? 'عن الشركة' : 'About us' }}
                </a>
                <div class="relative" id="servicesMenuWrapper">

                    <button
                        id="servicesMenuBtn"
                        type="button"
                        class="{{ request()->routeIs('services.*') ? 'text-blue-600' : '' }} hover:text-blue-600 transition flex items-center gap-1">

                        {{ $locale == 'ar' ? ' الخدمات' : 'Services' }}

                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>

                    </button>

                    <div id="servicesMenu"
                         class="hidden absolute top-full right-0 mt-2 w-[600px] bg-white shadow-xl rounded-xl border border-gray-200 z-50">
                        <div class="p-4">

                            <div class="mb-3 border-b pb-2">

                                <a href="{{ route('services.index', ['locale' => $locale]) }}"
                                   class="font-bold text-blue-600 hover:underline">
                                    {{ $locale == 'ar' ? 'عرض جميع الخدمات' : 'View All Services' }}
                                </a>

                            </div>

                            <div class="grid grid-cols-3 gap-4">

                                @foreach($serviceCategories as $category)

                                    <div>



                                        <ul class="space-y-2">

                                            @foreach($category->services->take(6) as $service)

                                                <li>

                                                    <a href="{{ route('services.show', [
                                            'locale' => $locale,
                                            'service' => $service->slug
                                        ]) }}"
                                                       class="hover:text-blue-600">

                                                        {{ $service->trans('title') }}

                                                    </a>

                                                </li>

                                            @endforeach

                                        </ul>

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    </div>

                </div>

                <a href="{{ route('portfolio.index', ['locale'=>$locale]) }}"
                   class="{{ request()->routeIs('portfolio.*') ? 'text-blue-600' : '' }} hover:text-blue-600 transition">
                    {{ $locale == 'ar' ? 'أعمالنا' : 'Portfolio' }}
                </a>
                <div class="relative" id="productsMenuWrapper">

                    <button
                        id="productsMenuBtn"
                        type="button"
                        class="flex items-center gap-1 transition hover:text-blue-600 {{ request()->routeIs('products.*') ? 'text-blue-600 font-semibold' : '' }}">

                        {{ $locale == 'ar' ? 'المنتجات' : 'Products' }}

                        <svg class="w-4 h-4 transition-transform duration-300" id="productsArrow"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M19 9l-7 7-7-7"/>
                        </svg>

                    </button>

                    <div id="productsMenu"
                         class="hidden absolute top-full right-0 mt-4 w-[420px] bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50">

                        <div class="bg-gray-50 px-5 py-4 border-b">

                            <h3 class="font-bold text-lg">
                                {{ $locale == 'ar' ? 'منتجاتنا' : 'Our Products' }}
                            </h3>

                            <p class="text-sm text-gray-500">
                                {{ $locale == 'ar'
                                    ? 'استعرض أحدث المنتجات'
                                    : 'Browse our latest products' }}
                            </p>

                        </div>

                        <div class="max-h-[420px] overflow-y-auto">

                            @foreach($products->take(10) as $product)

                                <a href="{{ route('products.show', [
                        'locale'  => $locale,
                        'product' => $product->slug,
                    ]) }}"
                                   class="flex items-center gap-4 px-5 py-3 hover:bg-gray-50 transition">

                                    <div class="w-14 h-14 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">

                                        @if($product->image)
                                            <img
                                                src="{{ asset('storage/'.$product->image) }}"
                                                alt="{{ $product->trans('name') }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                📦
                                            </div>
                                        @endif

                                    </div>

                                    <div class="flex-1">

                                        <div class="font-semibold text-gray-900">
                                            {{ $product->trans('name') ?? $product->name_ar }}
                                        </div>

                                        @if(!empty($product->price))
                                            <div class="text-sm text-blue-600 font-medium">
                                                {{ number_format($product->price,2) }}
                                            </div>
                                        @endif

                                    </div>

                                </a>

                            @endforeach

                        </div>

                        <div class="border-t p-4 bg-gray-50">

                            <a href="{{ route('products.index', ['locale' => $locale]) }}"
                               class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold transition">

                                {{ $locale == 'ar'
                                    ? 'عرض جميع المنتجات'
                                    : 'View All Products' }}

                            </a>

                        </div>

                    </div>

                </div>
                <a href="{{ route('contact.index', ['locale'=>$locale]) }}"
                   class="{{ request()->routeIs('contact.*') ? 'text-blue-600' : '' }} hover:text-blue-600 transition">
                    {{ $locale == 'ar' ? 'اتصل بنا' : 'Contact' }}
                </a>

            </nav>

            {{-- Search --}}
            {{-- Search --}}
            <div class="hidden xl:block flex-1 max-w-sm mx-8">

                <livewire:search-dropdown />

            </div>

            {{-- Right Side --}}
            <div class="flex items-center gap-3">

                {{-- Language --}}
                <a href="{{ route($routeName, $routeParams) }}"
                   class="hidden sm:flex items-center justify-center w-10 h-10 rounded-full border border-gray-300 hover:border-blue-600 hover:text-blue-600 transition">

                    {{ strtoupper($altLocale) }}

                </a>

                {{-- CTA --}}
                <a href="{{ route('contact.index', ['locale' => $locale]) }}"
                   class="hidden md:inline-flex items-center bg-orange-500 text-white px-5 py-3 rounded-xl font-semibold hover:bg-orange-600 transition duration-300 shadow-lg hover:shadow-xl">

                    {{ $locale == 'ar' ? 'ابدأ الآن' : 'Start Now' }}

                </a>

                {{-- Mobile Button --}}
                <button id="menuButton"
                        class="lg:hidden w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-6 h-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>

                    </svg>

                </button>

            </div>

        </div>

    </div>

    {{-- Mobile Menu --}}
    <div id="mobileMenu"
         class="hidden lg:hidden fixed inset-0 z-50">

        <!-- Overlay -->
        <div id="mobileOverlay"
             class="absolute inset-0 bg-black/50"></div>

        <!-- Drawer -->
        <div class="absolute top-0 right-0 w-80 max-w-[85%] h-full bg-white shadow-xl overflow-y-auto">

            <div class="flex items-center justify-between p-5 border-b">
                <h3 class="font-bold text-lg">
                    {{ $locale=='ar' ? 'القائمة' : 'Menu' }}
                </h3>

                <button id="closeMenu" class="text-2xl">
                    &times;
                </button>
            </div>

            <nav>

                <a href="{{ route('home',['locale'=>$locale]) }}"
                   class="block px-5 py-4 border-b">
                    {{ $locale=='ar' ? 'الرئيسية' : 'Home' }}
                </a>

                <!-- Services -->
                <details class="border-b">

                    <summary
                        class="px-5 py-4 font-semibold cursor-pointer flex justify-between">

                        {{ $locale=='ar' ? 'المنتجات' : 'Services' }}
                        <svg class="details-arrow w-5 h-5 text-gray-500"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M9 5l7 7-7 7"/>
                        </svg>
                    </summary>

                    <div class="bg-gray-50">

                        <a href="{{ route('services.index',['locale'=>$locale]) }}"
                           class="block px-8 py-3 text-blue-600 font-semibold">
                            {{ $locale=='ar' ? 'عرض جميع الخدمات' : 'View All Services' }}
                        </a>

                        @foreach($serviceCategories as $category)

                            <div class="px-8 py-2 text-blue-600 font-bold border-t">
                                {{ $category->trans('name') }}
                            </div>

                            @foreach($category->services as $service)

                                <a href="{{ route('services.show',[
                                    'locale'=>$locale,
                                    'service'=>$service->slug
                                ]) }}"
                                   class="block px-10 py-2 text-gray-700 hover:text-blue-600">

                                    {{ $service->trans('title') }}

                                </a>

                            @endforeach

                        @endforeach

                    </div>

                </details>

                <a href="{{ route('portfolio.index',['locale'=>$locale]) }}"
                   class="block px-5 py-4 border-b">
                    {{ $locale=='ar' ? 'أعمالنا' : 'Portfolio' }}
                </a>
                <a href="{{ route('products.index', ['locale' => $locale]) }}"
                   class="hover:text-amber-500 transition duration-300 border-b border-transparent hover:border-amber-500">

                    {{ $locale == 'ar' ? 'المنتجات' : 'Products' }}

                </a>
                <a href="{{ route('contact.index',['locale'=>$locale]) }}"
                   class="block px-5 py-4 border-b">
                    {{ $locale=='ar' ? 'اتصل بنا' : 'Contact' }}
                </a>

                <a href="{{ route($routeName,$routeParams) }}"
                   class="block px-5 py-4 text-blue-600 border-b">
                    {{ $locale=='ar' ? 'English' : 'العربية' }}
                </a>

                <div class="p-5">
                    <a href="{{ route('contact.index',['locale'=>$locale]) }}"
                       class="block bg-blue-600 text-white rounded-lg py-3 text-center">
                        {{ $locale=='ar' ? 'ابدأ الآن' : 'Start Now' }}
                    </a>
                </div>

            </nav>

        </div>

    </div>

</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const btn = document.getElementById('menuButton');
        const menu = document.getElementById('mobileMenu');
        const close = document.getElementById('closeMenu');
        const overlay = document.getElementById('mobileOverlay');

        function openMenu() {
            menu.classList.remove('hidden');
        }

        function closeMenu() {
            menu.classList.add('hidden');
        }

        function toggleMenu() {
            menu.classList.toggle('hidden');
        }

        // فتح / غلق من زر القائمة
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            toggleMenu();
        });

        // زر ×
        if (close) {
            close.addEventListener('click', function () {
                closeMenu();
            });
        }

        // الضغط خارج القائمة
        if (overlay) {
            overlay.addEventListener('click', function () {
                closeMenu();
            });
        }

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const btn = document.getElementById('productsMenuBtn');
        const menu = document.getElementById('productsMenu');
        const wrapper = document.getElementById('productsMenuWrapper');

        if (btn && menu) {

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {
                if (!wrapper.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const btn = document.getElementById('servicesMenuBtn');
        const menu = document.getElementById('servicesMenu');
        const wrapper = document.getElementById('servicesMenuWrapper');

        if (btn && menu) {

            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });

            document.addEventListener('click', function (e) {

                if (!wrapper.contains(e.target)) {
                    menu.classList.add('hidden');
                }

            });
        }

    });
</script>
