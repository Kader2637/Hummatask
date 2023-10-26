@extends('layouts.app')

@section('content')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <div class="container">

        <h4 class="mt-3">
            Dashboard
        </h4>

        <!-- Card Border Shadow -->
        <div class="row">
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i
                                        class="fa-solid fa-user-group"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">42</h4>
                        </div>
                        <p class="mb-1">Jumlah anak magang</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class="fa-solid fa-users"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">8</h4>
                        </div>
                        <p class="mb-1">Jumlah tim project</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4 mb-4">
                <div class="card card-border-shadow-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="ti ti-calendar-check "></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">27</h4>
                        </div>
                        <p class="mb-1">Presentasi hari ini</p>
                    </div>
                </div>
            </div>

        </div>
        <!--/ Card Border Shadow -->
        <div class="row">
            <div class="col-lg-8 col-12 mb-4">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="card-title mb-0">Latest Statistics</h5>
                        <div class="card-action-element ms-auto py-0">
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="ti ti-calendar"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Today</a></li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                            Days</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            30 Days</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Current Month</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            Month</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <canvas id="barChart" class="chartjs" data-height="435" style="height: 330px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-xxl-6 mb-4 order-3 order-xxl-1">
                <div class="card card-border-shadow-primary">
                    <div class="mt-3">
                        <h5><i class="mx-3 ti ti-presentation-analytics ti-lg "></i>List Presentasi Hari Ini</h5>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="table-responsive">
                        <table class="table table-borderless border-top">
                            <tbody>
                                <tr>
                                    <td class="pt-2">
                                        <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">Maven</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pt-2">
                                        <div class="user-progress mt-lg-4">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/14.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">HummasTask</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="user-progress">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('assets/img/backgrounds/airpods.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">Yo Wes Iki</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="user-progress">
                                            <i class="fa-solid fa-users"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/11.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">Manula</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="user-progress">
                                            <i class="fa-solid fa-user-group"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="avatar me-3 avatar-sm">
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-0">Sempul</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <div class="user-progress">
                                            <i class="fa-solid fa-user-group"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <a href="" class="btn btn-primary d-flex flex-wrap flex-col">Lihat Lebih Banyak</a>
                        <div class="mt-3 mx-3">
                            <div class="text-center fw-bold"><span>Keterangan</span></div>
                            <td class="text-end">
                                <div class="d-flex justify-content-evenly mt-2 pb-3 px-4 gap-3">
                                    <div class="border px-3 py-1 rounded rounded-full" style="background-color: rgb(231, 216, 216); display: flex; justify-items: center; flex-direction: column; align-items: center; gap: 0;">
                                        <span>
                                            <i class="fa-solid fa-user"></i>
                                        </span>
                                        <span>solo</span>
                                    </div>
                                    <div class="border px-3 py-1 rounded rounded-full" style="background-color: rgb(231, 216, 216); display: flex; justify-items: center; flex-direction: column; align-items: center; gap: 0;">
                                        <span>
                                            <i class="fa-solid fa-user-group"></i>
                                        </span>
                                        <span>Pre</span>
                                    </div>
                                    <div class="border px-3 py-1 rounded rounded-full" style="background-color: rgb(231, 216, 216); display: flex; justify-items: center; flex-direction: column; align-items: center; gap: 0;">
                                        <span>
                                            <i class="fa-solid fa-users"></i>
                                        </span>
                                        <span>Tim</span>
                                    </div>
                                </div>
                            </td>
                        </div>
                    </div>
                </div>
            </div>



        </div>

        <script>
            const cyanColor = '#28dac6',
                orangeLightColor = '#FDAC34';
            let cardColor, headingColor, labelColor, borderColor, legendColor;


            cardColor = config.colors.cardColor;
            headingColor = config.colors.headingColor;
            labelColor = config.colors.textMuted;
            legendColor = config.colors.bodyColor;
            borderColor = config.colors.borderColor;

            const barChart = document.getElementById('barChart');
            if (barChart) {
                const barChartVar = new Chart(barChart, {
                    type: 'bar',
                    data: {
                        labels: [
                            '7/12',
                            '8/12',
                            '9/12',
                            '10/12',
                            '11/12',
                            '12/12',
                            '13/12',
                            '14/12',
                            '15/12',
                            '16/12',
                            '17/12',
                            '18/12',
                            '19/12'
                        ],
                        datasets: [{
                            data: [275, 90, 190, 205, 125, 85, 55, 87, 127, 150, 230, 280, 190],
                            backgroundColor: cyanColor,
                            borderColor: 'transparent',
                            maxBarThickness: 15,
                            borderRadius: {
                                topRight: 15,
                                topLeft: 15
                            }
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        animation: {
                            duration: 500
                        },
                        plugins: {
                            tooltip: {
                                //   rtl: isRtl,
                                backgroundColor: cardColor,
                                titleColor: headingColor,
                                bodyColor: legendColor,
                                borderWidth: 1,
                                borderColor: borderColor
                            },
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    color: labelColor
                                }
                            },
                            y: {
                                min: 0,
                                max: 400,
                                grid: {
                                    color: borderColor,
                                    drawBorder: false,
                                    borderColor: borderColor
                                },
                                ticks: {
                                    stepSize: 100,
                                    color: labelColor
                                }
                            }
                        }
                    }
                });
            }
        </script>
    @endsection
