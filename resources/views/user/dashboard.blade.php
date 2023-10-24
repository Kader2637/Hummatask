@extends('layouts.app')


@section('style')
    <style>
        .jumbotron {
            height: 20vh;
        }
    </style>
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@section('content')
    <main class="container-fluid p-3">

        <div class="row">
            <div class=" jumbotron col-12 d-flex flex-column align-items-center justify-content-center">
                <p>Senin,19 oktober 2023</p>
                <p class="fs-3">Selamat datang, Adi Kurniawan</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-sesijalani"
                            aria-controls="" aria-selected="true" tabindex="-1">Sesi Yang Kamu Jalani</button>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tab-progress"
                            aria-controls="" aria-selected="true" tabindex="-1">Progress</button>
                    </li>
                </ul>
            </div>
                <div class="col d-flex justify-content-end dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownbutton"
                        data-bs-toggle="dropdown" aria-expanded="false"><i
                            class="fa-solid fa-gear px-2"></i>Setting</button>
                    <ul name="" id="" class="dropdown-menu" aria-labelledby="dropdownbutton">
                        <li><a href="" class="dropdown-item">Full</a></li>
                        <li><a href="" class="dropdown-item">Setengah</a></li>
                    </ul>
                </div>
        </div>
        <div class="row mt-4 justify-content-center" id="navs-tab-sesijalani">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4">
                    <div class="card text-center mb-3">
                        <div class="card-header pt-1">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-tab-sesi{{ $i }}"
                                        aria-controls="navs-tab-sesi{{ $i }}" aria-selected="true"
                                        tabindex="-1">Sesi</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link " role="tab" data-bs-toggle="tab"
                                        data-bs-target="#navs-tab-materi{{ $i }}"
                                        aria-selected="false">Materi</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button type="button" class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#navs-tab-tugas{{ $i }}" role="tab"
                                        aria-selected="false" tabindex="-1">Tugas</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body pt-3">
                            <div class="tab-content p-0">
                                <div class="tab-pane fade show active" id="navs-tab-sesi{{ $i }}"
                                    role="tabpanel">
                                    <h5 class="card-title">Sesi hari ini</h5>
                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="javascript:void(0);" class="btn btn-primary waves-effect waves-light">Go
                                        home</a>
                                </div>
                                <div style="text-align: start;" class="tab-pane fade  "
                                    id="navs-tab-materi{{ $i }}" role="tabpanel">
                                    <h5 class="card-title">Materi</h5>
                                    <p class="card-text">Uploadlah materi yang kamu dapatkan hari ini</p>
                                    <form action="" method="post" class="d-flex gap-2">
                                        @csrf
                                        <input type="file" name="materi" id="materi" class="form-control">
                                        <button type="submit" class="btn btn-primary">kirim</button>
                                    </form>
                                </div>
                                <div style="text-align: start;" class="tab-pane fade  "
                                    id="navs-tab-tugas{{ $i }}" role="tabpanel">
                                    <h5 class="card-title">Tugas</h5>
                                    <p class="card-text">Upload tugas yang kamu kerjakan untuk sesi ini</p>
                                    <form action="" method="post" class="d-flex gap-2">
                                        @csrf
                                        <input type="file" name="materi" id="materi" class="form-control">
                                        <button type="submit" class="btn btn-primary">kirim</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

    </main>
@endsection


@section('script')
@endsection
