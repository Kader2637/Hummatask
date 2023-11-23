@extends('layoutsMentor.app')

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
    <div class="container-fluid mt-4 justify-content-center">
        <h5 class="header">Project</h5>
        <div class="col-12">
            <div class="row">
                <div class="d-flex justify-content-between">
                    <div class="filter col-lg-3 col-md-3 col-sm-3">
                        <label for="select2Basic" class="form-label">Filter</label>
                        <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg"
                            data-allow-clear="true" onchange="filterProjek(this)">
                            <option value="" disabled selected>Pilih Data</option>
                            <option value="all">Semua</option>
                            <option value="solo">Solo Project</option>
                            <option value="pre_mini">Pre-mini Project</option>
                            <option value="mini">Mini Project</option>
                            <option value="big">Big Project</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-4" id="projectList">
                    @forelse ($projects as $item)
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
                            $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now());
                            $progressPercentage = 100 - ($dayLeft / $totalDeadline) * 100;
                        @endphp
                        <div class="col-md-4 col-lg-4 col-sm-4" id="projectList">
                            <div class="card text-center mb-3 projek-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <div class="d-flex flex-row gap-3">
                                        <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="foto logo"
                                            style="width: 100px; height: 100px; object-fit: cover"
                                            class="rounded-circle mb-3">
                                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                            class="">
                                            <span class="text-black fs-6">{{ $item->tim->nama }}</span>
                                            <div class="d-flex align-items-center">
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
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center">
                                                <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                    <div class="d-flex align-items-center">
                                                        <ul
                                                            class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                            @foreach ($item->tim->anggota as $anggota)
                                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                                    data-bs-placement="top"
                                                                    title="{{ $anggota->user->username }}"
                                                                    class="avatar avatar-sm pull-up">
                                                                    <img class="rounded-circle"
                                                                        src="{{ $anggota->user->avatar ? Storage::url($anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                        style="object-fit: cover" alt="Avatar">
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
                                            <div>{{ $item->created_at->translatedFormat('l, j F Y') }}</div>
                                        </div>
                                        <div class="d-flex justify-content-between my-3">
                                            <span>Deadline : </span>
                                            <div>
                                                {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>Tema : </span>
                                            <div data-bs-placement="top" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" title="{{ $item->tema->nama_tema }}">
                                                {{ Str::limit($item->tema->nama_tema, $limit = 20, $end = '...') }}</div>
                                        </div>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <a onclick="pieGet('{{ $item->tim->code }}')" data-bs-toggle=""
                                            data-bs-target="#modalDetailProjek"
                                            class="w-50 btn btn-primary btn-detail-projek"
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
                                            data-anggota="{{ $anggotaJson }}" data-deskripsi="{{ $item->deskripsi }}"
                                            data-dayleft="{{ $dayLeft }}" data-total-deadline="{{ $totalDeadline }}"
                                            data-progress="{{ $progressPercentage }}"
                                            data-repo="{{ $item->tim->repository }}"><span class="text-white">Detail</span>
                                        </a>
                                        <a data-bs-target="#editModal" data-bs-toggle="modal" data-expired="{{ $item->deadline }}" class="w-50 btn btn-primary btn-edit"><span
                                                class="text-white">Edit</span></a>
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
    </div>
    {{-- modal edit --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
          <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="text-center mb-4">
                <h3 class="mb-2">Add New Card</h3>
                <p class="text-muted">Add new card to complete payment</p>
              </div>
              <form id="addNewCCForm" class="row g-3" onsubmit="return false">
                <div class="col-12">
                  <label class="form-label w-100" for="modalAddCard">Card Number</label>
                  <div class="input-group input-group-merge">
                    <input type="date" id="expired" value="" name="expired" class="form-control dob-picker flatpickr-input active" placeholder="YYYY-MM-DD" min="{{ date('Y-m-d') }}" >
                    <span class="input-group-text cursor-pointer p-1" id="modalAddCard2"><span class="card-type"></span></span>
                  </div>
                </div>
              
              </form>
            </div>
          </div>
        </div>
      </div>
    {{-- modal edit end --}}
    {{-- Modal detail --}}
    <div class="modal fade" id="modalDetailProjek" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
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
                                                        <canvas id="" class="chartjs mb-4 mt-2 piechart-project"
                                                            data-height="267"
                                                            style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                                        <ul
                                                            class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                                            <li class="ct-series-0 d-flex flex-column">
                                                                <h5 class="mb-0">Tugas Baru</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: #ff7f00; height:6px;width:30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                            <li class="ct-series-1 d-flex flex-column">
                                                                <h5 class="mb-0">Revisi</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: blue; height:6px; width:30px;"></span>
                                                                <div class="text-muted"></div>
                                                            </li>
                                                            <li class="ct-series-1 d-flex flex-column">
                                                                <h5 class="mb-0">Selesai</h5>
                                                                <span
                                                                    class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                                    style="background-color: yellow; height:6px; width: 30px;"></span>
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
                                                            class="d-flex flex-row align-items-center justify-content-between">
                                                            <div class="fs-4 text-black">
                                                                Projek
                                                            </div>
                                                            <div
                                                                style="display: flex; flex-direction: column; justify-items: center; align-items: left;">

                                                                <span>Tanggal Mulai : <span id="tglmulai"></span>
                                                                </span>

                                                                <span>Tenggat : <span id="deadline"></span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="my-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="d-flex flex-row gap-3">
                                                                    <img id="logo-tim" src="" alt='logo tim'
                                                                        class="rounded-circle"
                                                                        style="width: 90px; height: 90px">
                                                                    <div
                                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center">
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
                                                                <div class="deskripsi mt-2">
                                                                    <div class="title text-dark">
                                                                        Deskripsi :
                                                                    </div>
                                                                    <div class="isi" id="deskripsi">

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
    {{-- Modal detail --}}

    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

    <script>
         $('.btn-edit').on('click', function() {
            var exp = $(this).data('expired');
            var token = ($('meta[name="csrf-token"]').attr('content'));
            // console.log(token);
            $('#expired').val(exp);

         });
    </script>

    {{-- filter projek --}}
    <script>
        const cardColor = 'gray';
        const headingColor = '#FDAC34';
        const black = '#ffff';

        let doughnutChartVar; // Variabel untuk menyimpan instance grafik

        if (true) {
            function pieGet(code) {
                var doughnutChart = $(".piechart-project");

                // Menghancurkan grafik yang ada jika ada
                if (doughnutChartVar) {
                    doughnutChartVar.destroy();
                }

                axios
                    .get("pieproject/" + code)
                    .then((res) => {
                        console.log(res.data[1]);
                        const data = res.data.chartData;
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
                                        "yellow",
                                        "blue",
                                        "#ff7f00"
                                    ],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                animation: {
                                    duration: 500
                                },
                                cutout: "68%",
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
                                            const data =
                                                doughnutChartVar.data.datasets[datasetIndex].data;
                                            const label =
                                                doughnutChartVar.data.labels[dataIndex];
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

                        processedData.forEach(function(data) {
                            const label = data[0];
                            const value = data[1];
                            console.log(label, value);
                        });
                    })
                    .catch((err) => {
                        console.log(err);
                    });
            }
        }

        function filterProjek(selectElement) {
            var code = selectElement.value;
            var projekElements = document.getElementsByClassName('projek-item');

            for (var i = 0; i < projekElements.length; i++) {
                var projekElement = projekElements[i];
                var statusTim = projekElement.getAttribute('data-status-tim');

                if (code === 'all' || code === statusTim) {
                    projekElement.style.display = 'block';
                } else {
                    projekElement.style.display = 'none';
                }
            }
        }
    </script>
    {{-- filter Projek --}}

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
                var progressFormat = Math.round(progress);

                $('#logo-tim').attr('src', logo);
                $('#logo-tim2').attr('src', logo);
                $('#nama-tim').text(namatim);
                $('#nama-tim2').text(namatim);
                $('#status').text(status);
                $('#tema').text(tema);
                $('#tglmulai').text(tglmulai);
                $('#deadline').text(deadline);
                $('#dayLeft').text(dayLeft);
                $('#dayleft').text(dayLeft);
                $('#total').text(total);
                $('#text-repo').text(repo);
                $('#repository').attr('href', repo);
                $('#textPercent').text(progressFormat);
                $('.progress-bar').css('width', progressFormat + '%');
                $('.progress-bar').attr('aria-valuenow', progressFormat);
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
                    var avatarSrc = anggota.avatar ? '/storage/' + anggota.avatar :
                        '/assets/img/avatars/1.png';

                    var anggotaItem = $('<div class="col-lg-4 p-2" style="box-shadow: none">' +
                        '<div class="card">' +
                        '<div class="card-body d-flex gap-3 align-items-center">' +
                        '<div>' +
                        '<img width="30px" height="30px" class="rounded-circle object-cover" src="' +
                        avatarSrc + '" alt="foto user">' +
                        '</div>' +
                        '<div>' +
                        '<h5 class="mb-0" style="font-size: 15px">' + anggota.name + '</h5>' +
                        '<span class="badge bg-label-warning">' + anggota.jabatan + '</span>' +
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
