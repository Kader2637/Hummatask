@extends('layoutsMentor.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3">
            <span class="text-muted fw-light">History</span>
        </h4>
        <div class="card p-3">
            <div class="filter col-lg-3 col-md-3 col-sm-3 mb-3">
                <label for="selectfilter" class="form-label">Filter</label>
                <form id="filterForm" action="{{ route('histori-presentasi.mentor') }}" method="get"
                    style="display: flex;">
                    <select id="selectfilter" name="status_presentasi" class="form-select selectFilter"
                        data-allow-clear="true">
                        <option value="all" {{ $status_presentasi == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="presentasi" {{ $status_presentasi == 'presentasi' ? 'selected' : '' }}>Selesai
                            Presentasi Hari Ini</option>
                        <option value="unpresentasi"{{ $status_presentasi == 'unpresentasi' ? 'selected' : '' }}>Belum
                            Presentasi Hari Ini</option>
                        <option value="weekpresentasi"{{ $status_presentasi == 'weekpresentasi' ? 'selected' : '' }}>Sudah
                            Presentasi Minggu Ini</option>
                        <option value="weekunpresentasi"{{ $status_presentasi == 'weekunpresentasi' ? 'selected' : '' }}>
                            Tidak Presentasi Mingguan</option>
                    </select>
                    <button type="submit" class="btn btn-primary ms-3">Filter</button>
                </form>
            </div>

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
                                        <span class="badge bg-label-success">Selesai Presentasi</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status_revisi === 'tidak_selesai')
                                        <span class="badge bg-label-danger">Tidak Selesai</span>
                                    @elseif($item->status_revisi == null)
                                        <span class="badge bg-label-warning">Kosong</span>
                                    @else
                                        <span class="badge bg-label-success">Selesai</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-id="{{ $item->id }}"
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

        {{-- modal status --}}
        <div class="modal fade" id="modal-update" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Status Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="tutup()" aria-label="Close"></button>
                    </div>
                    <form id="form-update" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="id" value="">
                        <div class="modal-body mx-3">
                            <div class="row mb-3">
                                <label for="status_presentasi" class="form-label">Status Presentasi</label>
                                <select id="status_presentasi" name="status_presentasi"
                                    class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option value="selesai">Presentasi</option>
                                    <option value="tidak_selesai">Tidak Presentasi</option>
                                </select>
                            </div>
                            <div class="row mb-3" style="margin: 0px;">
                                <label for="status_revisi" class="label" style="padding: 0px 4px 0px 0px;">Status
                                    Revisi</label>
                                <select id="status_revisi" name="status_revisi" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="selesai">Selesai</option>
                                    <option value="tidak_selesai">Tidak Selesai</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" onclick="tutup()">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- modal status --}}
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
                $('#form-update').attr('action', '{{ route('update-status-presentasi.mentor', '') }}');

                if (['tidak_selesai', 'menunggu', 'sedang_presentasi'].includes(statuspresentasi)) {
                    statuspresentasi = 'tidak_selesai';
                } else {
                    statuspresentasi = 'selesai';
                }

                if (['', 'tidak_selesai'].includes(statusrevisi)) {
                    statusrevisi = 'tidak_selesai';
                } else {
                    statusrevisi = 'selesai';
                }
                // alert(id + '- ' + statuspresentasi + '- ' + statusrevisi);
                // Set nilai pada select untuk Status Presentasi
                $('#id').val(id);
                $('#status_presentasi').val(statuspresentasi);

                // Set nilai pada select untuk Status Revisi
                $('#status_revisi').val(statusrevisi);

                // Tampilkan modal
                $('#modal-update').modal('show');

            });

            function tutup(){
                $('#modal-update').modal('hide');
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
