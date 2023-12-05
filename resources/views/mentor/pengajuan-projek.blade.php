@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-5 justify-content-center">
        <div class="card-header fs-4">
            Daftar Pengajuan Project
        </div>
        <div class="row">
            <div class="d-flex justify-content-between mb-4">
                <div class="filter col-lg-3 col-md-3 col-sm-3">
                    <label for="select2Basic" class="form-label">Filter</label>
                    <form id="filterForm" action="{{ route('pengajuan-projek') }}" method="get">
                        <select id="select2Basic" name="status_tim" class="form-select select2" data-allow-clear="true"
                            onchange="filterProjek(this)">
                            <option value="" disabled selected>Pilih Data</option>
                            <option value="all" {{ request('status_tim') == 'all' ? 'selected' : '' }}>Semua</option>
                            <option value="solo" {{ request('status_tim') == 'solo' ? 'selected' : '' }}>Solo Project
                            </option>
                            <option value="pre_mini" {{ request('status_tim') == 'pre_mini' ? 'selected' : '' }}>Pre-mini
                                Project</option>
                            <option value="mini" {{ request('status_tim') == 'mini' ? 'selected' : '' }}>Mini Project
                            </option>
                            <option value="big" {{ request('status_tim') == 'big' ? 'selected' : '' }}>Big Project
                            </option>
                        </select>
                        <input type="hidden" name="nama_tim" value="{{ request('nama_tim') }}">
                    </form>
                </div>
                <div class="filter col-lg-3 col-md-3 col-sm-3">
                    <label for="select2Basic" class="form-label">Cari</label>
                    <form action="{{ route('pengajuan-projek') }}" method="get">
                        <div class="flex-grow-1 input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                            <input name="nama_tim" type="text" class="form-control chat-search-input"
                                placeholder="Cari nama tim..." aria-label="Cari nama tim..."
                                aria-describedby="basic-addon-search31" value="{{ request('nama_tim') }}">
                        </div>
                        <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                    </form>
                </div>
            </div>

            @forelse ($projects as $item)
                @php
                    $anggotaArray = [];
                    foreach ($item->tim->anggota as $anggota) {
                        $anggotaArray[] = [
                            'username' => $anggota->user->username,
                            'avatar' => $anggota->user->avatar,
                            'jabatan' => $anggota->jabatan->nama_jabatan,
                        ];
                    }
                    $anggotaJson = json_encode($anggotaArray);

                    $temaArray = [];
                    foreach ($item->tim->tema as $tema) {
                        $temaArray[] = [
                            'tema_id' => $tema->id,
                            'tema_code' => $tema->code,
                            'nama_tema' => $tema->nama_tema,
                        ];
                    }
                    $temaJson = json_encode($temaArray);
                @endphp
                <div class="col-md-6 col-lg-4">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim"
                                class="rounded-circle mb-3" style="width: 100px; height: 100px">
                            <h5 class="card-title">{{ $item->tim->nama }}</h5>
                            <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                <div class="d-flex align-items-center">
                                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                        @foreach ($item->tim->anggota as $anggota)
                                            <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                                title="{{ $anggota->user->username }}" class="avatar avatar-sm pull-up">
                                                <img class="rounded-circle"
                                                    src="{{ $anggota->user->avatar ? asset('storage/' . $anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                    alt="Avatar">
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <a>
                                <span class="badge bg-label-warning mb-3">
                                    @if ($item->tim->status_tim == 'solo')
                                        Solo Project
                                    @elseif ($item->tim->status_tim == 'pre_mini')
                                        Pre-Mini Project
                                    @elseif ($item->tim->status_tim == 'mini')
                                        Mini Project
                                    @elseif ($item->tim->status_tim == 'big')
                                        Big Project
                                    @endif
                                </span>
                            </a>
                            <p class="card-text">{{ $item->created_at->translatedFormat('l, j F Y') }}</p>
                            <a data-bs-toggle="modal" data-bs-target="#modalDetail" data-nama-tim="{{ $item->tim->nama }}"
                                data-type-project="@if ($item->tim->status_tim == 'solo') Solo Project
                            @elseif ($item->tim->status_tim == 'pre_mini')
                                Pre-Mini Project
                            @elseif ($item->tim->status_tim == 'mini')
                                Mini Project
                            @elseif ($item->tim->status_tim == 'big')
                                Big Project @endif"
                                data-logo="{{ asset('storage/' . $item->tim->logo) }}"
                                data-created-at="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                data-anggota="{{ $anggotaJson }}" data-tema="{{ $temaJson }}"
                                class="btn btn-primary btn-detail w-100"><span class="text-white">Detail</span></a>
                        </div>
                    </div>
                </div>
            @empty
                <h6 class="text-center mt-4">Tidak Ada Pengajuan Projek <i class="ti ti-address-book-off"></i></h6>
                <div class="mt-4 mb-3 d-flex justify-content-evenly">
                    <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                        alt="page-misc-under-maintenance" width="300" class="img-fluid">
                </div>
            @endforelse
        </div>
        <div>
            {{ $projects->links('pagination::bootstrap-5') }}
        </div>

        <!-- Modal Terima-->
        <div class="modal fade" id="modalTerima" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Terima Pengajuan Projek</h5>
                        <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#modalDetail"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" id="terima-project">
                            @csrf
                            @method('PATCH')
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="tema" class="form-label">Tema Projek</label>
                                    <select id="tema" name="temaInput" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option disabled selected>Pilih Data</option>
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
                                        Jika tidak di isi maka deadline akan menyesuaikan status tim (Jika di isi, deadline
                                        harus
                                        1 minggu dari sekarang)
                                    </div>
                                    <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                        name="deadlineInput" id="deadline" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail">Kembali</button>
                                <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                                            <img src="" id="logo-tim" alt="logo tim"
                                                style="width: 100px; height: 100px" class="rounded-circle mb-3">
                                            <div
                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                <span class="d-block text-black fs-4 mb-2" id="nama-tim"></span>
                                                <span class="badge bg-label-warning" id="type-project"></span>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-wrap"
                                            style="display: flex; flex-direction: column; justify-items: center; align-items: center; padding: 30px 5px">
                                            <span class="d-block text-black fs-5">Tanggal Pengajuan</span>
                                            <span class="d-block" style="font-size: 13px" id="created-at"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div style="display: flex; align-content: center; align-items: center;">
                                            <span class="text-black fs-5">Anggota Tim : </span>
                                        </div>
                                        <div>
                                            <button type="button" id="btn-terima" data-bs-toggle="modal"
                                                data-bs-target="#modalTerima" class="btn btn-success"
                                                data-tema="">Terima</button>
                                        </div>
                                    </div>
                                    <div
                                        class="d-flex flex-row flex-wrap mt-3 justify-content-center align-content-center gap-3">
                                        <!-- Anggota Tim -->
                                        <div class="content-1 col-md-3 col-xl-3 col-sm-12 mb-4">
                                            <div class="card h-100">
                                                <div class="table-responsive">
                                                    <table class="table table-borderless">
                                                        <tbody id="anggota-list">
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
                                                        <tbody id="tema-list">
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


    </div>
@endsection

@section('script')
    {{-- script modal detail --}}
    <script>
        $(document).ready(function() {
            $('.btn-detail').click(function() {
                var namaTim = $(this).data('nama-tim');
                var typeProject = $(this).data('type-project');
                var logo = $(this).data('logo');
                var createdAt = $(this).data('created-at');
                var anggota = $(this).data('anggota');
                var tema = $(this).data('tema');
                var temaHtml = JSON.stringify(tema);

                $('#btn-terima').attr('data-tema', temaHtml);
                $('#nama-tim').text(namaTim);
                $('#type-project').text(typeProject);
                $('#created-at').text(createdAt);
                $('#logo-tim').attr('src', logo);

                var anggotaList = $('#anggota-list');
                anggotaList.empty();

                anggota.forEach(function(anggota, index) {
                    var avatarSrc = anggota.avatar ? '/storage/' + anggota.avatar :
                        '/assets/img/avatars/1.png';

                    var anggotaItem = $(
                        '<tr>' +
                        '<td>' +
                        '<div class="d-flex align-items-center mt-lg-3">' +
                        '<div class="avatar me-3 avatar-sm">' +
                        '<img src="' + avatarSrc +
                        '" alt="Avatar" class="h-auto rounded-circle" />' +
                        '</div>' +
                        '<div class="d-flex flex-column">' +
                        '<h6 class="mb-0">' + anggota.username + '</h6>' +
                        '<small class="text-truncate text-muted">' + anggota.jabatan +
                        '</small>' +
                        '</div>' +
                        '</div>' +
                        '</td>' +
                        '</tr>'
                    );

                    anggotaList.append(anggotaItem);
                });

                var temaList = $('#tema-list');
                temaList.empty();

                tema.forEach(function(tema, index) {
                    var temaItem = $(
                        '<tr>' +
                        '<td>' + (index + 1) + '.' + '</td>' +
                        '<td>' + tema.nama_tema + '</td>' +
                        '</tr>'
                    );
                    temaList.append(temaItem);
                });
            });

            $('#btn-terima').click(function() {
                var tema = $(this).data('tema');
                var temaList = $('#tema');
                temaList.empty();
                temaList.append("<option disabled selected value=''>Pilih tema</option>");
                tema.forEach(function(tema, index) {
                    temaList.append("<option data-url=" + tema.tema_code + " value=" + tema
                        .tema_id + ">" + tema.nama_tema +
                        "</option>");
                });

                temaList.on('change', function() {
                    var selectedTema = $(this).find(':selected').data('url');
                    var formAction =
                        "{{ route('persetujuan-project', ['code' => ':temaId']) }}";
                    formAction = formAction.replace(':temaId', selectedTema);
                    $('#terima-project').attr('action', formAction);
                });

            });

            const oneWeekFromToday = new Date();
            oneWeekFromToday.setDate(oneWeekFromToday.getDate() + 7);

            flatpickr("#deadline", {
                minDate: oneWeekFromToday,
                dateFormat: "Y-m-d",
            });


        });

        function filterProjek(selectElement) {
            document.getElementById('filterForm').submit();
        }
    </script>
    {{-- script modal detail --}}


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
                        showConfirmButton: false,
                        timer: 3000,
                    });
                    return;
                }
            });
        });
    </script>
    {{-- Validasi --}}
@endsection
