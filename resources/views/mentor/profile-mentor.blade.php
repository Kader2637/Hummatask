@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/pages/profile-banner.png"
                            alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            <label class="form-label text-white" for="image-input">
                                <img id="preview-image"
                                    src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/14.png"
                                    alt="example placeholder" style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer;" class="d-block ms-0 ms-sm-4 rounded user-profile-img" />
                                <input type="file" class="form-control d-none" id="image-input" name="avatar" />
                            </label>
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div
                                class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>John Doe</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class='ti ti-color-swatch'></i> Siswa
                                        </li>
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class='ti ti-map-pin'></i> SMKN 1 Wakanda
                                        </li>
                                        <li class="list-inline-item d-flex gap-1">
                                            <i class='ti ti-calendar'></i> Bergabung pada April 2021
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->

        <!-- User Profile Content -->
        <div class="card">
            <h5 class="card-header">Edit Profil</h5>
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Isi Nama Anda"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Nama</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="Isi Email Anda"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Email</label>
                    </div>
                    <div class="form-floating my-3">
                        <input type="number" class="form-control" id="floatingInput" placeholder="Isi Nomor Telpon Anda"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Nomor Telpon</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating my-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="Isi Asal Sekolah Anda"
                            aria-describedby="floatingInputHelp" />
                        <label for="floatingInput">Asal Sekolah</label>
                    </div>
                    <div class="form-floating my-3">
                        <textarea style="resize: none; height: 133.5px;" class="form-control" id="floatingInput"
                            placeholder="Isi Asal Sekolah Anda" aria-describedby="floatingInputHelp" /></textarea>
                        <label for="floatingInput">Asal Sekolah</label>
                    </div>
                </div>
                <div class="d-flex my-2">
                    <div class="button ms-auto">
                        <button class="btn btn-danger me-2">Reset</button>
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/ User Profile Content -->
    </div>
@endsection

@section('script')
    <script>
        let imageInput = $("#image-input");

        imageInput.on('change', function() {
            let previewImage = $("#preview-image");
            let file = imageInput[0].files[0];

            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            } else {
                previewImage.attr('src', '');
            }
        });
    </script>
@endsection
