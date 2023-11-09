@extends('layouts.tim')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    {{-- CDN Quill && JQuery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    {{-- CDN Quill --}}
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
    {{-- Table Content --}}
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="card">
                <h5 class="card-header">Histori Catatan</h5>
                <div class="card-datatable table-responsive">
                    <table id="jstabel" class="table">
                        <thead>
                            <tr>
                                <th>judul</th>
                                <th>Tanggal</th>
                                <th>jenis catatan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($catatans as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <span class="badge bg-label-success me-1">
                                            {{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, j F Y') }}</span>
                                    </td>
                                    <td>
                                        @if ($item->type_note === 'private')
                                            <span class="badge bg-label-warning me-1">
                                                Catatan Pribadi</span>
                                        @else
                                            <span class="badge bg-label-warning me-1">
                                                Catatan Revisi</span>
                                        @endif
                                    </td>
                                    @if ($item->type_note === 'private')
                                        <td class="d-flex flex-wrap flex-row">
                                            <a class="d-block cursor-pointer btn-show" id="show-button"
                                                data-bs-toggle="modal" data-bs-target="#modal-show"
                                                data-content="{{ $item->content }}">
                                                <i class="ti ti-eye me-1 text-warning"></i>
                                            </a>
                                            <a class="d-block cursor-pointer btn-edit" data-bs-toggle="modal"
                                                data-bs-target="#edit-catatan" data-content="{{ $item->content }}"
                                                data-url="{{ $item->code }}"><i
                                                    class="ti ti-pencil me-1 text-primary"></i></a>
                                            <a class="d-block cursor-pointer btn-delete" id="delete-button">
                                                <i class="ti ti-trash me-1 text-danger"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td>
                                            <a class="d-block cursor-pointer btn-show" id="show-button">
                                                <i class="ti ti-eye me-1 text-warning"></i>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- Table Content --}}

    {{-- Modal Edit --}}
    <div class="modal fade" id="edit-catatan" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-edit-user">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <form action="" id="edit-form" class="row g-2 p-0 m-0" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="card d-flex gap-0 m-0 p-0">
                            <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                                <span class="card-header fs-4">Catatan</span>
                                <span class="card-header">
                                    <button type="button" class="btn btn-label-danger mx-2">Reset</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </span>
                            </div>
                            <div class="card-body p-0 pb-4 m-0">
                                <div id="editor">
                                    <div>
                                    </div>
                                </div>
                                <textarea name="content" id="content" cols="30" rows="10" class="d-none"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit --}}

    {{-- Modal Show --}}
    <div class="modal fade" id="modal-show" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-simple modal-edit-user">
            <div class="modal-content">
                <form method="POST" action="">
                    <div class="modal-body">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="card d-flex gap-0 m-0 p-0">
                            <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                                <span class="card-header fs-4">Catatan</span>
                            </div>
                            <div class="card-body p-0 px-4 pb-4 m-0">
                                <div id="show-data-content" style="height: 400px">
                                    {{-- isi data show --}}
                                </div>
                            </div>
                            <textarea name="content" id="content" cols="30" rows="10" class="d-none"></textarea>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    {{-- Modal Show --}}

    {{-- Script Append Item to Show Modal && Edit Modal --}}
    <script>
        let quill;

        $(document).ready(function() {
            let quill = new Quill("#editor", {
                modules: {
                    clipboard: true,
                    toolbar: [
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }],
                        [{
                            'font': []
                        }],
                        ["bold", "italic", "underline", "strike"],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'align': []
                        }],
                    ],
                },
                placeholder: "Tuliskan catatan anda..",
                theme: "snow",
            });

            quill.on("text-change", function(delta, oldDelta, source) {
                $("#content").text($(".ql-editor").html());
            });

            $('.btn-show').click(function() {
                var content = $(this).data('content');
                $('#show-data-content').html(content);
            })

            $('.btn-edit').click(function() {
                var content = $(this).data('content');
                var dataUrl = $(this).data('url');
                var form = $('#edit-form');
                var formAction = "{{ route('catatan.update', ['code' => ':Id']) }}";
                formAction = formAction.replace(':Id', dataUrl);
                $('#edit-form').attr('action', formAction);
                quill.setContents(quill.clipboard.convert(content));
            })
        });
    </script>
    {{-- Script Append Item to Show Modal && Edit Modal --}}
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
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
@endsection
