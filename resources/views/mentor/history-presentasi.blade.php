@extends('layoutsMentor.app')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3">
      <span class="text-muted fw-light"></span> History
    </h4>
    <div class="d-flex card flex-md-row align-items-center justify-content-between">
      <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-tab="1"><i
              class="fa-solid fa-calendar-xmark icon-text me-2"></i>Belum Presentasi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
            type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
              class="fa-solid fa-person-chalkboard icon-text me-2"></i>Selesai Presentasi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-aduh"
            type="button" role="tab" aria-controls="pills-aduh" aria-selected="false" data-tab="2"><i
              class="fa-solid fa-person-chalkboard icon-text me-2"></i>Tidak Presentasi Mingguan</button>
        </li>
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
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
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
                    <td>{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
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
@endsection
