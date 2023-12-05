@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/pages/profile-banner.png"
                            alt="Banner image" class="rounded-top">
                    </div>
                    <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data"
                        id="update-profile-form">
                        @csrf
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <label class="form-label text-white" for="image-input3">
                                    <img id="preview-image3"
                                        src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('assets/img/avatars/pen.png') }}"
                                        alt="example placeholder"
                                        style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer; object-fit:cover;"
                                        class="d-block ms-0 ms-sm-4 rounded user-profile-img" />

                                    <input type="file" class="d-none" id="image-input3" name='photo'
                                        onchange="previewImage()" />

                                </label>
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4>{{ $user->username }}</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class='ti ti-color-swatch'></i> {{ $user->peran->peran }}
                                            </li>
                                            @if ($user->sekolah)
                                                <li class="list-inline-item d-flex gap-1">
                                                    <i class='ti ti-map-pin'></i> {{ $user->sekolah }}
                                                </li>
                                            @endif
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class='ti ti-calendar'></i> Bergabung pada
                                                {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM YYYY') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class="nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link cursor-pointer active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"
                        data-tab="1"><i class="ti ti-user-circle me-1"></i>Edit Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link cursor-pointer" id="pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false"
                        data-tab="2"><i class="ti ti-asterisk me-1"></i>Ganti password</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link cursor-pointer" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false"
                        data-tab="3"><i class="ti ti-clipboard-check me-1"></i>History Kelompok</a>
                </li>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Edit Profil</h5>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input name="username" type="text" class="form-control"
                                                placeholder="{{ $user->username ?: 'Isi username anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Nama</label>
                                            <span class="text-danger" id="username-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <input name="email" type="email" class="form-control"
                                                placeholder="{{ $user->email ?: 'Isi email anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Email</label>
                                            <span class="text-danger" id="email-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <input name="tlp" type="number" class="form-control"
                                                placeholder="{{ $user->tlp ? $user->tlp : 'Isi nomer telepon anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Nomor Telpon</label>
                                            <span class="text-danger" id="tlp-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input name="sekolah" type="text" class="form-control"
                                                placeholder="{{ $user->sekolah ?: 'Isi alamat sekolah anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Asal Sekolah</label>
                                            <span class="text-danger" id="alamat-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <textarea name="deskripsi" style="resize: none; height: 133.5px;" class="form-control"
                                                placeholder="{{ $user->deskripsi != 'none' ?: 'Isi deskripsi anda' }}" aria-describedby="floatingInputHelp"></textarea>
                                            <label for="floatingInput">deskripsi</label>
                                            <span class="text-danger" id="deskripsi-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex my-2">
                                        <div class="button ms-auto">
                                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">

                            {{-- card team --}}
                            <div class="row">
                                @forelse ($tims as $item)
                                    @php
                                        $anggotaArray = [];
                                        foreach ($item->anggota as $anggota) {
                                            $anggotaArray[] = [
                                                'name' => $anggota->user->username,
                                                'avatar' => $anggota->user->avatar,
                                                'jabatan' => $anggota->jabatan->nama_jabatan,
                                            ];
                                        }
                                        $anggotaArray = array_reverse($anggotaArray);
                                        $anggotaJson = json_encode($anggotaArray);
                                        $tanggalMulai = $item->created_at->translatedFormat('Y-m-d');
                                        $totalDeadline = null;
                                        $dayLeft = null;

                                        $deadline = \Carbon\Carbon::parse($item->deadline)->translatedFormat('Y-m-d');
                                        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);

                                        // Periksa apakah $totalDeadline tidak nol sebelum melakukan pembagian
                                        if ($totalDeadline > 0) {
                                            $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now());
                                            $progressPercentage = 100 - ($dayLeft / $totalDeadline) * 100;
                                        } else {
                                            // Tangani kasus di mana $totalDeadline adalah nol
                                            $progressPercentage = null; // Tetapkan nilai default atau tangani sesuai kebutuhan
                                        }
                                    @endphp

                                    <div class="col-md-6 col-lg-4">
                                        <div class="card text-center mb-3 tim-item"
                                            data-status-tim="{{ $item->status_tim }}">
                                            <div class="card-body">
                                                <img src="{{ asset('storage' . $item->logo) }}" alt="logo tim"
                                                    class="rounded-circle mb-3"
                                                    style="width: 100px; height: 100px; object-fit: cover">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div
                                                        class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                        <div class="d-flex align-items-center">
                                                            <ul
                                                                class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                                @foreach ($item->anggota_tim() as $anggota)
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="bottom"
                                                                        title="{{ $anggota->user->username }}"
                                                                        class="avatar avatar-sm pull-up">
                                                                        <img class="rounded-circle"
                                                                            src="{{ $anggota->user->avatar ? asset('storage' . $anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                            alt="Avatar" style="object-fit: cover">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="mb-0 d-flex justify-content-center">
                                                    <span class="badge bg-label-warning">
                                                        @if ($item->status_tim == 'solo')
                                                            Solo Project
                                                        @elseif ($item->status_tim == 'pre_mini')
                                                            Pre-mini Project
                                                        @elseif ($item->status_tim == 'mini')
                                                            Mini Project
                                                        @elseif ($item->status_tim == 'big')
                                                            Big Project
                                                        @endif
                                                    </span>
                                                    @if ($item->kadaluwarsa == 1)
                                                        <span class="ms-1 badge bg-label-danger">
                                                            Expired Team
                                                        </span>
                                                    @elseif ($item->kadaluwarsa == 0)
                                                        <span class="ms-1 badge bg-label-success">
                                                            Active Team
                                                        </span>
                                                    @endif
                                                </p>
                                                <h5 class="card-title">{{ $item->nama }}</h5>
                                                <div id="info" class="my-4">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Mulai : </span>
                                                        <div>{{ $item->created_at->translatedFormat('l, j F Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Tema :</span>
                                                        @if (isset($item->project[0]) && $item->project[0]->tema_id != null)
                                                            <span>{{ $item->project[0]->tema->nama_tema }}</span>
                                                        @else
                                                            belum ada
                                                        @endif
                                                        </span>

                                                    </div>
                                                </div>
                                                <p class="card-text" data-bs-placement="bottom" title="Deadline Project">
                                                    {{ $item->project->isNotEmpty() && isset($item->project[0]) ? \Carbon\Carbon::parse($item->project[0]->deadline)->translatedFormat('l j F Y') : 'Tim ini belum memiliki project' }}
                                                </p>
                                                <a data-bs-toggle="" data-bs-target="#modalDetailProjek"
                                                    class="w-100 btn btn-primary btn-detail-projek"
                                                    data-logo="{{ asset('storage/' . $item->logo) }}"
                                                    data-namatim="{{ $item->nama }}"
                                                    data-status="@if ($item->status_tim == 'solo') Solo Project
                                                @elseif ($item->status_tim == 'pre_mini')
                                                    Pre-Mini Project
                                                @elseif ($item->status_tim == 'mini')
                                                    Mini Project
                                                @elseif ($item->status_tim == 'big')
                                                    Big Project @endif"
                                                    data-tema="{{ isset($item->project[0]) && $item->project[0]->tema_id != null ? $item->project[0]->tema->nama_tema : 'belum ada' }}"
                                                    data-tglmulai="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                                    data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}"
                                                    data-anggota="{{ json_encode($item->anggota_profile()) }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
                                                    data-dayleft="{{ $dayLeft }}"
                                                    data-total-deadline="{{ $totalDeadline }}"
                                                    data-progress="{{ $progressPercentage }}"
                                                    data-repo="{{ $item->repository }}"><span
                                                        class="text-white">Detail</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-4 col-lg-4 col-sm-4 mb-3 " id="projectList">
                                        <div class="card text-center mb-3 me-3 projek-item"
                                            data-status-tim="{{ $item->status_tim }}">
                                            <div class="card-body">
                                                <div class="d-flex flex-row gap-3">
                                                    <img src="{{ asset('storage/' . $item->logo) }}" alt="foto logo"
                                                        style="width: 100px; height: 100px; object-fit: cover"
                                                        class="rounded-circle mb-3">
                                                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                                        class="">
                                                        <span class="text-black fs-6">{{ $item->nama }}</span>
                                                        <div class="d-flex align-items-center">
                                                            <span class="badge bg-label-warning my-1">
                                                                @if ($item->status_tim == 'solo')
                                                                    Solo Project
                                                                @elseif ($item->status_tim == 'pre_mini')
                                                                    Pre-Mini Project
                                                                @elseif ($item->status_tim == 'mini')
                                                                    Mini Project
                                                                @elseif ($item->status_tim == 'big')
                                                                    Big Project
                                                                @endif
                                                            </span>
                                                            @if ($item->kadaluwarsa == 1)
                                                                <span class="ms-1 badge bg-label-danger">
                                                                    Expired Team
                                                                </span>
                                                            @elseif ($item->kadaluwarsa == 0)
                                                                <span class="ms-1 badge bg-label-success">
                                                                    Active Team
                                                                </span>
                                                            @endif
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div
                                                                class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                                <div class="d-flex align-items-center">
                                                                    <ul
                                                                        class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                                        @foreach ($item->anggota as $anggota)
                                                                            <li data-bs-toggle="tooltip"
                                                                                data-popup="tooltip-custom"
                                                                                data-bs-placement="top"
                                                                                title="{{ $anggota->user->username }}"
                                                                                class="avatar avatar-sm pull-up">
                                                                                <img class="rounded-circle"
                                                                                    src="{{ $anggota->user->avatar ? Storage::url($anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                                    alt="Avatar"
                                                                                    style="object-fit: cover">
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
                                                        <div>{{ $item->created_at->translatedFormat('l, j F Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Tema :</span>
                                                        @if (isset($item->project[0]) && $item->project[0]->tema_id != null)
                                                            <span>{{ $item->project[0]->tema->nama_tema }}</span>
                                                        @else
                                                            belum ada
                                                        @endif
                                                        </span>

                                                    </div>
                                                </div>
                                                <a data-bs-toggle="" data-bs-target="#modalDetailProjek"
                                                    class="w-100 btn btn-primary btn-detail-projek"
                                                    data-logo="{{ asset('storage/' . $item->logo) }}"
                                                    data-namatim="{{ $item->nama }}"
                                                    data-status="@if ($item->status_tim == 'solo') Solo Project
                                                    @elseif ($item->status_tim == 'pre_mini')
                                                        Pre-Mini Project
                                                    @elseif ($item->status_tim == 'mini')
                                                        Mini Project
                                                    @elseif ($item->status_tim == 'big')
                                                        Big Project @endif"
                                                    data-tema="{{ isset($item->project[0]) && $item->project[0]->tema_id != null ? $item->project[0]->tema->nama_tema : 'belum ada' }}"
                                                    data-tglmulai="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                                    data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}"
                                                    data-anggota="{{ json_encode($item->anggota_profile()) }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
                                                    data-dayleft="{{ $dayLeft }}"
                                                    data-total-deadline="{{ $totalDeadline }}"
                                                    data-progress="{{ $progressPercentage }}"
                                                    data-repo="{{ $item->repository }}"><span
                                                        class="text-white">Detail</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}
                                @empty
                                @endforelse
                            </div>
                            {{-- card team end --}}

                            <div class="modal fade" id="modalDetailProjek" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="btn-close btn-lg " data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="col-12">
                                                    <div class="nav-align-top d-flex justify-between">
                                                        <div class="tab-content bg-transparent pb-0"
                                                            style="box-shadow: none;">
                                                            <div class="tab-pane fade active show"
                                                                id="navs-pills-top-home" role="tabpanel">
                                                                <div class="row">
                                                                    <div class="col-lg-6 mb-4">

                                                                        <div class="">
                                                                            <div class="mt-2 justify-content-center align-items-center grid"
                                                                                id="anggota-list-Projek">
                                                                                {{-- Anggota --}}
                                                                                {{-- Anggota --}}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        {{-- card projects --}}
                                                                        <div class="card">
                                                                            <div class="card-header">
                                                                                <div
                                                                                    class="card-header d-flex justify-content-center">
                                                                                    <div
                                                                                        class="d-flex flex-column align-items-center">
                                                                                        <span>Tanggal Mulai: <span
                                                                                                id="tglmulai"></span></span>
                                                                                        <span>Tenggat: <span
                                                                                                id="deadline"></span></span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <hr class="my-0">
                                                                            <div
                                                                                class="card-body d-flex flex-column align-items-center">
                                                                                <div class="row">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="d-flex flex-row gap-3">
                                                                                            <img id="logo-tim"
                                                                                                src=""
                                                                                                alt='logo tim'
                                                                                                class="rounded-circle"
                                                                                                style="width: 90px; height: 90px">
                                                                                            <div
                                                                                                class="d-flex flex-column justify-content-center align-items-center">
                                                                                                <span
                                                                                                    class="d-block text-black fs-5"
                                                                                                    id="nama-tim">nama
                                                                                                    tim</span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="mt-4">
                                                                                            <div class="mb-3">
                                                                                                Status: <span
                                                                                                    class="badge bg-label-warning"
                                                                                                    id="status"></span>
                                                                                            </div>
                                                                                            <div>
                                                                                                Tema: <span
                                                                                                    class="badge bg-label-warning"
                                                                                                    id="tema"></span>
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
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Ganti password</h5>
                                    <div class="card-body row">
                                        <form id="update-password-form"` action="{{ Route('password.updatee') }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="card mb-4">
                                                <div class="card-body row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fs-6" for="password">Password
                                                            Lama</label>
                                                        <div class="form-floating my-2 form-password-toggle">
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="current_password"
                                                                    class="form-control" name="current_password"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />

                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <span id="current_password-error" class="text-danger"></span>
                                                        </div>

                                                        <label class="form-label fs-6" for="password">Konfirmasi
                                                            password
                                                            baru</label>
                                                        <div class="form-floating my-2 form-password-toggle">

                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="confirm-new-password"
                                                                    class="form-control" name="new_password"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />
                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <div class="mt-1 ms-1">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fs-6" for="password">Password
                                                            baru</label>
                                                        <div class="form-floating my-2 form-password-toggle">
                                                            <label class="form-label" for="confirm-password">Konfirmasi
                                                                password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="confirm-password"
                                                                    class="form-control" name="new_password_confirmation"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />
                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <span id="new_password-error" class="text-danger"></span>
                                                        </div>

                                                        <div class="form-floating my-2 form-password-toggle mt-3">
                                                            <div class="button my-auto">
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary mt-4">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
    <script>
        function previewImage() {
            var preview = document.getElementById('preview-image3');
            var fileInput = document.getElementById('image-input3');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }

        $('#update-password-form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Sembunyikan tombol
                        $('#saveButton').hide();

                        // Tampilkan SweetAlert
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Password berhasil diperbarui.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1700,
                        }).then(() => {
                            $('#saveButton').show();

                            window.location.reload();
                        });
                    }
                },

                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        console.log(errors); // Add this line for debugging

                        $('.text-danger').text('');

                        $.each(errors, function(field, messages) {
                            console.log(field);
                            var errorMessage = messages[0];
                            $('#' + field + '-error').text(errorMessage);
                        });
                    } else {
                        toastr.error('Terjadi kesalahan: ' + error, 'Kesalahan');

                    }
                }
            });
        });

        $('#update-profile-form').submit(function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Sembunyikan tombol
                        $('#saveButton').hide();

                        // Tampilkan SweetAlert
                        Swal.fire({
                            title: 'Sukses',
                            text: 'Profile berhasil diperbarui.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1700,
                        }).then(() => {
                            $('#saveButton').show();

                            window.location.reload();
                        });
                    }
                },

                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;

                        console.log(errors); // Add this line for debugging

                        $('.text-danger').text('');

                        $.each(errors, function(field, messages) {
                            var errorMessage = messages[0];
                            $('#' + field + '-error').text(errorMessage);
                        });
                    } else {
                        toastr.error('Terjadi kesalahan: ' + error, 'Kesalahan');

                    }
                },
            });
        });
    </script>
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
                // console.log(anggota);
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
                    var jabatanLabel = anggota.status === 'kicked' ? 'Mantan Anggota' : anggota
                        .jabatan.nama_jabatan;

                    var avatarSrc = anggota.user.avatar ? '/storage/' + anggota.user.avatar :
                        '/assets/img/avatars/1.png';

                    var anggotaItem = $('<div class="col-lg-12 p-2" style="box-shadow: none">' +
                        '<div class="card">' +
                        '<div class="card-body d-flex gap-3 align-items-center">' +
                        '<div>' +
                        '<img width="30px" height="30px" class="rounded-circle object-cover" src="' +
                        avatarSrc + '" alt="foto user">' +
                        '</div>' +
                        '<div>' +
                        '<h5 class="mb-0" style="font-size: 15px">' + anggota.user.username +
                        '</h5>' +
                        '<span class="badge bg-label-warning">' + jabatanLabel + '</span>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>');
                    anggotaList.append(anggotaItem);

                });

                $('#modalDetailProjek').modal('show');

            });

            $('[data-tab]').click(function() {
                var tabProfile = $(this).attr('data-tab');
                sessionStorage.setItem('tabProfile', tabProfile);
            });

            var tabProfile = sessionStorage.getItem('tabProfile');
            if (tabProfile) {
                $('[data-tab="' + tabProfile + '"]').tab('show');
            }

        });
    </script>
@endsection
