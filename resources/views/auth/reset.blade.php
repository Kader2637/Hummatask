@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="authentication-wrapper authentication-cover authentication-bg ">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-reset-password-illustration-light.png') }}"
                        alt="auth-reset-password-cover" class="img-fluid my-5 auth-illustration"
                        data-app-dark-img="illustrations/auth-reset-password-illustration-dark.html">
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                            class="app-brand-link gap-2">
                        </a>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h4 class="mb-1">Reset Password </h4>
                    <p class="mb-4">untuk <span class="fw-medium">{{request()->email}}m</span></p>
                    
                    <form id="formAuthentication" class="mb-3" action="{{ Route('password.update') }}" method="post">
                        @csrf
                        <input type="hidden" name="token" value="{{ request()->token }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password baru</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="confirm-password">Konfirmasi password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="confirm-password" class="form-control" name="confirm-password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100 mb-3">
                            Kirim password baru
                        </button>
                        <div class="text-center">
                            <a href="{{ route('login') }}">
                                <i class="ti ti-chevron-left scaleX-n1-rtl"></i>
                                Kembali ke login
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
