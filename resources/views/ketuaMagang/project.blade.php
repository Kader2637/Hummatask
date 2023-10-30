@extends('layouts.app')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

    <style>
        .tim-detail {
            flex-direction: row;
        }

        @media (min-width: 768px) and (max-width: 800px) {
            .tim-detail {
                flex-direction: column;
            }
        }
    </style>
@endsection


@section('content')
    <div class="container-fluid mt-4">
        <h5 class="header">List Project</h5>
        {{-- Header --}}
        <div class="d-flex justify-content-between">
            <div class="filter col-lg-3 col-md-3 col-sm-3">
                <label for="select2Basic" class="form-label">Filter</label>
                <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg"
                    data-allow-clear="true">
                    <option value="a">Solo Project</option>
                    <option value="b">Pre-mini Project</option>
                    <option value="b">Mini Project</option>
                    <option value="b">Big Project</option>
                </select>
            </div>
            <div id="buatTim" class="d-flex align-items-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatTim">Buat
                    Tim</button>
            </div>
        </div>
        {{-- Header --}}

        {{-- Card --}}
        <div class="row mt-3">
            <div class="col-lg-4 col-md-4">
                <div class="card text-center mb-3">
                    <div class="card-body">
                        <div class="d-flex gap-3 tim-detail justify-content-between">
                            <img src="{{ asset('assets/img/avatars/2.png') }}" alt class="rounded-circle mb-3">
                            <div
                                style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                <span class="text-black fs-5 judul">Hummatask</span>
                                <div class="d-flex align-items-center">
                                    <a href="#"><span class="badge bg-label-warning my-1">Big Project</span></a>
                                </div>
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                        <div class="d-flex align-items-center">
                                            <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Vinnie Mostowy"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Allen Rieske"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar">
                                                </li>
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="Julee Rossignol"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                                        alt="Avatar">
                                                </li>
                                                <li class="avatar avatar-sm">
                                                    <span class="avatar-initial rounded-circle pull-up"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="8 more">+8</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="info" class="my-4">
                            <div class="d-flex justify-content-between">
                                <span>Mulai : </span>
                                <div>24 Januari 2023</div>
                            </div>
                            <div class="d-flex justify-content-between my-3">
                                <span>Akhir : </span>
                                <div>24 Januari 2024</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Tema : </span>
                                <div>Pengelolaan Tugas</div>
                            </div>
                        </div>
                        <a href="{{ route('ketua.detail_project') }}" class="w-100 btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        </div>
        {{-- Card --}}

        {{-- Modal Buat Tim --}}
        <div class="modal fade" id="modalBuatTim" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Buat Tim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="ketuaKelompok" class="form-label">Ketua Kelompok</label>
                                <select id="ketuaKelompok" name="ketuaKelompok" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="a">Rafliansyah</option>
                                    <option value="b">Jual beli Hewan</option>
                                    <option value="c">Jual beli Minuman</option>
                                    <option value="d">Jual beli Senjata</option>
                                    <option value="e">Jual beli Buku</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="KetuaProject" class="form-label">Ketua Projek</label>
                                <select id="KetuaProject" name="ketuaProjek" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="a">Rafliansyah</option>
                                    <option value="b">Jual beli Hewan</option>
                                    <option value="c">Jual beli Minuman</option>
                                    <option value="d">Jual beli Senjata</option>
                                    <option value="e">Jual beli Buku</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="anggota" class="form-label">Anggota</label>
                                <select id="anggota" class="select2 form-select" multiple>
                                    <option value="AK">Alaska</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AK">Alaska</option>
                                    <option value="HI">Hawaii</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Buat Tim --}}

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
