@extends('layoutsMentor.app')
<meta name="csrf-token" content="{{ csrf_token() }}">

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-5 justify-content-center">
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
            <div class="d-flex justify-content-between mb-4 gap-2">
                <div class="filter col-lg-3 col-md-3 col-sm-3">
                    <label for="select2Basic" class="form-label">Filter</label>
                    <form id="filterForm" action="{{ route('tim') }}" method="get">
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
                    <form action="{{ route('tim') }}" method="get">
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
            @forelse ($tims as $tim)
                <div class="col-md-6 col-lg-4">
                    <div class="card text-center mb-3 tim-item" data-status-tim="{{ $tim->status_tim }}">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $tim->logo) }}" alt="logo tim" class="rounded-circle mb-3"
                                style="width: 100px; height: 100px; object-fit: cover">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                            @foreach ($tim->anggota_tim() as $anggota)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="bottom" title="{{ $anggota->user->username }}"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="{{ $anggota->user->avatar ? asset('storage/' . $anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                        alt="Avatar" style="object-fit: cover">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                @if ($tim->kadaluwarsa == 1)
                                    <span class="ms-1 badge bg-label-danger">
                                        Expired Team
                                    </span>
                                @elseif ($tim->kadaluwarsa == 0)
                                    <span class="ms-1 badge bg-label-success">
                                        Active Team
                                    </span>
                                @endif
                                <span class="badge bg-label-primary text-capitalize">{{ $tim->divisi->name }}</span>
                            <h5 class="card-title">{{ $tim->nama }}</h5>
                            <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="bottom" title="Deadline Project">
                                {{ $tim->project->isNotEmpty() && isset($tim->project[0]) ? \Carbon\Carbon::parse($tim->project[0]->deadline)->translatedFormat('l j F Y') : 'Tim ini belum memiliki project' }}
                            </p>
                            <div class="d-flex justify-content-center">
                                @if ($tim->status_tim == 'solo')
                                    <div class="form-check form-switch mb-2">
                                        <input class="form-check-input flexSwitchCheckDefault" type="checkbox"
                                            id="flexSwitchCheckDefault{{ $tim->id }}"
                                            data-uri="/mentor/solo/edit/{{ $tim->id }}"
                                            data-kadaluwarsa="{{ $tim->kadaluwarsa }}"
                                            data-anggota="{{ json_encode($tim->anggota_id()) }}"
                                            @if ($tim->kadaluwarsa == 0) checked @endif>
                                        <label class="form-check-label" for="flexSwitchCheckDefault">Kondisi Tim</label>
                                    </div>
                                @else
                                    <a data-bs-toggle="modal" data-bs-target="#edit"
                                        class="w-100 btn btn-primary btn-detail-projek edit-tim btn-edit"
                                        data-anggota="{{ json_encode($tim->anggota_id()) }}" data-id="{{ $tim->id }}"
                                        data-url="/mentor/tim/edit/{{ $tim->id }}"
                                        data-status="{{ $tim->status_tim }}" data-logo="{{ $tim->logo }}"
                                        data-tema=" {{ $tim->project[0]->tema->nama_tema ?? '' }}"
                                        data-kadaluwarsa="{{ $tim->kadaluwarsa }}">
                                        <span class="text-white">Edit Tim</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h6 class="text-center mt-4">Tidak Ada Projek <i class="ti ti-address-book-off"></i></h6>
                <div class="mt-4 mb-3 d-flex justify-content-evenly">
                    <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                        alt="page-misc-under-maintenance" width="300" class="img-fluid">
                </div>
            @endforelse
        </div>
        <div>
            {{ $tims->links('pagination::bootstrap-5') }}
        </div>

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
    <form method="post" id="updateTimForm">
        @csrf
        <input type="hidden" name="modalDataId" id="modalDataIdInput" value="">
        <input type="hidden" id="logoInput" name="logo" value="">
        {{-- <input type="text" id="exp" value=""> --}}
        <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Edit Tim</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p id="modalDataId"></p>
                        <div class="row">
                            <div class="temas col mb-3">
                                <label for="status_tim" class="form-label">Tema Tim</label>
                                <input name="tema" id="tema" required type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="status_tim" class="form-label">Kategori Tim</label>
                                <select id="tim_status_modal" name="status_tim" class="select2 form-select form-select"
                                    data-allow-clear="true">
                                    <option value="" disabled selected>Pilih Data</option>
                                    <option class="nowStatus" value="pre_mini">Pre mini projek</option>
                                    <option class="nowStatus" value="mini">Mini projek</option>
                                    <option class="nowStatus" value="big">Big projek</option>
                                </select>

                                @error('status_tim')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row" id="kelompok_ketua" style="display: block">
                            <div class="col mb-3">
                                <label for="ketua" class="form-label">Ketua Tim</label>
                                <select id="ketua" name="ketuaKelompok"
                                    class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                    <option value="" disabled selected>Pilih Kelompok</option>
                                </select>
                                @error('ketua')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="anggota_kelompok" class="form-label">Anggota</label>
                                <select id="anggota_kelompok" name="anggota[]" class="select2 form-select selecto"
                                    multiple>
                                </select>
                                @error('anggota_kelompok')
                                    <p class="text-danger">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="ketua" class="form-label">Kondisi Tim</label>

                            <div class="form-check">
                                <input name="kadaluwarsa" class="form-check-input aktif" type="radio" value="0"
                                    id="aktif" />

                                <label class="form-check-label" for="aktif">
                                    Aktif
                                </label>
                            </div>
                            <div class="form-check mt-3">
                                <input name="kadaluwarsa" class="form-check-input aktif" id="deaktif" type="radio"
                                    value="1" />

                                <label class="form-check-label" for="deaktif">
                                    De aktif
                                </label>
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
    </form>
@endsection

@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            // Ambil nilai dan atribut yang diperlukan saat halaman dimuat
            var uri = $('.flexSwitchCheckDefault').data('uri');
            var kadaluwarsa = $('.flexSwitchCheckDefault').data('kadaluwarsa');
            var kadaluwarsa = $('.flexSwitchCheckDefault').data('anggota');
            var ikan = $('meta[name="csrf-token"]').attr('content');

            // Perbarui nilai checkbox berdasarkan kondisi
            if ($('.flexSwitchCheckDefault').prop('checked') && kadaluwarsa == 1) {
                $('.flexSwitchCheckDefault').prop('checked', false);
            } else if (!$('.flexSwitchCheckDefault').prop('checked') && kadaluwarsa == 0) {
                $('.flexSwitchCheckDefault').prop('checked', true);
            }
        });

        $(document).ready(function() {
            $('.flexSwitchCheckDefault').on('change', function() {
                var uri = $(this).data('uri');
                var isChecked = $(this).prop('checked');
                var kadaluwarsa = $(this).data('kadaluwarsa');
                var anggota = $(this).data('anggota');
                var isChecked = $(this).prop('checked');
                var token = ($('meta[name="csrf-token"]').attr('content'));

                // Perbarui nilai checkbox berdasarkan kondisi
                if (isChecked && kadaluwarsa == 1) {
                    $(this).prop('checked', false);
                } else if (!isChecked && kadaluwarsa == 0) {
                    $(this).prop('checked', true);
                }

                // Lakukan permintaan Ajax di sini jika diperlukan
                $.ajax({
                    url: uri,
                    method: 'POST', // Gantilah dengan metode HTTP yang sesuai
                    data: {
                        _token: token,
                        kadaluwarsa: isChecked ? 0 : 1,
                        anggota: anggota
                    },
                    success: function(data) {
                        $('#saveButton').hide();

                        Swal.fire({
                            title: 'Sukses',
                            text: 'Kondisi berhasil diperbarui.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 1700,
                        }).then(() => {
                            $('#updateTimForm ').modal('hide');
                            $('#saveButton').show();

                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, errors) {
                        console.log('Response:', xhr.responseText);

                        if (xhr.status === 422) {
                            // Handle validation errors
                            var errorMessages = xhr.responseJSON.errors;

                            // Display error messages to the user (you can customize this part based on your needs)
                            var errorMessageText = 'Terjadi kesalahan:';
                            for (var key in errorMessages) {
                                errorMessageText += '\n' + errorMessages[key];
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errorMessageText,
                                showConfirmButton: false,
                            });
                        } else {
                            // For other errors, display a generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan: ' + errors,
                                showConfirmButton: false,
                            });
                        }
                    }
                });
            })


            $('#updateTimForm').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    success: function(data) {
                        $('#saveButton').hide();

                        Swal.fire({
                            title: 'Sukses',
                            text: 'Tim berhasil diperbarui.',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 2000,
                        }).then(() => {
                            $('#updateTimForm ').modal('hide');
                            $('#saveButton').show();

                            window.location.reload();
                        });
                    },
                    error: function(xhr, status, errors) {
                        console.log('Response:', xhr.responseText);

                        if (xhr.status === 422) {
                            var errorMessages = xhr.responseJSON.errors;

                            // Display error messages to the user (you can customize this part based on your needs)
                            var errorMessageText = 'Terjadi kesalahan:';
                            for (var key in errorMessages) {
                                errorMessageText += '\n' + errorMessages[key];
                            }

                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: errorMessageText,
                                showConfirmButton: true,

                            });
                        } else {
                            // For other errors, display a generic error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'Terjadi kesalahan: ' + errors,
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        }
                    }
                });
            });
        });

        function filterProjek(selectElement) {
            document.getElementById('filterForm').submit();
        }
    </script>

    <script>
        $('.btn-edit').on('click', function() {
            var exp = $(this).data('kadaluwarsa');


            // Check the radio button based on the 'kadaluwarsa' value
            if (exp === 0) {
                $('#aktif').prop('checked', true);
            } else if (exp === 1) {
                $('#deaktif').prop('checked', true);
            }
            var anggotaData = $(this).data('anggota');
            var timId = $(this).data('id');
            var url = $(this).data('url');
            var dataId = $(this).data('id');
            var status = $(this).data('status');
            var logo = $(this).data('logo');
            var tema = $(this).data('tema');
            console.log(tema);
            $('#modalDataIdInput').val(dataId);
            $('#logoInput').val(logo);
            $('#nowStatus').text(status);
            $('#tema').val(tema);
            if (tema == 0) {
                $('.temas').addClass('d-none');
            } else {
                $('.temas').removeClass('d-none');
            }
            $('#updateTimForm').attr('action', '/mentor/update-tim/' + dataId);

            $(".nowStatus").each(function() {
                if ($(this).val() === status) {
                    $(this).prop("selected", true);
                }
            });

            $.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $('#ketua').html('')
                    $('#anggota_kelompok').html('')
                    $("#ketua").append("<option disabled selected>Pilih Data</option>");

                    // Populate the anggota_kelompok select
                    $.each(data.users, function(index, user) {
                        var option = new Option(user.username, user.id, false, false);
                        if ($.inArray(user.id, anggotaData) !== -1) {
                            option.selected = true;
                        }
                        $("#anggota_kelompok").append(option);
                    });

                    $.each(data.ketua, function(index, ketua) {
                        var option = new Option(ketua.username, ketua.id, false, false);
                        var ketua_id = data.ketua_id;
                        if ($.inArray(ketua.id, ketua_id) !== -1) {
                            option.selected = true;
                        }
                        $("#ketua").append(option);
                    });

                    var customStatus = [{
                            value: 'pre_mini',
                            text: 'Pre-mini Project'
                        },
                        {
                            value: 'mini',
                            text: 'Mini Project'
                        },
                        {
                            value: 'big',
                            text: 'Big Project'
                        }
                    ];

                    // Temukan elemen dropdown status
                    var statusDropdown = $("#tim_status_modal");

                    // Hapus opsi yang ada (kecuali opsi pertama "Pilih Data")
                    statusDropdown.find('option:not(:first)').remove();

                    // Tambahkan opsi dinamis dari data
                    $.each(customStatus, function(index, status) {
                        var option = new Option(status.text, status.value, false, false);
                        statusDropdown.append(option);
                    });

                    var nilai_default = status;
                    statusDropdown.val(nilai_default).trigger('change');




                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);

                    // Tambahkan kondisi
                    var status_tim = $('#tim_status_modal').val();
                    var ketuaKelompok = $('#kelompok_ketua').val();
                    var anggota = $('#anggota_kelompok').val();

                    if (!status_tim || !ketuaKelompok || !anggota.length) {
                        event.preventDefault();
                        swal.fire('Peringatan', 'Mohon lengkapi data sebelum simpan', 'warning');
                    }
                }
            });
        });

        $("#ketua").change(function() {
            var selectedValue = $(this).val();

            // Enable all options in #anggota select
            $("#anggota_kelompok option").prop('disabled', false);

            if (selectedValue) {
                // Disable the selected option in #anggota
                $("#anggota_kelompok option[value='" + selectedValue + "']").prop('disabled', true);
            }
        });

        // $("#ketua").change(function() {
        //     var selectedValue = $(this).val();
        //     if (selectedValue) {
        //         $("#anggota_kelompok option[value='" + selectedValue + "']").remove();
        //     }
        // });
    </script>

    {{-- ajax buat tim --}}
    <script>
        geto()

        function geto() {
            $.ajax({
                url: "{{ route('Project') }}",
                type: "GET",
                dataType: "json",
                success: function(data) {
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

        $('#createForm').submit(function(event) {
            var status_tim = $('#status_tim').val();
            var ketuaKelompok = $('#ketuaKelompok').val();
            var anggota = $('#anggota').val();

            if (!status_tim || !ketuaKelompok || !anggota.length) {
                event.preventDefault();
                swal.fire({
                    title: 'Peringatan',
                    text: 'Pastikan semua data terisi!',
                    icon: 'warning',
                    showConfirmButton: false,
                    timer: 2000
                });
            };
        });
        $("#ketuaKelompok").change(function() {
            var selectedValue = $(this).val();

            // Enable all options in #anggota select
            $("#anggota option").prop('disabled', false);

            if (selectedValue) {
                // Disable the selected option in #anggota
                $("#anggota option[value='" + selectedValue + "']").prop('disabled', true);
            }
        });
    </script>
    {{-- ajax buat tim --}}
@endsection
