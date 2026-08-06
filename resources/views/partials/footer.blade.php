@php $locale = app()->getLocale(); @endphp
<footer class="bg-ink text-white/70 mt-24">
    <div class="max-w-7xl mx-auto px-6 py-16 grid md:grid-cols-4 gap-10">
        <div class="md:col-span-2">
            <div class="text-white font-extrabold text-xl mb-3">{{ $settings->trans('site_name') }}</div>
            <p class="max-w-md leading-relaxed text-sm">{{ $settings->trans('footer_about') }}</p>
            <div class="flex gap-4 mt-6">
                @foreach(['facebook_url','linkedin_url','twitter_url','instagram_url','youtube_url'] as $social)
                    @if($settings->{$social})
                        <a href="{{ $settings->{$social} }}" target="_blank" class="w-9 h-9 rounded-full border border-white/15 flex items-center justify-center hover:border-signal hover:text-signal transition text-xs">
                            {{ strtoupper(substr($social, 0, 2)) }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <div class="eyebrow text-signal text-xs mb-4">{{ $locale === 'ar' ? 'روابط' : 'LINKS' }}</div>
            <ul class="space-y-2 text-sm">
                <li><a href="{{ route('services.index', ['locale' => $locale]) }}" class="hover:text-signal">{{ $locale === 'ar' ? 'خدماتنا' : 'Services' }}</a></li>
                <li><a href="{{ route('portfolio.index', ['locale' => $locale]) }}" class="hover:text-signal">{{ $locale === 'ar' ? 'أعمالنا' : 'Portfolio' }}</a></li>
                <li><a href="{{ route('contact.index', ['locale' => $locale]) }}" class="hover:text-signal">{{ $locale === 'ar' ? 'تواصل معنا' : 'Contact' }}</a></li>
            </ul>
        </div>

        <div>
            <div class="eyebrow text-signal text-xs mb-4">{{ $locale === 'ar' ? 'تواصل' : 'CONTACT' }}</div>
            <ul class="space-y-2 text-sm">
                @if($settings->phone)<li dir="ltr" class="text-end">{{ $settings->phone }}</li>@endif
                @if($settings->email)<li>{{ $settings->email }}</li>@endif
                @if($settings->trans('address'))<li>{{ $settings->trans('address') }}</li>@endif
            </ul>
        </div>
    </div>

    <div class="border-t border-white/10 py-5 text-center text-xs">
        &copy; {{ date('Y') }} {{ $settings->trans('site_name') }}. {{ $locale === 'ar' ? 'جميع الحقوق محفوظة' : 'All rights reserved' }}.
    </div>
</footer>
