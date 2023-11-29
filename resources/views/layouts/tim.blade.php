<!DOCTYPE html>

<html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed   " dir="ltr"
    {{-- data-assets-path="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/" --}} data-base-url="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
    data-framework="laravel" data-template="vertical-menu-theme-default-light">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="icon" type="image/x-icon" href="{{ url('assets/img/icons/icon.svg') }}" />
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
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-calendar.css') }}" />
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            /* Tambahkan z-index di sini */
        }

        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .hidden {
            opacity: 0;
        }

        #loader {
            z-index: 100000;
            /* Tambahkan z-index di sini */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
        }

        .preloader {
            position: absolute;
            width: 40px;
            height: 40px;
            left: calc(50% - 20px);
            top: calc(50% - 20px);
            animation: preloader 2s linear infinite;
        }

        .loadBar {
            position: absolute;
            width: 200px;
            height: 2px;
            left: calc(50% - 100px);
            top: calc(50% + 60px);
            background: #7a14c3;
        }

        .progress {
            position: relative;
            width: 0%;
            height: inherit;
            background: #e74c3c;
        }

        .custom-margin {
            margin-top: -65px;
        }

        @keyframes loading {

            0% {
                width: 0%;
            }

            100% {
                width: 100%;
            }

        }

        @keyframes preloader {

            0%,
            100% {
                transform: translateY(0);
            }

            25% {
                transform: translateY(-15px);
            }

            50% {
                transform: translateY(0);
            }

            75% {
                transform: translateY(15px);
            }
        }
    </style>
    @yield('link')
</head>

@yield('style')

<body class="overflow-hidden">
    <script src="https://code.jquery.com/jquery-2.2.3.min.js"
        integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo=" crossorigin="anonymous"></script>
    <div id="loader">
        <div class="preloader">
            <div class="d-flex justify-content-center custom-margin">
                <img src="{{ asset('assets/img/icons/icon.svg') }}" width="180" height="160" alt="Loader Image">
            </div>
        </div>
    </div>
    <script>
        $(window).load(function() {

            var rnd = Math.random() * (2000 - 2000) + 500;

            $('.progress').css("animation", "loading " + rnd + "ms linear");

            setTimeout(function() {

                $('#loader').fadeOut();
                $('body').removeClass('overflow-hidden');

            }, rnd);

        });
    </script>




    {{-- End OffCanvas --}}

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
                <ul class="menu-inner py-1 ">
                    @if ($project && $project->deskripsi)
                        <li class="menu-item @if ($title == 'Tim/board') active @endif ">
                            <a href="{{ route('tim.board', $tim->code) }}"
                                class="menu-link d-flex align-items-center gap-2">
                                <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
                                <div class="w-100 d-flex align-items-center justify-content-between">Board</div>
                            </a>
                        </li>
                    @endif
                    @if ($project && $project->deskripsi)
                        <li class="menu-item @if ($title == 'Tim/Statistik') active @endif ">
                            <a href="{{ route('tim.history', $tim->code) }}"
                                class="menu-link d-flex align-items-center gap-2">
                                <i class="menu-icon tf-icons ti ti-history"></i>
                                <div class="w-100 d-flex align-items-center justify-content-between">Statistik</div>
                            </a>
                        </li>
                    @endif
                    @if ($project && $project->deskripsi)
                        <li class="menu-item @if ($title == 'catatan') active @endif">
                            <a href="{{ route('tim.catatan', $tim->code) }}"
                                class="menu-link d-flex align-items-center gap-2">
                                <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                                <div class="w-100 d-flex align-items-center justify-content-between">Catatan</div>
                            </a>
                        </li>
                    @endif
                    @if ($project && $project->deskripsi)
                        <li class="menu-item @if ($title == 'Tim/presentasi') active @endif">
                            <a href="{{ route('tim.historyPresentasi', $tim->code) }}"
                                class="menu-link d-flex align-items-center gap-2">
                                <i class="menu-icon tf-icons ti ti-presentation"></i>
                                <div class="w-100 d-flex align-items-center justify-content-between">Presentasi</div>
                            </a>
                        </li>
                    @endif
                    <li class="menu-item @if ($title == 'Tim/project') active @endif ">
                        <a href="{{ route('tim.project', $tim->code) }}"
                            class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-folder-cog"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Project</div>
                        </a>
                    </li>
                    <li class="menu-item active mt-5">
                        <a href="{{ route('dashboard.siswa', $tim->code) }}"
                            class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-arrow-back"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Kembali</div>
                        </a>
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
                        <div class="d-flex align-items-center justify-content-center gap-2 ">
                            Login sebagai :
                            @if (auth()->check() &&
                                    auth()->user()->can('kelola siswa'))
                                <span class="py-2 px-3 bg-primary text-white rounded rounded-full">Ketua
                                    Magang</span>
                            @else
                                <span class="py-2 px-3 bg-primary text-white rounded rounded-full">Siswa</span>
                            @endif
                        </div>
                        <ul class="navbar-nav flex-row align-items-center ms-auto gap-2">
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            </li>
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                    <i class="ti ti-bell ti-md"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications"
                                        id="notification-count"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0" id="notification-dropdown">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                                            <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
                                        </div>
                                    </li>
                                    @foreach ($notifikasi as $item)
                                        <li class="dropdown-notifications-list scrollable-container">
                                            <ul class="list-group list-group-flush" id="notification-list">
                                                {{-- <li class="list-group-item" id="notification-list"> --}}
                                                {{-- <div class="d-flex" id="notifikasi-{{ $item->id }}">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="" alt class="h-auto rounded-circle">
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">{{ $item->judul }}</h6>
                                                        <p class="mb-0">{{ $item->body }}</p>
                                                        <small
                                                            class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"
                                                            onclick="deletenotifikasi({{ $item->id }})"><span
                                                                class="ti ti-x"></span></a>
                                                    </div>
                                                </div> --}}
                                                {{-- </li> --}}
                                            </ul>
                                        </li>
                                    @endforeach
                                    <li class="dropdown-menu-footer border-top">
                                        <a href="javascript:void(0);"
                                            class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"
                                            alt class="rounded-circle" style="object-fit: cover">
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('profile.siswa') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ Auth::user()->avatar ? Storage::url(Auth::user()->avatar) : asset('assets/img/avatars/1.png') }}"
                                                            class="rounded-circle" style="object-fit: cover">
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
    {{-- <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/app-calendar-events.js') }}"></script>
    <script src="{{ asset('assets/js/app-calendar.js') }}"></script>
    <!-- END: Page JS-->

    @yield('script')
    <script>
        function deletenotifikasi(id) {
            console.log('notifikasiId:', id);
            axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute(
                'content');
            console.log('Request URL:', `http://127.0.0.1:8000/tim/notifikasi/${id}`);
            axios.delete(`http://127.0.0.1:8000/tim/notifikasi/${id}`)
                .then(response => {
                    console.log('Axios Response:', response);
                    const notifikasiElement = document.getElementById(`notification-list-${id}`);
                    console.log('notifikasiElement:', notifikasiElement);
                    if (notifikasiElement) {
                        notifikasiElement.remove();
                    }
                })
                .catch(error => {
                    console.error('Gagal Menghapus notifikasi:', error);
                });
        }
    </script>

    <script>
        $(document).ready(function() {
            function ambilNotifikasi() {
                $.ajax({
                    url: '/ambil-notifikasi',
                    method: 'GET',
                    success: function(response) {
                        tampilkanNotifikasi(response.notifikasi);
                    },
                    error: function(error) {
                        console.log('Error mengambil notifikasi:', error);
                    }
                });
            }

            function tampilkanNotifikasi(notifikasi) {
                var daftarNotifikasi = $('#notification-list');
                var countBadge = $('#notification-count');

                daftarNotifikasi.empty();

                countBadge.text(notifikasi.length);

                notifikasi.reverse();

                notifikasi.forEach(function(item) {
                    var waktuNotifikasi = new Date(item.created_at);
                    var waktuSekarang = new Date();
                    var perbedaanWaktu = Math.floor((waktuSekarang - waktuNotifikasi) /
                        1000);

                    function formatWaktu(detik) {
                        if (detik < 60) {
                            return detik + ' detik yang lalu';
                        } else if (detik < 3600) {
                            return Math.floor(detik / 60) + ' menit yang lalu';
                        } else if (detik < 86400) {
                            return Math.floor(detik / 3600) + ' jam yang lalu';
                        } else {
                            return Math.floor(detik / 86400) + ' hari yang lalu';
                        }
                    }

                    var jenisClass, icon, textClass;

                    switch (item.jenis_notifikasi) {
                        case 'info':
                            jenisClass = 'alert-info';
                            textClass = 'text-info';
                            icon = '<i class="ti ti-info-circle ti-xs"></i>';
                            break;
                        case 'deadline':
                            jenisClass = 'alert-warning';
                            textClass = 'text-warning';
                            icon = '<i class="ti ti-clock ti-xs"></i>';
                            break;
                        case 'pemberitahuan':
                            jenisClass = 'alert-success';
                            textClass = 'text-success';
                            icon = '<i class="ti ti-check ti-xs"></i>';
                            break;
                        default:
                            jenisClass = 'bg-secondary';
                            icon = '<i class="ti ti-alert ti-xs"></i>';
                    }

                    var notifikasiBaru = `
            <li class="list-group-item" id="notification-list-${item.id}">
                <div class="d-flex mt-2 mb-2 pl-5">
                    <div class="flex-grow-1">
                        <div class="alert ${jenisClass} d-flex align-items-center" role="alert">
                            <span class="alert-icon ${textClass} me-2">
                                ${icon}
                            </span>
                            ${item.judul}
                        </div>
                        <p class="mb-0">${item.body}</p>
                        <small class="text-muted">${formatWaktu(perbedaanWaktu)}</small>
                    </div>
                    <div class="flex-shrink-0 dropdown-notifications-actions ">
                            <a href="javascript:void(0)" class="dropdown-notifications-read"><span
                                    class="badge badge-dot"></span></a>
                            <a href="javascript:void(0)" class="dropdown-notifications-archive mr-2"
                                onclick="deletenotifikasi(${item.id})"><span class="ti ti-x"></span></a>
                        </div>
                </div>
            </li>
        `;

                    daftarNotifikasi.append(notifikasiBaru);
                });
            }

            ambilNotifikasi();

            setInterval(function() {
                ambilNotifikasi();
            }, 5000);
        });
    </script>

    @if (session()->has('unauthorize'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Akses Ditolak',
                text: '{{ session('unauthorize') }}', // Teks pesan dari sesi
                showConfirmButton: false,
                timer: 3000,
            });
        </script>
    @elseif (session()->has('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}', // Teks pesan dari sesi
                showConfirmButton: false,
                timer: 3000,
            });
        </script>
    @elseif (session()->has('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}', // Teks pesan dari sesi
                showConfirmButton: false,
                timer: 3000,
            });
        </script>
    @endif
    @if (session()->has('tolak'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('tolak') }}', // Teks pesan dari sesi
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

</body>

</html>
