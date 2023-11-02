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
@endsection

@section('style')
    <style>
        @media (max-width: 425px) {
            .button-nav {
                font-size: 13px;
            }
        }
    </style>
@endsection

@section('content')
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
                                    Github</label>
                                <input type="text" id="modalEditUserLastName" name="repository"
                                    class="form-control @error('repository') is-invalid @enderror"
                                    placeholder="https://.." />
                                @error('repository')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 justify-content-center">
                            <label for="TagifyBasic" class="form-label">Tema</label>
                            <input id="TagifyBasic" class="form-control @error('temaInput') is-invalid @enderror"
                                name="temaInput" placeholder="Masukkan 5 tema pilihan anda" />
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

    {{-- Validasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ajukanModal = document.getElementById('ajukanModal');

            ajukanModal.addEventListener('submit', function(event) {
                const repositoryInput = document.querySelector('input[name="repository"]');
                const temaInput = document.getElementById('TagifyBasic').value;
                console.log(temaInput.length);
                console.log(temaInput);

                // Validasi input kosong
                if (temaInput.trim() === '' || repositoryInput.value.trim() === '') {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Pastikan semua input diisi!',
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
                    });
                    return;
                }
                // Validasi jumlah array
                try {
                    const temaArray = JSON.parse(temaInput);
                    console.log(temaArray);
                    if (!Array.isArray(temaArray) || temaArray.length !== 5) {
                        throw new Error();
                    }
                } catch (error) {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Inputkan 5 tema!',
                    });
                    return;
                }
            });
        });
    </script>
    {{-- Validasi --}}

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
                            <div class="col mb-3">
                                <label class="form-label text-white" for="image-input">
                                    <img id="preview-image" src="{{ asset('storage/' . $tim->logo) }}"
                                        alt="example placeholder"
                                        style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer" />
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
                                <input type="text" id="nameWithTitle" class="form-control" name="namaTimInput"
                                    placeholder="Masukkan nama tim" value="{{ $tim->nama }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="nameWithTitle" class="form-label">Deskripsi</label>
                                <textarea style="height: 150px; resize: none;" name="deskripsiInput" id="nameWithTitle" class="form-control"
                                    placeholder="Masukkan deskripsi project anda">{{ $project->deskripsi ?? '' }}</textarea>
                            </div>
                        </div>
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
                                aria-controls="navs-pills-top-home" aria-selected="true">Project</button>
                        </div>
                        <div class="nav-item button-nav" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                aria-selected="false" tabindex="-1">Anggota</button>
                        </div>
                    </div>

                    <div class="" role="presentation">
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
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <div class="fs-4 text-black">
                                                Project
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; justify-items: center; align-items: left;">
                                                @php
                                                    $tanggalMulai = $tim->created_at->translatedFormat('Y-m-d');
                                                    $totalDeadline = null;
                                                    $dayLeft = null;

                                                    if ($project) {
                                                        $deadline = \Carbon\Carbon::parse($project->deadline)->translatedFormat('Y-m-d');
                                                        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
                                                        $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now());
                                                        $progressPercentage = 100 - ($dayLeft / $totalDeadline) * 100;
                                                    }
                                                @endphp
                                                <span>Tanggal Mulai :
                                                    {{ $tim->created_at->translatedFormat('l, j F Y') }}</span>
                                                @if ($project)
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
                                                        class="rounded-circle" style="width: 90px; height: 90px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                        <span class="d-block text-black fs-5">{{ $tim->nama }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="mb-3">Status : <span
                                                            class="badge bg-label-warning">{{ $tim->status_tim }}</span>
                                                    </div>
                                                    @if ($project)
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
                                                <div class="d-flex justify-content-between">
                                                    @if ($project)
                                                        <span>Hari</span>
                                                        <span>{{ $dayLeft }} dari {{ $totalDeadline }} Hari</span>
                                                </div>
                                                <div class="d-flex flex-grow-1 align-items-center my-1">
                                                    <div class="progress w-100 me-3" style="height:8px;">
                                                        <div class="progress-bar bg-primary" role="progressbar"
                                                            style="width: {{ round($progressPercentage) }}%"
                                                            aria-valuenow="{{ round($progressPercentage) }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                        </div>
                                                    </div>
                                                    <span class="text-muted">{{ round($progressPercentage) }}%</span>
                                                </div>
                                                <div class="tenggat">
                                                    <span>Tenggat kurang {{ $dayLeft }} hari lagi</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @if ($project->deskripsi)
                                                <div class="deskripsi mt-2">
                                                    <div class="title text-dark">
                                                        Deskripsi :
                                                    </div>
                                                    <div class="isi">
                                                        {{ $project->deskripsi }}
                                                    </div>
                                                </div>
                                            @else
                                                <div class="alert alert-warning d-flex align-items-center mt-4 cursor-pointer" role="alert" data-bs-toggle="modal" data-bs-target="#editProject">
                                                    <span class="alert-icon text-warning me-2">
                                                        <i class="ti ti-bell ti-xs"></i>
                                                    </span>
                                                    Tim ini belum memiliki deskripsi tema!
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
                                    <img width="90px" height="90px" class="rounded-circle"
                                        src="{{ asset('storage/' . $tim->logo) }}" alt="">
                                    <h1>{{ $tim->nama }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 justify-content-center align-items-center grid">
                            {{-- Anggota --}}
                            @forelse ($anggota as $item)
                                <div class="col-lg-4 p-2" style="box-shadow: none">
                                    <div class="card">
                                        <div class="card-body d-flex gap-3 align-items-center">
                                            <div>
                                                <img width="30px" height="30px" class="rounded-circle object-cover"
                                                    src="{{ asset($item->user->avatar) }}" alt="foto user">
                                            </div>
                                            <div>
                                                <h5 class="mb-0" style="font-size: 15px">
                                                    {{ $item->user->username }}</h5>
                                                <span
                                                    class="badge bg-label-warning">{{ $item->jabatan->nama_jabatan }}</span>
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

    <script>
        const project = document.getElementById('project');
        const data = {
            labels: [
                'Progres',
                'Selesai',
                'Revisi'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [12, 8, 2],
                backgroundColor: [
                    'rgb(102, 110, 232)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
        new Chart(project, {
            type: 'pie',
            data: data
        })
    </script>
@endsection
