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

@section('content')
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                    <span class="card-header fs-4">Daftar Presentasi</span>
                    <span class="card-header">
                        <button type="button" data-bs-toggle="modal" data-bs-target="#ajukanPresentasi" class="btn btn-primary mx-2">Ajukan Presentasi</button>
                    </span>
                </div>
                {{-- Modal Ajukan presentasi --}}
                <div class="modal fade" id="ajukanPresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Ajukan Presentasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="{{ route('ajukan-presentasi', $tim->code) }}" method="post"
                                id="formAjukanPresentasi">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="judul" class="form-label">Judul Presentasi</label>
                                            <input type="text" id="judul" name="judul" class="form-control"
                                                placeholder="Masukan Judul Presentasi">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="deskripsi" class="form-label">Deskripsi Presentasi</label>
                                            <textarea name="deskripsi" id="deskripsi" cols="20" rows="10" class="form-control" style="resize: none"
                                                placeholder="Isi deskripsi pengajuan anda"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary waves-effect"
                                        data-bs-dismiss="modal">Kembali</button>
                                    <button type="submit"class="btn btn-primary waves-effect waves-light">Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Modal Ajukan presentasi --}}

                <div class="container table-responsive card-datatable  text-nowrap">
                    <table id="jstabel" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">Presentasi</th>
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">Status Presentasi</th>
                                <th class="text-white">Status Pengajuan</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($presentasi as $i=> $data)
                                <tr>
                                    <td><span class="fw-medium">{{ $data->judul }}</span></td>
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
                                        @if ($data->status_pengajuan === 'menunggu')
                                            <span class="badge bg-label-warning me-1">menunggu</span>
                                        @endif
                                        @if ($data->status_pengajuan === 'disetujui')
                                            <span class="badge bg-label-success me-1">disetujui</span>
                                        @endif
                                        @if ($data->status_pengajuan === 'ditolak')
                                            <span class="badge bg-label-danger me-1">ditolak</span>
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
