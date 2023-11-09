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
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class="nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i
                            class="ti ti-clipboard-text"></i>Buat Catatan</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i
                            class="ti ti-clipboard-check"></i>History Catatan</button>
                </li>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <form class="card" id="catatanPost" action="{{ route('catatan.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                                    <span class="card-header fs-4">Catatan</span>
                                    <span class="card-header">
                                        <button type="button" class="btn btn-label-danger mx-2">Reset</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </span>
                                </div>
                                <div class="container mb-3">
                                    <div class="mb-3">
                                        <label for="defaultInput" class="form-label">Judul Catatan</label>
                                        <input id="defaultInput" name="titleCreate" class="form-control" type="text"
                                            placeholder="Beri judul catatan anda.." />
                                    </div>
                                    <label for="" class="form-label">Tipe Catatan</label>
                                    <div class="row">
                                        <div class="col-md mb-md-0 mb-2">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp1">
                                                    <input name="type_note" class="form-check-input" type="radio"
                                                        value="private" id="customRadioTemp1" checked />
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Catatan Pribadi <span
                                                                class="text-warning">(Bisa
                                                                kamu edit sesuka hati)</span></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp2">
                                                    <input name="type_note" class="form-check-input" type="radio"
                                                        value="revisi" id="customRadioTemp2" />
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Catatan Revisi <span
                                                                class="text-warning">(Tidak
                                                                bisa di edit atau hapus)</span></span>
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="file" id="fileInput" accept="image/*" class="d-none">
                                <div class="container">
                                    <div class="card-body p-0 pb-4 m-0">
                                        <div id="editorCreate">
                                            <div>
                                            </div>
                                        </div>
                                        <textarea name="contentCreate" id="contentCreate" cols="30" rows="10" class="d-none"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="">
                    {{-- Table Content --}}
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <div class="card">
                                <h5 class="card-header">Histori Catatan</h5>
                                <div class="container card-datatable table-responsive">
                                    <table id="jstabel" class="table">
                                        <thead class="bg-primary">
                                            <tr class="text-white">
                                                <th class="text-white">no.</th>
                                                <th class="text-white">judul</th>
                                                <th class="text-white">Tanggal</th>
                                                <th class="text-white">jenis catatan</th>
                                                <th class="text-white">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @foreach ($catatans as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}.</td>
                                                    <td>{{ $item->title }}</td>
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
                                                                data-content="{{ $item->content }}"
                                                                data-title="{{ $item->title }}">
                                                                <i class="ti ti-eye me-1 text-warning"></i>
                                                            </a>
                                                            <a class="d-block cursor-pointer btn-edit"
                                                                data-bs-toggle="modal" data-bs-target="#edit-catatan"
                                                                data-content="{{ $item->content }}"
                                                                data-url="{{ $item->code }}"
                                                                data-title="{{ $item->title }}"><i
                                                                    class="ti ti-pencil me-1 text-primary"></i></a>
                                                            <form action="{{ route('catatan.delete', $item->code) }}"
                                                                class="form-delete" method="post">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a class="d-block cursor-pointer btn-delete"
                                                                    id="delete-button">
                                                                    <i class="ti ti-trash me-1 text-danger"></i>
                                                                </a>
                                                            </form>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a class="d-block cursor-pointer btn-show" id="show-button"
                                                                data-bs-toggle="modal" data-bs-target="#modal-show"
                                                                data-content="{{ $item->content }}"
                                                                data-title="{{ $item->title }}">
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
                                <div class="modal-body p-0 m-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                    <form action="" id="edit-form" class="row g-2 p-0 m-0" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="container">
                                            <div class="card d-flex">
                                                <div class="card-body">
                                                    <span class="mb-3">
                                                        <label for="" class="form-label">Judul</label>
                                                        <input type="text" class="form-control mb-3" name="titleEdit"
                                                            id="titleEdit" value=""
                                                            placeholder="Isi judul catatan anda">
                                                    </span>
                                                    <div id="editorEdit">
                                                        <div>
                                                        </div>
                                                    </div>
                                                    <textarea name="contentEdit" id="contentEdit" cols="30" rows="10" class="d-none"></textarea>
                                                    <div class="d-flex flex-row flex-wrap justify-content-end p-0 m-0">
                                                        <span class="card-footer">
                                                            <button type="button" class="btn btn-label-danger mx-2"
                                                                id="resetEdit" data-reset="">Reset</button>
                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                        </span>
                                                    </div>
                                                </div>
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
                                    <div class="modal-body p-0 m-0">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="card d-flex gap-0 m-0 p-0">
                                            <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                                                <span class="card-header fs-4" id="titleShow">Catatan</span>
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

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    {{-- Script Append Item to Show Modal && Edit Modal --}}
    <script>
        let quillEdit;

        $(document).ready(function() {
            let quillEdit = new Quill("#editorEdit", {
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

            quillEdit.on("text-change", function(delta, oldDelta, source) {
                let contentEdit = quillEdit.root.innerHTML;
                $("#contentEdit").html(contentEdit);
            });

            $('.btn-show').click(function() {
                var content = $(this).data('content');
                var title = $(this).data('title');
                $('#titleShow').text(title);

                $('#show-data-content').html(content);
            })

            $('.btn-edit').click(function() {
                var content = $(this).data('content');
                var dataUrl = $(this).data('url');
                var title = $(this).data('title');
                var form = $('#edit-form');
                var formAction = "{{ route('catatan.update', ['code' => ':Id']) }}";

                formAction = formAction.replace(':Id', dataUrl);
                $('#edit-form').attr('action', formAction);
                $('#titleEdit').val(title);
                $('#resetEdit').attr('data-reset', content);

                quillEdit.setContents(quillEdit.clipboard.convert(content));

                $('#resetEdit').click(function() {
                    quillEdit.setContents(quillEdit.clipboard.convert(content));
                })
            })


        });
    </script>
    {{-- Script Append Item to Show Modal && Edit Modal --}}
    <script>
        $(document).ready(function() {
            $('.btn-label-danger').click(function() {
                var editor = $('.ql-editor');
                editor.empty();
            })

            $('#catatanPost').submit(function() {
                var editor = $('.ql-editor');

                if (editor.text().trim() === '') {
                    event.preventDefault();
                    swal.fire('Peringatan', 'Mohon isi catatan sebelum simpan', 'warning');
                }
            })

            $('.btn-delete').click(function() {
                swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus data ini?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then(function(result) {
                    if (result.value) {
                        $('.form-delete').submit();
                    }
                });
            });

            $('#jstabel').DataTable({
                "paging": true, // Aktifkan penomoran halaman
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5, // Aktifkan opsi untuk mengubah jumlah entri per halaman
                "searching": true, // Aktifkan fitur pencarian
                "ordering": true, // Aktifkan pengurutan kolom
                "info": true, // Tampilkan informasi halaman saat ini dan total entri
                "autoWidth": false, // Nonaktifkan penyesuaian lebar otomatis
                // Menyesuaikan teks pada tombol filter
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ entri per halaman",
                    "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
@endsection
