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

  <style>
    @media (min-width: 500px) and (max-width: 768px) {
      .navbar-ul li {
        font-size: 14px;
        display: 'flex';
        justify-content: 'center';
        align-content: 'center';
      }
    }

    @media (min-width: 320px) and (max-width: 499px) {
      .navbar-ul {
        flex-direction: column;
        width: 100%;
        padding-left: 0px;
      }

      .navbar-ul li {
        display: 'flex';
        justify-content: 'center';
        align-content: 'center';
      }
    }
  </style>
@endsection

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex card flex-md-row align-items-center justify-content-between">
      <div class="nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-tab="1"><i
              class="ti ti-clipboard-text me-1"></i>Buat Catatan</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
            type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
              class="ti ti-clipboard-check me-1"></i>Histori Catatan</button>
        </li>
      </div>
    </div>
    <div class="tab-content px-0 mt-2" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
        tabindex="0">
        <div class="">
          <div class="d-flex justify-content-center">
            <div class="col-12">
              <form class="card" id="catatanPost" action="{{ route('catatan.store', ['tim_id' => $tim->id]) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="card-header">
                  <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fs-4 m-0">Catatan</h5>
                    <div>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
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
                        <label class="form-check-label custom-option-content" for="customRadioTemp1">
                          <input name="type_note" class="form-check-input" type="radio" value="private"
                            id="customRadioTemp1" checked />
                          <span class="custom-option-header">
                            <span class="h6 mb-0">Catatan Tim <span class="text-warning">(Bisa kamu edit sesuka
                                hati)</span></span>
                          </span>
                        </label>
                      </div>
                    </div>
                    <div class="col-md">
                      <div class="form-check custom-option custom-option-basic">
                        <label class="form-check-label custom-option-content" for="customRadioTemp2">
                          <input name="type_note" class="form-check-input" type="radio" value="revisi"
                            id="customRadioTemp2" />
                          <span class="custom-option-header">
                            <span class="h6 mb-0">Catatan Revisi <span class="text-warning">(Tidak bisa di edit atau
                                hapus)</span></span>
                          </span>
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="file" id="fileInput" accept="image/*" class="d-none">
                <div class="container">
                  {{-- <div class="card-body p-0 pb-4 m-0">
                    <div id="editorCreate">
                      <div>
                      </div>
                    </div>
                    <textarea name="contentCreate" id="contentCreate" cols="30" rows="10" class="d-none"></textarea>
                  </div> --}}
                  <div class="mb-4">
                    <label for="defaultInput" class="form-label">Catatan</label>
                    <div class="form-repeater">
                      <div class="form-add">
                        <div class="form-catatan-repeater row mb-3">
                          <div class="col-md-11 col-11">
                            <input name="catatan_text[]" id="catatan-input" type="text" class="form-control">
                          </div>
                          <div class="col-md-1 col-1 d-flex justify-content-center">
                            <div id="button-delete">
                              <button
                                class="btn btn-icon d-flex justify-content-center align-items-center btn-label-danger mx-2 waves-effect me-3">
                                <i class="ti ti-trash text-danger"></i>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div id="add-input" class="btn btn-primary">
                        Tambah Catatan
                      </div>
                    </div>
                  </div>
                  <script>
                    var i = 0;
                    $('#add-input').click(function() {
                      ++i;
                      $('.form-add').append(
                        `<div class="form-catatan-repeater row mb-3">
                          <div class="col-md-11 col-11">
                            <input name="catatan_text[]" id="catatan-input" type="text" class="form-control">
                          </div>
                          <div class="col-md-1 col-1 d-flex justify-content-center">
                            <div id="button-delete">
                              <button class="btn btn-icon d-flex justify-content-center align-items-center btn-label-danger mx-2 waves-effect me-3">
                                <i class="ti ti-trash text-danger"></i>
                              </button>
                            </div>
                          </div>
                        </div>`
                      )
                    })

                    $(document).on('click', '#button-delete', function(event) {
                      event.preventDefault();
                      var $formCatatanRepeater = $(this).parents('.form-catatan-repeater');

                      swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus baris catatan ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                      }).then(function(result) {
                        if (result.isConfirmed) {
                          $formCatatanRepeater.remove();
                          swal.fire(
                            'Terhapus!',
                            'Elemen berhasil dihapus.',
                            'success'
                          );
                        }
                      });
                    });
                  </script>
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
                <div class="card-header fs-4">Histori Catatan</div>
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
                                Catatan Tim</span>
                            @else
                              <span class="badge bg-label-warning me-1">
                                Catatan Revisi</span>
                            @endif
                          </td>
                          @if ($item->type_note === 'private')
                            <td class="d-flex flex-wrap flex-row gap-1">
                              <a class="d-block cursor-pointer btn-show" id="show-button" data-bs-toggle="modal"
                                data-bs-target="#modal-show{{ $item->id }}" data-content="{{ $item->content }}"
                                data-title="{{ $item->title }}">
                                <i class="ti ti-eye me-1 text-warning"></i>
                              </a>
                              <a class="d-block cursor-pointer btn-edit" data-bs-toggle="modal"
                                data-bs-target="#edit-catatan{{ $item->id }}" data-content="{{ $item->content }}"
                                data-url="{{ $item->code }}" data-title="{{ $item->title }}"><i
                                  class="ti ti-pencil me-1 text-primary"></i></a>
                              <form action="{{ route('catatan.delete', $item->code) }}" class="form-delete"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <a class="d-block cursor-pointer btn-delete" id="delete-button">
                                  <i class="ti ti-trash me-1 text-danger"></i>
                                </a>
                              </form>
                            </td>
                          @else
                            <td>
                              <a class="d-block cursor-pointer btn-show" id="show-button" data-bs-toggle="modal"
                                data-bs-target="#modal-show{{ $item->id }}" data-content="{{ $item->content }}"
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
          @foreach ($catatanTeam as $data)
            <div class="modal fade" id="edit-catatan{{ $data->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md modal-edit-user">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Edit Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <form action="{{ route('catatan.update', $data->id) }}" id="edit-form" class="row g-2 p-0 m-0"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                      <div class="container d-flex flex-column justify-content-center align-content-center">
                        <div class="mb-3">
                          <label for="titleEdit" class="form-label">Judul</label>
                          <input type="text" id="titleEdit" value="{{ $data->title }}" name="titleUpdate"
                            class="form-control mb-3">
                        </div>
                        <div class="form-add-edit">
                          @foreach ($data->catatanDetail as $i => $item)
                            <div class="form-catatan-repeater row mb-3">
                              <div class="col-md-10 col-10">
                                <label for="catatan" class="mb-2 form-label">Catatan {{ ++$i }}</label>
                                <input name="catatan_text[]" id="catatan-input" type="text"
                                  value="{{ $item->catatan_text }}" class="form-control">
                              </div>
                              <div class="col-md-1 col-1 d-flex justify-content-center align-items-end">
                                <div id="button-delete">
                                  <button
                                    class="btn btn-icon d-flex justify-content-center align-items-center btn-label-danger mx-2 waves-effect me-3">
                                    <i class="ti ti-trash text-danger"></i>
                                  </button>
                                </div>
                              </div>
                            </div>
                          @endforeach
                        </div>
                        <div id="add-input-edit" class="btn btn-primary">
                          Tambah Catatan Baru
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                  <script>
                    var i = 0;
                    $('#add-input-edit').click(function() {
                      ++i;
                      $('.form-add-edit').append(
                        `<div class="form-catatan-repeater row mb-3">
                              <div class="col-md-10 col-10">
                                <label for="catatan" class="mb-2 form-label">Catatan Baru</label>
                                <input name="catatan_text[]" id="catatan-input" type="text" value class="form-control">
                              </div>
                              <div class="col-md-1 col-1 d-flex justify-content-center align-items-end">
                                <div id="button-delete">
                                  <button class="btn btn-icon d-flex justify-content-center align-items-center btn-label-danger mx-2 waves-effect me-3">
                                    <i class="ti ti-trash text-danger"></i>
                                  </button>
                                </div>
                              </div>
                            </div>`
                      )
                    })

                    $(document).on('click', '#button-delete', function(event) {
                      event.preventDefault();
                      var $formCatatanRepeater = $(this).parents('.form-catatan-repeater');

                      swal.fire({
                        title: 'Konfirmasi',
                        text: 'Apakah Anda yakin ingin menghapus baris catatan ini?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, hapus',
                        cancelButtonText: 'Batal'
                      }).then(function(result) {
                        if (result.isConfirmed) {
                          $formCatatanRepeater.remove();
                          swal.fire(
                            'Terhapus!',
                            'Elemen berhasil dihapus.',
                            'success'
                          );
                        }
                      });
                    });
                  </script>
                </div>
              </div>
            </div>
          @endforeach

          @foreach ($catatanTeam as $data)
            {{-- Modal Show --}}
            <div class="modal fade" id="modal-show{{ $data->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-md modal-edit-user">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Detail Catatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container">
                      <div class="mb-3">
                        <label for="titleEdit" class="form-label">Judul</label>
                        <input type="text" id="titleEdit" value="{{ $data->title }}" name="titleEdit"
                          class="form-control mb-3" readonly>
                      </div>
                      @foreach ($data->catatanDetail as $i => $item)
                        <div class="form-catatan-repeater mb-3">
                          <label>Catatan {{ ++$i }}</label>
                          <input name="catatan_text[]" value="{{ $item->catatan_text }}" type="text"
                            class="form-control" readonly>
                        </div>
                      @endforeach
                    </div>
                  </div>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <!-- Jika ada yang ingin ditambahkan di footer -->
                  </div>
                </div>
              </div>
            </div>
        </div>
        {{-- Modal Show --}}
        @endforeach

      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  \
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
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

      // $('.btn-edit').click(function() {
      //   var content = $(this).data('content');
      //   var dataUrl = $(this).data('url');
      //  2 var title = $(this).data('title');
      //   var form = $('#edit-form');
      //   var formAction = "{{ route('catatan.update', ['code' => ':Id']) }}";

      //   console.log(title);

      //   formAction = formAction.replace(':Id', dataUrl);
      //   $('#edit-form').attr('action', formAction);
      //   $('#titleEdit').val(title);
      //   $('#resetEdit').attr('data-reset', content);

      //   quillEdit.setContents(quillEdit.clipboard.convert(content));

      //   $('#resetEdit').click(function() {
      //     quillEdit.setContents(quillEdit.clipboard.convert(content));
      //   })
      // })


    });
  </script>
  {{-- \] --}}
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('catatanPost').addEventListener('submit', function(event) {
        var judulCatatan = document.getElementById('defaultInput').value;
        var catatanInput = document.getElementById('catatan-input').value;

        if (judulCatatan.trim() === '') {
          Swal.fire({
            icon: 'warning',
            title: 'Gagal',
            text: 'Judul catatan tidak boleh kosong!',
            showConfirmButton: false,
            timer: 4000,
          });
          event.preventDefault();
        } else {}

        if (catatanInput.trim() === '') {
          Swal.fire({
            icon: 'warning',
            title: 'Gagal',
            text: 'Catatan tidak boleh kosong!',
            showConfirmButton: false,
            timer: 4000,
          });
          event.preventDefault();
        } else {}
      });
    });

    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('edit-form').addEventListener('submit', function(event) {
        var catatanInput = document.getElementById('catatan-input-edit').value;

        if (catatanInput.trim() === '') {
          event.preventDefault();
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Catatan tidak boleh kosong!',
            showConfirmButton: false,
            timer: 4000,
          });
        } else {}
      });
    });
  </script>

  {{-- Script Append Item to Show Modal && Edit Modal --}}
  <script>
    $(document).ready(function() {
      $('[data-tab]').click(function() {
        var historyCatatanTimTab = $(this).attr('data-tab');
        sessionStorage.setItem('historyCatatanTimTab', historyCatatanTimTab);
      });

      var historyCatatanTimTab = sessionStorage.getItem('historyCatatanTimTab');
      if (historyCatatanTimTab) {
        $('[data-tab="' + historyCatatanTimTab + '"]').tab('show');
      }

      $('.btn-label-danger').click(function() {
        var editor = $('.ql-editor');
        editor.empty();
      })

      // $('#catatanPost').submit(function() {
      //   var editor = $('.ql-editor');

      //   if (editor.text().trim() === '') {
      //     event.preventDefault();
      //     swal.fire('Peringatan', 'Mohon isi catatan sebelum simpan', 'warning');
      //   }
      // })

      $('.btn-delete').click(function() {
        swal.fire({
          title: 'Konfirmasi',
          text: 'Apakah Anda yakin ingin menghapus catatan ini?',
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
        "paging": true,
        "lengthMenu": [
          [5, 10, 15, -1],
          [5, 10, 15, "All"]
        ],
        "pageLength": 5,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "language": {
          "search": "Cari:",
          "lengthMenu": "Tampilkan _MENU_ entri per halaman",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri (difilter dari _MAX_ total entri)",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          },
          "emptyTable": "Tidak ada data yang ditemukan",
          "zeroRecords": "Tidak ada hasil yang ditemukan",
          "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
          "infoFiltered": "(difilter dari _MAX_ total entri)"
        }
      });
    });
  </script>
@endsection
