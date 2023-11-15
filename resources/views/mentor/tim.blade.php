@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-4 justify-content-center">
        <div class="row">
            <div class="d-flex justify-content-between">
                <div class="card-header fs-4">
                    Daftar Tim
                </div>
                <div id="buatTim" class="d-flex align-items-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatTim">Buat
                        Tim</button>
                </div>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <div class="filter col-lg-3 col-md-3 col-sm-3">
                    <label for="select2Basic" class="form-label">Filter</label>
                    <form id="filterForm" action="{{ route('tim.filter') }}" method="get">
                        <select id="select2Basic" name="status_tim" class="form-select" data-allow-clear="true"
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
                    </form>

                </div>
                <div class="filter col-lg-3 col-md-3 col-sm-3">
                    <label for="select2Basic" class="form-label">Cari</label>
                    <form action="{{ route('cari_tim') }}" method="get">

                        <div class="flex-grow-1 input-group input-group-merge rounded-pill">
                            <span class="input-group-text" id="basic-addon-search31"><i class="ti ti-search"></i></span>
                            <input name="nama_tim" type="text" class="form-control chat-search-input"
                                placeholder="Cari nama tim..." aria-label="Cari nama tim..."
                                aria-describedby="basic-addon-search31" value="{{ request('nama_tim') }}">
                            <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                        </div>
                    </form>
                </div>
            </div>
            @foreach ($tims as $tim)
                <div class="col-md-6 col-lg-3">
                    <div class="card text-center mb-3 tim-item" data-status-tim="{{ $tim->status_tim }}">
                        <div class="card-body">
                            <img src="{{ Storage::url($tim->logo) }}" alt="logo tim" class="rounded-circle mb-3"
                                style="width: 100px; height: 100px; object-fit: cover">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                            @foreach ($tim->user as $anggota)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="top" title="{{ $anggota->username }}"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="{{ $anggota->avatar ? Storage::url($anggota->avatar) : asset('assets/img/avatars/1.png') }}"
                                                        alt="Avatar" style="object-fit: cover">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="mb-0">
                                <span class="badge bg-label-warning">
                                    @if ($tim->status_tim == 'solo')
                                        Solo Project
                                    @elseif ($tim->status_tim == 'pre_mini')
                                        Pre-mini Project
                                    @elseif ($tim->status_tim == 'mini')
                                        Mini Project
                                    @elseif ($tim->status_tim == 'big')
                                        Big Project
                                    @endif
                                </span>
                                @if ($tim->kadaluwarsa == 0)
                                    <span class="ms-1 badge bg-label-danger">
                                        Sudah expired
                                    </span>
                                @elseif ($tim->kadaluwarsa == 1)
                                    <span class="ms-1 badge bg-label-success">
                                        Belum expired
                                    </span>
                                @endif
                            </p>
                            <h5 class="card-title">{{ $tim->nama }}</h5>
                            <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="top" title="Tanggal Dibentuk">
                                {{ $tim->created_at->translatedFormat('l, j F Y') }}
                            </p>
                            <div class="f-flex">

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center mt-3">
            <nav aria-label="Page navigation">
                <div>
                    <ul class="pagination">
                        <!-- Tampilkan link "First" -->
                        <li class="page-item {{ $tims->currentPage() == 1 ? 'disabled' : '' }}">
                            <form action="{{ route('tim.filter') }}" method="post" style="display: inline;">
                                @csrf
                                <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                                <input type="hidden" name="page" value="1">
                                <button type="submit" class="page-link">
                                    <i class="ti ti-arrow-big-left-lines"></i>
                                </button>
                            </form>
                        </li>

                        <!-- Tampilkan link "Previous" -->
                        @if ($tims->onFirstPage())
                            <!-- Jika di halaman pertama, link "Previous" nonaktif -->
                            <li class="page-item disabled">
                                <span class="page-link"><i class="ti ti-arrow-big-left"></i></span>
                            </li>
                        @else
                            <!-- Jika tidak di halaman pertama, tampilkan link "Previous" aktif -->
                            <li class="page-item">
                                <form action="{{ route('tim.filter') }}" method="get" style="display: inline;">
                                   
                                    <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                                    <input type="hidden" name="page" value="{{ $tims->currentPage() - 1 }}">
                                    <button type="submit" class="page-link">
                                        <i class="ti ti-arrow-big-left"></i>
                                    </button>
                                </form>
                            </li>
                        @endif

                        <!-- Tampilkan link halaman -->
                        @php
                            $startPage = max(1, $tims->currentPage() - 3);
                            $endPage = min($tims->lastPage(), $tims->currentPage() + 3);
                        @endphp

                        @for ($i = $startPage; $i <= $endPage; $i++)
                            <li class="page-item {{ $tims->currentPage() == $i ? 'active' : '' }}">
                                <form action="{{ route('tim.filter') }}" method="get" style="display: inline;">
                                   
                                    <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                                    <input type="hidden" name="page" value="{{ $i }}">
                                    <button type="submit" class="page-link">
                                        {{ $i }}
                                    </button>
                                </form>
                            </li>
                        @endfor

                        <!-- Tampilkan link "Next" -->
                        @if ($tims->hasMorePages())
                            <!-- Jika ada halaman berikutnya, tampilkan link "Next" aktif -->
                            <li class="page-item">
                                <form action="{{ route('tim.filter') }}" method="get" style="display: inline;">
                                     
                                    <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                                    <input type="hidden" name="page" value="{{ $tims->currentPage() + 1 }}">
                                    <button type="submit" class="page-link">
                                        <i class="ti ti-arrow-big-right"></i>
                                    </button>
                                </form>
                            </li>
                        @else
                            <!-- Jika tidak ada halaman berikutnya, link "Next" nonaktif -->
                            <li class="page-item disabled">
                                <span class="page-link"><i class="ti ti-arrow-big-right"></i></span>
                            </li>
                        @endif

                        <!-- Tampilkan link "Last" -->
                        <li class="page-item {{ $tims->currentPage() == $tims->lastPage() ? 'disabled' : '' }}">
                            <form action="{{ route('tim.filter') }}" method="get" style="display: inline;">
                                
                                <input type="hidden" name="status_tim" value="{{ request('status_tim') }}">
                                <input type="hidden" name="page" value="{{ $tims->lastPage() }}">
                                <button type="submit" class="page-link">
                                    <i class="ti ti-arrow-big-right-lines"></i>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        {{-- {{ $tims->links('pagination::bootstrap-5') }} --}}

        {{-- Modal Buat Tim --}}
        <form action="{{ route('pembuatan.tim') }}" id="createForm" method="post">
            @csrf
            <div class="modal fade" id="modalBuatTim" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Buat Tim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_tim" class="form-label">Kategori Tim</label>
                                    <select id="status_tim" name="status_tim" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Tim</option>
                                        @foreach ($status_tim as $status)
                                            <option class="text-capitalize" value="{{ $status->id }}">
                                                @if ($status->status === 'pre_mini')
                                                    Pre Mini Project
                                                @elseif ($status->status === 'mini')
                                                    Mini Project
                                                @elseif ($status->status === 'big')
                                                    Big Project
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status_tim')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="kelompok_ketua" style="display: block">
                                <div class="col mb-3">
                                    <label for="ketuaKelompok" class="form-label">Ketua Tim</label>
                                    <select id="ketuaKelompok" name="ketuaKelompok"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Kelompok</option>
                                    </select>
                                    @error('ketuaKelompok')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="anggota" class="form-label">Anggota</label>
                                    <select id="anggota" name="anggota[]" class="select2 form-select selecto" multiple>
                                    </select>
                                    @error('anggota')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{-- Modal Buat Tim --}}

    </div>
@endsection

@section('script')
    <script>
        function filterProjek(selectElement) {
            document.getElementById('filterForm').submit();
        }
    </script>


    {{-- filter projek --}}

    {{-- <script>
        function filterProjek(selectElement) {
            var code = selectElement.value;
            var projekElements = document.getElementsByClassName('tim-item');

            for (var i = 0; i < projekElements.length; i++) {
                var projekElement = projekElements[i];
                var statusTim = projekElement.getAttribute('data-status-tim');

                if (code === 'all' || code === statusTim || code === '') {
                    projekElement.style.display = 'block';
                } else {
                    projekElement.style.display = 'none';
                }
            }
        }
    </script> --}}
    {{-- filter Projek --}}

    {{-- ajax buat tim --}}
    <script>
        get()

        function get() {
            $.ajax({
                url: "{{ route('Project') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    console.log(data)
                    $('#ketuaKelompok').html('')
                    $('#anggota').html('')
                    $("#ketuaKelompok").append("<option disabled selected>Pilih Data</option>");

                    $.each(data.users, function(index, users) {
                        $("#anggota").append("<option value=" + users.id + ">" + users.username +
                            "</option>");
                        $("#ketuaKelompok").append("<option value=" + users.id + ">" + users.username +
                            "</option>");
                    });
                },
                error: function(xhr, status, error) {
                    console.error("Terjasi kesalahan : " + error);
                }
            });
        }

        $('#createForm').submit(function() {
            var status_tim = $('#status_tim').val();
            var ketuaKelompok = $('#ketuaKelompok').val();
            var anggota = $('#anggota').val();

            if (!status_tim || !ketuaKelompok || !anggota.length) {
                event.preventDefault();
                swal.fire('Peringatan', 'Mohon lengkapi data sebelum simpan', 'warning');
            }
        });

        $("#ketuaKelompok").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue) {
                $("#anggota option[value='" + selectedValue + "']").remove();
            }
        });
    </script>
    {{-- ajax buat tim --}}
@endsection
