@extends('layouts.tim')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
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
    </style>
@endsection

@section('content')
    <div class="modal fade" id="feedbackModal" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">Feedback</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="text-feedback" class="row mb-3">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary waves-effect"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="d-flex flex-row flex-wrap justify-content-between align-content-center px-md-4 px-2 py-3 mb-3">
                    <span class="card-header card-header-judul fs-4 p-0">Ajukan Presentasi</span>
                    @if ($anggota === 'active' || $jabatan === 1)
                        <span class="card-header btn-ajukan-presentasi p-0">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#ajukanPresentasi"
                                class="btn btn-primary mx-2 ">Presentasi</button>
                        </span>
                    @endif
                </div>
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
                                <ul class="nav nav-pills bg-light rounded mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#senin"
                                            role="tab">Senin</a>
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
                                <div class="tab-content">
                                    <div class="tab-pane active" id="senin" role="tabpanel">
                                        <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                            id="formAjukanPresentasi_1">
                                            @csrf
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" name="judul" class="form-control">
                                            <label for="" class="mt-3">Jadwal</label>
                                            <div class="row">
                                                @php
                                                    $pfft = 1;
                                                @endphp
                                                @forelse ($sesi_senin as $data)
                                                    @php
                                                        $xx = false;
                                                    @endphp
                                                    @if (\Carbon\Carbon::now()->parse('l') == 'Monday')
                                                        @foreach ($cek_present as $item)
                                                            @if ($item->jadwal_ke == $pfft)
                                                                @php
                                                                    $xx = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">{{ $xx ? 'Disable' : '' }}
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
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
                                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <div class="">
                                                        <button data-bs-dismiss="modal" class="btn btn-label-secondary waves-effect">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="selasa" role="tabpanel">
                                        <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                            id="formAjukanPresentasi_2">
                                            @csrf
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" name="judul" class="form-control">
                                            <label for="" class="mt-3">Jadwal</label>
                                            <div class="row">
                                                @php
                                                    $pfft = 1;
                                                @endphp
                                                @forelse ($sesi_selasa as $data)
                                                    @php
                                                        $xx = false;
                                                    @endphp
                                                    @if (\Carbon\Carbon::now()->parse('l') == 'Tuesday')
                                                        @foreach ($cek_present as $item)
                                                            @if ($item->jadwal_ke == $pfft)
                                                                @php
                                                                    $xx = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">{{ $xx ? 'Disable' : '' }}
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
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
                                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <div class="">
                                                        <button data-bs-dismiss="modal" class="btn btn-danger">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="rabu" role="tabpanel">
                                        <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                            id="formAjukanPresentasi_3">
                                            @csrf
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" name="judul" class="form-control">
                                            <label for="" class="mt-3">Jadwal</label>
                                            <div class="row">
                                                @php
                                                    $pfft = 1;
                                                @endphp
                                                @forelse ($sesi_rabu as $data)
                                                    @php
                                                        $xx = false;
                                                    @endphp
                                                    @if (\Carbon\Carbon::now()->parse('l') == 'Wednesday')
                                                        @foreach ($cek_present as $item)
                                                            @if ($item->jadwal_ke == $pfft)
                                                                @php
                                                                    $xx = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">{{ $xx ? 'Disable' : '' }}
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
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
                                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <div class="">
                                                        <button data-bs-dismiss="modal" class="btn btn-danger">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="kamis" role="tabpanel">
                                        <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                            id="formAjukanPresentasi_4">
                                            @csrf
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" name="judul" class="form-control">
                                            <label for="" class="mt-3">Jadwal</label>
                                            <div class="row">
                                                @php
                                                    $pfft = 1;
                                                @endphp
                                                @forelse ($sesi_kamis as $data)
                                                    @php
                                                        $xx = false;
                                                    @endphp
                                                    @if (\Carbon\Carbon::now()->parse('l') == 'Thursday')
                                                        @foreach ($cek_present as $item)
                                                            @if ($item->jadwal_ke == $pfft)
                                                                @php
                                                                    $xx = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">{{ $xx ? 'Disable' : '' }}
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
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
                                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <div class="">
                                                        <button data-bs-dismiss="modal" class="btn btn-danger">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="jumat" role="tabpanel">
                                        <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                            id="formAjukanPresentasi_5">
                                            @csrf
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" name="judul" class="form-control">
                                            <label for="" class="mt-3">Jadwal</label>
                                            <div class="row">
                                                @php
                                                    $pfft = 1;
                                                @endphp
                                                @forelse ($sesi_jumat as $data)
                                                    @php
                                                        $xx = false;
                                                    @endphp
                                                    @if (\Carbon\Carbon::now()->parse('l') == 'Friday')
                                                        @foreach ($cek_present as $item)
                                                            @if ($item->jadwal_ke == $pfft)
                                                                @php
                                                                    $xx = true;
                                                                @endphp
                                                            @endif
                                                        @endforeach

                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">{{ $xx ? 'Disable' : '' }}
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <div class="col-12 col-lg-4 col-xxl-4 my-2">
                                                            <label class="card">
                                                                <input name="plan" class="radio" type="radio"
                                                                    value="{{ $data->id }}">
                                                                <span class="plan-details text-center">
                                                                    <p class="fs-6 mb-2 text-dark"
                                                                        style="font-weight: 500">
                                                                        Jadwal Ke-{{ $pfft++ }}
                                                                    </p>
                                                                    <p class="text-primary mb-0">
                                                                        {{ $data->mulai }} - {{ $data->akhir }}
                                                                    </p>
                                                                </span>
                                                            </label>
                                                        </div>
                                                    @endif
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
                                                <label for="deskripsi" class="form-label">Deskripsi (Opsional)</label>
                                                <textarea name="deskripsi" class="form-control" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <div class="">
                                                        <button data-bs-dismiss="modal" class="btn btn-danger">
                                                            Tutup
                                                        </button>
                                                    </div>
                                                    <div class="">
                                                        <button type="submit" class="btn btn-primary">
                                                            Simpan
                                                        </button>
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
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">Status Presentasi</th>
                                <th class="text-white">Jadwal</th>
                                <th class="text-white">Dikonfirmasi oleh</th>
                                <th class="text-white">Feedback</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($presentasi as $i=> $data)
                                <tr>
                                    <td><span class="fw-medium">{{ $loop->iteration }}</span></td>
                                    <td>{{ $jadwal[$i] }}</td>
                                    <td>
                                        @if ($data->status_presentasi === 'menunggu')
                                            <span class="badge bg-label-warning me-1">menunggu jadwal</span>
                                        @endif
                                        @if ($data->status_presentasi === 'selesai')
                                            <span class="badge bg-label-success me-1">selesai</span>
                                        @endif
                                        @if ($data->status_presentasi === 'telat')
                                            <span class="badge bg-label-danger me-1">telat</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $data->jadwal_ke }}
                                    </td>
                                    <td class="d-flex align-items-center justify-content-center">
                                        @if ($data->user_approval_id === null)
                                            <span class="badge bg-label-warning me-1">menunggu</span>
                                        @else
                                            <div data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                data-bs-placement="top" title="{{ $data->user_approval->username }}"
                                                class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="{{ $data->user_approval->avatar ? asset('storage/' . $data->user_approval->avatar) : asset('assets/img/avatars/1.png') }}"
                                                    alt="Avatar">
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($data->feedback !== null || $data->status_presentasi === 'ditolak')
                                            <button class=" border-0 text-secondary bg-transparent btn-feedback-modal"
                                                data-bs-toggle="modal" data-bs-target="#feedbackModal"
                                                data-feedback="{{ $data->feedback }}">
                                                <i class="ti ti-eye me-1 text-warning"></i>
                                            </button>
                                            {{-- @elseIf(($data->status_pengajuan === 'menunggu' || $data->status_presentasi === 'menunggu') && $data->feedback === null)
                                            <button onclick="handleBelumDisetujuiFeedback()"
                                                class=" border-0 text-secondary bg-transparent btn-feedback-modal">
                                                <i class="ti ti-eye me-1 text-warning"></i>
                                            </button> --}}
                                        @elseIf(($data->status_pengajuan === 'disetujui' || $data->status_presentasi === 'selesai') && $data->feedback === null)
                                            <button onclick="handleDitolakFeedback()"
                                                class=" border-0 text-secondary bg-transparent btn-feedback-modal">
                                                <i class="ti ti-eye me-1 text-warning"></i>
                                            </button>
                                        @endif
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

        $(".btn-feedback-modal").click(function() {
            const feedback = $(this).data("feedback");
            console.log(feedback);
            const text = $("#text-feedback").html(
                `
                <p>${feedback}</p>
                `
            );
        })

        function validateForm(formId) {
            $(formId).on('submit', function(event) {
                var checkbox = $(this).find('[name="plan"]:checked').length > 0;

                if (!checkbox) {
                    swal.fire({
                        title: 'Peringatan',
                        text: 'Silahkan pilih data terlebih dahulu',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    event.preventDefault();
                }
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
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "ordering": false,

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
@endsection
