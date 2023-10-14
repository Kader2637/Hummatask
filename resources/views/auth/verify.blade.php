@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="authentication-wrapper authentication-cover authentication-bg ">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-verify-email-illustration-light.png') }}"
                        alt="auth-verify-email-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-verify-email-illustration-light.png"
                        data-app-dark-img="illustrations/auth-verify-email-illustration-dark.html">

                    <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
                        alt="auth-verify-email-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.html">
                </div>
            </div>
            <div class="d-flex col-12 col-lg-5 align-items-center p-4 p-sm-5">
                <div class="w-px-400 mx-auto">
                    <div class="app-brand mb-4">
                        <a href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                            class="app-brand-link gap-2">
                        </a>
                    </div>
                    <h3 class="mb-1">Verify your email</h3>
                    <p class="text-start mb-4">
                        Account activation link sent to your email address: hello@example.com Please follow the link inside
                        to continue.
                    </p>
                    <a class="btn btn-primary w-100 mb-3"
                        href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1">
                        Skip for now
                    </a>
                    <p class="text-center">Didn't get the mail?
                        <a href="javascript:void(0);">
                            Resend
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
