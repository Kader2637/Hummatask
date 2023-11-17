@extends('auth.templates.template')

@section('content')
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/tabler-iconsea04.css?id=6ad8bc28559d005d792d577cf02a2116') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/fonts/fontawesome8a69.css?id=a2997cb6a1c98cc3c85f4c99cdea95b5') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons80a8.css?id=121bcc3078c6c2f608037fb9ca8bce8d') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core6cc1.css?id=9dd8321ea008145745a7d78e072a6e36') }}"
        class="template-customizer-core-css" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/css/rtl/theme-defaultfc79.css?id=a4539ede8fbe0ee4ea3a81f2c89f07d9') }}"
        class "template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demof1ed.css?id=ddd2feb83a604f9e432cdcb29815ed44') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/node-waves/node-wavesd178.css?id=aa72fb97dfa8e932ba88c8a3c04641bc') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar7358.css?id=280196ccb54c8ae7e29ea06932c9a4b6') }}" />
    <link rel="stylesheet"
        href="{{ asset('assets/vendor/libs/typeahead-js/typeaheadb5e1.css?id=2603197f6b29a6654cb700bd9367e2a3') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>

    <style>
        @media (max-width: 768px) {
            #top-bar .step {
                display: flex;
                flex-direction: row;
                width: 25%;
            }
        }
    </style>

    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <div class="my-5 mx-5 py-5">
        <div class="bs-stepper wizard-numbered">
            <div class="bs-stepper-header align-items-center" id="top-bar" style="border-bottom: none; display: none">
                <div class="step w-50" data-target="#account-details">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Profile</span>
                        </span>
                    </button>
                </div>
                <div class="step w-50" data-target="#personal-info">
                    <button type="button" class="step-trigger" id="peranButton">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">Peran</span>
                        </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content" style="border-radius: 0px;">
                <form method="POST" enctype="multipart/form-data"
                    action="{{ route('register.store', Cookie::get('code')) }}">
                    @csrf
                    <div id="account-details" class="content">
                        <div class="container">
                            <h2 class="fs-3">Selamat datang di Hummatask!</h2>
                            <p class="w-75">Anda mendaftarkan sebagai <a class="text-primary"
                                    id="user-email">{{ Cookie::get('email') }}</a></p><br>
                            <div class="row">
                                <div class="col-lg-3">
                                    <label class="form-label text-white m-1" for="image-input">
                                        <img id="preview-image3" src="{{ asset('assets/img/avatars/pen.png') }}"
                                            class="rounded-circle" alt="example placeholder"
                                            style="width: 200px; height: 200px;" />
                                        <input type="file" class="form-control d-none" id="image-input3" name="avatar" />
                                    </label>
                                </div>

                                <div class="col-lg-6">
                                    <div class="fs-5 p-1">Siapa nama lengkap Anda?</div>
                                    <input id="username-input" type="text" class="form-control"
                                        placeholder="{{ Cookie::get('name') }}" required name="username">
                                    <div class="fs-6 validation-message text-danger" style="display: none;">Silakan masukkan
                                        username.</div>
                                    <div id="peranButton" class="step mt-4" data-target="#personal-info">
                                        <button type="button"
                                            class="step-trigger btn btn-primary px-3 py-1 d-flex gap-1 bg-primary text-white">
                                            <span class="bs-stepper-label">
                                                <span class="bs-stepper-title" style="font-weight: 400">Selanjutnya</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-5 mx-3">Akun salah? <a href="{{ route('login') }}" class="text-primary">Masuk
                                </a>saja
                            </p>
                        </div>
                    </div>
                    <div id="personal-info" class="content">
                        <div class="container">
                            <h2 class="fs-3">Apa peran anda?</h2>
                            <p class="w-75">Ini akan membantu kami untuk menyesuaikan web untuk anda. Kami untuk membantu
                                menemukan fitur yang sesuai dengan peran anda, pilih semua yang sesuai.
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($perans as $item)
                                    <div class="col-xl-3 col-md-5 col-sm-6 col-12">
                                        <div class="form-check custom-option custom-option-icon">
                                            <label class="form-check-label custom-option-content"
                                                for="{{ $item->id }}">
                                                <span class="custom-option-body">
                                                    <i class="ti ti-brand-telegram"></i>
                                                    <span class="custom-option-title">
                                                        {{ $item->peran }}
                                                    </span>
                                                </span>
                                                <input name="peran" class="form-check-input" type="radio"
                                                    value="{{ $item->id }}" id="{{ $item->id }}" required />
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="d-flex mt-5 gap-3 align-items-center">
                                <div class="step" data-target="#account-details">
                                    <button type="button"
                                        class="step-trigger btn btn-primary px-3 py-1 d-flex gap-1 bg-primary text-white">
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title" style="font-weight: 400">Kembali</span>
                                        </span>
                                    </button>
                                </div>
                                <div>
                                    <button type="submit"
                                        class="step-trigger btn btn-primary px-3 py-1 d-flex gap-1 bg-primary text-white">
                                        <span class="bs-stepper-label">
                                            <span class="bs-stepper-title" style="font-weight: 400">Selesai</span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>

    <script src="{{ asset('assets/js/form-wizard-numbered.js') }}"></script>
    <script src="{{ asset('assets/js/form-wizard-validation.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        let usernameInput = document.getElementById('username-input');
        let peranButton = document.getElementById('peranButton');

        console.log(usernameInput.value);
        console.log(peranButton);

        usernameInput.addEventListener('change', function() {
            if (usernameInput.value.trim() !== '') {
                peranButton.removeAttribute('disabled');
            } else {
                peranButton.setAttribute('disabled', 'true');
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            let imageInput = $("#image-input3");

            imageInput.on('change', function() {
                let previewImage = $("#preview-image3");
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

            $(document).ready(function() {
                const user = JSON.parse(localStorage.getItem("user"));
                localStorage.setItem("user", JSON.stringify(user));

                window.addEventListener('beforeunload', function() {
                    localStorage.removeItem('userImage');
                });

                const userImage = localStorage.getItem("userImage");
                const username = localStorage.getItem("username");
                if (userImage || username) {
                    if (userImage) {
                        $("#preview-image3").attr('src', userImage);
                    }
                }
                $("#image-input3").on('change', function(e) {
                    const file = e.target.files[0];
                    const reader = new FileReader();

                    reader.onload = function() {
                        const image = $("#uploadedAvatar");
                        image.attr('src', reader.result);
                    };

                    reader.readAsDataURL(file);
                });

                $("#username-input").on('input', function() {
                    const username = $(this).val();
                    localStorage.setItem('username', username);
                });
            });

            const next = $("#lewati");
        });
    </script>
@endsection
