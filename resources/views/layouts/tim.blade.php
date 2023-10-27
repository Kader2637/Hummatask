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

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/fullcalendar/fullcalendar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-calendar.css') }}" />
    @yield('link')
</head>

@yield('style')


<body>
    <div class="modal fade" id="ajukanPresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Ajukan Presentasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="judul" class="form-label">Judul Presentasi</label>
                            <input type="text" id="judul" name="judul" class="form-control"
                                placeholder="Masukan Judul Presentasi">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="deskripsi" class="form-label">Deskripsi Presentasi</label>
                            <textarea name="deskripsi" id="deskripsi" cols="20" rows="10" class="form-control" style="resize: none" placeholder="Isi deskripsi pengajuan anda"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="jadwal" class="form-label">Atur Jadwal</label>
                            <input type="date" name="jadwal" id="jadwal"
                                class="form-control datepicker-days">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary waves-effect"
                        data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light">Ajukan</button>
                </div>
            </div>
        </div>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h5 id="offcanvasEndLabel" class="offcanvas-title">Statistik Project</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body my-auto mx-0 flex-grow-0">

            <div class="row">
                <div class="col-12">
                    <div class="nav-align-top nav-tabs-shadow mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-top-home" aria-controls="navs-top-home"
                                    aria-selected="true">Chart</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-top-profile" aria-controls="navs-top-profile"
                                    aria-selected="false" tabindex="-1">Card</button>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                                <div class="card mb-3">
                                    <h5 class="card-header">Progres Tim</h5>
                                    <div class="card-body">
                                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"
                                            height="200" width="200"
                                            style="display: block; box-sizing: border-box; height: 100px; width: 100px;"></canvas>
                                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                            <li class="ct-series-0 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 15px">Proses</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(102, 110, 232);width:35px; height:6px;"></span>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 15px">Selesai</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
                                            </li>
                                            <li class="ct-series-2 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 15px">Revisi</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body pb-0">
                                        <div class="card-icon">
                                            <span class="badge bg-label-success rounded-pill p-2">
                                                <i class="ti ti-credit-card ti-sm"></i>
                                            </span>
                                        </div>
                                        <h5 class="card-title mb-0 mt-2">13</h5>
                                        <small>Tugas Terselesaikan</small>
                                        <div id="revenueGenerated" style="min-height: 130px;">
                                            <div id="apexchartsv5zg0eqk"
                                                class="apexcharts-canvas apexchartsv5zg0eqk apexcharts-theme-light"
                                                style="width: 243px; height: 130px;"><svg id="SvgjsSvg1416"
                                                    width="243" height="130" xmlns="http://www.w3.org/2000/svg"
                                                    version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                                                    xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                    xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                    style="background: transparent;">
                                                    <g id="SvgjsG1418" class="apexcharts-inner apexcharts-graphical"
                                                        transform="translate(0, 0)">
                                                        <defs id="SvgjsDefs1417">
                                                            <clipPath id="gridRectMaskv5zg0eqk">
                                                                <rect id="SvgjsRect1423" width="249"
                                                                    height="132" x="-3" y="-1" rx="0"
                                                                    ry="0" opacity="1" stroke-width="0"
                                                                    stroke="none" stroke-dasharray="0"
                                                                    fill="#fff"></rect>
                                                            </clipPath>
                                                            <clipPath id="forecastMaskv5zg0eqk"></clipPath>
                                                            <clipPath id="nonForecastMaskv5zg0eqk"></clipPath>
                                                            <clipPath id="gridRectMarkerMaskv5zg0eqk">
                                                                <rect id="SvgjsRect1424" width="247"
                                                                    height="134" x="-2" y="-2" rx="0"
                                                                    ry="0" opacity="1" stroke-width="0"
                                                                    stroke="none" stroke-dasharray="0"
                                                                    fill="#fff"></rect>
                                                            </clipPath>
                                                            <linearGradient id="SvgjsLinearGradient1429"
                                                                x1="0" y1="0" x2="0"
                                                                y2="1">
                                                                <stop id="SvgjsStop1430" stop-opacity="0.6"
                                                                    stop-color="rgba(40,199,111,0.6)" offset="0">
                                                                </stop>
                                                                <stop id="SvgjsStop1431" stop-opacity="0.1"
                                                                    stop-color="rgba(212,244,226,0.1)" offset="1">
                                                                </stop>
                                                                <stop id="SvgjsStop1432" stop-opacity="0.1"
                                                                    stop-color="rgba(212,244,226,0.1)" offset="1">
                                                                </stop>
                                                            </linearGradient>
                                                        </defs>
                                                        <line id="SvgjsLine1422" x1="0" y1="0"
                                                            x2="0" y2="130" stroke="#b6b6b6"
                                                            stroke-dasharray="3" stroke-linecap="butt"
                                                            class="apexcharts-xcrosshairs" x="0" y="0" width="1"
                                                            height="130" fill="#b1b9c4" filter="none"
                                                            fill-opacity="0.9" stroke-width="1"></line>
                                                        <g id="SvgjsG1435" class="apexcharts-xaxis"
                                                            transform="translate(0, 0)">
                                                            <g id="SvgjsG1436" class="apexcharts-xaxis-texts-g"
                                                                transform="translate(0, -4)"></g>
                                                        </g>
                                                        <g id="SvgjsG1445" class="apexcharts-grid">
                                                            <g id="SvgjsG1446" class="apexcharts-gridlines-horizontal"
                                                                style="display: none;">
                                                                <line id="SvgjsLine1448" x1="0"
                                                                    y1="0" x2="243" y2="0"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine1449" x1="0"
                                                                    y1="26" x2="243" y2="26"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine1450" x1="0"
                                                                    y1="52" x2="243" y2="52"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine1451" x1="0"
                                                                    y1="78" x2="243" y2="78"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine1452" x1="0"
                                                                    y1="104" x2="243" y2="104"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                                <line id="SvgjsLine1453" x1="0"
                                                                    y1="130" x2="243" y2="130"
                                                                    stroke="#e0e0e0" stroke-dasharray="0"
                                                                    stroke-linecap="butt" class="apexcharts-gridline">
                                                                </line>
                                                            </g>
                                                            <g id="SvgjsG1447" class="apexcharts-gridlines-vertical"
                                                                style="display: none;"></g>
                                                            <line id="SvgjsLine1455" x1="0" y1="130"
                                                                x2="243" y2="130" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                            <line id="SvgjsLine1454" x1="0" y1="1"
                                                                x2="0" y2="130" stroke="transparent"
                                                                stroke-dasharray="0" stroke-linecap="butt"></line>
                                                        </g>
                                                        <g id="SvgjsG1425"
                                                            class="apexcharts-area-series apexcharts-plot-series">
                                                            <g id="SvgjsG1426" class="apexcharts-series"
                                                                seriesName="seriesx1" data:longestSeries="true"
                                                                rel="1" data:realIndex="0">
                                                                <path id="SvgjsPath1433"
                                                                    d="M 0 130L 0 104C 14.174999999999999 104 26.325000000000003 60.66666666666663 40.5 60.66666666666663C 54.675 60.66666666666663 66.825 78 81 78C 95.175 78 107.325 34.66666666666663 121.5 34.66666666666663C 135.675 34.66666666666663 147.825 69.33333333333331 162 69.33333333333331C 176.175 69.33333333333331 188.325 17.333333333333314 202.5 17.333333333333314C 216.675 17.333333333333314 228.825 34.66666666666663 243 34.66666666666663C 243 34.66666666666663 243 34.66666666666663 243 130M 243 34.66666666666663z"
                                                                    fill="url(#SvgjsLinearGradient1429)"
                                                                    fill-opacity="1" stroke-opacity="1"
                                                                    stroke-linecap="butt" stroke-width="0"
                                                                    stroke-dasharray="0" class="apexcharts-area"
                                                                    index="0"
                                                                    clip-path="url(#gridRectMaskv5zg0eqk)"
                                                                    pathTo="M 0 130L 0 104C 14.174999999999999 104 26.325000000000003 60.66666666666663 40.5 60.66666666666663C 54.675 60.66666666666663 66.825 78 81 78C 95.175 78 107.325 34.66666666666663 121.5 34.66666666666663C 135.675 34.66666666666663 147.825 69.33333333333331 162 69.33333333333331C 176.175 69.33333333333331 188.325 17.333333333333314 202.5 17.333333333333314C 216.675 17.333333333333314 228.825 34.66666666666663 243 34.66666666666663C 243 34.66666666666663 243 34.66666666666663 243 130M 243 34.66666666666663z"
                                                                    pathFrom="M -1 364L -1 364L 40.5 364L 81 364L 121.5 364L 162 364L 202.5 364L 243 364">
                                                                </path>
                                                                <path id="SvgjsPath1434"
                                                                    d="M 0 104C 14.174999999999999 104 26.325000000000003 60.66666666666663 40.5 60.66666666666663C 54.675 60.66666666666663 66.825 78 81 78C 95.175 78 107.325 34.66666666666663 121.5 34.66666666666663C 135.675 34.66666666666663 147.825 69.33333333333331 162 69.33333333333331C 176.175 69.33333333333331 188.325 17.333333333333314 202.5 17.333333333333314C 216.675 17.333333333333314 228.825 34.66666666666663 243 34.66666666666663"
                                                                    fill="none" fill-opacity="1" stroke="#28c76f"
                                                                    stroke-opacity="1" stroke-linecap="butt"
                                                                    stroke-width="2" stroke-dasharray="0"
                                                                    class="apexcharts-area" index="0"
                                                                    clip-path="url(#gridRectMaskv5zg0eqk)"
                                                                    pathTo="M 0 104C 14.174999999999999 104 26.325000000000003 60.66666666666663 40.5 60.66666666666663C 54.675 60.66666666666663 66.825 78 81 78C 95.175 78 107.325 34.66666666666663 121.5 34.66666666666663C 135.675 34.66666666666663 147.825 69.33333333333331 162 69.33333333333331C 176.175 69.33333333333331 188.325 17.333333333333314 202.5 17.333333333333314C 216.675 17.333333333333314 228.825 34.66666666666663 243 34.66666666666663"
                                                                    pathFrom="M -1 364L -1 364L 40.5 364L 81 364L 121.5 364L 162 364L 202.5 364L 243 364">
                                                                </path>
                                                                <g id="SvgjsG1427"
                                                                    class="apexcharts-series-markers-wrap"
                                                                    data:realIndex="0"></g>
                                                            </g>
                                                            <g id="SvgjsG1428" class="apexcharts-datalabels"
                                                                data:realIndex="0"></g>
                                                        </g>
                                                        <line id="SvgjsLine1456" x1="0" y1="0"
                                                            x2="243" y2="0" stroke="#b6b6b6"
                                                            stroke-dasharray="0" stroke-width="1"
                                                            stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                                        </line>
                                                        <line id="SvgjsLine1457" x1="0" y1="0"
                                                            x2="243" y2="0" stroke-dasharray="0"
                                                            stroke-width="0" stroke-linecap="butt"
                                                            class="apexcharts-ycrosshairs-hidden"></line>
                                                        <g id="SvgjsG1458" class="apexcharts-yaxis-annotations"></g>
                                                        <g id="SvgjsG1459" class="apexcharts-xaxis-annotations"></g>
                                                        <g id="SvgjsG1460" class="apexcharts-point-annotations"></g>
                                                    </g>
                                                    <rect id="SvgjsRect1421" width="0" height="0" x="0"
                                                        y="0" rx="0" ry="0" opacity="1"
                                                        stroke-width="0" stroke="none" stroke-dasharray="0"
                                                        fill="#fefefe"></rect>
                                                    <g id="SvgjsG1444" class="apexcharts-yaxis" rel="0"
                                                        transform="translate(-18, 0)"></g>
                                                    <g id="SvgjsG1419" class="apexcharts-annotations"></g>
                                                </svg>
                                                <div class="apexcharts-legend" style="max-height: 65px;"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 244px; height: 248px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
                                <div class="row gap-4">
                                    <div class="col-12">
                                        <div class="card h-100">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-0 me-2">8</h5>
                                                    <small>Tugas dengan status selesai</small>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded-pill p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M13 19c0 1.1.3 2.12.81 3H6c-1.11 0-2-.89-2-2V4a2 2 0 0 1 2-2h1v7l2.5-1.5L12 9V2h6a2 2 0 0 1 2 2v9.09c-.33-.05-.66-.09-1-.09c-3.31 0-6 2.69-6 6m7-1v-3h-2v3h-3v2h3v3h2v-3h3v-2h-3Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card h-100">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-0 me-2">20%</h5>
                                                    <small>Tugas belum dikerjakan</small>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded-pill p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M17 4v6l-2-2l-2 2V4H9v16h3.1c.1.7.4 1.4.7 2H7c-1.1 0-2-1-2-2v-1H3v-2h2v-4H3v-2h2V7H3V5h2V4c0-1.1.9-2 2-2h12c1 0 2 1 2 2v9.8c-.6-.4-1.3-.6-2-.7V4h-2M5 19h2v-2H5v2m0-6h2v-2H5v2m0-6h2V5H5v2m15.1 8.5L18 17.6l-2.1-2.1l-1.4 1.4l2.1 2.1l-2.1 2.1l1.4 1.4l2.1-2.1l2.1 2.1l1.4-1.4l-2.1-2.1l2.1-2.1l-1.4-1.4Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card h-100">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-0 me-2">560 jam</h5>
                                                    <small>Waltu pengerjaan project</small>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded-pill p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="m10.45 14.55l1.325 2.95q.075.15.225.15t.225-.15l1.325-2.95l2.95-1.325q.15-.075.15-.225t-.15-.225l-2.95-1.325l-1.325-2.95q-.075-.15-.225-.15t-.225.15l-1.325 2.95l-2.95 1.325q-.15.075-.15.225t.15.225l2.95 1.325ZM10 3q-.425 0-.712-.288T9 2q0-.425.288-.713T10 1h4q.425 0 .713.288T15 2q0 .425-.288.713T14 3h-4Zm2 19q-1.85 0-3.487-.713T5.65 19.35q-1.225-1.225-1.938-2.863T3 13q0-1.85.713-3.488T5.65 6.65q1.225-1.225 2.863-1.938T12 4q1.55 0 2.975.5t2.675 1.45l.7-.7q.275-.275.7-.275t.7.275q.275.275.275.7t-.275.7l-.7.7Q20 8.6 20.5 10.025T21 13q0 1.85-.713 3.488T18.35 19.35q-1.225 1.225-2.863 1.938T12 22Zm0-2q2.9 0 4.95-2.05T19 13q0-2.9-2.05-4.95T12 6Q9.1 6 7.05 8.05T5 13q0 2.9 2.05 4.95T12 20Zm0-7Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card h-100">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-0 me-2">5</h5>
                                                    <small>Tugas pernah masuk revisi</small>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded-pill p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M8.3 19.3q-.275-.275-.275-.7t.275-.7l1.1-1.1q-3.2-.425-5.3-1.75T2 12q0-2.075 2.888-3.538T12 7q4.225 0 7.113 1.463T22 12q0 1.35-1.3 2.475t-3.475 1.8q-.5.15-.863-.125T16 15.325q0-.3.213-.587t.512-.388q1.575-.5 2.425-1.175T20 12q0-.8-2.137-1.9T12 9q-3.725 0-5.863 1.1T4 12q0 .6 1.275 1.438T8.9 14.7l-.6-.6q-.275-.275-.275-.7t.275-.7q.275-.275.7-.275t.7.275l2.6 2.6q.15.15.212.325t.063.375q0 .2-.063.375t-.212.325l-2.6 2.6q-.275.275-.7.275t-.7-.275Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="card h-100">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="card-title mb-0">
                                                    <h5 class="mb-0 me-2">120 hari</h5>
                                                    <small>Tenggat waktu</small>
                                                </div>
                                                <div class="card-icon">
                                                    <span class="badge bg-label-primary rounded-pill p-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24">
                                                            <path fill="currentColor"
                                                                d="M8 3.28L6.6 1.86l-.86.71L7.16 4m9.31 14.39C15.26 19.39 13.7 20 12 20a7 7 0 0 1-7-7c0-1.7.61-3.26 1.61-4.47M2.92 2.29L1.65 3.57L3 4.9l-1.13.93l1.42 1.42l1.11-.94l.8.8A8.964 8.964 0 0 0 3 13a9 9 0 0 0 9 9c2.25 0 4.31-.83 5.89-2.2l2.2 2.2l1.27-1.27L3.89 3.27l-.97-.98M22 5.72l-4.6-3.86l-1.29 1.53l4.6 3.86L22 5.72M12 6a7 7 0 0 1 7 7c0 .84-.16 1.65-.43 2.4l1.52 1.52c.58-1.19.91-2.51.91-3.92a9 9 0 0 0-9-9c-1.41 0-2.73.33-3.92.91L9.6 6.43C10.35 6.16 11.16 6 12 6Z" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End OffCanvas --}}

    <div class="layout-wrapper layout-content-navbar ">
        <div class="layout-container">

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                <div class="app-brand demo">
                    <a href="{{ route('dashboard.siswa') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ url('assets/img/icons/icon.svg') }}" width="50" alt="" srcset="">
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
                    <li class="menu-item @if ($title == 'Tim/board') active @endif ">
                        <a href="{{ route('tim.board') }}" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-layout-dashboard"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Board</div>
                        </a>
                    </li>
                    <li class="menu-item ">
                        <a style="cursor: pointer" data-bs-toggle="offcanvas" data-bs-target="#offcanvasEnd" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-chart-line"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Statistik Project
                            </div>
                        </a>
                    </li>
                    <li class="menu-item @if ($title == 'Tim/kalender') active @endif ">
                        <a href="{{ route('tim.kalender') }}" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-calendar"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Kalender</div>
                        </a>
                    </li>
                    <li class="menu-item @if ($title == 'Tim/project') active @endif ">
                        <a href="{{ route('tim.project') }}" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-folder-cog"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Project</div>
                        </a>
                    </li>
                    <li class="menu-item @if ($title == 'Tim/history') active @endif ">
                        <a href="{{ route('tim.history') }}" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-history"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">History</div>
                        </a>
                    </li>
                    <li class="menu-item @if ($title == 'catatan' || $title == 'catatan history') open @endif">
                        <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-clipboard-text"></i>
                            <div>Catatan</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item @if ($title == 'catatan') active @endif">
                                <a href="{{ route('tim.catatan') }}" class="menu-link">
                                    <div>Buat Catatan</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($title == 'catatan history') active @endif ">
                                <a href="{{ route('tim.historyCatatan') }}" class="menu-link">
                                    <div>History Catatan</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item @if ($title == 'Tim/presentasi') open @endif">
                        <a href="javascript:void(0);" class="menu-link menu-toggle d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-presentation"></i>
                            <div>Presentasi</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a data-bs-toggle="modal" data-bs-target="#ajukanPresentasi"
                                    class="menu-link cursor-pointer">
                                    <div>Atur Presentasi</div>
                                </a>
                            </li>
                            <li class="menu-item @if ($title == 'Tim/presentasi') active @endif ">
                                <a href="{{ route('tim.historyPresentasi') }}" class="menu-link">
                                    <div>History Presentasi</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item active mt-5">
                        <a href="{{ route('dashboard.siswa') }}" class="menu-link d-flex align-items-center gap-2">
                            <i class="menu-icon tf-icons ti ti-arrow-back"></i>
                            <div class="w-100 d-flex align-items-center justify-content-between">Kembali</div>
                        </a>
                    </li>

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
                                <span class="py-2 px-3 bg-primary text-white rounded rounded-full">Siswa Magang</span>
                            </li>
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
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
                                                    <small class="text-muted">Admin</small>
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

    <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/fullcalendar/fullcalendar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/app-calendar-events.js') }}"></script>
    <script src="{{ asset('assets/js/app-calendar.js') }}"></script>
    <!-- END: Page JS-->

    @yield('script')

    <script>
        const cyanColor = '#28dac6',
            orangeLightColor = '#FDAC34';
        let cardColor, headingColor, labelColor, borderColor, legendColor;


        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;

        const doughnutChart = document.getElementById('doughnutChart');
        if (doughnutChart) {
            const doughnutChartVar = new Chart(doughnutChart, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Revisi', 'Progres'],
                    datasets: [{
                        data: [10, 10, 80],
                        backgroundColor: [cyanColor, orangeLightColor, config.colors.primary],
                        borderWidth: 0,
                        pointStyle: 'rectRounded'
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 500
                    },
                    cutout: '68%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.labels || '',
                                        value = context.parsed;
                                    const output = ' ' + label + ' : ' + value + ' %';
                                    return output;
                                }
                            },
                            // Updated default tooltip UI
                            //   rtl: isRtl,
                            backgroundColor: cardColor,
                            titleColor: headingColor,
                            bodyColor: legendColor,
                            borderWidth: 1,
                            borderColor: borderColor
                        }
                    }
                }
            });
        }
    </script>

</body>

</html>
