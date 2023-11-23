@extends('layoutsMentor.app')
@section('content')
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    @if ($errors->any())
        <script>
            @foreach ($errors->all() as $error)
                swal.fire({
                    title: "Kesalahan!",
                    text: "{{ $error }}",
                    icon: "error",
                    confirmButtonText: "Tutup",
                    customClass: {
                        confirmButton: "btn btn-danger me-3",
                    }
                });
            @endforeach
        </script>
    @endif

    @if (session('error'))
        Swal.fire({
            title:"Kesalahan",
            text : ""
        })
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('[id^="delete-button-"]');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let code = button.id.replace('delete-button-', '');

                    swal.fire({
                        title: "Apa kamu yakin?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Hapus!",
                        customClass: {
                            confirmButton: "btn btn-danger me-3",
                            cancelButton: "btn btn-label-secondary",
                        },
                        buttonsStyling: false,
                    }).then(function(confirmDelete) {
                        if (confirmDelete.isConfirmed) {
                            window.location.href = "{{ url('mentor/delete-user') }}/" +
                                code;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('[id^="delete-button-mentor-"]');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let code = button.id.replace('delete-button-mentor-', '');

                    swal.fire({
                        title: "Apa kamu yakin?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Hapus!",
                        customClass: {
                            confirmButton: "btn btn-danger me-3",
                            cancelButton: "btn btn-label-secondary",
                        },
                        buttonsStyling: false,
                    }).then(function(confirmDelete) {
                        if (confirmDelete.isConfirmed) {
                            window.location.href = "{{ url('mentor/delete-mentor') }}/" +
                                code;
                        }
                    });
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let deleteButtons = document.querySelectorAll('[id^="delete-button-permisions-"]');

            deleteButtons.forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let code = button.id.replace('delete-button-permisions-', '');

                    swal.fire({
                        title: "Apa kamu yakin mencabut hak akses user ini?",
                        icon: "question",
                        showCancelButton: true,
                        confirmButtonText: "Hapus!",
                        customClass: {
                            confirmButton: "btn btn-danger me-3",
                            cancelButton: "btn btn-label-secondary",
                        },
                        buttonsStyling: false,
                    }).then(function(confirmDelete) {
                        if (confirmDelete.isConfirmed) {
                            window.location.href =
                                "{{ url('mentor/delete-user-permisions') }}/" +
                                code;
                        }
                    });
                });
            });
        });
    </script>

    <style>
        .icon-button {
            background: none;
            border: none;
        }

        .icon-text {
            margin-right: 5px;
        }

        @media (min-width: 320px) and (max-width: 767px) {
            .pencarian {
                width: 100px;
                height: 40px;
            }

            td.nama {
                display: flex;
                align-items: center;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 112px;
                height: 91px;
            }

            td.masa-jabatan {
                display: flex;
                align-items: center;
                white-space: nowrap;
                overflow-x: auto;
                text-overflow: ellipsis;
                max-width: 112px;
                height: 71px;
            }

            td.nama img {
                width: 30px;
                height: 30px;
                border-radius: 50%;
                margin-right: 10px;
                /* Atur margin kanan untuk memberi jarak antara gambar dan teks */
            }

            .search {
                display: none !important;
            }

            .saputra {
                flex-direction: column;
            }
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function toggleContent(tabId) {
                if (tabId === 'pills-home-tab') {
                    $('#siswa-content').show();
                } else {
                    $('#siswa-content').hide();
                }

                if (tabId === 'pills-profile-tab') {
                    $('#pengelola-content').show();
                } else {
                    $('#pengelola-content').hide();
                }

                if (tabId === 'pills-contact-tab') {
                    $('#mentor-content').show();
                } else {
                    $('#mentor-content').hide();
                }
            }

            toggleContent('pills-home-tab');

            $('.nav-link').click(function() {
                const tabId = $(this).attr('aria-controls');
                toggleContent(tabId);
            });

            $('[data-tab]').click(function() {
                var penggunaMentorTab = $(this).attr('data-tab');
                sessionStorage.setItem('penggunaMentorTab', penggunaMentorTab);
            });

            var penggunaMentorTab = sessionStorage.getItem('penggunaMentorTab');
            if (penggunaMentorTab) {
                $('[data-tab="' + penggunaMentorTab + '"]').tab('show');
            }
        });
    </script>


    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="d-flex flex-wrap flex-row justify-content-between">
                <div>
                    <ul class="nav nav-pills mb-3 mt-3 saputra" style="padding-left: 20px" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home-tab"
                                aria-selected="true" data-tab="1"><i
                                    class="fa-solid fa-users icon-text"></i>Siswa</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab"
                                aria-controls="pills-profile-tab" aria-selected="false" data-tab="2"><i
                                    class="fa-solid fa-user-group icon-text"></i>Pengelola Magang</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab"
                                aria-controls="pills-contact-tab" aria-selected="false" data-tab="3"><i
                                    class="fa-solid fa-user-tie icon-text"></i>Mentor</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-team" type="button" role="tab" aria-controls="pills-histori-tab"
                                aria-selected="false" data-tab="4"><i class="fa-solid fa-user-slash icon-text"></i>Histori
                                Pengelola
                                Magang</button>
                        </li>
                    </ul>
                </div>
                <div id="mentor-content" class="row g-3">
                    <div class="d-flex flex-row gap-2 justify-content-end py-3 px-4">
                        <div class="d-flex">
                            <div class="col d-flex flex-wrap gap-1">
                                <button id="add-btn" class="btn btn-primary" style="font-size: 13px"
                                    data-bs-toggle="modal" data-bs-target="#add-data-mentor"><i
                                        class="fa-solid fa-plus icon-text"></i>Tambah
                                    Mentor</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="pengelola-content" class="row g-3">
                    <div class="d-flex flex-row gap-2 justify-content-end py-3 px-4">
                        <div class="d-flex">
                            <div class="col d-flex flex-wrap gap-1">
                                <button id="add-btn" class="btn btn-primary" style="font-size: 13px"
                                    data-bs-toggle="modal" data-bs-target="#add-role"><i
                                        class="fa-solid fa-plus icon-text"></i>Tambah
                                    Role</button>
                            </div>
                            <div class="col d-flex flex-wrap gap-1">
                                <button id="add-btn" class="btn btn-primary" style="font-size: 13px"
                                    data-bs-toggle="modal" data-bs-target="#add-pengelola"><i
                                        class="fa-solid fa-plus icon-text"></i>Tambah
                                    Pengelola</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="siswa-content" class="row g-3">
                    <div class="d-flex flex-row gap-2 justify-content-end py-3 px-4">
                        <div class="d-flex">
                            <div class="col d-flex flex-wrap gap-1">
                                <div>
                                    <form action="{{ route('tambah.users.csv') }}" method="post" id="import-form"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input name="import" accept="text/csv" type="file" id="import"
                                            class="d-none">
                                        <button type="button" id="import-btn" style="font-size: 13px"
                                            class="btn btn-success"><i class="fa-regular fa-file icon-text"></i> Import
                                            CSV</button>
                                    </form>
                                    <script>
                                        document.getElementById("import-btn").addEventListener("click", function() {
                                            document.getElementById("import").click();
                                        });
                                        document.getElementById("import").addEventListener("change", function() {
                                            document.getElementById("import-form").submit();
                                        });
                                    </script>
                                </div>
                                <button id="add-btn" class="btn btn-primary" style="font-size: 13px"
                                    data-bs-toggle="modal" data-bs-target="#add-data"><i
                                        class="fa-solid fa-plus icon-text"></i>Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel1" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no_user = 1;
                                @endphp
                                @foreach ($users as $item)
                                    <tr>
                                        <th scope="row">{{ $no_user++ }}</th>
                                        <td class="nama">
                                            @if ($item->avatar)
                                                <img src="{{ asset('storage/' . $item->avatar) }}" alt=""
                                                    style="width:30px;height:30px;border-radius:50%">
                                            @else
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt=""
                                                    style="width:30px;height:30px;border-radius:50%">
                                            @endif
                                            <span class="ml-3">
                                                {{ $item->username }}
                                            </span>
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap flex-row">
                                                <span class="detail-user cursor-pointer" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#detail"
                                                    data-username="{{ $item->username }}"
                                                    data-avatar="{{ $item->avatar }}" data-tlp="{{ $item->tlp }}"
                                                    data-peran="{{ $item->peran->peran }}"
                                                    data-sekolah="{{ $item->sekolah }}" data-email="{{ $item->email }}"
                                                    data-masa-magang="{{ \Carbon\Carbon::parse($item->created_at)->translatedFormat('l, j F Y') }}"><i
                                                        class="ti ti-eye me-1"></i></span>
                                                <span class="cursor-pointer" id="delete-button-{{ $item->uuid }}"
                                                    href="javascript:void(0);"><i class="ti ti-trash me-1"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel2" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no_manage = 1;
                                @endphp
                                @foreach ($magang as $item)
                                    @if ($item->masih_menjabat)
                                        <tr>
                                            <th scope="row">{{ $no_manage++ }}</th>
                                            <td class="nama">
                                                @if ($item->user->avatar)
                                                    <img src="{{ asset('storage/' . $item->user->avatar) }}"
                                                        alt="" style="width:30px;height:30px;border-radius:50%">
                                                    {{ $item->user->username }}
                                                @else
                                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt=""
                                                        style="width:30px;height:30px;border-radius:50%">
                                                    {{ $item->user->username }}
                                                @endif
                                            </td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap flex-row gap-2">
                                                    <span class="detail-user cursor-pointer" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#detail"
                                                        data-username="{{ $item->user->username }}"
                                                        data-avatar="{{ $item->user->avatar }}"
                                                        data-tlp="{{ $item->user->tlp }}"
                                                        data-peran="{{ $item->user->peran->peran }}"
                                                        data-sekolah="{{ $item->user->sekolah }}"
                                                        data-email="{{ $item->user->email }}"><i
                                                            class="ti ti-eye me-1"></i></span>
                                                    <span class="cursor-pointer" href="javascript:void(0);"
                                                        data-bs-toggle="modal" data-bs-target="#edit-data-permisions"><i
                                                            class="ti ti-pencil me-1"></i></span>
                                                    <span class="cursor-pointer"
                                                        id="delete-button-permisions-{{ $item->user->uuid }}"
                                                        href="javascript:void(0);"><i class="ti ti-trash me-1"></i></span>
                                                </div>
                                            </td>

                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel3" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no_mentor = 1;
                                @endphp
                                @foreach ($mentors as $item)
                                    <tr>
                                        <th scope="row">{{ $no_mentor++ }}</th>
                                        <td class="nama">
                                            @if ($item->avatar)
                                                <img src="{{ asset('storage/' . $item->avatar) }}" alt=""
                                                    style="width:30px;height:30px;border-radius:50%">
                                            @else
                                                <img src="{{ asset('assets/img/avatars/1.png') }}" alt=""
                                                    style="width:30px;height:30px;border-radius:50%">
                                            @endif
                                            {{ $item->username }}
                                        </td>
                                        <td>{{ $item->email }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap flex-row cursor-pointer">
                                                <span class="edit-button" href="javascript:void(0);"
                                                    data-bs-toggle="modal" data-bs-target="#edit-data-mentor"
                                                    data-url="{{ $item->uuid }}" data-username="{{ $item->username }}"
                                                    data-email="{{ $item->email }}">
                                                    <i class="ti ti-pencil me-1"></i>
                                                </span>
                                                <span class="cursor-pointer"
                                                    id="delete-button-mentor-{{ $item->uuid }}"
                                                    href="javascript:void(0);"><i class="ti ti-trash me-1"></i></span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="tab-pane fade" id="pills-team" role="tabpanel" aria-labelledby="pills-disabled-tab"
                    tabindex="0">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel4" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">MASA JABATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($magang as $item)
                                    @if ($item->masih_menjabat === 0)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td class="nama">
                                                @if ($item->user->avatar)
                                                    <img src="{{ asset('storage/' . $item->user->avatar) }}"
                                                        alt="" style="width:30px;height:30px;border-radius:50%">
                                                    {{ $item->user->username }}
                                                @else
                                                    <img src="{{ asset('assets/img/avatars/1.png') }}" alt=""
                                                        style="width:30px;height:30px;border-radius:50%">
                                                    {{ $item->user->username }}
                                                @endif
                                            </td>
                                            <td>{{ $item->user->email }}</td>
                                            <td class="masa-jabatan">{{ $item->awal_menjabat }} sampai
                                                {{ $item->akhir_menjabat }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>

            {{-- modal add data --}}
            <div class="modal fade" id="add-role" tabindex="-1" aria-hidden="true">
                <form action="{{ route('tambah.roles') }}" method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="roles" class="form-label">Nama</label>
                                        <input name="roles" type="text" id="roles" class="form-control"
                                            placeholder="Masukkan nama hak akses " required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="add-pengelola" tabindex="-1" aria-hidden="true">
                <form action="{{ route('tambah.pengelola') }}" method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah Pengelola</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="role" class="form-label">Role Pengelola</label>
                                        <select id="role" name="role" class="select2 form-select selecto"
                                            required>
                                            @foreach ($roles as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="user" class="form-label">User</label>
                                        <select id="user" name="user" class="select2 form-select selecto"
                                            required>
                                            @foreach ($bukanPengelolaMagang as $data)
                                                <option value="{{ $data->id }}">{{ $data->username }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="add-data" tabindex="-1" aria-hidden="true">
                <form action="{{ route('tambah.users') }}" method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="username" class="form-label">Nama</label>
                                        <input name="username" type="text" id="username" class="form-control"
                                            placeholder="Masukkan nama pengguna" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="text" id="email" class="form-control"
                                            placeholder="Masukkan email" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="sekolah" class="form-label">Sekolah</label>
                                        <input name="sekolah" type="text" id="sekolah" class="form-control"
                                            placeholder="Masukkan sekolah asal" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="masa_magang" class="form-label">Masa Magang</label>
                                        <input name="masa_magang" type="date" id="masa_magang" class="form-control"
                                            placeholder="Masukan tanggal mulai dan selesai magang" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="add-data-mentor" tabindex="-1" aria-hidden="true">
                <form action="{{ route('tambah.mentor') }}" method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah Mentor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="username" class="form-label">Nama</label>
                                        <input name="username" type="text" id="username" class="form-control"
                                            placeholder="Masukkan nama pengguna" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="text" id="email" class="form-control"
                                            placeholder="Masukkan email" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="edit-data-mentor" tabindex="-1" aria-hidden="true">
                <form action="" id="edit-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Edit Mentor</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="username" class="form-label">Nama</label>
                                        <input name="username" type="text" id="username-mentor" class="form-control"
                                            placeholder="Masukkan nama pengguna" value="" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input name="email" type="text" id="email-mentor" class="form-control"
                                            placeholder="Masukkan email" value="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="edit-data-permisions" tabindex="-1" aria-hidden="true">
                <form action="{{ route('tambah.users') }}" method="POST">
                    @csrf
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Tambah Pengguna</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="role" class="form-label">Role Pengelola</label>
                                        <select id="role" name="role" class="select2 form-select selecto"
                                            required>
                                            @foreach ($roles as $data)
                                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            {{-- modal edit data --}}
            <div class="modal fade" id="edit-data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Email</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="select2Basic" class="form-label">Status Role</label>
                                    <select id="selectBasic" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary"
                                data-bs-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal team --}}
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="emailWithTitle" class="form-label">TEAM</label>
                                <div class="col mb-3">
                                    <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                        style="width: 80%;height:80%;border-radius:20%">
                                    <span>Hummatech</span>
                                </div>
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">ANGGOTA</label>
                                    <div class="avatar-container">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                style="width:30px;height:30px;border-radius:50%" class="avatar">
                                            <span>saputra</span>
                                        </div>
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                style="width:30px;height:30px;border-radius:50%" class="avatar">
                                            <span>saputra</span>
                                        </div>
                                        <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                            style="width:30px;height:30px;border-radius:50%" class="avatar">
                                        <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                            style="width:30px;height:30px;border-radius:50%" class="avatar">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">KETUA</label>
                                    <div class="col mb-3">
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width: 10%;height:10%;border-radius:20%">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">KETUA</label>
                                    <input type="email" id="emailWithTitle" class="form-control"
                                        placeholder="xxxx@xxx.xx">
                                </div>
                                <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">DOB</label>
                                    <input type="date" id="dobWithTitle" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal team --}}

            {{-- modal detail --}}
            <div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- User Card -->
                                {{-- <div class="card mb-4"> --}}
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class=" d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mb-3 pt-1 mt-4" src="" height="100"
                                                width="100" id="avatar" />
                                            <div class="user-info text-center">
                                                <h4 class="mb-2" id="username-siswa"></h4>
                                                <p id="masaMagang">21-01-2023 sampai 20-12-2024</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                                    </div>
                                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Email:</span>
                                                <span id="email-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Kontak:</span>
                                                <span id="tlp-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Sekolah:</span>
                                                <span id="sekolah-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Status:</span>
                                                <span class="badge bg-label-warning" id="peran-siswa"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal detail ketua dan wakil --}}
            <div class="modal fade" id="detail-ketua" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- User Card -->
                                {{-- <div class="card mb-4"> --}}
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class=" d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                                src="{{ asset('assets/img/avatars/15.png') }}" height="100"
                                                width="100" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4 class="mb-2">Violet Mendoza</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                                    </div>
                                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Email:</span>
                                                <span id="email-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Contact:</span>
                                                <span id="tlp-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Sekolah:</span>
                                                <span id="sekolah-siswa"></span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Status:</span>
                                                <span class="badge bg-label-warning" id="peran-siswa"></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $("#masa_magang").flatpickr({
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            mode: "range"
        });
    </script>

    <script>
        $('.detail-user').click(function() {
            let avatar = $(this).data('avatar');
            let username = $(this).data('username');
            let email = $(this).data('email');
            let tlp = $(this).data('tlp') != '' ? $(this).data('tlp') : 'User ini belum mengisi nomor telpon';
            let peran = $(this).data('peran');
            let sekolah = $(this).data('sekolah') != '' ? $(this).data('sekolah') :
                'User ini belum mengisi asal sekolah';
            let bergabung = $(this).data('masa-magang');

            $('#avatar').attr('src', (avatar == '' ? '/assets/img/avatars/1.png' :
                `/storage/${avatar}`));
            $('#username-siswa').text(username);
            $('#email-siswa').text(email);
            $('#tlp-siswa').text(tlp);
            $('#peran-siswa').text(peran);
            $('#sekolah-siswa').text(sekolah);
            $('#masaMagang').text(`Bergabung pada: ${bergabung}`);

            $('#detail').modal('show');
        });
    </script>

    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel1').DataTable({
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
        jQuery(document).ready(function($) {
            $('#jstabel2').DataTable({
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
        jQuery(document).ready(function($) {
            $('#jstabel3').DataTable({
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
        jQuery(document).ready(function($) {
            $('#jstabel4').DataTable({
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
    <script>
        $(document).ready(function() {
            $('.edit-button').click(function() {
                var dataUrl = $(this).data('url');
                var formAction = "{{ route('edit.mentor', ['uuid' => ':Id']) }}";
                var form = $('#edit-form');
                var nama = $(this).data('username');
                var email = $(this).data('email');

                $('#username-mentor').val(nama);
                $('#email-mentor').val(email);

                formAction = formAction.replace(':Id', dataUrl);
                $('#edit-form').attr('action', formAction);

                console.log(uuid);
            });
        });
    </script>
@endsection
