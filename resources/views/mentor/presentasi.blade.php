<!DOCTYPE html>
@extends('layoutsMentor.app')

@section('content')
    <html lang="en" class="light-style layout-compact layout-navbar-fixed layout-menu-fixed   " dir="ltr"
        data-theme="theme-default"
        data-assets-path="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/"
        data-base-url="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1" data-framework="laravel"
        data-template="vertical-menu-theme-default-light">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    <!-- Mirrored from demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1/ui/tabs-pills by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 03:51:20 GMT -->
    <!-- Added by HTTrack -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

    <head>
        <meta charset="utf-8" />
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Tabs
        </title>
    </head>

    <body>
        <div class="container-fluid mt-3">
            <h5>Presentasi</h5>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="nav-align-top d-flex justify-between">
                                <div class="nav nav-pills d-flex justify-content-between row" role="tablist">
                                    {{-- <div class="row"> --}}
                                    <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                            aria-selected="true"><i class="ti ti-news me-2"></i>Pengajuan</button>
                                    </div>
                                    <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                            aria-selected="false" tabindex="-1"><i
                                                class="ti ti-presentation-analytics me-2"></i>Presentasi</button>
                                    </div>
                                    <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-baru" aria-controls="navs-pills-top-profile"
                                            aria-selected="false" tabindex="-1"><i
                                                class="ti ti-adjustments-horizontal me-2"></i>Belum Presentasi</button>
                                    </div>
                                    <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                            data-bs-target="#navs-pills-top-start" aria-controls="navs-pills-top-profile"
                                            aria-selected="false" tabindex="-1"><i
                                                class="ti ti-clock-exclamation me-2"></i>Telat</button>
                                    </div>
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="table-responsive text-nowrap">
                            <h6 class="fw-normal">Presentasi</h6>
                            <table class="table">
                                <div class="">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;">
                                            Hidan</td>
                                        <td>21-03-2023</td>
                                        <td>Senin</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                        <td><span class="badge bg-label-warning">tertunda</span></td>
                                        <td><button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#Reject">Tolak</button>
                                            <button class="btn btn-primary">Terima</button>
                                        </td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button trigger modal -->
            <div class="modal fade" id="Reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tolak Presentasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="fw-bold mt-1">Alasan</label>
                            <textarea type="text" class="form-control" placeholder="alasan"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="table-responsive text-nowrap">
                            <h6 class="fw-normal">Presentasi</h6>
                            <table class="table">
                                <div class="">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                        <th>Aksi</th>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;"> Hidan</td>
                                        <td>21-03-2023</td>
                                        <td>Senin</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                        <td><button class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#Reset">Atur ulang</button>
                                            <button class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#Finish">Selesai</button>
                                        </td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{-- start --}}
            <div class="modal fade" id="Reset" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Atur Ulang Presentasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="fw-bold mt-1">Tanggal</label>
                            <input type="date" class="form-control" placeholder="atur tanggal">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            {{-- start --}}
            <div class="modal fade" id="Finish" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Selesai Presentasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label for="" class="fw-bold mt-1">Ulasan</label>
                            <textarea type="text" class="form-control" placeholder="ulasan"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success">Setuju</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end --}}
            <div class="tab-pane fade" id="navs-pills-top-baru" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="table-responsive text-nowrap">
                            <h6 class="fw-normal">Belum Presentasi</h6>
                            <table class="table">
                                <div class="">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                        <th>Status</th>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;"> Hidan</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                        <td><span class="badge bg-label-warning">Belum Presentasi</span></td>
                                    </tr>
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="navs-pills-top-start" role="tabpanel">
                <div class="card">
                    <div class="card-header">
                        <div class="table-responsive text-nowrap">
                            <h6 class="fw-normal">Telat Presentasi</h6>
                            <table class="table">
                                <div class="">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                    </tr>
                                    @php
                                        $no = 1;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;"> Hidan</td>
                                        <td>21-03-2023</td>
                                        <td>Senin</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                    </tr>
                                </div>
                            </table>
                        </div>
    </body>
@endsection
<!-- Mirrored from demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1/ui/tabs-pills by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Oct 2023 03:51:22 GMT -->

</html>
