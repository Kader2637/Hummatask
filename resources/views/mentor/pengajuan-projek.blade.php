@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-4 ">
        <h5 class="header">Daftar Pengajuan Projek</h5>
        <div class="row">
            @forelse ($projects as $item)
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim" class="rounded-circle mb-3"
                                style="width: 100px; height: 100px">
                            <h5 class="card-title">{{ $item->tim->nama }}</h5>
                            <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                <div class="d-flex align-items-center">
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach ($item->tim->anggota as $anggota)
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $anggota->user->username }}" class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle" src="{{ $anggota->user->avatar }}"
                                                    alt="Avatar">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <a href="#"><span
                                    class="badge bg-label-warning mb-3">{{ $item->tim->status_tim }}</span></a>
                            <p class="card-text">{{ $item->created_at->translatedFormat('l, j F Y') }}</p>
                            <a  data-bs-toggle="" data-bs-target="#Detail" class="btn btn-primary"><span
                                    class="text-white">Detail</span></a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada data pengajuan project</p>
            @endforelse
        </div>

        {{-- pagination --}}
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-end">
                <li class="page-item first">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-left ti-xs"></i></a>
                </li>
                <li class="page-item prev">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-left ti-xs"></i></a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">1</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">2</a>
                </li>
                <li class="page-item active">
                    <a class="page-link" href="javascript:void(0);">3</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">4</a>
                </li>
                <li class="page-item">
                    <a class="page-link" href="javascript:void(0);">5</a>
                </li>
                <li class="page-item next">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevron-right ti-xs"></i></a>
                </li>
                <li class="page-item last">
                    <a class="page-link" href="javascript:void(0);"><i class="ti ti-chevrons-right ti-xs"></i></a>
                </li>
            </ul>
        </nav>
        {{-- pagination --}}

        {{-- Modal Detail --}}
        <div class="modal fade" id="modalDetail" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Detail tim</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid mt-4">
                            <h5 class="header">Detail Pengajuan Projek</h5>
                            <div class="card">
                                <div class="card-body">
                                    <div class="content-profile d-flex flex-wrap flex-row justify-content-between">
                                        <div class="d-flex flex-row gap-3 justify-content-center">
                                            <img src="" alt="logo tim" class="h-auto rounded-circle mb-3">
                                            <div
                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                <span class="d-block text-black fs-4 mb-2">NAMA TIM</span>
                                                {{-- @if ($projects->tim->status_tim == 'solo') --}}
                                                <span class="badge bg-label-warning">Solo Project</span>
                                                {{-- @elseif ($projects->tim->status_tim == 'pre_mini')
                                                    <span class="badge bg-label-warning">Pre Mini Project</span>
                                                @elseif ($projects->tim->status_tim == 'mini')
                                                    <span class="badge bg-label-warning">Mini Project</span>
                                                @elseif ($projects->tim->status_tim == 'pre_big')
                                                    <span class="badge bg-label-warning">Pre Big Project</span>
                                                @elseif ($projects->tim->status_tim == 'big')
                                                    <span class="badge bg-label-warning">Big Project</span>
                                                @endif --}}
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap"
                                            style="display: flex; flex-direction: column; justify-items: center; align-items: center; padding: 30px 5px">
                                            <span class="d-block text-black fs-5">Tanggal Pengajuan</span>
                                            <span class="d-block" style="font-size: 13px">CREATED AT</span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div style="display: flex; align-content: center; align-items: center;">
                                            <span class="text-black fs-5">Anggota Tim : </span>
                                        </div>
                                        <div>
                                            {{-- @if ($projects->status_project == 'notapproved') --}}
                                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#modalTerima">Terima</button>
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex flex-row flex-wrap mt-3 justify-content-center align-content-center gap-3">
                                        <!-- Anggota Tim -->
                                        <div class="content-1 col-md-3 col-xl-3 col-sm-12 mb-4">
                                            <div class="card h-100">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tbody>
                                                            <tr>
                                                                <td>DAFTAR ANGGOTA</td>
                                                            </tr>
                                                            {{-- @forelse ($projects->tim->anggota as $item)
                                                                <tr>
                                                                    <td>
                                                                        <div class="d-flex align-items-center mt-lg-3">
                                                                            <div class="avatar me-3 avatar-sm">
                                                                                <img src="{{ $item->user->avatar }}"
                                                                                    alt="Avatar"
                                                                                    class="rounded-circle" />
                                                                            </div>
                                                                            <div class="d-flex flex-column">
                                                                                <h6 class="mb-0">
                                                                                    {{ $item->user->username }}</h6>
                                                                                <small
                                                                                    class="text-truncate text-muted">{{ $item->jabatan->nama_jabatan }}</small>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            @empty
                                                                <tr>
                                                                    <td>
                                                                        Data tidak ada.
                                                                    </td>
                                                                </tr>
                                                            @endforelse --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!--/ Anggota Tim -->

                                        {{-- List Tema --}}
                                        <div class="content-1 col-md-8 col-xl-8 col-sm-12 mb-4">
                                            <div class="card h-100">
                                                <h5 class="card-header">List Tema Projek</h5>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>No.</th>
                                                                <th>Tema</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>TEMA 1</td>
                                                                <td>TEMA 1</td>
                                                            </tr>
                                                            {{-- @forelse ($projects->tim->tema as $item)
                                                                <tr>
                                                                    <td>{{ $loop->iteration }}.</td>
                                                                    <td>{{ $item->nama_tema }}</td>
                                                                @empty
                                                            @endforelse --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Modal Detail --}}

        <!-- Modal Terima-->
        <div class="modal fade" id="modalTerima" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Terima Pengajuan Projek</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="terima-project">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="select2Basic" class="form-label">Tema Projek</label>
                                    <select id="select2Basic" name="temaInput" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Data</option>
                                        {{-- @foreach ($projects->tim->tema as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_tema }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="flatpickr-date" class="form-label">Tentukan Deadline</label>
                                    <div class="alert alert-warning d-flex align-items-center cursor-pointer"
                                        role="alert">
                                        <span class="alert-icon text-warning me-2">
                                            <i class="ti ti-bell ti-xs"></i>
                                        </span>
                                        Jika tidak di isi maka deadline akan menyesuaikan status tim (Jika di isi eadline
                                        harus
                                        1 minggu dari sekarang)
                                    </div>
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                        name="deadlineInput" id="flatpickr-date" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Validasi --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ajukanModal = document.getElementById('terima-project');

                ajukanModal.addEventListener('submit', function(event) {
                    const temaInput = document.querySelector('select[name="temaInput"]');
                    const deadlineInput = document.querySelector('input[name="deadlineInput"]');

                    // Validasi input kosong
                    if (temaInput.value.trim() === '') {
                        event.preventDefault(); // Mencegah pengiriman formulir
                        Swal.fire({
                            icon: 'warning',
                            title: 'Peringatan',
                            text: 'Inputkan Tema Project!',
                        });
                        return;
                    }
                });
            });
        </script>
        {{-- Validasi --}}

        <!-- Modal Terima-->

    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
@endsection
