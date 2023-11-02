@extends('layoutsMentor.app')

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <h5 class="header">List Project</h5>
        {{-- Header --}}
        <div class="d-flex justify-content-between">
            <div class="filter col-lg-3 col-md-3 col-sm-3">
                <label for="select2Basic" class="form-label">Filter</label>
                <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg" data-allow-clear="true">
                    <option value="a">Solo Project</option>
                    <option value="b">Pre-mini Project</option>
                    <option value="b">Mini Project</option>
                    <option value="b">Big Project</option>
                </select>
            </div>
            <div id="buatTim" class="d-flex align-items-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalBuatTim">Buat
                    Tim</button>
            </div>
        </div>
        {{-- Header --}}

        {{-- Card --}}
        <div class="row mt-4">
            @forelse ($projects as $item)
                <div class="col-md-4 col-lg-4 col-sm-4">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-row gap-3">
                                <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="foto logo"
                                    style="width: 100px; height: 100px" class="rounded-circle mb-3">
                                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                    class="">
                                    <span class="text-black fs-6">{{ $item->tim->nama }}</span>
                                    <div class="d-flex align-items-center">
                                        <span class="badge bg-label-warning my-1">{{ $item->tim->status_tim }}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                            <div class="d-flex align-items-center">
                                                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                    @foreach ($item->tim->anggota as $anggota)
                                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                            data-bs-placement="top" title="{{ $anggota->user->username }}"
                                                            class="avatar avatar-sm pull-up">
                                                            <img class="rounded-circle"
                                                                src="{{ asset($anggota->user->avatar) }}" alt="Avatar">
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="info" class="my-4">
                                <div class="d-flex justify-content-between">
                                    <span>Mulai : </span>
                                    <div>{{ $item->created_at->translatedFormat('l, j F Y') }}</div>
                                </div>
                                <div class="d-flex justify-content-between my-3">
                                    <span>Deadline : </span>
                                    <div>{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}</div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <span>Tema : </span>
                                    <div>{{ $item->tema->nama_tema }}</div>
                                </div>
                            </div>
                            <a href="{{ route('detail-projek', $item->code) }}" class="w-100 btn btn-primary">Detail</a>
                        </div>
                    </div>
                </div>
            @empty
                <p>Tidak ada data project</p>
            @endforelse
        </div>
        {{-- Card --}}

        {{-- Modal Buat Tim --}}
        <form action="" id="createForm" method="post">
            @csrf
            <div class="modal fade" id="modalBuatTim" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Buat Tim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="status_tim" class="form-label">Tim</label>
                                    <select id="status_tim" onchange="run()" name="status_tim"
                                        class="select2 form-select form-select-lg" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Tim</option>
                                        @foreach ($status_tim as $status)
                                            <option class="text-capitalize" value="{{ $status->id }}">
                                                {{ $status->status }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_tim')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="kelompok_ketua" style="display: block">
                                <div class="col mb-3">
                                    <label for="ketuaKelompok" class="form-label">Ketua Kelompok</label>
                                    <select id="ketuaKelompok" name="ketuaKelompok"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Kelompok</option>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->username }}</option>
                                        @endforeach
                                    </select>
                                    @error('ketuaKelompok')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>
                            <div class="row" id="project_ketua" style="display: block">
                                <div class="col mb-3">
                                    <label for="KetuaProject" class="form-label">Ketua Projek</label>
                                    <select id="KetuaProject" name="ketuaProjek"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Projek</option>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="anggota" class="form-label">Anggota</label>
                                    <select id="anggota" name="anggota[]" class="select2 form-select selecto" multiple>
                                        @foreach ($users as $data)
                                            <option value="{{ $data->id }}">{{ $data->username }}</option>
                                        @endforeach
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
                            <button type="submit" class="btn btn-primary" id="btnSimpan">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- Tambahkan jQuery jika belum ada -->


        <script>
            $(document).ready(function() {
                // Fungsi untuk menangani pembuatan tim menggunakan AJAX
                function createTim() {
                    // Mendapatkan data formulir
                    $('#loader').show();
                    var formData = new FormData($('#createForm')[0]);
                    // Menggunakan AJAX untuk mengirim data ke server
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('pembuatan.tim') }}',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            // Tanggapan dari server, bisa ditangani sesuai kebutuhan
                            console.log(response);
                            // Tutup modal
                            $('#status_tim').val('');
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Data Berhasil Ditambahkan',
                            });
                            $('#ketuaKelompok, #status_tim, #anggota').val(null).trigger('change');
                            $('#modalBuatTim').modal('hide');
                            $('#loader').fadeOut();
                            $('.preloader').fadeIn(500).delay(500).fadeOut(500, function() {
                                location.reload(true);
                            });
                        },
                        error: function(error) {
                            $('#modalBuatTim').modal('hide');
                            // Tanggapan error dari server
                            console.log(error);
                            var errorMessage = 'Pastikan data terisi semua.';
                            if (error.response && error.response.data && error.response.data.message) {
                                errorMessage = error.response.data.message;
                            }
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: errorMessage,
                            });
                            $('#loader').fadeOut();
                        }
                    });
                }

                // Menangani submit formulir menggunakan AJAX
                $('#createForm').submit(function(e) {
                    e.preventDefault(); // Mencegah formulir melakukan submit bawaan
                    createTim(); // Panggil fungsi untuk membuat tim menggunakan AJAX
                });
            });
        </script>




        <script>
            function run() {
                const status = document.getElementById('status_tim').value;
                let project_ketua = document.getElementById('project_ketua');

                if (status == 2) {
                    project_ketua.style = 'display: none';
                } else {
                    project_ketua.style = 'display: block';
                }
            }
        </script>
        <script>
            $(document).ready(function() {
                let selectedOptions = {};

                function disableSelectedOptions(select) {
                    let selectedValues = $(select).val();

                    // Menyimpan nilai opsi yang dipilih
                    selectedOptions[$(select).attr('id')] = selectedValues;

                    $("select").not(select).each(function() {
                        let currentSelect = this;
                        $(this).find('option').each(function() {
                            let optionValue = $(this).val();

                            // Mengatur opsi yang dipilih di dropdown lainnya menjadi nonaktif
                            if (selectedValues && selectedValues.includes(optionValue)) {
                                $(this).prop('disabled', true);
                            } else {
                                $(this).prop('disabled', false);
                            }
                        });
                    });
                }

                // Event handler saat memilih opsi di ketuaKelompok, KetuaProject, atau anggota
                $("#ketuaKelompok, #KetuaProject, #anggota").change(function() {
                    disableSelectedOptions(this);
                });

                // Event handler saat memfokuskan pada ketuaKelompok, KetuaProject, atau anggota
                $("#ketuaKelompok, #KetuaProject, #anggota").focus(function() {
                    disableSelectedOptions(this);
                });

                // Event handler saat kehilangan fokus pada ketuaKelompok, KetuaProject, atau anggota
                $("#ketuaKelompok, #KetuaProject, #anggota").blur(function() {
                    // Mengembalikan opsi yang telah dinonaktifkan
                    $("select").each(function() {
                        let selectId = $(this).attr('id');
                        let originalOptions = selectedOptions[selectId];
                        if (originalOptions) {
                            $(this).html(originalOptions);
                        }
                    });

                    // Menonaktifkan opsi yang telah dipilih di dropdown lainnya
                    for (let selectId in selectedOptions) {
                        if (selectedOptions.hasOwnProperty(selectId)) {
                            let selectedValues = selectedOptions[selectId];
                            $("select#" + selectId + " option").each(function() {
                                let optionValue = $(this).val();
                                if (selectedValues && selectedValues.includes(optionValue)) {
                                    $(this).prop('disabled', true);
                                }
                            });
                        }
                    }
                });
            });
        </script>
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
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
@endsection
