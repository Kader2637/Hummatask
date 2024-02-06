@extends('layoutsMentor.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3">
            <span class="text-muted fw-light">History</span>
        </h4>
        <div class="d-flex card flex-md-row align-items-center justify-content-between pb-3">
            <div class="filter col-lg-3 col-md-3 col-sm-3">
                <label for="select2Basic" class="form-label">Filter</label>
                <form id="filterForm" action="{{ route('tim') }}" method="get">
                    <select id="select2Basic" name="status_tim" class="form-select select2" data-allow-clear="true"
                        onchange="filterProjek(this)">
                        <option value="all" selected {{ request('status_presentasi') == 'all' ? 'selected' : '' }}>Semua
                        </option>
                        <option value="solo" {{ request('status_presentasi') == 'solo' ? 'selected' : '' }}>Solo Project
                        </option>
                        <option value="pre_mini" {{ request('status_presentasi') == 'pre_mini' ? 'selected' : '' }}>Pre-mini
                            Project</option>
                        <option value="mini" {{ request('status_presentasi') == 'mini' ? 'selected' : '' }}>Mini Project
                        </option>
                        <option value="big" {{ request('status_presentasi') == 'big' ? 'selected' : '' }}>Big Project
                        </option>
                    </select>
                    <input type="hidden" name="nama_tim" value="{{ request('nama_tim') }}">
                </form>
            </div>
        </div>
        <div class="card p-3">
            <div class="card-datatable table-responsive">
                <table id="jstabel1" class="dt-responsive table">
                    <thead>
                        <tr>
                            <th scope="col">NO</th>
                            <th scope="col">NAMA TIM</th>
                            <th scope="col">STATUS TIM</th>
                            <th scope="col">STATUS PRESENTASI</th>
                            <th scope="col">STATUS REVISI</th>
                            <th scope="col">HARI/TANGGAL</th>
                            <th scope="col">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presentasi as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->tim->nama }}</td>
                                <td>
                                    @if ($item->tim->status_tim === 'solo')
                                        <span class="badge bg-label-danger">Solo Project</span>
                                    @elseif ($item->tim->status_tim === 'pre_mini')
                                        <span class="badge bg-label-warning">Pre Mini Project</span>
                                    @elseif ($item->tim->status_tim === 'mini')
                                        <span class="badge bg-label-success">Mini Project</span>
                                    @else
                                        <span class="badge bg-label-primary">Big Project</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_presentasi === 'menunggu')
                                        <span class="badge bg-label-warning">Menunggu</span>
                                    @elseif ($item->status_presentasi === 'sedang_presentasi')
                                        <span class="badge bg-label-primary">Sedang Presentasi</span>
                                    @elseif ($item->status_presentasi === 'tidak_selesai')
                                        <span class="badge bg-label-danger">Tidak Selesai</span>
                                    @else
                                        <span class="badge bg-label-success">Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_revisi === 'tidak_selesai')
                                        <span class="badge bg-label-danger">Tidak Selesai</span>
                                    @else
                                        <span class="badge bg-label-success">Selesai</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->tim->id }}"
                                        data-status="{{ $item->status_presentasi }}"
                                        data-statusr="{{ $item->status_revisi }}" style="padding: 10px;"><i
                                            class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Edit Status --}}
        <div class="modal fade" id="modal-update" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Status Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-update" method="post">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_tim" class="form-label">Status Presentasi</label>
                                    <select id="status_tim" name="status_tim" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="" selected>Presentasi</option>
                                        <option value="">Tidak Presentasi</option>
                                    </select>
                                    {{-- @error('status_tim')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Edit Status --}}
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <script>
        $('.btn-edit').on('click', function() {
            var id = $(this).data('id');
            var statuspresentasi = $(this).data('status');
            var statusrevisi = $(this).data('statusr');
            $('#form-update').attr('action', '/tim/' + id);
            $('#modal-update').modal('show');
        });
    </script>

    <script>
        // Fungsi untuk menampilkan modal dan mengatur nilai pada modal
        // function openEditModal(id, status) {
        //     $('#status_tim').val(status); // Atur nilai select sesuai status yang diberikan
        //     $('#form-update').attr('action', '/tim/' + id); // Atur action form sesuai dengan URL yang sesuai dengan id
        //     $('#modal-update').modal('show'); // Tampilkan modal
        // }

        // Fungsi untuk menangani submit formulir modal
        // $(document).on('submit', '#form-update', function(event) {
        //     event.preventDefault();
        //     var form = $(this);
        //     var formData = form.serialize();

        //     $.ajax({
        //         url: form.attr('action'),
        //         type: 'POST',
        //         data: formData,
        //         success: function(response) {
        //             // Tambahkan logika untuk menanggapi respons
        //             console.log(response);
        //             $('#modal-update').modal('hide');
        //         },
        //         error: function(error) {
        //             console.log(error.responseJSON.message);
        //         }
        //     });
        // });

        // Fungsi untuk menangani klik pada tombol edit
        // $(document).on('click', '.btn-edit', function(event) {
        //     event.preventDefault();
        //     var id = $(this).data('id');
        //     var status = $(this).data('status');

        //     openEditModal(id, status);
        // });
    </script>
    <script>
        function filterProjek(selectObject) {
            var selectedValue = selectObject.value;
            var url = "{{ route('tim') }}" + "?status_tim=" + selectedValue;
            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Perbarui tabel dengan data yang difilter
                    // Misalnya, dengan mengganti isi tabel dengan data yang baru
                    $('#jstabel1 tbody').html('');

                    $.each(data.presentasi, function(index, item) {
                        var statusLabel = getStatusLabel(item.tim.status_tim);
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + item.tim.nama + '</td>' +
                            '<td>' + statusLabel + '</td>' +
                            '<td>' + item.created_at + '</td>' +
                            '<td>' +
                            '<button class="btn btn-warning btn-edit" data-bs-toogle="modal" id="btn-edit-' +
                            item.id + '" data-id="' + item.id + '" data-status="' + item
                            .status_presentasi +
                            '" style="padding: 10px;"><i class="fa-solid fa-pen-to-square"></i></button>' +
                            '</td>' +
                            '</tr>';

                        $('#jstabel1 tbody').append(row);
                    });

                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }
    </script>
    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel1').DataTable({
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
                        "next": "&#8594;",
                        "previous": "&#8592;",
                    },
                    "emptyTable": "Tidak ada data yang ditemukan",
                    "zeroRecords": "Tidak ada hasil yang ditemukan",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)"
                }
            });
        });
    </script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel2').DataTable({
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
                        "next": "&#8594;",
                        "previous": "&#8592;",
                    },
                    "emptyTable": "Tidak ada data yang ditemukan",
                    "zeroRecords": "Tidak ada hasil yang ditemukan",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)"
                }
            });
        });
    </script>
    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel3').DataTable({
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
                        "next": "&#8594;",
                        "previous": "&#8592;",
                    },
                    "emptyTable": "Tidak ada data yang ditemukan",
                    "zeroRecords": "Tidak ada hasil yang ditemukan",
                    "infoEmpty": "Menampilkan 0 hingga 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)"
                }
            });
        });
    </script>
    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel4').DataTable({
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
                        "next": "&#8594;",
                        "previous": "&#8592;",
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
