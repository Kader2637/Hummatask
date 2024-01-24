    @extends('layouts.tim')

    @section('link')
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
        <link rel="stylesheet"
            href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />
    @endsection

    @section('style')
        <style>
            * {
                font-family: 'Poppins', sans-serif;
            }

            @media (max-width:425px) {}

            :root {
                --card-line-height: 1.2em;
                --card-padding: 1em;
                --card-radius: 0.5em;
                --color-green: #8256da;
                --color-gray: #e2ebf6;
                --color-dark-gray: #c4d1e1;
                --radio-border-width: 2px;
                --radio-size: 1.5em;
            }

            .grid {
                display: grid;
                grid-gap: var(--card-padding);
                margin: 0 auto;
                max-width: 60em;
                padding: 0;

                @media (min-width: 42em) {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            .card {
                background-color: #fff;
                border-radius: var(--card-radius);
                position: relative;

                &:hover {
                    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
                }
            }

            .radio {
                font-size: inherit;
                margin: 0;
                position: absolute;
                right: calc(var(--card-padding) + var(--radio-border-width));
                top: calc(var(--card-padding) + var(--radio-border-width));
            }

            @supports(-webkit-appearance: none) or (-moz-appearance: none) {
                .radio {
                    -webkit-appearance: none;
                    -moz-appearance: none;
                    background: #fff;
                    border: var(--radio-border-width) solid var(--color-gray);
                    border-radius: 50%;
                    cursor: pointer;
                    height: var(--radio-size);
                    outline: none;
                    transition:
                        background 0.2s ease-out,
                        border-color 0.2s ease-out;
                    width: var(--radio-size);

                    &::after {
                        border: var(--radio-border-width) solid #fff;
                        border-top: 0;
                        border-left: 0;
                        content: '';
                        display: block;
                        height: 0.75rem;
                        left: 25%;
                        position: absolute;
                        top: 50%;
                        transform:
                            rotate(45deg) translate(-50%, -50%);
                        width: 0.375rem;
                    }

                    &:checked {
                        background: var(--color-green);
                        border-color: var(--color-green);
                    }
                }

                .card:hover .radio {
                    border-color: var(--color-dark-gray);

                    &:checked {
                        border-color: var(--color-green);
                    }
                }
            }

            .plan-details {
                border: var(--radio-border-width) solid var(--color-gray);
                border-radius: var(--card-radius);
                cursor: pointer;
                display: flex;
                flex-direction: column;
                padding: var(--card-padding);
                transition: border-color 0.2s ease-out;
            }

            .card:hover .plan-details {
                border-color: var(--color-dark-gray);
            }

            .radio:checked~.plan-details {
                border-color: var(--color-green);
            }

            .radio:focus~.plan-details {
                box-shadow: 0 0 0 2px var(--color-dark-gray);
            }

            .radio:disabled~.plan-details {
                color: var(--color-dark-gray);
                cursor: default;
            }

            .radio:disabled~.plan-details .plan-type {
                color: var(--color-dark-gray);
            }

            .card:hover .radio:disabled~.plan-details {
                border-color: var(--color-gray);
                box-shadow: none;
            }

            .card:hover .radio:disabled {
                border-color: var(--color-gray);
            }

            .plan-type {
                color: var(--color-green);
                font-size: 1.5rem;
                font-weight: bold;
                line-height: 1em;
            }

            .plan-cost {
                font-size: 2.5rem;
                font-weight: bold;
                padding: 0.5rem 0;
            }

            .slash {
                font-weight: normal;
            }

            .plan-cycle {
                font-size: 2rem;
                font-variant: none;
                border-bottom: none;
                cursor: inherit;
                text-decoration: none;
            }

            .hidden-visually {
                border: 0;
                clip: rect(0, 0, 0, 0);
                height: 1px;
                margin: -1px;
                overflow: hidden;
                padding: 0;
                position: absolute;
                white-space: nowrap;
                width: 1px;
            }

            hr {
                height: 8px;
                background-image: linear-gradient(90deg, #7367F0, transparent);
                /* Ganti #007BFF dengan warna primary yang Anda inginkan */
                border: 0;
                height: 1px;
            }
        </style>
    @endsection

    @section('content')
        <div class="container-fluid d-flex mt-5 justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div
                        class="d-flex flex-row flex-wrap justify-content-between align-content-center px-md-4 px-2 py-3 mb-3">
                        <span class="card-header card-header-judul fs-4 p-0">Ajukan Presentasi</span>
                        @if ($anggota === 'active' || $jabatan === 1)
                            <span class="card-header btn-ajukan-presentasi p-0">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#ajukanPresentasi"
                                    class="btn btn-primary mx-2 ">Presentasi</button>
                            </span>
                        @endif
                    </div>
                    {{-- modal detail --}}
                    <div class="modal fade" id="detailpresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel3">Feedback</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Judul Presentasi : </label>
                                            <span id="judul-detail">
                                                Senin, 21 januari 2014
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Tanggal : </label>
                                            <span id="tanggal-detail">
                                                Senin, 21 januari 2014
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Jadwal : </label>
                                            <span id="sesi-detail">
                                                Senin, 21 januari 2014
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Deskripsi : </label>
                                            <span id="deskripsi-detail">
                                                Presentasi revisian kemarin
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <label for="" class="form-label">Feedback dari mentor : </label>
                                            <span id="feedback-detail">
                                                Jangan terlalu terburu2 saat presentasi
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- modal detail --}}

                    {{-- Modal Ajukan presentasi --}}
                    <input type="hidden" id="activeTab" name="active_tab" value="senin">
                    <div class="modal fade" id="ajukanPresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel1">Ajukan Presentasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="nav nav-pills bg-light rounded mb-3 flex-column flex-sm-row" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Monday' || \Carbon\Carbon::now()->format('l') === 'Saturday' || \Carbon\Carbon::now()->format('l') === 'Sunday' ? 'active' : '' }}"
                                                data-bs-toggle="tab" href="#senin" role="tab">Senin</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Tuesday' ? 'show active' : '' }}"
                                                data-bs-toggle="tab" href="#selasa" role="tab">Selasa</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Wednesday' ? 'show active' : '' }}"
                                                data-bs-toggle="tab" href="#rabu" role="tab">Rabu</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Thursday' ? 'show active' : '' }}"
                                                data-bs-toggle="tab" href="#kamis" role="tab">Kamis</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Friday' ? 'show active' : '' }}"
                                                data-bs-toggle="tab" href="#jumat" role="tab">Jumat</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="row">
                                            <h5>Informasi</h5>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="alert alert-primary px-3" role="alert">
                                                            <strong>Checked:</strong> Jadwal telah dipilih oleh tim Anda.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="alert alert-secondary px-3" role="alert">
                                                            <strong>Disabled:</strong> Jadwal telah dipilih oleh tim yang
                                                            lain.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Monday' || \Carbon\Carbon::now()->format('l') === 'Saturday' || \Carbon\Carbon::now()->format('l') === 'Sunday' ? 'show active' : '' }}"
                                            id="senin" role="tabpanel">
                                            <form id="formAjukanPresentasi_1"
                                                @if ($cekJadwalSenin !== null) action="{{ route('update-presentasi', $presentID) }}" method="post"
                                                @else
                                                action="{{ route('ajukan-presentasi', $tim->code) }}" method="post" @endif>
                                                @csrf
                                                @if ($cekJadwalSenin !== null)
                                                    @method('PUT')
                                                @endif
                                                @if ($cekJadwalRabu)
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul"
                                                        value="{{ $cekJadwalRabu->judul }}" class="form-control">
                                                @else
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul" class="form-control">
                                                @endif
                                                <label for="" class="mt-3">Jadwal</label>
                                                <div class="row">
                                                    @forelse ($sesi_senin as $data)
                                                        @php
                                                            $cekJadwal = \App\Models\Presentasi::where('presentasi_divisi_id', $data->presentasi_divisi_id)
                                                                ->where('jadwal_ke', $data->jadwal_ke)
                                                                ->whereDate('jadwal', '>=', Carbon\Carbon::now()->startOfWeek())
                                                                ->where('divisi_id', auth()->user()->divisi_id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label
                                                                class="card card-jadwal {{ $cekJadwalSenin !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'bg-label-primary': '' }} {{ $cekJadwal ? 'bg-label-secondary' : '' }}">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}"
                                                                    {{ $cekJadwalSenin !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'checked': '' }}
                                                                    {{ $cekJadwal ? 'disabled' : '' }}>
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        {{ $data->jadwal_ke }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                    @if ($data->tim != null)
                                                                        @if ($data->cek_tim == true)
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-primary w-100 d-flex rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Tim Anda">
                                                                                        Tim Anda
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-secondary d-flex w-100 rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ $data->tim->nama }}">
                                                                                        {{ Str::limit($data->tim->nama, 20) }}
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <h6 class="text-center mt-4">Tidak ada jadwal sesi hari ini, cek di
                                                            hari lain
                                                            <i class="ti ti-address-book-off"></i>
                                                        </h6>
                                                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                                                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                                                alt="page-misc-under-maintenance" width="300"
                                                                class="img-fluid">
                                                        </div>
                                                    @endforelse
                                                </div>
                                                @if ($cekJadwalSenin)
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{ $cekJadwalSenin->deskripsi }}</textarea>
                                                @else
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                                @endif
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if ($cekJadwalSenin && $cekJadwalSenin->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-primary bg-danger waves-effect">
                                                                    Anda sudah melakukan presentasi hari Senin
                                                                </button>
                                                            </div>
                                                        @elseif ($cekJadwalSenin === null)
                                                            <div class="">
                                                                <button data-bs-dismiss="modal"
                                                                    class="btn btn-label-secondary waves-effect">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="">
                                                            @if ($cekJadwalSenin && $cekJadwalSenin->status_presentasi !== 'menunggu')
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        disabled>
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Tuesday' ? 'show active' : '' }}"
                                            id="selasa" role="tabpanel">
                                            <form id="formAjukanPresentasi_2"
                                                @if ($cekJadwalSelasa !== null) action="{{ route('update-presentasi', $presentID) }}" method="post"
                                                @else
                                                action="{{ route('ajukan-presentasi', $tim->code) }}" method="post" @endif>
                                                @csrf
                                                @if ($cekJadwalSelasa !== null)
                                                    @method('PUT')
                                                @endif
                                                @if ($cekJadwalSelasa)
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul"
                                                        value="{{ $cekJadwalSelasa->judul }}" class="form-control">
                                                @else
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul" class="form-control">
                                                @endif
                                                <label for="" class="mt-3">Jadwal</label>
                                                <div class="row">
                                                    @forelse ($sesi_selasa as $data)
                                                        @php
                                                            $cekJadwal = \App\Models\Presentasi::where('presentasi_divisi_id', $data->presentasi_divisi_id)
                                                                ->where('jadwal_ke', $data->jadwal_ke)
                                                                ->whereDate('jadwal', '>=', Carbon\Carbon::now()->startOfWeek())
                                                                ->where('divisi_id', auth()->user()->divisi_id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label
                                                                class="card card-jadwal {{ $cekJadwalSelasa !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'bg-label-primary': '' }} {{ $cekJadwal ? 'bg-label-secondary' : '' }}"
                                                                data-jadwal-ke="{{ $cekJadwalSelasa ? $cekJadwalSelasa->jadwal_ke : '' }}"
                                                                id="jadwalCard{{ $data->id }}">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}"
                                                                    {{ $cekJadwalSelasa !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'checked': '' }}
                                                                    {{ $cekJadwal ? 'disabled' : '' }}>
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        {{ $data->jadwal_ke }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                    @if ($data->tim != null)
                                                                        @if ($data->cek_tim == true)
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-primary w-100 d-flex rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Tim Anda">
                                                                                        Tim Anda
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-secondary d-flex w-100 rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ $data->tim->nama }}">
                                                                                        {{ Str::limit($data->tim->nama, 20) }}
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <h6 class="text-center mt-4">Tidak ada jadwal sesi hari ini, cek di
                                                            hari lain
                                                            <i class="ti ti-address-book-off"></i>
                                                        </h6>
                                                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                                                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                                                alt="page-misc-under-maintenance" width="300"
                                                                class="img-fluid">
                                                        </div>
                                                    @endforelse
                                                </div>
                                                @if ($cekJadwalSelasa)
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{ $cekJadwalSelasa->deskripsi }}</textarea>
                                                @else
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                                @endif
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if ($cekJadwalSelasa && $cekJadwalSelasa->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-primary bg-danger waves-effect">
                                                                    Anda sudah melakukan presentasi hari Selasa
                                                                </button>
                                                            </div>
                                                        @elseif ($cekJadwalSelasa === null)
                                                            <div class="">
                                                                <button data-bs-dismiss="modal"
                                                                    class="btn btn-label-secondary waves-effect">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        @endif
                                                        @if ($cekJadwalSelasa && $cekJadwalSelasa->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="submit" class="btn btn-primary" disabled>
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        @else
                                                            <div class="">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Simpan
                                                                </button>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Wednesday' ? 'show active' : '' }}"
                                            id="rabu" role="tabpanel">
                                            <form id="formAjukanPresentasi_3"
                                                @if ($cekJadwalRabu !== null) action="{{ route('update-presentasi', $presentID) }}" method="post"
                                                @else
                                                action="{{ route('ajukan-presentasi', $tim->code) }}" method="post" @endif>
                                                @csrf
                                                @if ($cekJadwalRabu !== null)
                                                    @method('PUT')
                                                @endif
                                                @if ($cekJadwalRabu)
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul"
                                                        value="{{ $cekJadwalRabu->judul }}" class="form-control">
                                                @else
                                                    @if ($cekJadwalRabu)
                                                        <label for="judul" class="form-label">Judul Presentasi</label>
                                                        <input type="text" name="judul"
                                                            value="{{ $cekJadwalRabu->judul }}" class="form-control">
                                                    @else
                                                        <label for="judul" class="form-label">Judul Presentasi</label>
                                                        <input type="text" name="judul" class="form-control">
                                                    @endif
                                                @endif
                                                <label for="" class="mt-3">Jadwal</label>
                                                <div class="row">
                                                    @forelse ($sesi_rabu as $data)
                                                        @php
                                                            $cekJadwal = \App\Models\Presentasi::where('presentasi_divisi_id', $data->presentasi_divisi_id)
                                                                ->where('jadwal_ke', $data->jadwal_ke)
                                                                ->whereDate('jadwal', '>=', Carbon\Carbon::now()->startOfWeek())
                                                                ->where('divisi_id', auth()->user()->divisi_id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label style=" height:100%;"
                                                                class="card card-jadwal {{ $cekJadwalRabu !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'bg-label-primary': '' }} {{ $cekJadwal ? 'bg-label-secondary' : '' }}">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}"
                                                                    {{ $cekJadwalRabu !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'checked': '' }}
                                                                    {{ $cekJadwal ? 'disabled' : '' }}>
                                                                <span
                                                                    class="plan-details text-center  d-flex align-items-center justify-content-center flex-column "
                                                                    style=" height:100%;">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        {{ $data->jadwal_ke }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                    @if ($data->tim != null)
                                                                        @if ($data->cek_tim == true)
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-primary w-100 d-flex rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Tim Anda">
                                                                                        Tim Anda
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-secondary d-flex w-100 rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ $data->tim->nama }}">
                                                                                        {{ Str::limit($data->tim->nama, 20) }}
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <h6 class="text-center mt-4">Tidak ada jadwal sesi hari ini, cek di
                                                            hari lain
                                                            <i class="ti ti-address-book-off"></i>
                                                        </h6>
                                                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                                                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                                                alt="page-misc-under-maintenance" width="300"
                                                                class="img-fluid">
                                                        </div>
                                                    @endforelse
                                                </div>
                                                @if ($cekJadwalRabu)
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{ $cekJadwalRabu->deskripsi }}</textarea>
                                                @else
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                                @endif
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if ($cekJadwalRabu && $cekJadwalRabu->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-primary bg-danger waves-effect">
                                                                    Anda sudah melakukan presentasi hari Rabu
                                                                </button>
                                                            </div>
                                                        @elseif ($cekJadwalRabu === null)
                                                            <div class="">
                                                                <button data-bs-dismiss="modal"
                                                                    class="btn btn-label-secondary waves-effect">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="">
                                                            @if ($cekJadwalRabu && $cekJadwalRabu->status_presentasi !== 'menunggu')
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        disabled>
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Thursday' ? 'show active' : '' }}"
                                            id="kamis" role="tabpanel">
                                            <form id="formAjukanPresentasi_4"
                                                @if ($cekJadwalKamis !== null) action="{{ route('update-presentasi', $presentID) }}" method="post"
                                                @else
                                                action="{{ route('ajukan-presentasi', $tim->code) }}" method="post" @endif>
                                                @csrf
                                                @if ($cekJadwalKamis !== null)
                                                    @method('PUT')
                                                @endif
                                                @if ($cekJadwalKamis)
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul"
                                                        value="{{ $cekJadwalKamis->judul }}" class="form-control">
                                                @else
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul" class="form-control">
                                                @endif
                                                <label for="" class="mt-3">Jadwal</label>
                                                <div class="row">
                                                    @forelse ($sesi_kamis as $data)
                                                        @php
                                                            $cekJadwal = \App\Models\Presentasi::where('presentasi_divisi_id', $data->presentasi_divisi_id)
                                                                ->where('jadwal_ke', $data->jadwal_ke)
                                                                ->whereDate('jadwal', '>=', Carbon\Carbon::now()->startOfWeek())
                                                                ->where('divisi_id', auth()->user()->divisi_id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label
                                                                class="card card-jadwal {{ $cekJadwalKamis !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'bg-label-primary': '' }} {{ $cekJadwal ? 'bg-label-secondary' : '' }}">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}"
                                                                    {{ $cekJadwalKamis !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'checked': '' }}
                                                                    {{ $cekJadwal ? 'disabled' : '' }}>
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        {{ $data->jadwal_ke }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                    @if ($data->tim != null)
                                                                        @if ($data->cek_tim == true)
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-primary w-100 d-flex rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Tim Anda">
                                                                                        Tim Anda
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-secondary d-flex w-100 rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ $data->tim->nama }}">
                                                                                        {{ Str::limit($data->tim->nama, 20) }}
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <h6 class="text-center mt-4">Tidak ada jadwal sesi hari ini, cek di
                                                            hari lain
                                                            <i class="ti ti-address-book-off"></i>
                                                        </h6>
                                                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                                                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                                                alt="page-misc-under-maintenance" width="300"
                                                                class="img-fluid">
                                                        </div>
                                                    @endforelse
                                                </div>
                                                @if ($cekJadwalKamis)
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{ $cekJadwalKamis->deskripsi }}</textarea>
                                                @else
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                                @endif
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if ($cekJadwalKamis && $cekJadwalKamis->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-primary bg-danger waves-effect">
                                                                    Anda sudah melakukan Presentasi hari Kamis
                                                                </button>
                                                            </div>
                                                        @elseif ($cekJadwalKamis === null)
                                                            <div class="">
                                                                <button data-bs-dismiss="modal"
                                                                    class="btn btn-label-secondary waves-effect">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="">
                                                            @if ($cekJadwalKamis && $cekJadwalKamis->status_presentasi !== 'menunggu')
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        disabled>
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Friday' ? 'show active' : '' }}"
                                            id="jumat" role="tabpanel">
                                            <form id="formAjukanPresentasi_5"
                                                @if ($cekJadwalJumat !== null) action="{{ route('update-presentasi', $presentID) }}" method="post"
                                                @else
                                                action="{{ route('ajukan-presentasi', $tim->code) }}" method="post" @endif>
                                                @csrf
                                                @if ($cekJadwalJumat !== null)
                                                    @method('PUT')
                                                @endif
                                                @if ($cekJadwalJumat)
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul"
                                                        value="{{ $cekJadwalJumat->judul }}" class="form-control">
                                                @else
                                                    <label for="judul" class="form-label">Judul Presentasi</label>
                                                    <input type="text" name="judul" class="form-control">
                                                @endif
                                                <label for="" class="mt-3">Jadwal</label>
                                                <div class="row">
                                                    @forelse ($sesi_jumat as $data)
                                                        @php
                                                            $cekJadwal = \App\Models\Presentasi::where('presentasi_divisi_id', $data->presentasi_divisi_id)
                                                                ->where('jadwal_ke', $data->jadwal_ke)
                                                                ->whereDate('jadwal', '>=', Carbon\Carbon::now()->startOfWeek())
                                                                ->where('divisi_id', auth()->user()->divisi_id)
                                                                ->first();
                                                        @endphp

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label
                                                                class="card card-jadwal {{ $cekJadwalJumat !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'bg-label-primary': '' }} {{ $cekJadwal ? 'bg-label-secondary' : '' }}">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}"
                                                                    {{ $cekJadwalJumat !== null &&$cekJadwal &&$cekJadwal->tim->id ==Auth::user()->anggota()->latest()->first()->tim_id? 'checked': '' }}
                                                                    {{ $cekJadwal ? 'disabled' : '' }}>
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        {{ $data->jadwal_ke }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                    @if ($data->tim != null)
                                                                        @if ($data->cek_tim == true)
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-primary w-100 d-flex rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="Tim Anda">
                                                                                        Tim Anda
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @else
                                                                            <ul
                                                                                class="justify-content-center list-unstyled d-flex align-items-center avatar-group mb-0 pt-2 w-100">
                                                                                <span
                                                                                    class="bg-secondary d-flex w-100 rounded align-items-center justify-content-center"
                                                                                    style="padding-block: 8px;">
                                                                                    <p class="fw-medium text-capitalize m-0 text-white text-truncate d-block"
                                                                                        style="letter-spacing: 1px; max-width: 140px"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-popup="tooltip-custom"
                                                                                        data-bs-placement="bottom"
                                                                                        title="{{ $data->tim->nama }}">
                                                                                        {{ Str::limit($data->tim->nama, 20) }}
                                                                                    </p>
                                                                                </span>
                                                                            </ul>
                                                                        @endif
                                                                    @endif
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @empty
                                                        <h6 class="text-center mt-4">Tidak ada jadwal sesi hari ini, cek di
                                                            hari lain
                                                            <i class="ti ti-address-book-off"></i>
                                                        </h6>
                                                        <div class="mt-4 mb-3 d-flex justify-content-evenly">
                                                            <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                                                                alt="page-misc-under-maintenance" width="300"
                                                                class="img-fluid">
                                                        </div>
                                                    @endforelse
                                                </div>
                                                @if ($cekJadwalJumat)
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10">{{ $cekJadwalJumat->deskripsi }}</textarea>
                                                @else
                                                    <label for="deskripsi" class="form-label">Deskripsi
                                                        (Opsional)</label>
                                                    <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                                @endif
                                                <div class="modal-footer">
                                                    <div class="d-flex justify-content-end gap-2">
                                                        @if ($cekJadwalJumat && $cekJadwalJumat->status_presentasi !== 'menunggu')
                                                            <div class="">
                                                                <button type="button" data-bs-dismiss="modal"
                                                                    class="btn btn-primary bg-danger waves-effect">
                                                                    Anda sudah melakukan presentasi hari Jumat
                                                                </button>
                                                            </div>
                                                        @elseif ($cekJadwalJumat === null)
                                                            <div class="">
                                                                <button data-bs-dismiss="modal"
                                                                    class="btn btn-label-secondary waves-effect">
                                                                    Tutup
                                                                </button>
                                                            </div>
                                                        @endif
                                                        <div class="">
                                                            @if ($cekJadwalJumat && $cekJadwalJumat->status_presentasi !== 'menunggu')
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary"
                                                                        disabled>
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @else
                                                                <div class="">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        Simpan
                                                                    </button>
                                                                </div>
                                                            @endif
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
                    </form>
                    {{-- Modal Ajukan presentasi --}}

                    <div class="container table-responsive card-datatable  text-nowrap">
                        <table id="jstabel" class="table">
                            <thead class="bg-primary">
                                <tr>
                                    <th class="text-white">No</th>
                                    <th class="text-white">Judul</th>
                                    <th class="text-white">Tanggal</th>
                                    <th class="text-white">Status Presentasi</th>
                                    <th class="text-white">Jadwal</th>
                                    <th class="text-white">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @forelse ($presentasi as $i=> $data)
                                    <tr>
                                        <td><span class="fw-medium">{{ $loop->iteration }}.</span></td>
                                        <td>{{ $data->judul }}</td>
                                        <td>{{ $jadwal[$i] }}</td>
                                        <td>
                                            @if ($data->status_presentasi === 'menunggu')
                                                <span class="badge bg-label-warning me-1">menunggu jadwal</span>
                                            @endif
                                            @if ($data->status_presentasi === 'selesai')
                                                <span class="badge bg-label-success me-1">selesai</span>
                                            @endif
                                            @if ($data->status_presentasi === 'tidak_selesai')
                                                <span class="badge bg-label-danger me-1">Tidak Selesai</span>
                                            @endif
                                            @if ($data->status_presentasi === 'sedang_presentasi')
                                                <span class="badge bg-label-primary me-1">Sedang Presentasi</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data->jadwal_ke }}
                                        </td>
                                        <td>
                                            <a class="btn-detail cursor-pointer btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#detailpresentasi" class="cursor-pointer detail-btn"
                                                data-judul="{{ $data->judul }}" data-jadwal="{{ $data->jadwal_ke }}"
                                                data-hari="{{ $data->hari }}"
                                                data-mulai="{{ \Carbon\Carbon::parse($data->mulai)->format('H:i') }}"
                                                data-akhir="{{ \Carbon\Carbon::parse($data->akhir)->format('H:i') }}"
                                                data-feedback="{{ $data->feedback }}"
                                                data-deskripsi="{{ $data->deskripsi }}"
                                                data-jadwal-lengkap="{{ \Carbon\Carbon::parse($data->jadwal)->translatedFormat('l, j F Y') }}"><i
                                                    class="ti ti-eye text-white"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
        <script>
            function handleNullFeedback() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: ' Mentor Belum atau tidak Memberikan feedback ',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            function handleBelumDisetujuiFeedback() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Kamu Belum Presentasi',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            function handleDitolakFeedback() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning!',
                    text: 'Mentor tidak memberikan feedback',
                    showConfirmButton: false,
                    timer: 2000
                })
            }

            $('.btn-detail').on('click', function() {
                let judul = $(this).data('judul');
                let jadwal = $(this).data('jadwal');
                let hari = $(this).data('hari');
                let mulai = $(this).data('mulai');
                let akhir = $(this).data('akhir');
                let feedback = $(this).data('feedback');
                let deskripsi = $(this).data('deskripsi');
                let jadwalLengkap = $(this).data('jadwal-lengkap');

                const modal = $('#detailpresentasi');

                modal.find('#judul-detail').text('');
                modal.find('#tanggal-detail').text('');
                modal.find('#deskripsi-detail').text('');
                modal.find('#feedback-detail').text('');
                modal.find('#sesi-detail').text('');

                modal.find('#judul-detail').text(judul);
                modal.find('#tanggal-detail').text(jadwalLengkap);
                modal.find('#sesi-detail').text(jadwal + ' ' + mulai + ' ' + akhir);

                if (deskripsi) {
                    modal.find('#deskripsi-detail').text(deskripsi);
                } else {
                    modal.find('#deskripsi-detail').text('Anda tidak mengisi deskripsi presentasi');
                }

                // Set feedback hanya jika feedback tidak kosong
                if (feedback) {
                    modal.find('#feedback-detail').text(feedback);
                } else {
                    modal.find('#feedback-detail').text('Mentor tidak atau belum memberi feedback');
                }
            });

            function validateForm(formId) {
                $(formId).on('submit', function(event) {
                    var checkbox = $(this).find('[name="plan"]:checked').length > 0;
                    var judul = $(this).find('input[name="judul"]').val();

                    if (!checkbox) {
                        swal.fire({
                            title: 'Peringatan',
                            text: 'Silahkan pilih jadwal terlebih dahulu',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        event.preventDefault();
                    };

                    if (!judul) {
                        swal.fire({
                            title: 'Peringatan',
                            text: 'Silahkan isi judul terlebih dahulu',
                            icon: 'warning',
                            showConfirmButton: false,
                            timer: 2000
                        });
                        event.preventDefault();
                    };
                });
            }

            validateForm('#formAjukanPresentasi_1');
            validateForm('#formAjukanPresentasi_2');
            validateForm('#formAjukanPresentasi_3');
            validateForm('#formAjukanPresentasi_4');
            validateForm('#formAjukanPresentasi_5');
        </script>
        <script>
            jQuery.noConflict();

            jQuery(document).ready(function($) {
                $('#jstabel').DataTable({
                    "lengthMenu": [
                        [10, 20, 30, -1],
                        [10, 20, 30, "All"]
                    ],
                    "pageLength": 10,

                    "order": [],

                    "ordering": true,

                    "language": {
                        "sProcessing": "Sedang memproses...",
                        "sLengthMenu": "Tampilkan _MENU_ data",
                        "sZeroRecords": "Tidak ditemukan Data",
                        "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                        "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                        "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                        "sInfoPostFix": "",
                        "sSearch": "Cari:",
                        "sUrl": "",
                        "oPaginate": {
                            "sFirst": "Pertama",
                            "sPrevious": "&#8592;",
                            "sNext": "&#8594;",
                            "sLast": "Terakhir"
                        }
                    }
                });
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const cards = document.querySelectorAll('.card-jadwal');
                const hariSaatIni = new Date().getDay();
                // console.log(hariSaatIni);
                const initialCheckedStatus = {};
                cards.forEach(card => {
                    const radio = card.querySelector('.radio');
                    initialCheckedStatus[card.id] = radio.checked;
                });

                cards.forEach(card => {
                    card.addEventListener('click', function() {
                        const radio = this.querySelector('.radio');
                        const jadwalId = radio.value;
                        const isDisabled = radio.disabled;
                        const isJadwalSelected = {{ $cekJadwalKamis ? 'true' : 'false' }};
                        console.log('cardId:', isJadwalSelected);
                        const cardId = this.id;

                        let $cekJadwal;

                        switch (hariSaatIni) {
                            case 1: // Senin
                                $cekJadwal = {!! $cekJadwalSenin ? 'true' : 'false' !!};
                                break;
                            case 2: // Selasa
                                $cekJadwal = {!! $cekJadwalSelasa ? 'true' : 'false' !!};
                                break;
                            case 3: // Rabu
                                $cekJadwal = {!! $cekJadwalRabu ? 'true' : 'false' !!};
                                break;
                            case 4: // Kamis
                                $cekJadwal = {!! $cekJadwalKamis ? 'true' : 'false' !!};
                                break;
                            case 5: // Jumat
                                $cekJadwal = {!! $cekJadwalJumat ? 'true' : 'false' !!};
                                break;

                            default:
                                $cekJadwal = false;
                        }

                        if (!isDisabled && $cekJadwal) {
                            Swal.fire({
                                title: 'Konfirmasi',
                                text: 'Apakah Anda yakin ingin mengganti jadwal?',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonText: 'Ya, pilih jadwal',
                                cancelButtonText: 'Batal',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    console.log('User memilih jadwal dengan ID:', jadwalId);
                                    radio.checked = true;
                                } else if (result.isDismissed) {
                                    radio.checked = initialCheckedStatus[cardId];
                                    console.log(radio.checked);
                                }
                            });
                        }
                    });
                });
            });
        </script>
    @endsection
