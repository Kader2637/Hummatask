@extends('layoutsMentor.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3">
            <span class="text-muted fw-light"></span> History
        </h4>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class="nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <form id="filterForm" action="{{ route('tim') }}" method="get">
                    <select id="select2Basic" name="status_tim" class="form-select select2" data-allow-clear="true">
                        <option value="" disabled selected>Pilih Data</option>
                        <option value="belum_presentasi">Belum Presentasi Hari
                        </option>
                        <option value="selesai_presentasi">Selesai Presentasi Hari Ini Project</option>
                        <option value="sudah_presentasi">Sudah
                            Presentasi Minggu Ini
                        </option>
                        <option value="tidak_presentasi">Tidak Presentasi Mingguan
                        </option>
                    </select>
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
                                <td>{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                                <td>
                                    <button class="btn btn-warning btn-edit" data-bs-toogle="modal" id="btn-edit-{{ $item->id }}" data-id="{{ $item->id }}" style="padding: 10px;"><i class="fa-solid fa-pen-to-square"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Modal Buat Tim --}}
        {{-- <form action="{{ route('pembuatan.tim') }}" id="createForm" method="post"> --}}
        <div class="modal fade" id="modal-update" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Status Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-update" method="post"></form>
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
                </div>
            </div>
        </div>
        {{-- </form> --}}
        {{-- Modal Buat Tim --}}
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        $('.btn-edit').click(function() {
            const formData = $(this).data('id');
            alert($(this).data('id'));
        });
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
