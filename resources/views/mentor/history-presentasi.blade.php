@extends('layoutsMentor.app')

@section('content')
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
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
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
                                @foreach ($tidakPresentasi as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td>
                                            @if ($item->status_tim === 'solo')
                                                <span class="badge bg-label-danger">Solo Project</span>
                                            @elseif ($item->status_tim === 'pre_mini')
                                                <span class="badge bg-label-warning">Pre Mini Project</span>
                                            @elseif ($item->status_tim === 'mini')
                                                <span class="badge bg-label-success">Mini Project</span>
                                            @else
                                                <span class="badge bg-label-primary">Big Project</span>
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                                        <td><button class="btn btn-warning" data-bs-target="#modal" data-bs-toggle="modal"
                                                data style="padding: 10px;"><i
                                                    class="fa-solid fa-pen-to-square"></i></button></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="card p-3">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel2" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA TIM</th>
                                    <th scope="col">STATUS TIM</th>
                                    <th scope="col">HARI/TANGGAL</th>
                                    <th scope="col">STATUS PRESENTASI</th>
                                    <th scope="col">STATUS REVISI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($presentasiSelesai as $item)
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
                                            @if ($item->status_presentasi === 'tidak_selesai')
                                                <span class="badge bg-label-danger">Tidak Selesai</span>
                                            @elseif ($item->status_presentasi === 'selesai')
                                                <span class="badge bg-label-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_revisi === 'tidak_selesai')
                                                <span class="badge bg-label-danger">Tidak Selesai</span>
                                            @elseif ($item->status_revisi === 'selesai')
                                                <span class="badge bg-label-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-present" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="card p-3">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel4" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA TIM</th>
                                    <th scope="col">STATUS TIM</th>
                                    <th scope="col">HARI/TANGGAL</th>
                                    <th scope="col">STATUS PRESENTASI</th>
                                    <th scope="col">STATUS REVISI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    function terjemahkanHari($namaHari)
                                    {
                                        switch ($namaHari) {
                                            case 'Monday':
                                                return 'Senin';
                                            case 'Tuesday':
                                                return 'Selasa';
                                            case 'Wednesday':
                                                return 'Rabu';
                                            case 'Thursday':
                                                return 'Kamis';
                                            case 'Friday':
                                                return 'Jumat';
                                            default:
                                                return $namaHari;
                                        }
                                    }

                                    function terjemahkanBulan($namaBulan)
                                    {
                                        switch ($namaBulan) {
                                            case 'January':
                                                return 'Januari';
                                            case 'February':
                                                return 'Februari';
                                            case 'March':
                                                return 'Maret';
                                            case 'April':
                                                return 'April';
                                            case 'May':
                                                return 'Mei';
                                            case 'June':
                                                return 'Juni';
                                            case 'July':
                                                return 'Juli';
                                            case 'August':
                                                return 'Agustus';
                                            case 'September':
                                                return 'September';
                                            case 'October':
                                                return 'Oktober';
                                            case 'November':
                                                return 'November';
                                            case 'December':
                                                return 'Desember';
                                            default:
                                                return $namaBulan;
                                        }
                                    }
                                @endphp
                                @foreach ($presentasiSelesaiMingguan as $item)
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
                                            @php
                                                $tanggal = $item->created_at;
                                                $namaHari = terjemahkanHari($tanggal->format('l'));
                                                $namaBulan = terjemahkanBulan($tanggal->format('F'));
                                            @endphp

                                            {{ $namaHari }}, {{ $tanggal->format('j') }} {{ $namaBulan }}
                                            {{ $tanggal->format('Y') }}
                                        </td>
                                        <td>
                                            @if ($item->status_presentasi === 'tidak_selesai')
                                                <span class="badge bg-label-danger">Tidak Selesai</span>
                                            @elseif ($item->status_presentasi === 'selesai')
                                                <span class="badge bg-label-success">Selesai</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->status_revisi === 'tidak_selesai')
                                                <span class="badge bg-label-danger">Tidak Selesai</span>
                                            @elseif ($item->status_revisi === 'selesai')
                                                <span class="badge bg-label-success">Selesai</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-aduh" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                <div class="card p-3">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel3" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA TIM</th>
                                    <th scope="col">STATUS TIM</th>
                                    <th scope="col">HARI/TANGGAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tidakPresentasiMingguan as $item)
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
                                            @php
                                                $tanggal = $item->created_at;
                                                $namaHari = terjemahkanHari($tanggal->format('l'));
                                                $namaBulan = terjemahkanBulan($tanggal->format('F'));
                                            @endphp
                                            {{ $namaHari }}, {{ $tanggal->format('j') }} {{ $namaBulan }}
                                            {{ $tanggal->format('Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Buat Tim --}}
        {{-- <form action="{{ route('pembuatan.tim') }}" id="createForm" method="post"> --}}
        @csrf
        <div class="modal fade" id="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Status Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
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
