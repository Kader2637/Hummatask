@extends('layoutsMentor.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid mt-5 justify-content-center">
        <div class="card-header fs-4">
            Daftar Project
        </div>
        <div class="col-12">
            <div class="row">
                <div class="d-flex justify-content-between mb-4 gap-2">
                    <div class="filter col-lg-3 col-md-3 col-sm-3">
                        <label for="select2Basic" class="form-label">Filter</label>
                        <form id="filterForm" action="{{ route('projek') }}" method="get">
                            <select id="select2Basic" name="status_tim" class="form-select select2" data-allow-clear="true"
                                onchange="filterProjek(this)">
                                <option value="" disabled selected>Pilih Data</option>
                                <option value="all" {{ request('status_tim') == 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="solo" {{ request('status_tim') == 'solo' ? 'selected' : '' }}>Solo Project
                                </option>
                                <option value="pre_mini" {{ request('status_tim') == 'pre_mini' ? 'selected' : '' }}>
                                    Pre-mini
                                    Project</option>
                                <option value="mini" {{ request('status_tim') == 'mini' ? 'selected' : '' }}>Mini Project
                                </option>
                                <option value="big" {{ request('status_tim') == 'big' ? 'selected' : '' }}>Big Project
                                </option>
                            </select>
                            <input type="hidden" name="nama_tim" value="{{ request('nama_tim') }}">
                        </form>
                    </div>
                    <div class="filter col-lg-3 col-md-3 col-sm-3">
                        <label for="select2Basic" class="form-label">Cari</label>
                        <form action="{{ route('projek') }}" method="get">
                            <div class="flex-grow-1 input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                                <input name="nama_tim" type="text" class="form-control chat-search-input"
                                    placeholder="Cari nama tim..." aria-label="Cari nama tim..."
                                    aria-describedby="basic-addon-search31" value="{{ request('nama_tim') }}">
                            </div>
                            <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                        </form>
                    </div>
                </div>
                @forelse ($projects as $item)
                    {{-- @dd($item->tim) --}}
                    @php
                        $anggotaArray = [];
                        foreach ($item->tim->anggota as $anggota) {
                            $anggotaArray[] = [
                                'name' => $anggota->user->username,
                                'avatar' => $anggota->user->avatar,
                                'jabatan' => $anggota->jabatan->nama_jabatan,
                            ];
                        }
                        $anggotaJson = json_encode($anggotaArray);
                        $tanggalMulai = $item->tim->created_at->translatedFormat('Y-m-d');
                        $totalDeadline = null;
                        $dayLeft = null;
                        $deadline = \Carbon\Carbon::parse($item->deadline)->translatedFormat('Y-m-d');
                        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
                        $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now()->startOfDay());
                        $progressPercentage = $totalDeadline > 0 ? 100 - ($dayLeft / $totalDeadline) * 100 : 0;
                    @endphp
                    <div class="col-md-6 col-lg-4" id="projectList">
                        <div class="card text-center mb-3 projek-item" data-status-tim="{{ $item->tim->status_tim }}">
                            <div class="card-body">
                                <div class="d-flex flex-row gap-3 justify-content-between">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="foto logo"
                                        style="width: 100px; height: 100px; object-fit: cover" class="rounded-circle mb-3">
                                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                        class="">
                                        <span class="text-black fs-6">{{ $item->tim->nama }}</span>
                                        <div class="d-flex align-items-center">
                                            <div class="align-items-center">
                                                <span class="badge bg-label-warning my-1">
                                                    @if ($item->tim->status_tim == 'solo')
                                                        Solo Project
                                                    @elseif ($item->tim->status_tim == 'pre_mini')
                                                        Pre-Mini Project
                                                    @elseif ($item->tim->status_tim == 'mini')
                                                        Mini Project
                                                    @elseif ($item->tim->status_tim == 'big')
                                                        Big Project
                                                    @endif
                                                </span>
                                                @if ($item->tim->kadaluwarsa == 1)
                                                    <span class="mx-1 badge bg-label-danger">
                                                        Expired Team
                                                    </span>
                                                @elseif ($item->tim->kadaluwarsa == 0)
                                                    <span class="mx-1 badge bg-label-success">
                                                        Active Team
                                                    </span>
                                                @endif
                                                <span
                                                    class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                <div class="d-flex align-items-center">
                                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                        @foreach ($item->anggota_tim() as $anggota)
                                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                data-bs-placement="bottom"
                                                                title="{{ $anggota->user->username }}"
                                                                class="avatar avatar-sm pull-up">
                                                                <img class="rounded-circle"
                                                                    src="{{ $anggota->user->avatar ? asset('storage/' . $anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                    alt="Avatar" style="object-fit: cover">
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="info" class="my-4">
                                    <div class="d-flex justify-content-between">
                                        <span>Mulai : </span>
                                        <div>{{ $item->created_at->translatedFormat('l, j M Y') }}</div>
                                    </div>
                                    <div class="d-flex justify-content-between my-3">
                                        <span>Deadline : </span>
                                        <div>
                                            {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j M Y') }}
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <span>Tema : </span>
                                        <div data-bs-placement="bottom" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                            title="{{ $item->tema->nama_tema }}">
                                            {{ Str::limit($item->tema->nama_tema, $limit = 20, $end = '...') }}</div>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a onclick="pieGet('{{ $item->tim->code }}')" data-bs-toggle=""
                                        data-bs-target="#modalDetailProjek" class="w-50 btn btn-primary btn-detail-projek"
                                        data-logo="{{ asset('storage/' . $item->tim->logo) }}"
                                        data-namatim="{{ $item->tim->nama }}"
                                        data-status="@if ($item->tim->status_tim == 'solo') Solo Project
                                        @elseif ($item->tim->status_tim == 'pre_mini')
                                            Pre-Mini Project
                                        @elseif ($item->tim->status_tim == 'mini')
                                            Mini Project
                                        @elseif ($item->tim->status_tim == 'big')
                                            Big Project @endif"
                                        data-tema="{{ $item->tema->nama_tema }}"
                                        data-tglmulai="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                        data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}"
                                        data-anggota="{{ json_encode($item->anggota_profile()) }}"data-deskripsi="{{ $item->deskripsi }}"
                                        data-dayleft="{{ $dayLeft }}" data-total-deadline="{{ $totalDeadline }}"
                                        data-progress="{{ $progressPercentage }}" data-tenggat="{{ $item->deadline }}"
                                        data-repo="{{ $item->tim->repository }}"><span class="text-white">Detail</span>
                                    </a>
                                    <a data-bs-target="#editModal" data-bs-toggle="modal"
                                        data-expired="{{ $item->deadline }}"
                                        data-url="/mentor/update-deadline/{{ $item->id }}"
                                        data-nama="{{ $item->tim->nama }}" class="w-50 btn btn-primary btn-edit"><span
                                            class="text-white">Extend</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h6 class="text-center mt-4">Tidak Ada Projek <i class="ti ti-address-book-off"></i></h6>
                    <div class="mt-4 mb-3 d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                            alt="page-misc-under-maintenance" width="300" class="img-fluid">
                    </div>
                @endforelse
                <div>
                    {{ $projects->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Extend Deadline</h3>
                        <h5 id="nama-tim-suka-suka">NAMA TIM</h5>
                    </div>
                    <form class="row g-3" id="updateTimForm">
                        <div class="col-12">
                            <label class="form-label w-100" for="modalAddCard">Deadline</label>
                            <div class="input-group">
                                <input type="text" name="xp" id="tanggal"
                                    class="form-control dob-picker flatpickr-input active">
                            </div>
                            <button type="submit" class="w-100 btn btn-primary mt-4">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit end --}}
    {{-- Modal detail --}}
    <div class="modal fade" id="modalDetailProjek" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Detail tim</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-12">
                            <div class="nav-align-top d-flex justify-between">
                                <div class="nav nav-pills d-flex justify-content-between my-4" role="tablist">
                                    <div class="d-flex justify-content-between">
                                        <div class="nav-item" role="presentation">
                                            <button type="button" class="nav-link active button-nav" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-home"
                                                aria-controls="navs-pills-top-home" aria-selected="true">Project</button>
                                        </div>
                                        <div class="nav-item button-nav" role="presentation">
                                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                                data-bs-target="#navs-pills-top-profile"
                                                aria-controls="navs-pills-top-profile" aria-selected="false"
                                                tabindex="-1">Anggota</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-4 mb-4">
                                                <div class="card">
                                                    <h5 class="card-header">Progres Tim</h5>
                                                    <div class="card-body">
                                                        <p id="" class="text-center chart-status"></p>
                                                        <canvas id="" class="chartjs mb-4 mt-2 piechart-project"
                                                            data-height="267"
                                                            style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                                        <ul
                                                            class="doughnut-legend d-flex justify-content-evenly ps-0 mb-2 pt-1">
                                                            <li class="ct-series-0 d-flex flex-column">
                                                                <h5 class="mb-0" style="font-size: 13px">Tugas Baru</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: #6A2C70; height: 6px; width: 30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                            <li class="ct-series-1 d-flex flex-column">
                                                                <h5 class="mb-0" style="font-size: 13px">Dikerjakan</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: #B83B5E; height: 6px; width: 30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                            <li class="ct-series-1 d-flex flex-column">
                                                                <h5 class="mb-0" style="font-size: 13px">Revisi</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: #F08A5D; height: 6px; width: 30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                            <li class="ct-series-1 d-flex flex-column">
                                                                <h5 class="mb-0" style="font-size: 13px">Selesai</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: #F9ED69; height: 6px; width: 30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                {{-- card projects --}}
                                                <div class="card">
                                                    <div class="card-header">
                                                        <div
                                                            class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                                                            <div class="fs-4 text-black">
                                                                Projek
                                                            </div>
                                                            <div class="d-flex flex-column mt-1">
                                                                <span>Tanggal Mulai: <span id="tglmulai"></span></span>
                                                                <span>Tenggat: <span id="deadline"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="d-flex flex-column flex-md-row gap-3">
                                                                    <div class="text-center">
                                                                        <img id="logo-tim" src="" alt='logo tim'
                                                                            class="rounded-circle"
                                                                            style="width: 90px; height: 90px">
                                                                    </div>
                                                                    <div
                                                                        class="d-flex flex-column justify-content-center align-items-center">
                                                                        <span class="d-block text-black fs-5"
                                                                            id="nama-tim">nama tim</span>
                                                                    </div>
                                                                </div>
                                                                <div class="mt-4">
                                                                    <div class="mb-3">Status : <span
                                                                            class="badge bg-label-warning"
                                                                            id="status"></span>
                                                                    </div>

                                                                    <div>Tema : <span class="badge bg-label-warning"
                                                                            id="tema"></span>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="progres-bar">
                                                                    <div class="d-flex justify-content-between">
                                                                        <span>Hari</span>
                                                                        <span><span id="dayLeft"></span> dari
                                                                            <span id="total"></span>
                                                                            Hari</span>
                                                                    </div>
                                                                    <div
                                                                        class="d-flex flex-grow-1 align-items-center my-1">
                                                                        <div class="progress w-100 me-3"
                                                                            style="height:8px;background-color: gainsboro">
                                                                            <div class="progress-bar bg-primary"
                                                                                role="progressbar" style="width: 10%"
                                                                                aria-valuenow="10" aria-valuemin="0"
                                                                                aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-muted"><span
                                                                                id="textPercent"></span>%</span>
                                                                    </div>
                                                                    <div class="tenggat">
                                                                        <span>Tenggat kurang <span id="dayleft"></span>
                                                                            hari
                                                                            lagi</span>
                                                                    </div>
                                                                </div>
                                                                <div class="link mt-2">
                                                                    <div class="title text-dark">
                                                                        Link Repository :
                                                                    </div>
                                                                    <a href="" id="repository"
                                                                        target="_blank"><span class="text-blue"
                                                                            id="text-repo"></span></a>
                                                                </div>
                                                                <div class="deskripsi my-2">
                                                                    <div class="title text-dark">
                                                                        Deskripsi :
                                                                    </div>
                                                                    <div class="isi mt-2" id="deskripsi">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- card projects --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                        <div class="container">
                                            <div class="row">
                                                <div
                                                    class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                                                    <div
                                                        class="card-body d-flex flex-column align-items-center justify-content-center">
                                                        <img id="logo-tim2" width="90px" height="90px"
                                                            class="rounded-circle" src="" alt="">
                                                        <h1 id="nama-tim2" class="mt-2"></h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2 justify-content-center align-items-center grid"
                                                id="anggota-list-Projek">
                                                {{-- Anggota --}}
                                                {{-- Anggota --}}
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
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script>
        $('.btn-edit').on('click', function() {
            var url = $(this).data('url');
            var exp = $(this).data('expired');
            var nama = $(this).data('nama');
            $('#updateTimForm').attr('action', url);
            $('#deadline').val(exp);
            $('#nama-tim-suka-suka').text(nama);
            var tomorrowDate = new Date();
            tomorrowDate.setDate(tomorrowDate.getDate() + 1);
            var tomorrow = tomorrowDate.toISOString().slice(0, 10);

            if (exp > tomorrow) {
                $('#tanggal').flatpickr({
                    defaultDate: exp,
                    minDate: tomorrow,
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'Y-m-d',
                });
            } else {
                $('#tanggal').flatpickr({
                    defaultDate: exp,
                    minDate: exp,
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'Y-m-d',
                });
            };
        });
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#updateTimForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: $('#updateTimForm').attr('action'),
                    data: formData,
                    success: function(data) {
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Deadline berhasil diperbarui.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1700,
                        }).then(() => {
                            $('#updateTimForm ').modal('hide');
                            $('#saveButton').show();

                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, errors) {
                        console.log('Response:', xhr.responseText);

                        if (xhr.status === 422) {
                            // For other errors, display a generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Deadline harus setelah tanggal awal proyek',
                            });
                        }
                    }
                });
            });
        });
    </script>

    {{-- pie chart --}}
    <script>
        const cardColor = 'gray';
        const headingColor = '#FDAC34';
        const black = '#ffff';

        let doughnutChartVar; // Variabel untuk menyimpan instance grafik

        function pieGet(code) {
            const doughnutChart = document.querySelector(".piechart-project");
            const chartStatus = document.querySelector(".chart-status");

            // Menghancurkan grafik yang ada jika ada
            if (doughnutChartVar) {
                doughnutChartVar.destroy();
            }

            axios
                .get("pieproject/" + code)
                .then((res) => {
                    const processedData = res.data.chartData;

                    const labels = processedData.map((data) => data[0]);
                    const values = processedData.map((data) => data[1]);

                    doughnutChartVar = new Chart(doughnutChart, {
                        type: "doughnut",
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: [
                                    cardColor,
                                    "#F9ED69",
                                    "#F08A5D",
                                    "#B83B5E",
                                    "#6A2C70",
                                ],
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
                                            const label = context.label || "";
                                            const value = context.parsed;
                                            const output = " " + label + " : " + value;
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

                                        const amountDescription =
                                            label === "Revisi" ?
                                            "Revisi" :
                                            label === "Tugas Baru" ?
                                            "Tugas Baru" :
                                            "Selesai";
                                        return `Jumlah ${amountDescription}: ${value}`;
                                    }
                                }
                            }
                        }
                    });

                    if (values.slice(1).every(value => value === false)) {
                        chartStatus.style.display = 'block';
                        doughnutChart.style.display = 'none';

                        const img = document.createElement('img');
                        img.src = '{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}';
                        img.alt = 'Belum Ada Tugas';
                        img.style.width = '200px';

                        const h6Text = 'Tidak Ada Tugas <i class="ti ti-address-book-off"></i>';
                        const h6Element = document.createElement('h6');
                        h6Element.classList.add('text-center', 'mt-4');
                        h6Element.innerHTML = h6Text;

                        chartStatus.innerHTML = '';
                        chartStatus.appendChild(h6Element);
                        chartStatus.appendChild(img);
                    } else {
                        chartStatus.style.display = 'none';
                        doughnutChart.style.display = 'block';
                        chartStatus.textContent = '';
                    }
                })
                .catch((err) => {
                    console.log(err);
                });
        }

        function filterProjek(selectElement) {
            document.getElementById('filterForm').submit();
        }
    </script>
    {{-- pie chart --}}

    {{-- JS Modal Detail --}}
    <script>
        $(document).ready(function() {
            $('.btn-detail-projek').click(function() {
                var logo = $(this).data('logo');
                var namatim = $(this).data('namatim');
                var status = $(this).data('status');
                var tema = $(this).data('tema');
                var tglmulai = $(this).data('tglmulai');
                var deadline = $(this).data('deadline');
                var anggota = $(this).data('anggota');
                var deskripsi = $(this).data('deskripsi');
                var dayLeft = $(this).data('dayleft');
                var repo = $(this).data('repo');
                var total = $(this).data('total-deadline');
                var progress = $(this).data('progress');
                var tenggat = $(this).data('tenggat');
                var progressFormat = Math.round(progress);
                var now = new Date();
                var tenggatDate = new Date(tenggat);

                $('#logo-tim').attr('src', logo);
                $('#logo-tim2').attr('src', logo);
                $('#nama-tim').text(namatim);
                $('#nama-tim2').text(namatim);
                $('#status').text(status);
                $('#tema').text(tema);
                $('#tglmulai').text(tglmulai);
                $('#deadline').text(deadline);
                $('#text-repo').text(repo);
                $('#repository').attr('href', repo);

                if (tenggatDate.getTime() < now.getTime()) {
                    $('.progres-bar').empty();
                    var timeDiff = Math.abs(now.getTime() - tenggatDate.getTime());
                    var dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Menghitung selisih dalam hari
                    var alertMessage = $('<div></div>')
                        .addClass('alert alert-danger d-flex align-items-center')
                        .attr('role', 'alert')
                        .html(
                            '<span class="alert-icon text-danger me-2"><i class="ti ti-ban ti-xs"></i></span>Project ini telah lewat deadline selama ' +
                            dayDiff + ' hari, extend untuk perpanjang deadline!');
                    $('.progres-bar').html(alertMessage);
                } else {
                    $('#dayLeft').text(dayLeft);
                    $('#dayleft').text(dayLeft);
                    $('#total').text(total);
                    $('#textPercent').text(progressFormat);
                    $('.progress-bar').css('width', progressFormat + '%');
                    $('.progress-bar').attr('aria-valuenow', progressFormat);
                }
                if (deskripsi) {
                    $('#deskripsi').text(deskripsi);
                } else {
                    $('#deskripsi').html(
                        '<div class="alert alert-warning d-flex align-items-center mt-3 cursor-pointer" role="alert">' +
                        '<span class="alert-icon text-warning me-2">' +
                        '<i class="ti ti-bell ti-xs"></i>' +
                        '</span>' +
                        'Tim ini belum memiliki deskripsi tema!' +
                        '</div>'
                    );
                }
                var anggotaList = $('#anggota-list-Projek');

                anggotaList.empty();

                anggota.forEach(function(anggota, index) {


                    // var jabatanLabel = anggota.status === 'kicked' ? 'Mantan Anggota' : anggota
                    //     .jabatan.nama_jabatan;

                    // var avatarSrc = anggota.user.avatar ? '/storage/' + anggota.user.avatar :
                    //     '/assets/img/avatars/1.png';

                    // var anggotaItem = $('<div class="col-lg-12 p-2" style="box-shadow: none">' +
                    //     '<div class="card">' +
                    //     '<div class="card-body d-flex gap-3 align-items-center">' +
                    //     '<div>' +
                    //     '<img width="30px" height="30px" class="rounded-circle object-cover" src="' +
                    //     avatarSrc + '" alt="foto user">' +
                    //     '</div>' +
                    //     '<div>' +
                    //     '<h5 class="mb-0" style="font-size: 15px">' + anggota.user.username +
                    //     '</h5>' +
                    //     '<span class="badge bg-label-warning">' + jabatanLabel + '</span>' +
                    //     '</div>' +
                    //     '</div>' +
                    //     '</div>' +
                    //     '</div>');
                    // anggotaList.append(anggotaItem);

                    var avatarSrc = anggota.user.avatar ? '/storage/' + anggota.user.avatar :
                        '/assets/img/avatars/1.png';

                    var jabatanLabel = anggota.status === 'kicked' ? 'Mantan Anggota' : anggota
                        .jabatan.nama_jabatan;

                    var lulus = anggota.user.status_kelulusan == '1'

                    var anggotaItem = $('<div class="col-lg-4 p-2" style="box-shadow: none">' +
                        '<div class="card">' +
                        '<div class="card-body d-flex gap-3 align-items-center">' +
                        '<div>' +
                        '<img width="30px" height="30px" class="rounded-circle object-cover" src="' +
                        avatarSrc + '" alt="foto user">' +
                        '</div>' +
                        '<div>' +
                        '<h5 class="mb-0" style="font-size: 15px">' + anggota.user.username +
                        '</h5>' +
                        (lulus ? '<span class="badge bg-label-success me-2">Lulus</span>' :
                            '') +
                        (jabatanLabel ? '<span class="badge bg-label-warning">' + jabatanLabel +
                            '</span>' : '') +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                    anggotaList.append(anggotaItem);
                });

                $('#modalDetailProjek').modal('show');

            });
        });
    </script>
    {{-- js Modal Detail --}}
@endsection
