@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-forgot-password-illustration-light.png') }}"
                        alt="auth-forgot-password-cover" class="img-fluid my-5 auth-illustration">
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                            class="app-brand-link gap-2">
                        </a>
                    </div>

                    <h3 class="mb-1">Lupa password? </h3>
                    <p class="mb-4">
                        Masukan email anda dan akam mengirim intruksi untuk atur ulang kata sandi
                    </p>
                    <form id="formAuthentication" class="mb-3" action="{{ Route('lupa-password.store') }}" method="post">
                        @csrf

                        @error('email')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                        @if (session('status'))
                            <div class="alert alert-success mt-2">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email" autofocus>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Kirim</button>
                    </form>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                            Kembali ke login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
