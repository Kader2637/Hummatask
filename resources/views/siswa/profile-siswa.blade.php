@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
@endsection


@section('content')
    <script>
        @if (session('success'))
            Swal.fire({
                title: "Sukses",
                text: "{{ session('success') }}",
                icon: "success",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: false,
            });
        @endif
        @if (session('error'))
            Swal.fire({
                title: "Gagal",
                text: "{{ session('error') }}",
                icon: "error",
                customClass: {
                    confirmButton: "btn btn-primary"
                },
                buttonsStyling: false,
            });
        @endif
    </script>

    <div class="container-fluid mt-4">
        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                        src="{{ asset('storage/' . ($user->avatar ?? 'assets/img/avatars/pen.png')) }}"
                                        alt="example placeholder"
                                        style="width: 150px; height: 150px; border-radius: 10px; cursor: pointer;"
                                        class="d-block ms-0 ms-sm-4 rounded user-profile-img" />
                                    <input type="file" class="d-none" id="image-input" name="avatar" />
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

            <div class="card">
                <h5 class="card-header">Edit Profil</h5>
                <div class="card-body row">
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input name="username" type="text" class="form-control" id="floatingInput"
                                placeholder="{{ $user->username }}" aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nama</label>
                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating my-3">
                            <input name="email" type="email" class="form-control" id="floatingInput"
                                placeholder="{{ $user->email }}" aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Email</label>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating my-3">
                            <input name="tlp" type="number" class="form-control" id="floatingInput"
                                placeholder="{{ $user->tlp ? $user->tlp : 'Isi nomer telefon anda' }}"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Nomor Telpon</label>
                            @error('tlp')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating my-3">
                            <input name="sekolah" type="text" class="form-control" id="floatingInput"
                                placeholder="{{ $user->sekolah ? $user->sekolah : 'Isi alamat sekolah anda' }}"
                                aria-describedby="floatingInputHelp" />
                            <label for="floatingInput">Asal Sekolah</label>
                            @error('sekolah')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-floating my-3">
                            <textarea name="deskripsi" style="resize: none; height: 133.5px;" class="form-control" id="floatingInput"
                                placeholder="{{ $user->deskripsi != 'none' ? $user->deskripsi : 'I am a programmer' }}"
                                aria-describedby="floatingInputHelp"></textarea>
                            <label for="floatingInput">deskripsi</label>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex my-2">
                        <div class="button ms-auto">
                            <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
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
