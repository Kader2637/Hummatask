@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-5 justify-content-center">
        <div class="card-header fs-5 mb-3 d-flex justify-content-between">
            <span> Daftar Presentasi di minggu ke {{ $history->noMinggu }} bulan {{ $history->bulan }} tahun
                {{ $history->tahun }}
            </span>
            <a class="btn btn-primary" href="{{ url()->previous() }}">Kembali</a>
        </div>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-senin"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-tab="1"><i
                            class=""></i>Senin</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-selasa"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
                            class=""></i>Selasa</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-rabu"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
                            class=""></i>Rabu</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-kamis"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
                            class=""></i>Kamis</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-jumat"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
                            class=""></i>Jumat</button>
                </li>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-senin" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($presentasiSenin as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                        class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota_tim() as $anggota)
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
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <span class="badge bg-label-warning">
                                            @if ($item->tim->status_tim == 'solo')
                                                Solo Project
                                            @elseif ($item->tim->status_tim == 'pre_mini')
                                                Pre-mini Project
                                            @elseif ($item->tim->status_tim == 'mini')
                                                Mini Project
                                            @elseif ($item->tim->status_tim == 'big')
                                                Big Project
                                            @endif
                                        </span>
                                        <span
                                            class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                    </div>
                                    @if ($item->status_presentasi == 'menunggu')
                                        <span class="badge bg-label-danger text-capitalize">Menunggu Presentasi</span>
                                    @elseif ($item->status_presentasi == 'sedang_presentasi')
                                        <span class="badge bg-label-success text-capitalize">Sedang Presentasi</span>
                                    @endif
                                    <h5 class="card-title my-2 text-capitalize">{{ $item->tim->nama }}</h5>
                                    <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="bottom" title="Jadwal Presentasi">
                                        {{ $item->jadwal_ke }} {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->akhir)->format('H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                        @if ($item->status_presentasi == 'menunggu')
                                            <form class="konfirmasi-pengajuan-presentasi-form w-100"
                                                action="{{ route('konfirmasi-pengajuan-presentasi', $item->code) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                    class="btn btn-primary w-100 confirm-btn-up">Konfirmasi
                                                    Presentasi
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-primary w-100 confirm-btn"
                                                data-nama-tim="{{ $item->tim->nama }}"
                                                data-url="{{ route('konfirmasiPresentasi', $item->code) }}">Konfirmasi
                                                Presentasi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i></h6>
                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                alt="page-misc-under-maintenance" width="300" class="img-fluid">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="pills-selasa" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($presentasiSelasa as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                        class="rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: cover">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota_tim() as $anggota)
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
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <span class="badge bg-label-warning">
                                            @if ($item->tim->status_tim == 'solo')
                                                Solo Project
                                            @elseif ($item->tim->status_tim == 'pre_mini')
                                                Pre-mini Project
                                            @elseif ($item->tim->status_tim == 'mini')
                                                Mini Project
                                            @elseif ($item->tim->status_tim == 'big')
                                                Big Project
                                            @endif
                                        </span>
                                        <span
                                            class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                    </div>
                                    @if ($item->status_presentasi == 'menunggu')
                                        <span class="badge bg-label-danger text-capitalize">Menunggu Presentasi</span>
                                    @elseif ($item->status_presentasi == 'sedang_presentasi')
                                        <span class="badge bg-label-success text-capitalize">Sedang Presentasi</span>
                                    @endif
                                    <h5 class="card-title my-2 text-capitalize">{{ $item->tim->nama }}</h5>
                                    <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="bottom" title="Jadwal Presentasi">
                                        {{ $item->jadwal_ke }} {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->akhir)->format('H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                        @if ($item->status_presentasi == 'menunggu')
                                            <form class="konfirmasi-pengajuan-presentasi-form w-100"
                                                action="{{ route('konfirmasi-pengajuan-presentasi', $item->code) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                    class="btn btn-primary w-100 confirm-btn-up">Konfirmasi
                                                    Presentasi
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-primary w-100 confirm-btn"
                                                data-nama-tim="{{ $item->tim->nama }}"
                                                data-url="{{ route('konfirmasiPresentasi', $item->code) }}">Konfirmasi
                                                Presentasi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i></h6>
                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                alt="page-misc-under-maintenance" width="300" class="img-fluid">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="pills-rabu" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                <div class="row">
                    @forelse ($presentasiRabu as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                        class="rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: cover">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota_tim() as $anggota)
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
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <span class="badge bg-label-warning">
                                            @if ($item->tim->status_tim == 'solo')
                                                Solo Project
                                            @elseif ($item->tim->status_tim == 'pre_mini')
                                                Pre-mini Project
                                            @elseif ($item->tim->status_tim == 'mini')
                                                Mini Project
                                            @elseif ($item->tim->status_tim == 'big')
                                                Big Project
                                            @endif
                                        </span>
                                        <span
                                            class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                    </div>
                                    @if ($item->status_presentasi == 'menunggu')
                                        <span class="badge bg-label-danger text-capitalize">Menunggu
                                            Presentasi</span>
                                    @elseif ($item->status_presentasi == 'sedang_presentasi')
                                        <span class="badge bg-label-danger text-capitalize">Sedang
                                            Presentasi</span>
                                    @endif
                                    <h5 class="card-title my-2 text-capitalize">{{ $item->tim->nama }}</h5>
                                    <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="bottom" title="Jadwal Presentasi">
                                        {{ $item->jadwal_ke }} {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->akhir)->format('H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                        @if ($item->status_presentasi == 'menunggu')
                                            <form class="konfirmasi-pengajuan-presentasi-form w-100"
                                                action="{{ route('konfirmasi-pengajuan-presentasi', $item->code) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                    class="btn btn-primary w-100 confirm-btn-up">Konfirmasi
                                                    Presentasi
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-primary w-100 confirm-btn"
                                                data-nama-tim="{{ $item->tim->nama }}"
                                                data-url="{{ route('konfirmasiPresentasi', $item->code) }}">Konfirmasi
                                                Presentasi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i>
                        </h6>
                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                alt="page-misc-under-maintenance" width="300" class="img-fluid">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="pills-kamis" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($presentasiKamis as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                        class="rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: cover">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota_tim() as $anggota)
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
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <span class="badge bg-label-warning">
                                            @if ($item->tim->status_tim == 'solo')
                                                Solo Project
                                            @elseif ($item->tim->status_tim == 'pre_mini')
                                                Pre-mini Project
                                            @elseif ($item->tim->status_tim == 'mini')
                                                Mini Project
                                            @elseif ($item->tim->status_tim == 'big')
                                                Big Project
                                            @endif
                                        </span>
                                        <span
                                            class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                    </div>
                                    @if ($item->status_presentasi == 'menunggu')
                                        <span class="badge bg-label-danger text-capitalize">Menunggu
                                            Presentasi</span>
                                    @elseif ($item->status_presentasi == 'sedang_presentasi')
                                        <span class="badge bg-label-danger text-capitalize">Sedang
                                            Presentasi</span>
                                    @endif
                                    <h5 class="card-title my-2 text-capitalize">{{ $item->tim->nama }}</h5>
                                    <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="bottom" title="Jadwal Presentasi">
                                        {{ $item->jadwal_ke }} {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->akhir)->format('H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                        @if ($item->status_presentasi == 'menunggu')
                                            <form class="konfirmasi-pengajuan-presentasi-form w-100"
                                                action="{{ route('konfirmasi-pengajuan-presentasi', $item->code) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                    class="btn btn-primary w-100 confirm-btn-up">Konfirmasi
                                                    Presentasi
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-primary w-100 confirm-btn"
                                                data-nama-tim="{{ $item->tim->nama }}"
                                                data-url="{{ route('konfirmasiPresentasi', $item->code) }}">Konfirmasi
                                                Presentasi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i></h6>
                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                alt="page-misc-under-maintenance" width="300" class="img-fluid">
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="tab-pane fade" id="pills-jumat" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="row">
                    @forelse ($presentasiJumat as $item)
                        <div class="col-md-6 col-lg-4">
                            <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                        class="rounded-circle mb-3"
                                        style="width: 100px; height: 100px; object-fit: cover">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota_tim() as $anggota)
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
                                    <div class="d-flex justify-content-center mb-2 gap-2">
                                        <span class="badge bg-label-warning">
                                            @if ($item->tim->status_tim == 'solo')
                                                Solo Project
                                            @elseif ($item->tim->status_tim == 'pre_mini')
                                                Pre-mini Project
                                            @elseif ($item->tim->status_tim == 'mini')
                                                Mini Project
                                            @elseif ($item->tim->status_tim == 'big')
                                                Big Project
                                            @endif
                                        </span>
                                        <span
                                            class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                                    </div>
                                    @if ($item->status_presentasi == 'menunggu')
                                        <span class="badge bg-label-danger text-capitalize">Menunggu
                                            Presentasi</span>
                                    @elseif ($item->status_presentasi == 'sedang_presentasi')
                                        <span class="badge bg-label-danger text-capitalize">Sedang
                                            Presentasi</span>
                                    @endif
                                    <h5 class="card-title my-2 text-capitalize">{{ $item->judul }}
                                    </h5>
                                    <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                        data-bs-placement="bottom" title="Jadwal Presentasi">
                                        {{ $item->jadwal_ke }} {{ \Carbon\Carbon::parse($item->mulai)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($item->akhir)->format('H:i') }}
                                    </p>
                                    <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                        @if ($item->status_presentasi == 'menunggu')
                                            <form class="konfirmasi-pengajuan-presentasi-form w-100"
                                                action="{{ route('konfirmasi-pengajuan-presentasi', $item->code) }}"
                                                method="post">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button"
                                                    class="btn btn-primary w-100 confirm-btn-up">Konfirmasi
                                                    Presentasi
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-primary w-100 confirm-btn"
                                                data-nama-tim="{{ $item->tim->nama }}"
                                                data-url="{{ route('konfirmasiPresentasi', $item->code) }}">Konfirmasi
                                                Presentasi
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i></h6>
                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                alt="page-misc-under-maintenance" width="300" class="img-fluid">
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Modal Konfirmasi Project --}}
        <form id="selesaiPresentasiForm" action="" method="post">
            @csrf
            @method('PUT')
            <div class="modal fade" id="konfirmasi-presentasi" tabindex="-1" aria-labelledby="" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">Konfirmasi Selesai Presentasi</h5>
                            <button type="button" class="btn-close" data-bs-toggle="modal"
                                data-bs-target="#detailPresentasi" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <div for="nama-tim" id="nama-tim" class="form-div text-capitalize">Nama Tim : Pre
                                        Mini Team</div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_revisi" class="form-label mb-2">Status Revisi</label>
                                    <div class="form-check">
                                        <input type="radio" value="selesai" name="status_revisi"
                                            class="form-check-input" id="selesai_revisi">
                                        <label for="selesai_revisi" class="form-check-label">Selesai</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" value="tidak_selesai" name="status_revisi"
                                            class="form-check-input" id="tidak_selesai_revisi">
                                        <label for="tidak_selesai_revisi" class="form-check-label">Tidak
                                            selesai</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_presentasi" class="form-label mb-2">Status Presentasi</label>
                                    <div class="form-check">
                                        <input type="radio" value="selesai" name="status_presentasi"
                                            class="form-check-input" id="selesai_presentasi">
                                        <label for="selesai_presentasi" class="form-check-label">Selesai
                                            Presentasi</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" value="tidak_selesai" name="status_presentasi"
                                            class="form-check-input" id="tidak_selesai_presentasi">
                                        <label for="tidak_selesai_presentasi" class="form-check-label">Tidak
                                            Selesai
                                            Presentasi</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="feedback" class="form-label mb-3">Feedback <span
                                            class="badge bg-label-warning">Opsional</span></label>
                                    <textarea type="text" name="feedback" class="form-control" id="feedback" placeholder="Beri Feedback Presentasi"
                                        style="height: 150px; resize: none"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#detailPresentasi">Kembali</button>
                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#detailPresentasi">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- Modal Konfirmasi Project --}}
@endsection

@section('script')
    <script>
        $('.confirm-btn').on('click', function() {
            let url = $(this).data('url');
            let nama = $(this).data('nama-tim');
            let modal = $('#konfirmasi-presentasi');

            let form = $('#selesaiPresentasiForm');
            form.attr('action', url);

            modal.find('#nama-tim').text('Nama tim : ' + nama);
            modal.modal('show');
        });

        $('.confirm-btn-up').on('click', function() {
            Swal.fire({
                title: 'Konfirmasi Pengajuan',
                text: 'Setelah dikonfirmasi, status akan menjadi "sedang presentasi"',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    var form = $(this).closest('form');
                    form.submit();
                }
            });
        });
    </script>
@endsection
