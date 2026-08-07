<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}"
      dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        rel="stylesheet"
        href="https://unpkg.com/aos@2.3.4/dist/aos.css">
    @livewireStyles
    <title>
        {{ $settings->trans('site_name') ?? 'Company' }}
        -
        {{ $settings->trans('tagline') }}
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @if($settings->favicon)
        <link rel="icon" type="image/png" href="{{ asset('storage/'.$settings->favicon) }}">
    @endif
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        ink: '#0B1220',
                        paper: '#F6F7F9',
                        signal: '#1363ff',
                        amber: '#FFB020',
                        slate: '#5B6472',
                        line: '#E4E7EC',
                    }
                }
            }
        }
    </script>

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            margin: 0;
            padding: 0;
        }
        .heroSwiper,
        .heroSwiper .swiper-slide,
        .heroSwiper .sk-hero{
            width:100%;
            min-height:100vh;
        }

        .heroSwiper .swiper-slide{
            overflow:hidden;
        }

        .sk-hero{
            display:flex;
            align-items:center;
            position:relative;
        }
        .sk-hero-slider{
            position:relative;
            width:100%;
        }

        .heroSwiper{
            width:100%;
            height:calc(100vh - 80px);
        }

        .heroSwiper .swiper-slide{
            height:calc(100vh - 80px);
        }

        .sk-hero{
            position:relative;
            width:100%;
            height:calc(100vh - 80px);

            background-size:cover !important;
            background-position:center center !important;
            background-repeat:no-repeat !important;

            display:flex;
            align-items:center;
        }

        /* طبقة شفافة فوق الصورة */
        .sk-hero::before{
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(
                135deg,
                rgba(3,10,18,.65) 0%,
                rgba(7,22,36,.45) 50%,
                rgba(7,22,36,.20) 100%
            );
            z-index:1;
        }

        /* المحتوى فوق الطبقة */
        .sk-container,
        .sk-hero-content{
            position:relative;
            z-index:2;
        }
        .sk-btn-primaryh{
            background:#f47d2b;
            color:#fff;
            padding:14px 30px;
            border-radius:12px;
            font-weight:700;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            text-decoration:none;
            transition:.3s ease;
        }
        .product-description{
            line-height:1.9;
            color:#374151;
        }

        /* العناوين */
        .product-description h1{
            font-size:2.2rem;
            font-weight:700;
            margin:25px 0 15px;
            color:#111827;
        }

        .product-description h2{
            font-size:1.8rem;
            font-weight:700;
            margin:20px 0 15px;
            color:#111827;
        }

        .product-description h3{
            font-size:1.4rem;
            font-weight:700;
            margin:15px 0 10px;
            color:#111827;
        }

        /* الفقرات */
        .product-description p{
            margin-bottom:15px;
            line-height:2;
        }

        /* القوائم */
        .product-description ul{
            list-style:disc;
            padding-inline-start:25px;
            margin:15px 0;
        }

        .product-description ol{
            list-style:decimal;
            padding-inline-start:25px;
            margin:15px 0;
        }

        .product-description li{
            margin-bottom:8px;
        }

        /* الصور */
        .product-description img{
            max-width:100%;
            height:auto;
            border-radius:12px;
            margin:20px 0;
            box-shadow:0 10px 25px rgba(0,0,0,.08);
        }

        /* الجداول */
        .product-description table{
            width:100%;
            border-collapse:collapse;
            margin:20px 0;
        }

        .product-description table th,
        .product-description table td{
            border:1px solid #e5e7eb;
            padding:12px;
        }

        .product-description table th{
            background:#f8fafc;
        }

        /* الروابط */
        .product-description a{
            color:#f97316;
            font-weight:600;
        }

        .product-description a:hover{
            text-decoration:underline;
        }
        .sk-btn-primary:hover{
            background:#dd6d1e;
            color:#fff;
            transform:translateY(-3px);
            box-shadow:0 10px 20px rgba(244,125,43,.35);
        }
        /* النص */

        .sk-hero-title{
            color:#fff;
            text-shadow:0 4px 25px rgba(0,0,0,.3);
        }

        .sk-hero-desc{
            color:#f5f5f5;
        }

        /* موبايل */

        @media(max-width:768px){

            .heroSwiper,
            .heroSwiper .swiper-slide,
            .sk-hero{
                height:85vh;
            }

        }
        .swiper-slide .sk-hero-content{
            opacity:0;
            transform:translateY(40px);
            transition:all .8s ease;
        }

        .swiper-slide-active .sk-hero-content{
            opacity:1;
            transform:translateY(0);
        }

        .heroSwiper .swiper-pagination{
            bottom:40px !important;
        }

        .heroSwiper .swiper-pagination-bullet{
            width:14px;
            height:14px;
            background:rgba(255,255,255,.4);
            opacity:1;
        }

        .heroSwiper .swiper-pagination-bullet-active{
            background:#f47d2b;
            width:40px;
            border-radius:20px;
        }

        .swiper-button-next,
        .swiper-button-prev{
            color:#f47d2b;
        }

        @media(max-width:768px){
            .swiper-button-next,
            .swiper-button-prev{
                display:none;
            }
        }
        .sk-hero-slider{
            position:relative;
        }

        .heroSwiper{
            width:100%;
            height:100vh;
        }

        .heroSwiper .swiper-slide{
            overflow:hidden;
        }

        .heroSwiper .sk-hero{
            min-height:100vh;
        }

        .swiper-button-next,
        .swiper-button-prev{
            color:#f47d2b;
        }
        .service-card{
            transition:all .5s ease;
        }

        .service-card:hover{
            transform:translateY(-12px);
            box-shadow:0 30px 60px rgba(0,0,0,.12);
        }

        .project-card{
            transition:all .5s ease;
        }

        .project-card:hover{
            transform:translateY(-12px);
            box-shadow:0 30px 60px rgba(0,0,0,.12);
        }

        .client-item img{
            filter:grayscale(100%);
            opacity:.7;
            transition:.4s;
        }

        .client-item:hover img{
            filter:none;
            opacity:1;
            transform:scale(1.08);
        }
        .swiper-pagination-bullet{
            background:#fff;
        }

        .swiper-pagination-bullet-active{
            background:#f47d2b;
        }

    </style>

    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>

<body class="text-ink">

@include('partials.header')

<main>
    @yield('content')
</main>

@include('partials.footer')

@if($settings?->whatsapp || $settings?->phone)

    <div class="fixed bottom-6 right-6 z-[9999] flex flex-col gap-3">

        @if($settings?->whatsapp)
            <a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp) }}"
               target="_blank"
               class="w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">

                <i class="fab fa-whatsapp text-2xl"></i>

            </a>
        @endif

            @if($settings?->phone)
                <a href="tel:{{ $settings->phone }}"
                   class="floating-phone">
                    <i class="fas fa-phone"></i>
                </a>
            @endif

        <button id="scrollTopBtn"
                class="w-14 h-14 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">

            <i class="fas fa-arrow-up"></i>

        </button>

    </div>

@endif

@stack('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const btn = document.getElementById('scrollTopBtn');

        if(btn){
            btn.addEventListener('click', function () {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        new Swiper(".projectGallery", {

            loop: true,

            slidesPerView: 1,

            spaceBetween: 20,

            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },

            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },

        });

    });
</script>
@livewireScripts
<script>
    document.addEventListener("DOMContentLoaded", function () {

        new Swiper(".heroSwiper", {

            loop: true,

            effect: "fade",

            fadeEffect: {
                crossFade: true
            },

            speed: 1500,

            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },

            pagination: {
                el: ".heroSwiper .swiper-pagination",
                clickable: true,
            },

            navigation: {
                nextEl: ".heroSwiper .swiper-button-next",
                prevEl: ".heroSwiper .swiper-button-prev",
            }

        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/gsap.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/gsap@3/dist/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
    AOS.init({

        duration: 800,

        easing: 'ease-out',

        once: true,

        offset: 80,

    });
</script>
<script>



    /* آراء العملاء */

    gsap.registerPlugin(ScrollTrigger);

    document.addEventListener("DOMContentLoaded", () => {

        gsap.utils.toArray(".service-card").forEach(card => {

            gsap.from(card, {
                opacity: 0,
                y: 50,
                duration: .8,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%"
                }
            });

        });

        gsap.utils.toArray(".project-card").forEach(card => {

            gsap.from(card, {
                opacity: 0,
                y: 50,
                duration: .8,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%"
                }
            });

        });

        gsap.utils.toArray(".testimonial-card").forEach(card => {

            gsap.from(card, {
                opacity: 0,
                y: 50,
                duration: .8,
                ease: "power3.out",
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%"
                }
            });

        });

    });

</script>
</body>
</html>
