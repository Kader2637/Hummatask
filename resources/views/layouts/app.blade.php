<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed   " dir="ltr"
    data-theme="theme-default"
    data-assets-path="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/"
    data-base-url="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1" data-framework="laravel"
    data-template="vertical-menu-theme-default-light">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        {{ $title }}
    </title>
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <meta name="csrf-token" content="y0lzh53YmoH0xFgY2vFjhD4S1TOiq6lE58zbW7ec">
    <link rel="canonical" href="https://1.envato.market/vuexy_admin">
    <link rel="icon" type="image/x-icon"
        href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/favicon/favicon.ico" />

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap"
        rel="stylesheet">

    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/tabler-iconsea04.css?id=6ad8bc28559d005d792d577cf02a2116') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/fontawesome8a69.css?id=a2997cb6a1c98cc3c85f4c99cdea95b5') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/flag-icons80a8.css?id=121bcc3078c6c2f608037fb9ca8bce8d') }}" />
    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core6cc1.css?id=9dd8321ea008145745a7d78e072a6e36') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/css/rtl/theme-defaultfc79.css?id=a4539ede8fbe0ee4ea3a81f2c89f07d9') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demof1ed.css?id=ddd2feb83a604f9e432cdcb29815ed44') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/node-waves/node-wavesd178.css?id=aa72fb97dfa8e932ba88c8a3c04641bc') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar7358.css?id=280196ccb54c8ae7e29ea06932c9a4b6') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/typeahead-js/typeaheadb5e1.css?id=2603197f6b29a6654cb700bd9367e2a3') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    @yield('link')
</head>

@yield('style')

<body>
    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo">
                    <a href="{{ route('dashboard.siswa') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ url('assets/img/icons/icon.svg') }}" width="50" alt=""
                                srcset="">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold">HummaTask</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
                        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
                    </a>
                </div>
                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <li class="menu-item">
                        <a href="{{ route('dashboard.siswa') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-category"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Dashboard</div>
                        </a>
                    </li>

                    {{-- Navigasi ketua magang --}}

                    @can('kelola siswa')
                        <li class="menu-item @if (
                            $title === 'Dashboard Ketua Magang' ||
                                $title === 'Presentasi Ketua Magang' ||
                                $title === 'Project Ketua Magang' ||
                                $title === 'History Ketua Magang') open @endif">
                            <a href="" class="menu-link menu-toggle d-flex">
                                <i class="menu-icon tf-icons ti ti-crown"></i>
                                <div class="w-100 d-flex align-items-center justify-content-between">Ketua Magang</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                    <a href="{{ route('ketua.dashboard') }}" class="menu-link">
                                        <div>Dashboard</div>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="{{ route('ketua.presentasi') }}" class="menu-link">
                                        <div>Presentasi</div>
                                    </a>
                                </li>
                                <li class="menu-item {{ request()->routeIs('ketua.project') ? 'active' : '' }}">
                                    <a href="{{ route('ketua.project') }}" class="menu-link">
                                        <div>Project</div>
                                    </a>
                                </li>
                                <li class="menu-item ">
                                    <a href="{{ route('ketua.history') }}" class="menu-link">
                                        <div>History</div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    @endcan

                    {{-- Navigasi ketua magang --}}

                    <li class="menu-item ">
                        <a class="menu-link">
                            <i class="menu-icon tf-icons ti ti-users-group"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Tim
                                <svg data-bs-toggle="modal" data-bs-target="#editUser"
                                    style="position: relative; right: -10px; cursor: pointer"
                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 1024 1024">
                                    <path fill="#888888"
                                        d="M512 64a448 448 0 1 1 0 896a448 448 0 0 1 0-896zm-38.4 409.6H326.4a38.4 38.4 0 1 0 0 76.8h147.2v147.2a38.4 38.4 0 0 0 76.8 0V550.4h147.2a38.4 38.4 0 0 0 0-76.8H550.4V326.4a38.4 38.4 0 1 0-76.8 0v147.2z" />
                                </svg>
                            </div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <ul class="">
                            @forelse ($tims as $tim)
                                <li class="menu-item ">
                                    @if (auth()->user()->can('kelola tim'))
                                        <a href="{{ route('tim.board', $tim->code) }}"
                                            class="menu-link d-flex align-items-center gap-2">
                                            <img style="width: 30px;height:30px;object-fit: cover"
                                                class="rounded-circle border border-primary"
                                                src="{{ asset('storage/' . $tim->logo) }}" alt="">
                                            <div class="">{{ $tim->nama }}</div>
                                        </a>
                                    @else
                                        <a href="{{ route('tim.project', $tim->code) }}"
                                            class="menu-link d-flex align-items-center gap-2">
                                            <img style="width: 30px;height:30px;object-fit: cover"
                                                class="rounded-circle border border-primary"
                                                src="{{ asset('storage/' . $tim->logo) }}" alt="">
                                            <div class="">{{ $tim->nama }}</div>
                                        </a>
                                    @endif
                                </li>
                            @empty

                                <li class="menu-item bg-info bg-light ">
                                    <a class="menu-link d-flex align-items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                            viewBox="0 0 512 512">
                                            <path fill="currentColor"
                                                d="M256 16c-48 0-80 32-80 64c0 48 16 80 32 96v16h96v-16c16-16 32-48 32-96c0-32-32-64-80-64zm-63.6 65.33L256 102.5l63.6-21.17l-39.2 97.97l-16.8-6.6l24.8-62l-32.4 10.8l-32.4-10.8l24.8 62l-16.8 6.6l-39.2-97.97zm-83.3 79.07c-23.4 3-44.6 30.5-44.6 65.9c0 19.6 6.8 36.9 16.7 48.9l11.9 14.2l-18.3 3.4c-12.9 2.5-22.3 9.3-30.4 20.4c-8.1 11.1-14.3 26.5-18.6 44.4C18 389.8 16.2 429.2 16 464h42.8l2.24 30H169.6l2-30h40.8c0-35.2-.4-75.1-7.5-107.7c-4-17.9-9.9-33.3-18.1-44.3c-8.2-11-18.1-17.8-32.6-20l-18.5-2.9l11.7-14.7c9.5-11.9 15.9-29 15.9-48.1c0-37.8-23.6-65.8-49.4-65.8l-4.8-.1zm283.6 0c-23.4 3-44.6 30.5-44.6 65.9c0 19.6 6.8 36.9 16.7 48.9l11.9 14.2l-18.3 3.4c-12.9 2.5-22.3 9.3-30.4 20.4c-8.1 11.1-14.3 26.5-18.6 44.4c-7.8 32.2-9.6 71.6-9.8 106.4h42.8l2.2 30h108.6l2-30H496c0-35.2-.4-75.1-7.5-107.7c-4-17.9-9.9-33.3-18.1-44.3c-8.2-11-18.1-17.8-32.6-20l-18.5-2.9l11.7-14.7c9.5-11.9 15.9-29 15.9-48.1c0-37.8-23.6-65.8-49.4-65.8l-4.8-.1zM208 209v18h96v-18h-96zm16 34v18h64v-18h-64z" />
                                        </svg>
                                        <div class="">Belum punya tim</div>
                                    </a>
                                </li>
                            @endforelse
                        </ul>
                    </li>
                </ul>
            </aside>

            <div class="layout-page">

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">

                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0  d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="ti ti-menu-2 ti-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-auto gap-2">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                @if (auth()->check() &&
                                        auth()->user()->can('kelola siswa'))
                                    <span class="py-2 px-3 bg-primary text-white rounded rounded-full">Ketua
                                        Magang</span>
                                @else
                                    <span class="py-2 px-3 bg-primary text-white rounded rounded-full">Siswa
                                        Magang</span>
                                @endif
                            </li>
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow mx-3" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-bell ti-md"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/avatars/1.png" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                                                        <p class="mb-0">Won the monthly best seller gold badge</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Charles Franklin</h6>
                                                        <p class="mb-0">Accepted your connection</p>
                                                        <small class="text-muted">12hr ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/avatars/2.png" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New Message ✉️</h6>
                                                        <p class="mb-0">You have new message from Natalie</p>
                                                        <small class="text-muted">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-cart"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Whoo! You have new order 🛒 </h6>
                                                        <p class="mb-0">ACME Inc. made new order $1,154</p>
                                                        <small class="text-muted">1 day ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/avatars/9.png" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Application has been approved 🚀 </h6>
                                                        <p class="mb-0">Your ABC project application has been
                                                            approved.</p>
                                                        <small class="text-muted">2 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="ti ti-chart-pie"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Monthly report is generated</h6>
                                                        <p class="mb-0">July monthly financial report is generated
                                                        </p>
                                                        <small class="text-muted">3 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/avatars/5.png" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">Send connection request</h6>
                                                        <p class="mb-0">Peter sent you connection request</p>
                                                        <small class="text-muted">4 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="assets/img/avatars/6.png" alt
                                                                class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">New message from Jane</h6>
                                                        <p class="mb-0">Your have new message from Jane</p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-warning"><i
                                                                    class="ti ti-alert-triangle"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">CPU is running high</h6>
                                                        <p class="mb-0">CPU Utilization Percent is currently at
                                                            88.63%,</p>
                                                        <small class="text-muted">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown-menu-footer border-top">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                            View all notifications
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt
                                            class="h-auto rounded-circle">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.siswa') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                            class="h-auto rounded-circle">
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-medium d-block">
                                                        {{ Auth::user()->username }}
                                                    </span>
                                                    @if (auth()->check() &&
                                                            auth()->user()->can('kelola siswa'))
                                                        <small class="text-muted">Ketua Magang</small>
                                                    @else
                                                        <small class="text-muted">Siswa Magang</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.siswa') }}">
                                            <i class="ti ti-user-check me-2 ti-sm"></i>
                                            <span class="align-middle">Profil Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class='ti ti-logout me-2'></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-search-wrapper search-input-wrapper  d-none">
                        <input type="text" class="form-control search-input container-xxl border-0"
                            placeholder="Search..." aria-label="Search...">
                        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
                    </div>
                </nav>

                @yield('content')

                {{-- Modal Tambah Tim --}}
                <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-simple modal-edit-user">
                        <div class="modal-content p-2">
                            <div class="modal-body">
                                <button type="button" class="btn-close position-absolute top-0 " style="right: 0px"
                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                <form id="editUserForm" action="{{ route('buat_tim_solo') }}" method="POST"
                                    enctype="multipart/form-data" class="row g-2 p-0 m-0">
                                    @csrf
                                    <div class="col-12  gap-3 align-items-center">
                                        <div class="col-12 col-md-3 align-items-center">
                                            <label class="form-label text-white" for="image-input">
                                                <img id="preview-image"
                                                    src="{{ asset('assets/img/avatars/pen.png') }}"
                                                    alt="example placeholder"
                                                    style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer" />
                                                <input type="file" class="form-control d-none" id="image-input"
                                                    name="logo" />
                                                @error('logo')
                                                    <p class="text-danger">
                                                        {{ $message }}
                                                    </p>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="col-lg-12 d-flex flex-wrap flex-col align-items-center">
                                            <label class="form-label m-0 p-0" for="modalEditUserLastName">Nama
                                                Tim</label>
                                            <input type="text" id="modalEditUserLastName" name="nama"
                                                class="form-control" placeholder="Isi nama tim" />
                                            @error('nama')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                            <label class="form-label m-0 p-0 mt-2" for="modalEditUserLastName">Link
                                                Repository
                                                Github</label>
                                            <input type="text" id="modalEditUserLastName" name="repository"
                                                class="form-control" placeholder="https://.." />
                                            @error('repository')
                                                <p class="text-danger">
                                                    {{ $message }}
                                                </p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex flex-row flex-wrap justify-content-end">
                                        <button type="submit" class="btn btn-primary me-sm-3 me-1">Unggah</button>
                                        <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"
                                            aria-label="Close">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- validasi --}}
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const editUserForm = document.getElementById('editUserForm');

                        editUserForm.addEventListener('submit', function(event) {
                            const namaInput = document.querySelector('input[name="nama"]');
                            const repositoryInput = document.querySelector('input[name="repository"]');
                            const logoInput = document.querySelector('input[name="logo"]');

                            // Validasi input kosong
                            if (namaInput.value.trim() === '' || repositoryInput.value.trim() === '' || logoInput.files
                                .length === 0) {
                                event.preventDefault(); // Mencegah pengiriman formulir
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: 'Pastikan semua input diisi!',
                                });
                            }
                            // Validasi repositoryInput sebagai URL
                            else if (!repositoryInput.value.match(
                                    /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/)) {
                                event.preventDefault(); // Mencegah pengiriman formulir
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: 'URL Repository tidak valid!',
                                });
                            }
                            // Validasi logoInput sebagai gambar (image)
                            else {
                                const allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
                                const file = logoInput.files[0];

                                if (!allowedImageTypes.includes(file.type)) {
                                    event.preventDefault(); // Mencegah pengiriman formulir
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Peringatan',
                                        text: 'File yang diunggah harus berupa gambar (jpeg, jpg, png, atau gif)!',
                                    });
                                }
                                // Validasi panjang maksimum untuk namaInput dan repositoryInput
                                else if (namaInput.value.length > 50) {
                                    event.preventDefault(); // Mencegah pengiriman formulir
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Peringatan',
                                        text: 'Nama Tim harus kurang dari atau sama dengan 50 karakter!',
                                    });
                                } else if (repositoryInput.value.length > 100) {
                                    event.preventDefault(); // Mencegah pengiriman formulir
                                    Swal.fire({
                                        icon: 'warning',
                                        title: 'Peringatan',
                                        text: 'URL Repository harus kurang dari atau sama dengan 100 karakter!',
                                    });
                                }
                            }
                        });
                    });
                </script>
                {{-- validasi --}}

                {{-- Modal Tambah Tim --}}

            </div>
        </div>

        <div class="layout-overlay layout-menu-toggle"></div>
        <div class="drag-target"></div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}">
    </script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>


    <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>

    <script>
        let imageInput = $("#image-input");

        imageInput.on('change', function() {
            let previewImage = $("#preview-image");
            let file = imageInput[0].files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.attr('src', '');
            }
        });

        const buatTim = () => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Membuat Tim'
            })
        }
    </script>

    @if (session()->has('unauthorize'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '{{ session('unauthorize') }}', // Teks pesan dari sesi
                showClass: {
                    popup: "animate__animated animate__tada"
                },
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: !1,
            });
        </script>
    @elseif (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}', // Teks pesan dari sesi
            });
        </script>
    @endif


    @yield('script')

</body>

</html>
