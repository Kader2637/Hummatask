@extends('layoutsMentor.app')

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <h5 class="header">List Project</h5>
        {{-- <div id="data"></div> --}}
        {{-- Header --}}
        <div class="d-flex justify-content-between">
            <div class="filter col-lg-3 col-md-3 col-sm-3">
                <label for="select2Basic" class="form-label">Filter</label>
                <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg" data-allow-clear="true">
                    <option value="a">Solo Project</option>
                    <option value="b">Pre-mini Project</option>
                    <option value="c">Mini Project</option>
                    <option value="d">Big Project</option>
                </select>
            </div>
            <div id="buatTim" class="d-flex align-items-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatTim">Buat
                    Tim</button>
            </div>
        </div>
        {{-- Header --}}

        {{-- Card --}}
        <div class="row mt-4">
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
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-3">
                                <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="foto logo"
                                    style="width: 100px; height: 100px" class="rounded-circle mb-3">
                                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                    class="">
                                    <span class="text-black fs-6">{{ $item->tim->nama }}</span>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-warning my-1">{{ $item->tim->status_tim }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota as $anggota)
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="{{ $anggota->user->username }}"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="rounded-circle"
                                                                src="{{ $anggota->user->avatar ? Storage::url($anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                alt="Avatar">
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
                                    <div>{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Tema : </span>
                                    <div>{{ $item->tema->nama_tema }}</div>
                                </div>
                            </div>
                            <a data-bs-toggle="" data-bs-target="#modalDetail" class="w-100 btn btn-primary btn-detail"
                                data-logo="{{ asset('storage/' . $item->tim->logo) }}" data-namatim="{{ $item->tim->nama }}"
                                data-status="{{ $item->tim->status_tim }}" data-tema="{{ $item->tema->nama_tema }}"
                                data-tglmulai="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}"
                                data-anggota="{{ $anggotaJson }}" data-deskripsi="{{ $item->deskripsi }}"
                                data-dayleft="{{ $dayLeft }}" data-total-deadline="{{ $totalDeadline }}"
                                data-progress="{{ $progressPercentage }}" data-repo="{{ $item->tim->repository }}"
                                data-now="{{ now() }}"><span class="text-white">Detail</span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada data project</p>
            @endforelse
        </div>
        {{-- Card --}}

        {{-- Script detail modal --}}
        <script>
            $(document).ready(function() {
                $('.btn-detail').click(function() {
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
                    var now = $(this).data('now');

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
                    $('#textPercent').text(progressFormat);

                    if (deadline < now) {
                        $('#dayLeft').text(dayLeft);
                        $('#dayleft').text(dayLeft);
                        $('#total').text(total);
                        $('.progress-bar').css('width', progressFormat + '%');
                        $('.progress-bar').attr('aria-valuenow', progressFormat);
                    } else {
                        $('#container').html(
                            '<div class="alert alert-danger d-flex align-items-center" role="alert">' +
                            '<span class="alert-icon text-danger me-2">' +
                            '<i class="ti ti-ban ti-xs"></i>' +
                            '</span>' +
                            'Project anda telah lewat deadline selama ' + dayLeft +
                            ' hari, mohon konfirmasi mentor untuk perpanjang tenggat!' +
                            '</div>'
                        );
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

                    var anggotaList = $('#anggota-list');
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

                    $('#modalDetail').modal('show');

                });
            });
        </script>
        {{-- Script detail modal --}}

        {{-- Modal detail --}}
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
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
                                                    aria-controls="navs-pills-top-home"
                                                    aria-selected="true">Project</button>
                                            </div>
                                            <div class="nav-item button-nav" role="presentation">
                                                <button type="button" class="nav-link" role="tab"
                                                    data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile"
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
                                                            <canvas id="project" class="chartjs mb-4" data-height="267"
                                                                style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
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
                                                                    <div class="progres-bar" id="container">
                                                                        <div class="d-flex justify-content-between">
                                                                            <span>Hari</span>
                                                                            <span><span id="dayLeft"></span> dari <span
                                                                                    id="total"></span> Hari</span>
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
                                                                            <span>Tenggat kurang <span
                                                                                    id="dayleft"></span> hari lagi</span>
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
                                                    id="anggota-list">
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

        {{-- Modal Buat Tim --}}
        <form action="" id="createForm" method="post">
            @csrf
            <div class="modal fade" id="modalBuatTim" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Buat Tim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_tim" class="form-label">Tim</label>
                                    <select id="status_tim" onchange="run()" name="status_tim"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Tim</option>
                                        @foreach ($status_tim as $status)
                                            <option class="text-capitalize" value="{{ $status->id }}">
                                                {{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_tim')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="kelompok_ketua" style="display: block">
                                <div class="col mb-3">
                                    <label for="ketuaKelompok" class="form-label">Ketua Kelompok</label>
                                    <select id="ketuaKelompok" name="ketuaKelompok"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Kelompok</option>
                                    </select>
                                    @error('ketuaKelompok')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="project_ketua" style="display: block">
                                <div class="col mb-3">
                                    <label for="KetuaProject" class="form-label">Ketua Projek</label>
                                    <select id="KetuaProject" name="ketuaProjek"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Projek</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="anggota" class="form-label">Anggota</label>
                                    <select id="anggota" name="anggota[]" class="select2 form-select selecto" multiple>
                                    </select>
                                    @error('anggota')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <script>
            function run() {
                const status = document.getElementById('status_tim').value;
                let project_ketua = document.getElementById('project_ketua');

                if (status == 2) {
                    project_ketua.style = 'display: none';
                } else {
                    project_ketua.style = 'display: block';
                }
            }
        </script>
        <script>
            get()

            function get() {
                $.ajax({
                    url: "{{ route('Project') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#KetuaProject').html('')
                        $('#ketuaKelompok').html('')
                        $('#anggota').html('')
                        $("#KetuaProject").append("<option disabled selected>Pilih Data</option>");
                        $("#ketuaKelompok").append("<option disabled selected>Pilih Data</option>");

                        $.each(data.users, function(index, users) {
                            $("#anggota").append("<option value=" + users.id + ">" + users.username +
                                "</option>");
                            $("#KetuaProject").append("<option value=" + users.id + ">" + users.username +
                                "</option>");
                            $("#ketuaKelompok").append("<option value=" + users.id + ">" + users.username +
                                "</option>");
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Terjasi kesalahan : " + error);
                    }
                });
            }
            $(document).ready(function() {
                var isCreatingTim = false;
                // Fungsi untuk menangani pembuatan tim menggunakan AJAX
                function createTim() {
                    // Mendapatkan data formulir
                    $('#createButton').prop('disabled', true);

                    // Set variabel isCreatingTim menjadi true
                    isCreatingTim = true;
                    $('#loader').show();
                    var formData = new FormData($('#createForm')[0]);
                    // Menggunakan AJAX untuk mengirim data ke server
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('pembuatan.tim') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Tanggapan dari server, bisa ditangani sesuai kebutuhan
                            get();
                            isCreatingTim = false;
                            // Aktifkan kembali button create
                            $('#createButton').prop('disabled', false);
                            // Tutup modal
                            $('#status_tim').val('');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Data Berhasil Ditambahkan',
                            });
                            $('#ketuaKelompok, #status_tim, #anggota').val(null).trigger('change');
                            $('#modalBuatTim').modal('hide');
                            get();
                            $('#loader').fadeOut();
                        },
                        error: function(error) {
                            $('#modalBuatTim').modal('hide');
                            // Tanggapan error dari server
                            console.log(error);
                            var errorMessage = 'Pastikan data terisi semua.';
                            if (error.responseJSON && error.responseJSON.message) {
                                errorMessage = error.responseJSON.message;
                            } else if (error.responseJSON && error.responseJSON.errors && error.responseJSON
                                .errors.anggota) {
                                errorMessage = 'Data sudah digunakan di opsi lain.';
                            }
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: errorMessage,
                            });
                            $('#loader').fadeOut();
                            isCreatingTim = false;

                            // Aktifkan kembali button create
                            $('#createButton').prop('disabled', false);
                        }
                    });
                }

                // Menangani submit formulir menggunakan AJAX
                $('#createForm').submit(function(e) {
                    e.preventDefault(); // Mencegah formulir melakukan submit bawaan
                    createTim(); // Panggil fungsi untuk membuat tim menggunakan AJAX
                });
            });
        </script>
        {{-- pagination --}}
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item first">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-left ti-xs"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">2</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="javascript:void(0);">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">5</a>
                </li>
                <li class="page-item next">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs"></i></a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
                </li>
            </ul>
        </nav>
        {{-- pagination --}}
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection
