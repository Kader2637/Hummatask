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
                <h5 class="card-header">History Presentasi</h5>
                <div class="table-responsive card-datatable  text-nowrap">
                    <table id="jstabel" class="table">
                        <thead class="bg-primary">
                            <tr>
                                <th class="text-white">Presentasi</th>
                                <th class="text-white">Tanggal</th>
                                <th class="text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>
                            <tr>
                                <td><span class="fw-medium">Progres Figma</span></td>
                                <td>12 Oktober 2023</td>
                                <td><span class="badge bg-label-success me-1">Sukses</span></td>
                            </tr>

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
