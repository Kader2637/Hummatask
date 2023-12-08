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
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
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
    {{-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> --}}
    <script src="{{ asset('assets/js/front-config.js') }}"></script>
    <!-- Vendor Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <!-- Page Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/css/galery.css') }}"></script>
    <style>
        .responsive-img{
            width: 100%;
            height: auto;
        }
        @media (max-width: 768px){
        .responsive-img {
            max-width: 100%;
            height: auto;
        }
    }
    </style>
</head>

<body>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <nav class="layout-navbar shadow-none py-0 rounded">
        <div class="">
            <div class="navbar navbar-expand-lg landing-navbar px-3 mt-0 border-0  ">
                <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                    <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <a href="" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ asset('assets/img/hummatask.png') }}" width="50" height="40"
                                alt="Loader Image">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1" style="color:#7367F0;">Humma<span
                                style="color: purple;">Task</span></span>
                    </a>
                </div>
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria- label="Toggle navigation">
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
                    <li style="color:#7367F0;">
                        <a href="{{ route('login') }}" class="btn btn-primary"><span
                                class="tf-icons fa-solid fa-right-to-bracket scaleX-n1-rtl me-md-1"></span><span
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
                    </div>
                    <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="" target="_blank">
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                                    alt="" class="animation-img"
                                    data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-dashboard-light.png" />
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-light.png') }}"
                                    alt=""
                                    class="position-absolute hero-elements-img animation-img top-0 start-0 price-duration-toggler"
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
                                <h5 class="h2 mb-1">{{ $task }}</h5>
                                <p class="fw-medium mb-0">
                                    Presentasi selesai
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-success shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/user-success.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">{{ $user }}</h5>
                                <p class="fw-medium mb-0">
                                    Siswa Magang Hummatech
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-info shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/user.png') }}" alt="laptop"
                                    class="mb-2" />
                                <h5 class="h2 mb-1" id="countingElement">{{ $tim }}</h5>
                                <p class="fw-medium mb-0">
                                    Team terbuat di Hummatask<br />
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-warning shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/check-warning.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">{{ $project }}</h5>
                                <p class="fw-medium mb-0">
                                    Project selesai
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingReviews" class="section-py bg-body landing-fun-facts">
            <div class="container">
                <div class="row align-items-center gx-0 gy-4 g-lg-4">
                    <div class="col-md-6 col-lg-6 col-xl-4">
                        <div class="mb-3 pb-1">
                            <span class="badge bg-label-primary text-capitalize">menjalin kerja sama</span>
                        </div>
                        <h3 class="mb-1"><span class="section-title">Sekolah yang bekerja sama</span></h3>
                        <p class="mb-0 mb-md-1">
                            Berikut adalah beberapa<br class="d-none d-xl-block" />
                            sekolah atau lembaga yang menjalin kerjasama dengan Hummatech
                        </p>
                        <div class="landing-reviews-btns">
                            @if ($logo->count() > 1)
                                {{-- <button id="reviews-previous-btn"
                                    class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                                    <i class="ti ti-chevron-left ti-sm"></i>
                                </button>
                                <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                                    type="button">
                                    <i class="ti ti-chevron-right ti-sm"></i>
                                </button> --}}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-8">
                        <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-reviews">
                                @if ($logo->isEmpty())
                                    <div class="justify-content-center" style="display: flex;">
                                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}"
                                            alt="page-misc-under-maintenance" class="responsive-img">
                                    </div>
                                @else
                                    <div class="swiper-wrapper">
                                        @foreach ($logo as $item)
                                            <div class="swiper-slide">
                                                <div class="card h-100">
                                                    <div class="card h-100">
                                                        <div
                                                            class="card-body text-body d-flex flex-column justify-content-between">
                                                            <div class="mb-auto mt-auto">
                                                                <img src="{{ asset('storage/public/img/' . $item->foto) }}"
                                                                    alt="client logo" class="client-logo img-fluid"
                                                                    style="max-width: 95%;" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    @if ($logo->count() > 1)
                                        <div class="swiper-button-next"></div>
                                        <div class="swiper-button-prev"></div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="landingPricing" class="section-py">
            <!-- Gallery effect-->
            <div class="container py-1">
                <!-- For Demo Purpose -->
                <header class="text-center">
                    <h3 class="display-4 font-weight-bold"><span style="color:#7367F0;">Galery </span> Hummasoft</h3>
                    <p class="font-italic text-muted mb-0">Galery kegiatan anak magang di hummasoft</p>
                    <p class="font-italic">Humma<a href="https://bootstrapious.com" class="text-muted">
                            <u>soft</u></a>
                    </p>
                </header>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="news-slider" class="owl-carousel">
                            @forelse ($galery as $item)
                                <div class="post-slide">
                                    <div class="hover hover-4 text-white rounded ">
                                        <img src="{{ asset('storage/public/img/' . $item->foto) }}" alt="">
                                        <div class="hover-overlay"></div>
                                        <div class="hover-4-content">
                                            <h3 class="hover-4-title text-uppercase font-weight-bold mb-0" style="color:#7367F0;"><span
                                                    class="font-weight-light fw-lighter">{{ $item->judul }}</span></h3>
                                            <p class="hover-4-description text-uppercase mb-0 small ">
                                                {{ $item->keterangan }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="justify-content-center" style="display: flex;">
                                    <img src="{{ asset('assets/img/illustrations/noData.png') }}" alt="">
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <section id="landingFAQ" class="section-py bg-body landing-faq">
                <div class="container">
                    <div class="text-center mb-3 pb-1">
                        <span class="badge bg-label-primary">Pertanyaan</span>
                    </div>
                    <h3 class="text-center mb-1">Beberapa persoalan yang sering <span
                            class="section-title">ditanyakan</span>
                    </h3>
                    <p class="text-center mb-5 pb-3">Jelajahi bagian ini dan hilangkan rasa penasaran yang ada
                        dibenakmu
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
                                            Web apa ini?
                                        </button>
                                    </h2>

                                    <div id="accordionOne" class="accordion-collapse collapse show"
                                        data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Ini adalah sebuah web pengelola tugas anak magang di Hummatech, harapan nya
                                            dengan ada nya web ini, para siswa magang dapat mengelola pekerjaan mereka
                                            dengan lebih efisien.
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                            aria-expanded="false" aria-controls="accordionTwo">
                                            Apa fitur-fitur nya?
                                        </button>
                                    </h2>
                                    <div id="accordionTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Fitur-fitur yang ada di web ini adalah Board untuk mengelola tugas, Catatan
                                            untuk catatan tim atau catatan presentasi, Pengajuan dan history presentasi,
                                            dan
                                            ada halaman project untuk melihat statistik project.
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                            aria-expanded="false" aria-controls="accordionThree">
                                            Apakah web ini memerlukan biaya tambahan?
                                        </button>
                                    </h2>
                                    <div id="accordionThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Tidak ada, karena web ini di khususkan untuk siswa magang Hummatech dan
                                            dapat
                                            digunakan secara gratis.
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordionFour"
                                            aria-expanded="false" aria-controls="accordionFour">
                                            Web ini dibuat menggunakan bahasa apa?
                                        </button>
                                    </h2>
                                    <div id="accordionFour" class="accordion-collapse collapse"
                                        aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Web ini dibuat menggunakan Laravel, yaitu framework dari bahasa php.
                                        </div>
                                    </div>
                                </div>
                                <div class="card accordion-item">
                                    <h2 class="accordion-header" id="headingFive">
                                        <button type="button" class="accordion-button collapsed"
                                            data-bs-toggle="collapse" data-bs-target="#accordionFive"
                                            aria-expanded="false" aria-controls="accordionFive">
                                            Kapan web ini dibuat?
                                        </button>
                                    </h2>
                                    <div id="accordionFive" class="accordion-collapse collapse"
                                        aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            Web ini dibuat pada bulan oktober tahun 2023.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </div>

    <style>

        .hover {
            overflow: hidden;
            position: relative;
            padding-bottom: 60%;
        }

        .hover-overlay {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 90;
            transition: all 0.4s;
        }

        .hover img {
            width: 100%;
            position: absolute;
            top: 0;
            left: 0;
            transition: all 0.3s;
        }

        .hover-content {
            position: relative;
            z-index: 99;
        }

        /* DEMO 4 ============================== */
        .hover-4 img {
            width: 110%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .hover-4 .hover-overlay {
            background: rgba(0, 0, 0, 0.4);
            z-index: 90;
        }

        .hover-4-title {
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 3rem;
            z-index: 99;
        }

        .hover-4-description {
            position: absolute;
            font-size: 1.2vw;
            top: 2rem;
            left: 2rem;
            text-align: right;
            border-right: 3px solid #fff;
            padding: 0 1rem;
            z-index: 99;
            transform: translateX(-1.5rem);
            opacity: 0;
            transition: all 0.3s;
        }

        @media (min-width: 992px) {
            .hover-4-description {
                width: 50%;
            }
        }

        .hover-4:hover img {
            width: 100%;
        }

        .hover-4:hover::after {
            opacity: 1;
            transform: none;
        }

        .hover-4:hover .hover-4-description {
            opacity: 1;
            transform: none;
        }

        .hover-4:hover .hover-overlay {
            background: rgba(0, 0, 0, 0.8);
        }

        body {
            min-height: 100vh;
            background-color: #fafafa;
        }

        /* calouser */


        #news-slider {
            margin-top: 80px;
        }

        .post-slide {
            background: #fff;
            margin: 20px 15px 20px;
            border-radius: 15px;
            padding-top: 1px;
            box-shadow: 0px 14px 22px -9px #bbcbd8;
        }

        .post-slide .post-img {
            position: relative;
            overflow: hidden;
            border-radius: 10px;
            margin: -12px 15px 8px 15px;
            margin-left: -10px;
        }

        .post-slide .post-img img {
            width: 100%;
            height: auto;
            transform: scale(1, 1);
            transition: transform 0.2s linear;
        }

        .post-slide:hover .post-img img {
            transform: scale(1.1, 1.1);
        }

        .post-slide .over-layer {
            width: 100%;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            background: linear-gradient(-45deg, rgba(6, 190, 244, 0.75) 0%, rgba(45, 112, 253, 0.6) 100%);
            transition: all 0.50s linear;
        }

        .post-slide:hover .over-layer {
            opacity: 1;
            text-decoration: none;
        }

        .post-slide .over-layer i {
            position: relative;
            top: 45%;
            text-align: center;
            display: block;
            color: #fff;
            font-size: 25px;
        }

        .post-slide .post-content {
            background: #fff;
            padding: 2px 20px 40px;
            border-radius: 15px;
        }

        .post-slide .post-title a {
            font-size: 15px;
            font-weight: bold;
            color: #333;
            display: inline-block;
            text-transform: uppercase;
            transition: all 0.3s ease 0s;
        }

        .post-slide .post-title a:hover {
            text-decoration: none;
            color: #3498db;
        }

        .post-slide .post-description {
            line-height: 24px;
            color: #5b98cd;
            margin-bottom: 25px;
        }

        .post-slide .post-date {
            color: #a9a9a9;
            font-size: 14px;
        }

        .post-slide .post-date i {
            font-size: 20px;
            margin-right: 8px;
            color: #CFDACE;
        }

        .post-slide .read-more {
            padding: 7px 20px;
            float: right;
            font-size: 12px;
            background: #2196F3;
            color: #ffffff;
            box-shadow: 0px 10px 20px -10px #1376c5;
            border-radius: 25px;
            text-transform: uppercase;
        }

        .post-slide .read-more:hover {
            background: #3498db;
            text-decoration: none;
            color: #fff;
        }

        .owl-controls .owl-buttons {
            text-align: center;
            margin-top: 20px;
        }

        .owl-controls .owl-buttons .owl-prev {
            background: #fff;
            position: absolute;
            top: -13%;
            left: 15px;
            padding: 0 18px 0 15px;
            border-radius: 50px;
            box-shadow: 3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }

        .owl-controls .owl-buttons .owl-next {
            background: #fff;
            position: absolute;
            top: -13%;
            right: 15px;
            padding: 0 15px 0 18px;
            border-radius: 50px;
            box-shadow: -3px 14px 25px -10px #92b4d0;
            transition: background 0.5s ease 0s;
        }

        .owl-controls .owl-buttons .owl-prev:after,
        .owl-controls .owl-buttons .owl-next:after {
            content: "\f104";
            font-family: FontAwesome;
            color: #333;
            font-size: 30px;
        }

        .owl-controls .owl-buttons .owl-next:after {
            content: "\f105";
        }

        @media only screen and (max-width:1280px) {
            .post-slide .post-content {
                padding: 0px 15px 25px 15px;
            }
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#news-slider").owlCarousel({
                items: 2,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [980, 2],
                itemsMobile: [600, 1],
                loop: true,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true

            });
        });
    </script>


    <footer class="landing-footer bg-body footer-text" id="landingContact">
        <div class="footer-top">
            <div class="container">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="col-lg-5">
                        <a href="" class="app-brand-link mb-4">
                            <span class="app-brand-logo demo mb-1">
                                <img src="{{ asset('assets/img/taskhumma.png') }}" width="60" height="50"
                                    alt="Loader Image">
                            </span>
                            <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1"><span
                                    style="color:#7367F0;">Humma</span>task</span>
                        </a>
                        <p class="footer-text footer-logo-description mb-4">
                            Aplikasi HummaTask membantu Anda mengelola dan mengingat tugas-tugas Anda, menjadi teman produktivitas Anda.
                        </p>
                        {{-- <form class="footer-form">
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
                        </form> --}}
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h5 class="footer-title mb-4">Alamat Kantor</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="" target="_blank" class="footer-link">Perum permata regency 1 blok 10
                                    no 28 ngijo karangploso
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6">
                        <h5 class="footer-title mb-4">Tentang Perusahaan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="" class="footer-link">Hummasoft
                                    Kelas Industri
                                    E Learning
                                    Magang / PKL</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <h5 class="footer-title mb-4">Pesan</h5>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="" class="footer-link">Sempurnakan Tugas Keseharianmu dengan Hummatech
                                    Task Management: Mencatat, Menyimpan, dan Mengingatkan dengan Lebih Efisien!</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/front-main1b3c.js?id=2c2564d4c142df108c8f3152af8e0460') }}"></script>
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
</body>

</html>
</div>
