@extends('layoutsMentor.app')

@section('content')
    <div class="container-fluid mt-3">
        <h5 class="mt-3">Dashboard</h5>
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
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($presentasi as $i => $item)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td class=""><img src="{{Storage::url($item->tim->logo)}}" alt=""
                                        style="width: 40px; height: 40px; ;border-radius:50%; margin-right:5px;">
                                    {{ $item->tim->nama }}
                                </td>
                                <td>{{ $jadwal[$i] }}</td>
                                <td>{{ $hari[$i] }}</td>
                                <td>{{ $item->tim->status_tim }}</td>
                                <td><span class="badge bg-label-success me-1">{{ $item->status_pengajuan }}</span></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4 col-12 mb-4">
                <div class="card">
                    <h5 class="card-header">Data</h5>
                    <div class="card-body">
                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                            <li class="ct-series-0 d-flex flex-column">
                                <h5 class="mb-0">Presentasi</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: blue; height:6px;width:30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                            <li class="ct-series-1 d-flex flex-column">
                                <h5 class="mb-0">Akun User</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: yellow; height:6px; width:30px;"></span>
                                <div class="text-muted"></div>
                            </li>
                            <li class="ct-series-1 d-flex flex-column">
                                <h5 class="mb-0">Tim</h5>
                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                    style="background-color: grey; height:6px; width: 30px;"></span>
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
                        <h5 class="card-title mb-0">Jumlah Perbulan</h5>
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
const doughnutChart = document.getElementById('doughnutChart');
const cyanColor = '#28dac6';
const orangeLightColor = '#FDAC34';
let cardColor, headingColor, labelColor, borderColor, legendColor;

cardColor = config.colors.cardColor;
headingColor = config.colors.headingColor;
labelColor = config.colors.textMuted;
legendColor = config.colors.bodyColor;
borderColor = config.colors.borderColor;

if (doughnutChart) {
    const processedData = <?php echo json_encode($chartData); ?>;
    const dataValues = processedData.map(data => data.disetujui);
    const acount = processedData.map(data => data['1']);
    const tims = processedData.map(data => data['2']);

    // Menggabungkan data dari kedua set data
    const mergedDataValues = acount.concat(dataValues).concat(tims);
    const mergedBackgroundColor = acount.map(() => 'yellow').concat(dataValues.map(() => 'blue')).concat(tims.map(() =>
        'grey'));

    const doughnutChartVar = new Chart(doughnutChart, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: mergedDataValues,
                backgroundColor: mergedBackgroundColor,
                borderWidth: 0,
                pointStyle: 'rectRounded'
            }],
            labels: ['Revisi', 'Tugas Baru', 'Selesai']
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
                            const label = context.label || '';
                            const value = context.parsed;
                            const output = '' + label + ' : ' + value;
                            return output;
                        },
                        afterLabel: function(context) {
                            const datasetIndex = context.datasetIndex;
                            const dataIndex = context.dataIndex;
                            const data = doughnutChartVar.data.datasets[datasetIndex].data;
                            const label = doughnutChartVar.data.labels[dataIndex];
                            const value = data[dataIndex];

                            // Menampilkan jumlah saat kursor mengarah ke elemen chart
                            let amountDescription = '';
                            if (label === 'Revisi') {
                                amountDescription = 'Revisi: ' + acount[dataIndex];
                            } else if (label === 'Tugas Baru') {
                                amountDescription = 'Tugas Baru: ' + dataValues[dataIndex];
                            } else if (label === 'Selesai') {
                                amountDescription = 'Selesai: ' + tims[dataIndex];
                            }

                            return `Jumlah ${amountDescription}: ${value}`;
                        }
                    },
                    backgroundColor: cardColor,
                    titleColor: headingColor,
                    bodyColor: legendColor,
                    borderWidth: 1,
                    borderColor: borderColor,
                    labelColor: labelColor,
                    displayColors: false,
                    titleFont: {
                        size: 14
                    }
                }
            }
        }
    });
}
</script>

    <script>
        var chartData = @json($chartData);

        if (chartData) {
            const barChartCanvas = document.getElementById('barChart').getContext('2d');

            const barChartVar = new Chart(barChartCanvas, {
                type: 'bar',
                data: {
                    labels: chartData.map(data => data.month),
                    datasets: [{
                        label: 'Data Persentasi',
                        data: chartData.map(data => parseInt(data.disetujui)),
                        backgroundColor: chartData.map(data => data.color),
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
                                drawBorder: true,
                                borderColor: borderColor
                            },
                            ticks: {
                                color: labelColor
                            }
                        },
                        y: {
                            min: 0,
                            max: 500,
                            grid: {
                                color: borderColor,
                                drawBorder: true,
                                borderColor: borderColor
                            },
                            ticks: {
                                stepSize: 50,
                                color: labelColor
                            }
                        }
                    }
                }
            });
        }
    </script>
@endsection
