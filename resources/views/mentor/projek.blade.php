@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
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
        <div class="row mt-4">
            @forelse ($projects as $item)
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
                                                    @foreach ($anggota as $anggota)
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="{{ $anggota->user->username }}"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="rounded-circle"
                                                                src="{{ asset($anggota->user->avatar) }}" alt="Avatar">
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
                            <a href="{{ route('detail-projek', $item->code) }}" class="w-100 btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada data project</p>
            @endforelse
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
