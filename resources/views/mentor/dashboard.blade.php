@extends('layoutsMentor.app')

@section('content')
    <div class="container-fluid mt-3">
        <h5 class="mt-3 fs-4">Dashboard Mentor</h5>
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="pb-0">Atur Jadwal Presentasi</h5>
                        <ul class="nav nav-pills bg-light rounded" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#senin" role="tab">Senin</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#selasa" role="tab">Selasa</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#rabu" role="tab">Rabu</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#kamis" role="tab">Kamis</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#jumat" role="tab">Jumat</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-4">
                            <div class="tab-pane active" id="senin" role="tabpanel">
                                <form class="form-repeater">
                                    <div data-repeater-list="group-a">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                                                    <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                                                        Jadwal Ke 1
                                                    </p>
                                                </div>
                                                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                                    <input type="time" id="form-repeater-1-1" class="form-control"
                                                        placeholder="john.doe" />
                                                </div>
                                                <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                                                    -
                                                </div>
                                                <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                                                    <input type="time" id="form-repeater-1-2" class="form-control"
                                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                </div>
                                                <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                                                    <button class="btn btn-label-danger" data-repeater-delete>
                                                        <i class="ti ti-x ti-xs me-1"></i>
                                                        <span class="align-middle">Delete</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <button class="btn btn-primary" data-repeater-create>
                                            <i class="ti ti-plus me-1"></i>
                                            <span class="align-middle">Add</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="selasa" role="tabpanel">
                                <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                    <form class="form-repeater">
                                        <div data-repeater-list="group-a">
                                            <div data-repeater-item>
                                                <div class="row">
                                                    <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                                        <label class="form-label" for="form-repeater-1-1">Username</label>
                                                        <input type="text" id="form-repeater-1-1" class="form-control"
                                                            placeholder="john.doe" />
                                                    </div>
                                                    <div class="mb-3 col-lg-6 col-xl-2 col-12 mb-0">
                                                        <label class="form-label" for="form-repeater-1-2">Password</label>
                                                        <input type="password" id="form-repeater-1-2" class="form-control"
                                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
                                                    </div>
        
                                                    <div class="mb-3 col-lg-12 col-xl-2 col-12 d-flex align-items-center mb-0">
                                                        <button class="btn btn-label-danger mt-4" data-repeater-delete>
                                                            <i class="ti ti-x ti-xs me-1"></i>
                                                            <span class="align-middle">Delete</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                        <div class="mb-0">
                                            <button class="btn btn-primary" data-repeater-create>
                                                <i class="ti ti-plus me-1"></i>
                                                <span class="align-middle">Add</span>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="d-flex justify-content-end mt-2">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="rabu" role="tabpanel">
                                <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">
                                            Setting Limit
                                        </button>
                                    </div>
                                    <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                        <div class="d-flex justify-content-evenly mb-0">
                                            <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt=""
                                                class="mb-0" style="width: 250px;">
                                        </div>
                                        <p class="text-center mb-0 mt-1">Atur Limit presentasi terlebih dahulu <i
                                                class="ti ti-address-book-off"></i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="kamis" role="tabpanel">
                                <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">
                                            Setting Limit
                                        </button>
                                    </div>
                                    <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                        <div class="d-flex justify-content-evenly mb-0">
                                            <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt=""
                                                class="mb-0" style="width: 250px;">
                                        </div>
                                        <p class="text-center mb-0 mt-1">Atur Limit presentasi terlebih dahulu <i
                                                class="ti ti-address-book-off"></i></p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="jumat" role="tabpanel">
                                <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-primary">
                                            Setting Limit
                                        </button>
                                    </div>
                                    <div class="table-responsive" data-simplebar style="max-height: 330px;">
                                        <div class="d-flex justify-content-evenly mb-0">
                                            <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt=""
                                                class="mb-0" style="width: 250px;">
                                        </div>
                                        <p class="text-center mb-0 mt-1">Atur Limit presentasi terlebih dahulu <i
                                                class="ti ti-address-book-off"></i></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modal create limit senin  --}}
                <div class="modal fade" id="limit" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Atur Limit hari senin</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="anggota" class="form-label">Limit</label>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end modal  --}}
            </div>
            <div class="col-12 col-xl-4">
                <div class="card">
                    <div class="d-flex justify-content-between mx-3 mb-1 mt-4">
                        <h5 class="pb-0">Data Presentasi hari ini</h5>
                        <a href="{{ route('presentasi.mentor') }}" class="btn btn-primary d-flex justify-content-end">Detail</a>
                    </div>
                    <div class="table-responsive text-nowrap card-datatable">
                        @php
                            $no = 1;
                        @endphp
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
                                @forelse ($presentasi as $i => $item)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td class=""><img src="{{ asset('storage/' . $item->tim->logo) }}" alt=""
                                                style="width: 40px; height: 40px; ;border-radius:50%; margin-right:5px;">
                                            {{ $item->tim->nama }}
                                        </td>
                                        <td>{{ $jadwal[$i] }}</td>
                                        <td>{{ $hari[$i] }}</td>
                                        <td>{{ $item->tim->status_tim }}</td>
                                        <td><span class="badge bg-label-success me-1">{{ $item->status_presentasi }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">
                                            <div class="d-flex justify-content-evenly">
                                                <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt=""
                                                    class="mb-0" style="width: 250px;">
                                            </div>
                                            <p class="text-center mb-0 mt-2">Data tidak tersedia <i
                                                    class="ti ti-address-book-off"></i></p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3 mb-5 gy-2">
            <div class="col-12 col-lg-4 col-xxl-4 mb-4">
                <div class="card" style="height: 100%">
                    <h5 class="card-header">Jumlah Tim Saat Ini</h5>
                    <div class="card-body">
                        <p id="statusPie" class="text-center statusPie"></p>
                        <canvas id="piechart" class="chartjs mb-4 piechart mt-2" data-height=""
                            style="height: 10px;"></canvas>
                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1 mt-4">
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
            <div class="col-lg-8 col-md-8 col-12 col-xxl-8 mb-4">
                <div class="card" style="height: 100%; width: 100%">
                    <div class="card-header header-elements">
                        <h5 class="card-title mb-0">Data Anak Magang</h5>
                        <div class="card-action-element ms-auto py-0">
                            {{-- <div class="dropdown">
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
                            </div> --}}
                            <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="ti ti-calendar"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <form method="get">
                                            <input type="hidden" value="{{ $currentYear }}">
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                                                Sekarang
                                                <i class="ti ti-calendar-event"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="get">
                                            <input type="hidden" name="year" value="{{ $year - 1 }}">
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                                                Sebelumnya
                                                <i class="ti ti-calendar-minus"></i></button>
                                        </form>
                                    </li>
                                    <li>
                                        <form method="get">
                                            <input type="hidden" name="year" value="{{ $year + 1 }}">
                                            <button type="submit"
                                                class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                                                Selanjutnya
                                                <i class="ti ti-calendar-plus"></i></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex pt-2">
                        <canvas id="barChart" class="chartjs" data-height="480" style="height: 400px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>

    <script>
        const cardColor = 'grey';
        const headingColor = '#FDAC34';
        const black = '#fff';

        const piechart = document.getElementById('piechart');
        const statusPie = document.getElementById('statusPie');
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

            if (jumlah.slice(1).every(value => value === 0)) {
                statusPie.style.display = 'block';
                piechart.style.display = 'none';

                const img = document.createElement('img');
                img.src = '{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}';
                img.alt = 'Belum Ada Tim';
                img.style.width = '200px';

                const h6Text = 'Tidak Ada Tim <i class="ti ti-address-book-off"></i>';
                const h6Element = document.createElement('h6');
                h6Element.classList.add('text-center', 'mt-4');
                h6Element.innerHTML = h6Text;

                statusPie.innerHTML = '';
                statusPie.appendChild(h6Element);
                statusPie.appendChild(img);
            } else {
                statusPie.style.display = 'none';
                piechart.style.display = 'block';
                statusPie.textContent = '';
            }
        }

        let barCardColor, barHeadingColor, barLabelColor, barBorderColor, barLegendColor;
        let year = @json($year);
        let currentYear = @json($currentYear);
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
