@extends('layoutsMentor.app')

@section('content')
    <div class="container-fluid mt-3">
        <h5 class="">Dashboard</h5>
        <div class="card">
            <div class="d-flex justify-content-between mx-3 mb-1 mt-4">
                <h5 class="pb-0">Tabel Presentasi</h5>
                <a href="{{ route('presentasi.mentor') }}" class="btn btn-primary d-flex justify-content-end">Detail</a>
            </div>
            <div class="table-responsive text-nowrap card-datatable">
                <table id="myTable" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Tanggal</th>
                            <th>Hari</th>
                            <th>Projek</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td>1</td>
                            <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                    style="width: 40px; border-radius:50%;"> Andi</td>
                            <td>21-03-2023</td>
                            <td>Senin</td>
                            <td>Solo Project</td>
                            <td><span class="badge bg-label-success me-1">Tertunda</span></td>
                            {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><img src="{{ asset('assets/img/avatars/12.png') }}" alt=""
                                    style="width: 40px; border-radius:50%;"> Rohim</td>
                            <td>21-03-2023</td>
                            <td>Selasa</td>
                            <td>Solo Project</td>
                            <td><span class="badge bg-label-success me-1">Tertunda</span></td>
                            {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><img src="{{ asset('assets/img/avatars/2.png') }}" alt=""
                                    style="width: 40px; border-radius:50%;"> Dina</td>
                            <td>21-03-2023</td>
                            <td>Selasa</td>
                            <td>Solo Project</td>
                            <td><span class="badge bg-label-success me-1">Tertunda</span></td>
                            {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        </tr>
                        <tr>
                            <td>4</td>
                            <td><img src="{{ asset('assets/img/avatars/4.png') }}" alt=""
                                    style="width: 40px; border-radius:50%;"> Indah</td>
                            <td>21-03-2023</td>
                            <td>Selasa</td>
                            <td>Solo Project</td>
                            <td><span class="badge bg-label-success me-1">Tertunda</span></td>
                            {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        </tr>
                        <tr>
                            <td>5</td>
                            <td><img src="{{ asset('assets/img/avatars/13.png') }}" alt=""
                                    style="width: 40px; border-radius:50%;"> Rafi</td>
                            <td>21-03-2023</td>
                            <td>Selasa</td>
                            <td>Solo Project</td>
                            <td><span class="badge bg-label-success me-1">Tertunda</span></td>
                            {{-- <td><span class="badge bg-label-warning me-1">Pending</span></td> --}}
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Jumlah Anak Magang</h5>
                    <div class="card-body">
                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                            <li class="ct-series-0 d-flex flex-column">
                                <h5 class="mb-0">Desktop</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: rgb(102, 110, 232);width:35px; height:6px;"></span>
                                <div class="text-muted">80 %</div>
                            </li>
                            <li class="ct-series-1 d-flex flex-column">
                                <h5 class="mb-0">Tablet</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
                                <div class="text-muted">10 %</div>
                            </li>
                            <li class="ct-series-2 d-flex flex-column">
                                <h5 class="mb-0">Mobile</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
                                <div class="text-muted">10 %</div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Doughnut Chart -->

            <!-- Scatter Chart -->
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
                                            class="dropdown-item d-flex align-items-center">Today</a>
                                    </li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                            Days</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            30
                                            Days</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Current
                                            Month</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            Month</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <canvas id="barChart" class="chartjs" data-height="480" style="height: 365px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

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
