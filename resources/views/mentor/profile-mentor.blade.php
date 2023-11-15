@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/pages/profile-banner.png"
                            alt="Banner image" class="rounded-top">
                    </div>
                    <form action="{{ route('profile.mentor.store') }}" method="POST" enctype="multipart/form-data"
                        id="update-profile-form">
                        @csrf
                        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                                <label class="form-label text-white" for="image-input3">
                                    <img id="preview-image3"
                                        src="{{ $user->avatar ? Storage::url($user->avatar) : asset('assets/img/avatars/pen.png') }}"
                                        alt="example placeholder"
                                        style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer; object-fit:cover;"
                                        class="d-block ms-0 ms-sm-4 rounded user-profile-img" />

                                    <input type="file" class="d-none" id="image-input3" name='photo'
                                        onchange="previewImage()" />

                                </label>
                            </div>
                            <div class="flex-grow-1 mt-3 mt-sm-5">
                                <div
                                    class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                    <div class="user-profile-info">
                                        <h4>{{ $user->username }}</h4>
                                        <ul
                                            class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class='ti ti-color-swatch'></i> {{ $user->peran->peran }}
                                            </li>
                                            @if ($user->sekolah)
                                                <li class="list-inline-item d-flex gap-1">
                                                    <i class='ti ti-map-pin'></i> {{ $user->sekolah }}
                                                </li>
                                            @endif
                                            <li class="list-inline-item d-flex gap-1">
                                                <i class='ti ti-calendar'></i> Bergabung pada
                                                {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM YYYY') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class="nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link cursor-pointer active" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true"
                        data-tab="1"><i class="ti ti-user-circle me-1"></i>Edit Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link cursor-pointer" id="pills-password-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false"
                        data-tab="2"><i class="ti ti-asterisk me-1"></i>Ganti password</a>
                </li>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Edit Profil</h5>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input name="username" type="text" class="form-control"
                                                placeholder="{{ $user->username }}" aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Nama</label>
                                            <span class="text-danger" id="username-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <input name="email" type="email" class="form-control"
                                                placeholder="{{ $user->email }}" aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Email</label>
                                            <span class="text-danger" id="email-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <input name="tlp" type="number" class="form-control"
                                                placeholder="{{ $user->tlp ? $user->tlp : 'Isi nomer telefon anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Nomor Telpon</label>
                                            <span class="text-danger" id="tlp-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input name="sekolah" type="text" class="form-control"
                                                placeholder="{{ $user->sekolah ? $user->sekolah : 'Isi alamat sekolah anda' }}"
                                                aria-describedby="floatingInputHelp" />
                                            <label for="floatingInput">Asal Sekolah</label>
                                            <span class="text-danger" id="alamat-error">
                                            </span>
                                        </div>
                                        <div class="form-floating my-3">
                                            <textarea name="deskripsi" style="resize: none; height: 133.5px;" class="form-control"
                                                placeholder="{{ $user->deskripsi != 'none' ? $user->deskripsi : 'I am a programmer' }}"
                                                aria-describedby="floatingInputHelp"></textarea>
                                            <label for="floatingInput">deskripsi</label>
                                            <span class="text-danger" id="deskripsi-error">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-flex my-2">
                                        <div class="button ms-auto">
                                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                <div class="">
                    <div class="d-flex justify-content-center">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="card mb-4">
                                    <h5 class="card-header">Ganti password</h5>
                                    <div class="card-body row">
                                        <form id="update-password-form"` action="{{ Route('password.mentor.updatee') }}">
                                            @method('PUT')
                                            @csrf
                                            <div class="card mb-4">

                                                <div class="card-body row">
                                                    <div class="col-md-6">
                                                        <label class="form-label fs-6" for="password">Password
                                                            Lama</label>
                                                        <div class="form-floating my-2 form-password-toggle">
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="current_password"
                                                                    class="form-control" name="current_password"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />

                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <span id="current_password-error" class="text-danger"></span>
                                                        </div>

                                                        <label class="form-label fs-6" for="password">Konfirmasi
                                                            password
                                                            baru</label>
                                                        <div class="form-floating my-2 form-password-toggle">

                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="confirm-new-password"
                                                                    class="form-control" name="new_password"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />
                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <div class="mt-1 ms-1">

                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label fs-6" for="password">Password
                                                            baru</label>
                                                        <div class="form-floating my-2 form-password-toggle">
                                                            <label class="form-label" for="confirm-password">Konfirmasi
                                                                password</label>
                                                            <div class="input-group input-group-merge">
                                                                <input type="password" id="confirm-password"
                                                                    class="form-control" name="new_password_confirmation"
                                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                                    aria-describedby="password" />
                                                                <span class="input-group-text cursor-pointer"><i
                                                                        class="ti ti-eye-off"></i></span>
                                                            </div>
                                                            <span id="new_password-error" class="text-danger"></span>
                                                        </div>

                                                        <div class="form-floating my-2 form-password-toggle mt-3">
                                                            <div class="button my-auto">
                                                                <button type="submit"
                                                                    class="btn btn-outline-primary mt-4">Simpan</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex my-2">

                                                </div>
                                        </form>
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
@endsection

@section('script')
    <script>
        function previewImage() {
            var preview = document.getElementById('preview-image3');
            var fileInput = document.getElementById('image-input3');
            var file = fileInput.files[0];

            if (file) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                };

                reader.readAsDataURL(file);
            }
        }
    </script>
        <script>
            $('#update-password-form').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Sembunyikan tombol
                            $('#saveButton').hide();

                            // Tampilkan SweetAlert
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Profile berhasil diperbarui.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1700,
                            }).then(() => {
                                $('#saveButton').show();

                                window.location.reload();
                            });
                        }
                    },

                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            console.log(errors); // Add this line for debugging

                            $('.text-danger').text('');

                            $.each(errors, function(field, messages) {
                                console.log(field);
                                var errorMessage = messages[0];
                                $('#' + field + '-error').text(errorMessage);
                            });



                        } else {
                            toastr.error('Terjadi kesalahan: ' + error, 'Kesalahan');

                        }
                    }
                });
            });

            $('#update-profile-form').submit(function(e) {
                e.preventDefault();


                var formData = new FormData(this);

                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Sembunyikan tombol
                            $('#saveButton').hide();

                            // Tampilkan SweetAlert
                            Swal.fire({
                                title: 'Sukses',
                                text: 'Password berhasil diperbarui.',
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1700,
                            }).then(() => {
                                $('#saveButton').show();

                                window.location.reload();
                            });
                        }
                    },

                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            var errors = xhr.responseJSON.errors;

                            console.log(errors); // Add this line for debugging

                            $('.text-danger').text('');

                            $.each(errors, function(field, messages) {
                                var errorMessage = messages[0];
                                $('#' + field + '-error').text(errorMessage);
                            });



                        } else {
                            toastr.error('Terjadi kesalahan: ' + error, 'Kesalahan');

                        }
                    },
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $('[data-tab]').click(function() {
                    var tabProfile = $(this).attr('data-tab');
                    sessionStorage.setItem('tabProfile', tabProfile);
                });

                var tabProfile = sessionStorage.getItem('tabProfile');
                if (tabProfile) {
                    $('[data-tab="' + tabProfile + '"]').tab('show');
                }

            });
        </script>
@endsection
