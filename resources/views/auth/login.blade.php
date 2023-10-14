@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-login-illustration-light.png"
                        data-app-dark-img="illustrations/auth-login-illustration-dark.html">

                    <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-login-cover"
                        class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.html">
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                            class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"><svg width="32" height="20" viewBox="0 0 32 22"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span>
                        </a>
                    </div>
                    <h3 class=" mb-1">Selamat datang! 👋</h3>
                    <p class="mb-4">Masuk dan mulai berpetualang.</p>

                    <form id="formAuthentication" class="mb-3"
                        action="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1" method="GET">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email atau Nama Pengguna</label>
                            <input type="text" class="form-control" id="email" name="email-username"
                                placeholder="Masukkan email atau nama pengguna Anda" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Kata Sandi</label>
                                <a href="{{ route('lupa-password') }}">
                                    <small>Lupa Sandi?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me">
                                <label class="form-check-label" for="remember-me">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">
                            Sign in
                        </button>
                    </form>

                    <p class="text-center">
                        <span>Belum punya akun?</span>
                        <a href="{{ route('register') }}">
                            <span>Buat akun</span>
                        </a>
                    </p>

                    <div class="divider my-4">
                        <div class="divider-text">atau</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
