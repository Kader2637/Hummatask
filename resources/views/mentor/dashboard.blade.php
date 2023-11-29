@extends('layoutsMentor.app')

@section('content')
    <div class="container-fluid mt-3">
        <h5 class="mt-3 fs-4">Dashboard Mentor</h5>
        <div class="card">
            <div class="d-flex justify-content-between mx-3 mb-1 mt-4">
                <h5 class="pb-0">Data Presentasi hari ini</h5>
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
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($presentasi as $i => $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class=""><img src="{{ Storage::url($item->tim->logo) }}" alt=""
                                        style="width: 40px; height: 40px; ;border-radius:50%; margin-right:5px;">
                                    {{ $item->tim->nama }}
                                </td>
                                <td>{{ $jadwal[$i] }}</td>
                                <td>{{ $hari[$i] }}</td>
                                <td>{{ $item->tim->status_tim }}</td>
                                <td><span class="badge bg-label-success me-1">{{ $item->status_presentasi }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Jumlah Tim Saat Ini</h5>
                    <div class="card-body">
                        <canvas id="piechart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                            <li class="ct-series-0 d-flex flex-column">
                                <h5 class="mb-0">Big</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: #FE7BE5; height:6px;width:30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                            <li class="ct-series-1 d-flex flex-column">
                                <h5 class="mb-0">Mini</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: #974EC3; height:6px; width: 30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                            <li class="ct-series-1 d-flex flex-column">
                                <h5 class="mb-0">Pre-mini</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: #504099; height:6px; width:30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                            <li class="ct-series-0 d-flex flex-column">
                                <h5 class="mb-0">Solo</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: #313866; height:6px;width:30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Doughnut Chart -->

            <!-- Scatter Chart -->
            <div class="col-lg-8 col-12 mb  -4">
                <div class="card">
                    <div class="card-header header-elements">
                        <h5 class="card-title mb-0">Data Anak Magang</h5>
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
                    <div class="card-body d-flex pt-2">
                        <canvas id="barChart" class="chartjs" data-height="480" style="height: 346px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

    <script>
        const cardColor = 'grey';
        const headingColor = '#FDAC34';
        const black = '#fff';

        const piechart = document.getElementById('piechart');
        const processedData = @json($chart);

        if (piechart) {
            const pie = processedData.map(data => data[0]);
            const jumlah = processedData.map(data => data[1]);

            const doughnutChartVar = new Chart(piechart, {
                type: 'doughnut',
                data: {
                    labels: pie,
                    datasets: [{
                        data: jumlah,
                        backgroundColor: [cardColor, '#313866', '#504099', '#974EC3', '#FE7BE5'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 500
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const output = ' ' + label + ' : ' + value;
                                    return output;
                                }
                            },
                            backgroundColor: cardColor,
                            titleColor: black,
                            bodyColor: black,
                            borderWidth: 1,
                            borderColor: cardColor,
                            afterLabel: function(context) {
                                const datasetIndex = context.datasetIndex;
                                const dataIndex = context.dataIndex;
                                const data = doughnutChartVar.data.datasets[datasetIndex].data;
                                const label = doughnutChartVar.data.labels[dataIndex];
                                const value = data[dataIndex];

                                // Menampilkan jumlah saat kursor mengarah ke elemen chart
                                const amountDescription = label === 'Jumlah Solo' ? 'Jumlah Solo' : label ===
                                    'Jumlah Pre Mini' ? 'Jumlah Pre Mini' : 'Jumlah Mini';
                                return `Jumlah ${amountDescription}: ${value}`;
                            }
                        }
                    }
                }
            });
        }

        let barCardColor, barHeadingColor, barLabelColor, barBorderColor, barLegendColor;
        var chartData = @json($chartData);

        if (chartData) {
            const barChartCanvas = document.getElementById('barChart').getContext('2d');

            const barChartVar = new Chart(barChartCanvas, {
                type: 'bar',
                data: {
                    labels: chartData.map(data => data.month),
                    datasets: [{
                        label: 'Tim Mini',
                        data: chartData.map(data => parseInt(data.mini)),
                        backgroundColor: chartData.map(data => data.color),
                        borderColor: 'transparent',
                        maxBarThickness: 15,
                        borderRadius: {
                            topRight: 15,
                            topLeft: 15
                        }
                    }, {
                        label: 'Tim Premini',
                        data: chartData.map(data => parseInt(data.pre_mini)),
                        backgroundColor: chartData.map(data => data.piecolor),
                        borderColor: 'transparent',
                        maxBarThickness: 15,
                        borderRadius: {
                            topRight: 15,
                            topLeft: 15
                        }
                    }, {
                        label: 'Tim Big',
                        data: chartData.map(data => parseInt(data.big)),
                        backgroundColor: chartData.map(data => data.colors),
                        borderColor: 'transparent',
                        maxBarThickness: 15,
                        borderRadius: {
                            topRight: 15,
                            topLeft: 15
                        }
                    }, {
                        label: 'Data Akun User',
                        data: chartData.map(data => parseInt(data['1'])),
                        backgroundColor: chartData.map(data => data.colorwait),
                        borderColor: 'transparent',
                        maxBarThickness: 15,
                        borderRadius: {
                            topRight: 15,
                            topLeft: 15
                        }
                    }],
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 500
                    },
                    plugins: {
                        tooltip: {
                            backgroundColor: barCardColor,
                            titleColor: barHeadingColor,
                            bodyColor: barLegendColor,
                            borderWidth: 1,
                            borderColor: barBorderColor
                        },
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: barBorderColor,
                                drawBorder: true,
                                borderColor: barBorderColor
                            },
                            ticks: {
                                color: barLabelColor
                            }
                        },
                        y: {
                            min: 0,
                            max: 300,
                            grid: {
                                color: barBorderColor,
                                drawBorder: true,
                                borderColor: barBorderColor
                            },
                            ticks: {
                                stepSize: 100,
                                color: barLabelColor
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
