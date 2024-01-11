@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <style>
        @media screen and (max-width:768px) {
            .nav-item {
                font-size: 10px;
            }
        }
    </style>
@endsection

@section('content')
    {{-- modal --}}

    <div class="modal fade" id="aturUrutan" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Atur urutan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col" data-select2-id="45">
                            <label for="select2Basic" class="form-label">Atur Urutan</label>
                            <div class="position-relative" data-select2-id="44">
                                <select id="select2Basic" class="select2 form-select form-select-lg select2-accessible"
                                    data-allow-clear="false" data-select2-id="select2Basic" tabindex="-1"
                                    aria-hidden="false" name="urutan" data-bs-code="">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#detailPresentasi"
                        class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" onclick="kirimProsesGantiUrutan()" data-bs-toggle="modal"
                        data-bs-target="#detailPresentasi" class="btn btn-primary waves-effect waves-light">Atur
                        Urutan</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail presentasi tim --}}
    <div class="modal fade" id="detailTim" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel3">History Presentasi Tim</h5>
                    <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#detailPresentasi"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <h6 style="font-size: 15px;">Statistik Tim</h6>
                            <div class="row gap-2 mt-2">
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-title mb-0">
                                                <h5 id="persentasiRevisiSelesai" class="mb-0 me-2"></h5>
                                                <small>Keberhasilan dalam mengerjakan revisi</small>
                                            </div>
                                            <div class="card-icon">
                                                <span class="badge bg-label-primary rounded-pill p-2">
                                                    <i class="ti ti-cpu ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="card-title mb-0">
                                                <h5 class="mb-0 me-2" id="historyTotalPresentasi">3</h5>
                                                <small>Total Presentasi</small>
                                            </div>
                                            <div class="card-icon">
                                                <span class="badge bg-label-success rounded-pill p-2">
                                                    <i class="ti ti-server ti-sm"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card h-100">
                                        <div class="card-body d-flex justify-content-between align-items-center">
                                            <div class="col-12">
                                                {{-- <div class="col-4 foto-ketua-tim">
                                                <img class="rounded-circle foto-ketua-tim" style="width:50px; height:50px;" src="{{ asset('assets/img/avatars/10.png') }}" alt="">
                                            </div> --}}
                                                <div class="col-8">
                                                    <p class="m-0 text-secondary" id="history-ketua-tim"></p>
                                                    <span class="badge bg-label-primary">Ketua Tim</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 mt-5  mt-lg-0">
                            <h6 style="font-size: 15px;">History Presentasi</h6>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="demo-inline-spacing mt-3">
                                        <div id="list-group" class="list-group">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary waves-effect" data-bs-toggle="modal"
                        data-bs-target="#detailPresentasi">Kembali</button>
                </div>
            </div>
        </div>
    </div>
    {{-- modal detail presentasi tim --}}


    {{-- Modal Selesai Project --}}

    <div class="modal fade" id="Finish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="selesaiPresentasiForm" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selesai Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col">
                                <span>Status Revisi</span> <br><br>
                                <input type="radio" value="selesai" name="status_revisi" class="form-check-input"
                                    id="selesai">
                                <label for="selesai">Selesai</label>
                                <input type="radio" value="tidak_selesai" name="status_revisi"
                                    class="form-check-input" id="tidak">
                                <label for="tidak">Tidak selesai</label>

                                <br>
                                <br>
                                <br>

                                <label for="feedback" class="mb-3">Feedback <span
                                        class="badge bg-label-warning">Opsional</span> </label>
                                <textarea type="text" class="form-control" id="feedback" placeholder="Beri Feedback Presentasi"
                                    style="height: 150px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Kembali</button>
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Selesai Project --}}

    {{-- Modal Tolak Presentasi --}}

    <div class="modal fade" id="Reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="tolakPresentasiForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="mt-1">Alasan</label>
                        <textarea id="alasan" type="text" name="alasan" class="form-control" placeholder="Beri alasan penolakan"
                            style="height: 150px; resize: none"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Kembali</button>
                        <button type="setuju" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Setuju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Modal Tolak Presentasi --}}

    <div class="container mt-3">
        <h2 class="fs-4 mt-3">Presentasi</h2>
        <div class="row">
            @forelse ($historyPresentasi as $history)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-black">
                            <img width="300" height="auto" class="img-fluid"
                                src="{{ asset('assets/img/presentasi.png') }}" alt="">
                            <div class="d-flex justify-content-around align-items-center">
                                <span class="badge bg-label-info">Minggu ke-{{ $history->noMinggu }}</span>
                                <span class="badge bg-label-warning">{{ $history->bulan }} {{ $history->tahun }}</span>
                                {{-- <span class="badge bg-label-primary">{{ $history->divisi->name }}</span> --}}
                            </div>
                            <div class="d-flex justify-content-around align-items-center gap-3  mt-3">
                                <a href="{{ route('detail-presentasi.mentor', $history->code) }}"
                                    class="btn btn-primary w-100">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h6 class="text-center mt-4">Tidak Ada Presentasi <i class="ti ti-address-book-off"></i></h6>
                <div class="mt-4 mb-3 d-flex justify-content-evenly">
                    <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                        alt="page-misc-under-maintenance" width="300" class="img-fluid">
                </div>
            @endforelse
        </div>
        <div class="pagination">
            {{ $historyPresentasi->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script src="{{ asset('utils/Kategory.js') }}"></script>
    <script src="{{ asset('utils/handleFormatDate.js') }}"></script>
@endsection
