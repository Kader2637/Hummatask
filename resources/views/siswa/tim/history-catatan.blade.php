@extends('layouts.tim')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('[id^="delete-button-"]');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                var code = button.id.replace('delete-button-', '');

                swal.fire({
                    title: "Apa kamu yakin?",
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Hapus!",
                    customClass: {
                        confirmButton: "btn btn-danger me-3",
                        cancelButton: "btn btn-label-secondary",
                    },
                    buttonsStyling: false,
                }).then(function(confirmDelete) {
                    if (confirmDelete.isConfirmed) {
                        window.location.href = "{{ url('tim/catatan-delete') }}/" +
                            code;
                    }
                });
            });
        });
    });
</script>


@section('content')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Sukses",
                text: "{{ session('success') }}",
                icon: "success",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: false,
            });
        @endif
        @if (session('error'))
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: false,
            });
        @endif
    </script>
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Histori Catatan</h5>
                <div class="card-datatable table-responsive">
                    <table id="jstabel" class="table">
                        <thead>
                            <tr>
                                <th>Catatan</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($catatans as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <span class="badge bg-label-primary me-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->isoFormat('DD MMMM YYYY') }}</span>
                                    </td>
                                    <td class="d-flex flex-wrap flex-row">
                                        <a class="d-block cursor-pointer" data-bs-toggle="modal"
                                            data-bs-target="#edit-catatan-{{ $item->code }}"><i
                                                class="ti ti-pencil me-1 text-primary"></i></a>
                                        <a class="d-block cursor-pointer" id="delete-button-{{ $item->code }}">
                                            <i class="ti ti-trash me-1 text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($catatans as $item)
        <div class="modal fade" id="edit-catatan-{{ $item->code }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content">
                    <form method="POST" action="{{ route('catatan.update', $item->code) }}">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <form id="editUserForm" class="row g-2 p-0 m-0" onsubmit="return false" method="POST"
                                action="">
                                <div class="card d-flex gap-0 m-0 p-0">
                                    <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                                        <span class="card-header fs-4">Catatan</span>
                                        <span class="card-header">
                                            <button type="button" class="btn btn-label-danger mx-2" data-bs-toggle="modal"
                                                data-bs-target="#modalTolak">Reset</button>
                                            <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#modalTerima">Simpan</button>
                                        </span>
                                    </div>
                                    <div class="card-body p-0 px-4 pb-4 m-0">
                                        <div id="editor-history-{{ $item->code }}" style="height: 400px">
                                            {!! $item->content !!}
                                        </div>
                                    </div>
                                    <textarea name="content" id="content-{{ $item->code }}" cols="30" rows="10" class="d-none"></textarea>
                                </div>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
            let editors = document.querySelectorAll("#editor-history-{{ $item->code }}");

            console.log(editors);

            editors.forEach(function(editorElement) {
                let quill = new Quill(editorElement, {
                    modules: {
                        clipboard: true,
                        toolbar: [
                            ["bold", "italic"],
                            ["link", "blockquote"],
                            [{
                                list: "ordered"
                            }, {
                                list: "bullet"
                            }],
                        ],
                    },
                    placeholder: "Tuliskan catatan anda..",
                    theme: "snow",
                });

                let contentID = "content-{{ $item->code }}";
                let contentElement = document.getElementById(contentID);

                quill.on("text-change", function(delta, oldDelta, source) {
                    contentElement.value = quill.root.innerHTML;
                });
            });
        </script>
    @endforeach
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
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
                    "sSearch": "Cari :",
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
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script s rc="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>
    <script src="{{ asset('assets/js/forms-editors-history.js') }}"></script>
@endsection
