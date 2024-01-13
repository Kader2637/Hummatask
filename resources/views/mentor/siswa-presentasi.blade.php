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
