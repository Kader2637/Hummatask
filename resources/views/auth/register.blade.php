@extends('auth.templates.template')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Registrasi Berhasil',
                text: '{{ session('success') }}',
            });
        @elseif (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '{{ session('error') }}',
            });
        @endif
    </script>

    <style>
        .bs-stepper-label {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">

            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-register-illustration-light.png') }}"
                        alt="auth-register-cover" class="img-fluid my-5 auth-illustration"
                        data-app-dark-img="illustrations/auth-register-illustration-dark.html">
                </div>
            </div>

            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">

                    <div class="col-12 mb-4">
                        <div style="border-radius: 10px"
                            class="bs-stepper wizard-icons wizard-icons-example d-flex flex-wrap flex-row justify-content-center align-items-center gap-3 p-0 py-4">
                            <div class="step" data-target="#account-details">
                                <button type="button" class="step-trigger p-0">
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Akun Details</span>
                                    </span>
                                </button>
                            </div>
                            <div class="line">
                                <i class="ti ti-chevron-right"></i>
                            </div>
                            <div class="step" data-target="#personal-info">
                                <button type="button" class="step-trigger p-0">
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-title">Personal Info</span>
                                    </span>
                                </button>
                            </div>

                            <div class="bs-stepper-content">
                                <form onSubmit="return false">
                                    <div id="account-details" class="content">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Masukkan Email Anda" value="{{ old('email') }}">
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <label class="form-label" for="password">Kata Sandi</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password" class="form-control" name="password"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password" value="{{ old('password') }}" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        class="ti ti-eye-off"></i></span>
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <label class="form-label" for="password_confirmation">Konfirmasi Kata
                                                Sandi</label>
                                            <div class="input-group input-group-merge">
                                                <input type="password" id="password_confirmation" class="form-control"
                                                    name="password_confirmation"
                                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                    aria-describedby="password"
                                                    value="{{ old('password_confirmation') }}" />
                                                <span class="input-group-text cursor-pointer"><i
                                                        class="ti ti-eye-off"></i></span>
                                            </div>
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="step" data-target="#personal-info">
                                            <button type="button"
                                                class="step-trigger btn btn-primary px-3 py-1 d-flex gap-1 bg-primary text-white w-100">
                                                <span class="bs-stepper-label">
                                                    <span class="bs-stepper-title"
                                                        style="font-weight: 400">Selanjutnya</span>
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="personal-info" class="content">
                                        <div class="mb-3 d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                            <label class="form-label text-white m-1" for="image-input">
                                                <img id="preview-image" src="{{ asset('assets/img/avatars/pen.png') }}"
                                                    class="rounded-circle" alt="example placeholder"
                                                    style="width: 100px; height: 100px;" />
                                                <input type="file" class="form-control d-none" id="image-input"
                                                    name="avatar" />
                                            </label>
                                        </div>
                                        <div class="mb-3 form-password-toggle">
                                            <div class="input-group input-group-merge">
                                                <input type="text" class="form-control" name="username"
                                                    value="{{ old('password') }}" placeholder="Username" />
                                            </div>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="my-2 form-password-toggle">
                                            <div class="input-group input-group-merge gap-3 d-flex justify-content-center">
                                                @foreach ($perans as $item)
                                                    <div class="col-md-5">
                                                        <div
                                                            class="form-check custom-option custom-option-icon h-75 w-125">
                                                            <label
                                                                class="form-check-label custom-option-content d-flex justify-content-center align-items-center "
                                                                style="width: 100%" for="{{ $item->id }}">
                                                                <span class="custom-option-body">
                                                                    <span class="custom-option-title">
                                                                        @if ($item->id == 1)
                                                                            <img src="{{ asset('assets/img/icons/auth/student.svg') }}"
                                                                                alt="" srcset="">
                                                                        @else
                                                                            <img src="{{ asset('assets/img/icons/auth/teacher.svg') }}"
                                                                                alt="" srcset="">
                                                                        @endif
                                                                    </span>
                                                                    <small class="py-4">{{ $item->peran }}</small>
                                                                </span>
                                                                <input style="display: none"
                                                                    name="customDeliveryRadioIcon"
                                                                    class="form-check-input" type="radio"
                                                                    value="{{ $item->id }}"
                                                                    id="{{ $item->id }}" />
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="terms-conditions"
                                                    name="terms">
                                                <label class="form-check-label" for="terms-conditions">
                                                    Saya menyetujui
                                                    <a href="javascript:void(0);">Syarat & Ketentuan</a>
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary d-grid w-100">
                                            Sign up
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <p class="text-center">
                                <span>Sudah punya akun?</span>
                                <a href="{{ route('login') }}">
                                    <span>Masuk</span>
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="divider my-4">
                        <div class="divider-text">atau</div>
                    </div>

                    <div class="d-flex justify-content-center gap-4">
                        <a href="{{ route('facebook.register') }}" class="btn btn-icon btn-label-facebook">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="{{ route('google.register') }}" class="btn btn-icon btn-label-google-plus">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}">
    </script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>


    <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>
    <script src="{{ asset('assets/js/form-wizard-icons.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            localStorage.clear();
        })

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
