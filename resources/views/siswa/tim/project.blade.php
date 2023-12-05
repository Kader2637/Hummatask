@extends('layouts.tim')

@section('link')
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
    <!-- Core CSS -->
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
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('style')
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        @media (max-width: 425px) {
            .button-nav {
                font-size: 13px;
            }
        }

        @media (max-width: 767px) {
            #tenggat {
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('content')
    @if (session('error'))
        <script>
            // Display SweetAlert with the error message
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
    {{-- Modal Ajukan Project --}}
    <div class="modal fade" id="ajukanModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form id="editUserForm" class="row g-2 p-0 m-0" action="{{ route('tim.ajukanProject', $tim->code) }}"
                        method="POST">
                        @csrf
                        <div class="col-12 col-md-12 d-flex flex-row gap-3 align-items-center">
                            <div class="col-12 col-md-12 d-flex flex-wrap flex-col align-items-center">
                                <label class="form-label m-0 p-0 mt-2" for="modalEditUserLastName">Link Repository
                                    Github <span class="text-warning">(Harap inputkan url valid)</span></label>
                                <input type="text" id="modalEditUserLastName" name="repository"
                                    class="form-control @error('repository') is-invalid @enderror"
                                    placeholder="https://.." />
                                @error('repository')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 justify-content-center">
                            <label for="TagifyBasic" class="form-label">Tema <span class="text-warning">(Inputkan 10 tema,
                                    tekan enter di setiap tema)</span></label>
                            <input id="TagifyBasic" class="form-control @error('temaInput') is-invalid @enderror"
                                name="temaInput" placeholder="Masukkan 10 tema pilihan anda" />
                            @error('temaInput')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 d-flex flex-row flex-wrap justify-content-end">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1">Unggah</button>
                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"
                                aria-label="Close">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal --}}

    {{-- Modal Edit Project --}}
    <div class="modal fade" id="editProject" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProjectTitle">Edit Project</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tim.editProject', $tim->code) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col mb-3 text-center">
                                <label class="form-label text-white" for="image-input">
                                    <img id="preview-image" src="{{ asset('storage/' . $tim->logo) }}"
                                        alt="example placeholder"
                                        style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer; object-fit: cover" />
                                    <input type="file" class="form-control d-none" id="image-input" name="logo" />
                                    @error('logo')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                    <script>
                                        document.getElementById('image-input').addEventListener('change', function(e) {
                                            var previewImage = document.getElementById('preview-image');
                                            var file = e.target.files[0];

                                            if (file) {
                                                var reader = new FileReader();
                                                reader.onload = function(event) {
                                                    previewImage.src = event.target.result;
                                                };
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Nama Tim</label>
                                <input type="text" id="namaTim" class="form-control" name="namaTimInput"
                                    placeholder="Masukkan nama tim" value="{{ $tim->nama }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Repository Github</label>
                                <input type="text" id="repoInput" class="form-control" name="repoInput"
                                    placeholder="Masukkan URL Repository" value="{{ $tim->repository }}">
                            </div>
                        </div>
                        @if (@isset($project) && $project->status_project === 'approved')
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Deskripsi <span id="deskripsi-length"
                                            class="text-warning">Panjang deskripsi anda karakter, maks 500
                                            karakter</span></label>
                                    <textarea style="height: 150px; resize: none;" name="deskripsiInput" id="deskripsiEdit" class="form-control"
                                        placeholder="Masukkan deskripsi project anda">{{ $project->deskripsi ?? '' }}</textarea>
                                </div>
                            </div>
                            <script>
                                $(document).ready(function() {
                                    var initialText = $('#deskripsiEdit').val();
                                    var initialCharCount = initialText.length;
                                    $('#deskripsi-length').text('Panjang deskripsi anda ' + initialCharCount +
                                        ' karakter, maks 500 karakter');

                                    $('#deskripsiEdit').on('input', function() {
                                        var text = $(this).val();
                                        var totalCharCount = text.length;

                                        $('#deskripsi-length').text('Panjang deskripsi anda ' + totalCharCount +
                                            ' karakter, maks 500 karakter');
                                    });
                                });
                            </script>
                        @else
                            <label for="nameWithTitle" class="form-label">Deskripsi</label>
                            <div class="alert alert-warning d-flex align-items-center mt-4 cursor-pointer" role="alert">
                                <span class="alert-icon text-warning me-2">
                                    <i class="ti ti-bell ti-xs"></i>
                                </span>
                                Deskripsi baru bisa di edit saat project anda telah di konfirmasi oleh mentor/ketua magang
                            </div>
                        @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Edit Project --}}

    <div class="container-fluid mt-5">
        <div class="col-12">
            <div class="nav-align-top d-flex justify-between">
                <div class="nav nav-pills d-flex justify-content-between my-4" role="tablist">
                    <div class="d-flex justify-content-between">
                        <div class="nav-item" role="presentation">
                            <button type="button" class="nav-link active button-nav" role="tab"
                                data-bs-toggle="tab" data-bs-target="#navs-pills-top-home"
                                aria-controls="navs-pills-top-home" aria-selected="true" data-tab="1">Project</button>
                        </div>
                        <div class="nav-item button-nav" role="presentation">
                            <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false" data-tab="2">Anggota</button>
                        </div>

                    </div>
                    <div class="" role="presentation">
                        @auth
                            @if (auth()->user()->anggota->jabatan_id == '1')
                                @if (!$project)
                                    <button class="btn btn-primary button-nav waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#ajukanModal">
                                        Ajukan Project
                                    </button>
                                @else
                                    <button class="btn btn-primary button-nav waves-effect waves-light" data-bs-toggle="modal"
                                        data-bs-target="#editProject">
                                        Edit Project
                                    </button>
                                @endif
                            @endif
                        @endauth
                    </div>
                </div>
                <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    <h5 class="card-header">Progres Tim</h5>
                                    <div class="card-body">
                                        <p id="chart-status" class="text-center chart-status"></p>
                                        <canvas id="project" class="chartjs mb-4" data-height="267"
                                            style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                            <li class="ct-series-0 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 13px">Tugas Baru</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: #6A2C70; height: 6px; width: 30px;"></span>
                                                <div class="text-muted"></div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 13px">Dikerjakan</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: #B83B5E; height: 6px; width: 30px;"></span>
                                                <div class="text-muted"></div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 13px">Revisi</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: #F08A5D; height: 6px; width: 30px;"></span>
                                                <div class="text-muted"></div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0" style="font-size: 13px">Selesai</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
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
                                            class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-2">
                                            <div class="fs-4 text-black">
                                                Project
                                            </div>
                                            <div id="tenggat"
                                                style="display: flex; flex-direction: column; justify-items: center; align-items: left;">
                                                @if (@isset($project) && $project->deadline)
                                                    @php
                                                        $tanggalMulai = $tim->created_at->translatedFormat('Y-m-d');
                                                        $totalDeadline = null;
                                                        $dayLeft = null;

                                                        $deadline = \Carbon\Carbon::parse($project->deadline)->translatedFormat('Y-m-d');
                                                        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
                                                        $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now()->startOfDay());
                                                        $progressPercentage = $totalDeadline > 0 ? 100 - ($dayLeft / $totalDeadline) * 100 : 0;
                                                    @endphp
                                                @endif
                                                <span>Tanggal Mulai :
                                                    {{ $tim->created_at->translatedFormat('l, j F Y') }}</span>
                                                @if (@isset($project) && $project->deadline)
                                                    <span>Tenggat :
                                                        {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('l, j F Y') }}</span>
                                                @else
                                                    <span>Tenggat : Pending </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex flex-row gap-3">
                                                    <img src="{{ asset('storage/' . $tim->logo) }}" alt='logo tim'
                                                        class="rounded-circle"
                                                        style="width: 90px; height: 90px; object-fit: cover">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                        <span class="d-block text-black fs-5">{{ $tim->nama }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="mb-3">Status : <span class="badge bg-label-warning">
                                                            @if ($tim->status_tim == 'solo')
                                                                Solo Project
                                                            @elseif ($tim->status_tim == 'pre_mini')
                                                                Pre-Mini Project
                                                            @elseif ($tim->status_tim == 'mini')
                                                                Mini Project
                                                            @elseif ($tim->status_tim == 'big')
                                                                Big Project
                                                            @endif
                                                        </span>
                                                    </div>
                                                    @if (@isset($project) && $project->deadline)
                                                        <div>Tema : <span
                                                                class="badge bg-label-warning">{{ $project->tema->nama_tema }}</span>
                                                        @else
                                                            <div>Tema : <span class="badge bg-label-warning">Pending</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="progres-bar">
                                                @if (@isset($project) && $project->status_project === 'approved')
                                                    @if ($project->deadline > now())
                                                        <div class="d-flex justify-content-between">
                                                            <span>Hari</span>
                                                            <span>{{ $dayLeft }} dari {{ $totalDeadline }}
                                                                Hari</span>
                                                        </div>
                                                        <div class="d-flex flex-grow-1 align-items-center my-1">
                                                            <div class="progress w-100 me-3" style="height:8px;">
                                                                <div class="progress-bar bg-primary" role="progressbar"
                                                                    style="width: {{ round($progressPercentage) }}%"
                                                                    aria-valuenow="{{ round($progressPercentage) }}"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                </div>
                                                            </div>
                                                            <span
                                                                class="text-muted">{{ round($progressPercentage) }}%</span>
                                                        </div>
                                                        <div class="tenggat">
                                                            <span>Tenggat kurang {{ $dayLeft }} hari lagi</span>
                                                        </div>
                                                    @else
                                                        <div class="alert alert-danger d-flex align-items-center"
                                                            role="alert">
                                                            <span class="alert-icon text-danger me-2">
                                                                <i class="ti ti-ban ti-xs"></i>
                                                            </span>
                                                            Project anda telah lewat deadline selama {{ $dayLeft }}
                                                            hari, mohon konfirmasi mentor untuk perpanjang tenggat!
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                            @if (@isset($project) && $project->deskripsi != null)
                                                <div class="deskripsi my-2">
                                                    <div class="title text-dark">
                                                        Deskripsi :
                                                    </div>
                                                    <div class="isi mt-2">
                                                        {{ $project->deskripsi }}
                                                    </div>
                                                </div>
                                            @elseif (@isset($project) && $project->deskripsi == null)
                                                <div class="alert alert-warning d-flex align-items-center mt-4 cursor-pointer"
                                                    role="alert" data-bs-toggle="modal" data-bs-target="#editProject"
                                                    style="font-size: 12px">
                                                    <span class="alert-icon text-warning me-2">
                                                        <i class="ti ti-bell ti-xs"></i>
                                                    </span>
                                                    Tim ini belum memiliki deskripsi tema, mohon isi agar dapat mengakses
                                                    fitur lain nya! Hanya Ketua tim yang dapat mengajukan tema.
                                                </div>
                                            @else
                                                <div class="alert alert-warning d-flex align-items-center mt-4 cursor-pointer"
                                                    role="alert" data-bs-toggle="modal" data-bs-target="#editProject"
                                                    style="font-size: 12px">
                                                    <span class="alert-icon text-warning me-2">
                                                        <i class="ti ti-bell ti-xs"></i>
                                                    </span>
                                                    Tim ini belum memiliki project, mohon ajukan project agar dapat
                                                    mengakses
                                                    fitur lain nya! Hanya Ketua tim yang dapat mengajukan project.
                                                </div>
                                            @endif
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
                            <div class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                    <img width="90px" height="90px" class="rounded-circle" style="object-fit: cover"
                                        src="{{ asset('storage/' . $tim->logo) }}" alt="">
                                    <h1>{{ $tim->nama }}</h1>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 justify-content-center align-items-center grid">
                            {{-- Anggota --}}
                            @forelse ($anggota as $item)
                                <div class="col-lg-4 my-1 px-1" style="box-shadow: none">
                                    <div class="card">
                                        <div class="card-body d-flex gap-3 align-items-center">
                                            <div>
                                                <img width="30px" height="30px" class="rounded-circle"
                                                    style="object-fit: cover"
                                                    src="{{ $item->user->avatar ? asset('storage/' . $item->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                    alt="foto user">
                                            </div>
                                            <div>
                                                <h5 class="mb-0" style="font-size: 15px" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ $item->user->username }}">
                                                    {{ Str::limit($item->user->username, 18) }}</h5>
                                                <div>
                                                    @if ($item->status == 'active')
                                                        <span
                                                            class="badge bg-label-warning">{{ $item->jabatan->nama_jabatan }}</span>
                                                    @elseif ($item->status == 'kicked')
                                                        <span class="badge bg-label-danger">Mantan anggota </span>
                                                    @endif
                                                    @if ($item->user->status_kelulusan == '1')
                                                        <span class="badge bg-label-success">Lulus</span>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Tidak ada data anggota</p>
                            @endforelse
                            {{-- Anggota --}}
                        </div>
                    </div>
                </div>

                {{-- statistic --}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd"
                    aria-labelledby="offcanvasEndLabel">
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
                                            <button type="button" class="nav-link active" role="tab"
                                                data-bs-toggle="tab" data-bs-target="#navs-top-home"
                                                aria-controls="navs-top-home" aria-selected="true">Card</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
                                            {{-- @foreach ($selesaiCount as $card) --}}
                                            {{-- @dump($selesaiCount) --}}
                                            <div class="row gap-4">
                                                <div class="col-12">
                                                    <div class="card h-100">
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <div class="card-title mb-0">
                                                                <h5 class="mb-0 me-2">{{ $selesaiCount }}</h5>
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
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <div class="card-title mb-0">
                                                                <h5 class="mb-0 me-2">{{ $persentase }}%
                                                                </h5>
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
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <div class="card-title mb-0">
                                                                @if (!empty($tanggal))
                                                                    @foreach ($tanggal as $tgl)
                                                                        <h5 class="mb-0 me-2">
                                                                            {{ $tgl }} Jam</h5>
                                                                    @endforeach
                                                                @else
                                                                    <h6 class="mb-0 me-0">Belum ada project
                                                                    </h6>
                                                                @endif
                                                                <small>Waktu pengerjaan project</small>
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
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <div class="card-title mb-0">
                                                                <h5 class="mb-0 me-2">{{ $revisiCount }}</h5>
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
                                                        <div
                                                            class="card-body d-flex justify-content-between align-items-center">
                                                            <div class="card-title mb-0">
                                                                @if (!empty($days))
                                                                    @foreach ($days as $day)
                                                                        <h5 class="mb-0 me-2">
                                                                            {{ $day }} Hari</h5>
                                                                    @endforeach
                                                                @else
                                                                    <h6 class="mb-0 me-2">Belum ada project
                                                                    </h6>
                                                                @endif
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
                                            {{-- @endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- statistic --}}

            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}">
    </script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- Validasi --}}
    <script>
        $('#editProject').on('submit', function(e) {
            var foto = $('#image-input').val();
            var namaTim = $('#namaTim').val();
            var repo = $('#repoInput').val();
            var deskripsi = $('#deskripsiEdit').val();

            if (foto !== '') {
                var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                if (!allowedExtensions.exec(foto)) {
                    e.preventDefault(); // Menghentikan pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'File harus berupa gambar (jpg, jpeg, png, gif)',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }

            if (namaTim.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama tim tidak boleh kosong',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (namaTim.length > 50) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama tim terlalu panjang, maks 50 char',
                    showConfirmButton: false,
                    timer: 2000
                });
            }

            // Validasi repo (URL)
            if (repo.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Nama repo tidak boleh kosong',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                // Pengecekan apakah repo adalah URL menggunakan regex
                var urlRegex = /^(ftp|http|https):\/\/[^ "]+$/;
                if (!urlRegex.test(repo)) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Nama repo harus berupa URL yang valid',
                        showConfirmButton: false,
                        timer: 2000
                    });
                }
            }

            // Validasi deskripsi
            if (deskripsi.length === 0) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Deskripsi tidak boleh kosong',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else if (deskripsi.length > 500) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Deskripsi terlalu panjang, maks 500',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        });
    </script>
    {{-- Validasi --}}
    {{-- Validasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ajukanModal = document.getElementById('ajukanModal');

            ajukanModal.addEventListener('submit', function(event) {
                const repositoryInput = document.querySelector('input[name="repository"]');
                const temaInput = document.getElementById('TagifyBasic').value;

                // Validasi input kosong
                if (temaInput.trim() === '' || repositoryInput.value.trim() === '') {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Pastikan semua input diisi!',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    return;
                }
                // Validasi repositoryInput sebagai URL
                if (!repositoryInput.value.match(
                        /^(http(s)?:\/\/)?([\w-]+\.)+[\w-]+(\/[\w- .\/?%&=]*)?$/)) {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'URL Repository tidak valid!',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    return;
                }
                // Validasi jumlah array
                try {
                    const temaArray = JSON.parse(temaInput);
                    if (!Array.isArray(temaArray) || temaArray.length !== 10) {
                        throw new Error();
                    }
                } catch (error) {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Inputkan 10 tema!',
                        showConfirmButton: false,
                        timer: 1500,
                    });
                    return;
                }
            });

            $('[data-tab]').click(function() {
                var projectTab = $(this).attr('data-tab');
                sessionStorage.setItem('projectTab', projectTab);
            });

            var projectTab = sessionStorage.getItem('projectTab');
            if (projectTab) {
                $('[data-tab="' + projectTab + '"]').tab('show');
            }
        });
    </script>
    {{-- <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script> --}}

    {{-- Validasi --}}

    {{-- pie chart --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardColor = 'grey';
            const headingColor = '#FDAC34';
            const black = '#fff';

            const doughnutChart = document.getElementById('project');
            const chartStatus = document.querySelector('.chart-status');

            if (doughnutChart) {
                const processedData = <?php echo json_encode($chartData); ?>;

                const labels = processedData.map(data => data[0]);
                const values = processedData.map(data => data[1]);

                const doughnutChartVar = new Chart(doughnutChart, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [cardColor, '#F9ED69', '#F08A5D', '#B83B5E',
                                '#6A2C70'
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
                                    return `Jumlah ${label}: ${value}`;
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
            }
        });
    </script>
@endsection
