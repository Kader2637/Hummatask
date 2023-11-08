<!DOCTYPE html>

<html lang="en" class="light-style  layout-navbar-fixed    " dir="ltr" data-theme="theme-default"
    data-assets-path="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/"
    data-base-url="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1" data-framework="laravel"
    data-template="front-menu-theme-default-light">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>{{ $title }}</title>
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <meta name="csrf-token" content="y0lzh53YmoH0xFgY2vFjhD4S1TOiq6lE58zbW7ec">
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;ampdisplay=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/tabler-iconsea04.css?id=6ad8bc28559d005d792d577cf02a2116"') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core6cc1.css?id=9dd8321ea008145745a7d78e072a6e36') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demof1ed.css?id=ddd2feb83a604f9e432cdcb29815ed44') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/node-waves/node-wavesd178.css?id=aa72fb97dfa8e932ba88c8a3c04641bc') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/css/pages/front-pagee721.css?id=360d017735733ce726893ee5acf0aa07') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/front-config.js') }}"></script>

<!-- Vendor Styles -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css')}}" />


<!-- Page Styles -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css')}}" />
    <script>
        window.templateCustomizer = new TemplateCustomizer({
            cssPath: '',
            themesPath: '',
            defaultStyle: "light",
            displayCustomizer: "true",
            lang: 'en',
            pathResolver: function(path) {
                var resolvedPaths = {
                    'core.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/core.css?id=9dd8321ea008145745a7d78e072a6e36',
                    'core-dark.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/core-dark.css?id=d661bae1d0ada9f7e9e3685a3e1f427e',

                    'theme-default.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default.css?id=a4539ede8fbe0ee4ea3a81f2c89f07d9',
                    'theme-default-dark.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-default-dark.css?id=ce86d777a4c5030f51d0f609f202bcc5',
                    'theme-bordered.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered.css?id=786794ca0c68d96058e8ceeb20f4e7c5',
                    'theme-bordered-dark.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-bordered-dark.css?id=e7122ef6338b22f7cea9eaff5a96aa8b',
                    'theme-semi-dark.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark.css?id=a0a317e88e943fdd62d514e00deebb22',
                    'theme-semi-dark-dark.css': 'https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/rtl/theme-semi-dark-dark.css?id=e9a2f7cd6ace727264936f6bf93ab1e2',
                }
                return resolvedPaths[path] || path;
            },
            'controls': ["rtl", "style"],

        });
    </script>
</head>

<body>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <nav class="layout-navbar shadow-none py-0">
        <div class="">
            <div class="navbar navbar-expand-lg landing-navbar px-3 mt-0 border-0">
                <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                    <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <a href="landing.html" class="app-brand-link">
                        <span class="app-brand-logo demo"><svg width="32" height="20" viewBox="0 0 32 22"
                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                    fill="#7367F0" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                    fill="#161616" />
                                <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                    d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                    fill="#161616" />
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                    fill="#7367F0" />
                            </svg>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">HummaTask</span>
                    </a>
                </div>
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-sm"></i>
                    </button>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page" href="#landingHero">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingFeatures">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingReviews">Kerja sama</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingPricing">Galeri</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingFAQ">Pertanyaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingContact">Hubungi kami</a>
                        </li>
                    </ul>
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>
                <ul class="navbar-nav flex-row align-items-center ms-auto">
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <i class='ti ti-sm'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                    <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                    <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('login') }}" class="btn btn-primary"><span
                                class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span
                                class="d-none d-md-block">Login</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div data-bs-spy="scroll" class="scrollspy-example">
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title display-6 fw-bold">Hummatech Task Management</h1>
                        <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Aplikasi web yang membantu tugas keseharian anda<br class="d-none d-lg-block" />
                            Mencatat, Menyimpan dan Mengingatkan tugas Anda
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Masuk Komunitas
                                <img src="{{ asset('assets/img/front-pages/icons/Join-community-arrow.png') }}"
                                    alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                            <a href="#landingPricing" class="btn btn-primary btn-lg">Dapatkan Akses Awal</a>
                        </div>
                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="../app/ecommerce/dashboard.html" target="_blank">
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                                    alt="hero dashboard" class="animation-img"
                                    data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-dashboard-light.png" />
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-light.png') }}"
                                    alt="hero elements"
                                    class="position-absolute hero-elements-img animation-img top-0 start-0"
                                    data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-elements-light.png" />
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="landing-hero-blank"></div>
        </section>

        <section id="landingFeatures" class="section-py landing-features">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Fitur bermanfaat</span>
                </div>
                <h3 class="text-center mb-1">
                    <span class="section-title">Semua yang kamu butuhkan</span> untuk menjadi lebih produktif
                </h3>
                <p class="text-center mb-3 mb-md-5 pb-3">
                    Tidak hanya menjadi alat, kami adalah teman anda menjadi lebih produktif
                </p>
                <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/laptop.png') }}"
                                alt="laptop charging" />
                        </div>
                        <h5 class="mb-3">Dashboard Pribadi</h5>
                        <p class="features-icon-description">
                            Semua tools yang anda butuhkan dibungkus rapi dalam dashboard pribadi milik anda
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/rocket.png') }}" alt="transition up" />
                        </div>
                        <h5 class="mb-3">Catatan dan Dokumen</h5>
                        <p class="features-icon-description">
                            Kegiatan menulis menggunakan alat konvensional sudah terlalu kuno di zaman sekarang ganti
                            dengan mengetik
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/paper.png') }}" alt="edit" />
                        </div>
                        <h5 class="mb-3">Managemen Tugas</h5>
                        <p class="features-icon-description">
                            Mulai Kelola tugasmu dengan Hummatask menjadi lebih mudah dan tanpa kata ribet
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/check.png') }}" alt="3d select solid" />
                        </div>
                        <h5 class="mb-3">Penyimpanan file</h5>
                        <p class="features-icon-description">
                            Simpan semua materi dan tugasmu di HummaTask dan tidak ada lagi lupa membawa Pekerjaan dan
                            Buku
                        </p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/user.png') }}" alt="lifebelt" />
                        </div>
                        <h5 class="mb-3">Notifikasi dan Pengingat</h5>
                        <p class="features-icon-description">HummaTask akan selalu mengingatkanmu bahkan 3 hari sebelum
                            deadline</p>
                    </div>
                    <div class="col-lg-4 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <img src="{{ asset('assets/img/front-pages/icons/keyboard.png') }}" alt="google docs" />
                        </div>
                        <h5 class="mb-3">Visualisasi dan Grafik</h5>
                        <p class="features-icon-description">Selalu lihat tugasmu setiap Semester,Bulan bahkan hari
                            dengan visual dan grafik yang membuat mata nyaman</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingFunFacts" class="section-py bg-body landing-reviews pb-0">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-primary shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/laptop.png') }}" alt="laptop"
                                    class="mb-2" />
                                <h5 class="h2 mb-1">7</h5>
                                <p class="fw-medium mb-0">
                                    Materi di LMS
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-success shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/user-success.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">50</h5>
                                <p class="fw-medium mb-0">
                                    Siswa Magang
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-info shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/user.png') }}" alt="laptop"
                                    class="mb-2" />
                                <h5 class="h2 mb-1">200</h5>
                                <p class="fw-medium mb-0">
                                    Siswa Alumni<br />
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-warning shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/check-warning.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">100%</h5>
                                <p class="fw-medium mb-0">
                                    Reating Google Maps
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingReviews" class="section-py bg-body landing-fun-facts">
            <div class="container">
                <div class="row align-items-center gx-0 gy-4 g-lg-5">
                    <div class="col-md-6 col-lg-5 col-xl-3">
                        <div class="mb-3 pb-1">
                            <span class="badge bg-label-primary">menjalin kerja sama</span>
                        </div>
                        <h3 class="mb-1"><span class="section-title">Sekolah yang bekerja sama</span></h3>
                        <p class="mb-0 mb-md-1">
                            Berikut adalah beberapa<br class="d-none d-xl-block" />
                            sekolah atau lembaga yang menjalin kerjasama dengan Hummatech
                        </p>
                        <div class="landing-reviews-btns">
                            <button id="reviews-previous-btn"
                                class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                                <i class="ti ti-chevron-left ti-sm"></i>
                            </button>
                            <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                                type="button">
                                <i class="ti ti-chevron-right ti-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 col-xl-9">
                        <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-reviews">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div class="card h-100">
                                                <div
                                                    class="card-body text-body d-flex flex-column justify-content-between">
                                                    <div class="mb-auto mt-auto">
                                                        <img src="{{ asset('assets/img/front-pages/branding/sekolah.png') }}"
                                                            alt="client logo" class="client-logo img-fluid" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between">
                                                <div class="mx-auto my-auto">
                                                    <img src="{{ asset('assets/img/front-pages/branding/psht.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-auto mt-auto">
                                                    <img src="{{ asset('assets/img/front-pages/branding/contoh.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-auto mt-auto">
                                                    <img src="{{ asset('assets/img/front-pages/branding/ikspi.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-auto mt-auto">
                                                    <img src="{{ asset('assets/img/front-pages/branding/sekolah.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-auto mt-auto">
                                                    <img src="{{ asset('assets/img/front-pages/branding/sekolah.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingPricing" class="section-py">
            <!-- Gallery effect-->
            <div class="col-12">
                <h3 class="text-center mb-1"><span class="section-title">Galeri </span>Siswa</h3>
                <div id="swiper-gallery">
                    <div class="swiper gallery-top">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/2.jpg')}})">Slide 1</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/1.jpg')}})">Slide 2</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/3.jpg')}})">Slide 3</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/4.jpg')}})">Slide 4</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/6.jpg')}})">Slide 5</div>
                        </div>
                        <!-- Add Arrows -->
                        <div class="swiper-button-next swiper-button-white"></div>
                        <div class="swiper-button-prev swiper-button-white"></div>
                    </div>
                    <div class="swiper gallery-thumbs">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/2.jpg')}})">Slide 1</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/1.jpg')}})">Slide 2</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/3.jpg')}})">Slide 3</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/4.jpg')}})">Slide 4</div>
                            <div class="swiper-slide"
                                style="background-image:url({{ asset('assets/img/backgrounds/6.jpg')}})">Slide 5</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingFAQ" class="section-py bg-body landing-faq">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Pertanyaan</span>
                </div>
                <h3 class="text-center mb-1">Beberapa persoalan yang sering <span
                        class="section-title">ditanyakan</span></h3>
                <p class="text-center mb-5 pb-3">Jelajahi bagian ini dan hilangkan rasa penasaran yang ada dibenakmu
                </p>
                <div class="row gy-5">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/front-pages/landing-page/faq-boy-with-logos.png') }}"
                                alt="faq boy with logos" class="faq-image" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion" id="accordionExample">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionOne" aria-expanded="true"
                                        aria-controls="accordionOne">
                                        Do you charge for each upgrade?
                                    </button>
                                </h2>

                                <div id="accordionOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping.
                                        Sesame snaps icing
                                        marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée
                                        pastry topping
                                        soufflé. Wafer gummi bears marshmallow pastry pie.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                        aria-expanded="false" aria-controls="accordionTwo">
                                        Do I need to purchase a license for each website?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw
                                        dragée oat cake
                                        dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart
                                        donut gummies. Jelly
                                        beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                        aria-expanded="false" aria-controls="accordionThree">
                                        What is regular license?
                                    </button>
                                </h2>
                                <div id="accordionThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Regular license can be used for end products that do not charge users for access
                                        or service(access
                                        is free and there will be no monthly subscription fee). Single regular license
                                        can be used for
                                        single end product and end product can be used by you or your client. If you
                                        want to sell end
                                        product to multiple clients then you will need to purchase separate license for
                                        each client. The
                                        same rule applies if you want to use the same end product on multiple
                                        domains(unique setup). For
                                        more info on regular license you can check official description.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFour"
                                        aria-expanded="false" aria-controls="accordionFour">
                                        What is extended license?
                                    </button>
                                </h2>
                                <div id="accordionFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid
                                        quaerat possimus maxime!
                                        Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum
                                        maxime, blanditiis
                                        earum ea, incidunt quam possimus cumque.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFive"
                                        aria-expanded="false" aria-controls="accordionFive">
                                        Which license is applicable for SASS application?
                                    </button>
                                </h2>
                                <div id="accordionFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias
                                        exercitationem ab cum
                                        nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia
                                        ipsam quasi
                                        labore enim architecto non!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="landing-footer bg-body footer-text" id="landingContact">
        <div class="footer-top">
            <div class="container">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="col-lg-5">
                        <a href="landing.html" class="app-brand-link mb-4">
                            <span class="app-brand-logo demo"><svg width="32" height="20" viewBox="0 0 32 22"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span>
                            <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">HummaTask</span>
                        </a>
                        <p class="footer-text footer-logo-description mb-4">
                            Aplikasi pengelola dan pengingat tugasmu, kami adalah temanmu menjadi produktif
                        </p>
                        <form class="footer-form">
                            <label for="footer-email" class="small">Berlangganan untuk hal terbaru</label>
                            <div class="d-flex mt-1">
                                <input type="email"
                                    class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                    id="footer-email" placeholder="Emailmu" />
                                <button type="submit"
                                    class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                    Berlangganan
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Demos</h6>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                                    target="_blank" class="footer-link">Vertical Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-5"
                                    target="_blank" class="footer-link">Horizontal Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-2"
                                    target="_blank" class="footer-link">Bordered Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-3"
                                    target="_blank" class="footer-link">Semi Dark Layout</a>
                            </li>
                            <li class="mb-3">
                                <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-4"
                                    target="_blank" class="footer-link">Dark Layout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Pages</h6>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="pricing.html" class="footer-link">Pricing</a>
                            </li>
                            <li class="mb-3">
                                <a href="payment.html" class="footer-link">Payment<span
                                        class="badge rounded bg-primary ms-2">New</span></a>
                            </li>
                            <li class="mb-3">
                                <a href="checkout.html" class="footer-link">Checkout</a>
                            </li>
                            <li class="mb-3">
                                <a href="help-center.html" class="footer-link">Help Center</a>
                            </li>
                            <li class="mb-3">
                                <a href="../auth/login-cover.html" target="_blank"
                                    class="footer-link">Login/Register</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h6 class="footer-title mb-4">Download our app</h6>
                        <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img
                                src="{{ asset('assets/img/front-pages/landing-page/apple-icon.png') }}"
                                alt="apple icon" /></a>
                        <a href="javascript:void(0);" class="d-block footer-link"><img
                                src="{{ asset('assets/img/front-pages/landing-page/google-play-icon.png') }}"
                                alt="google play icon" /></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/front-main1b3c.js?id=2c2564d4c142df108c8f3152af8e0460') }}"></script>
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js')}}"></script>
    <script src="{{ asset('assets/js/ui-carousel.js')}}"></script>
</body>

</html>
