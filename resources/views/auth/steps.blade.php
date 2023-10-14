@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/illustrations/auth-two-step-illustration-light.png') }}"
                        alt="auth-two-steps-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="illustrations/auth-two-step-illustration-light.png"
                        data-app-dark-img="illustrations/auth-two-step-illustration-dark.html">

                    <img src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}" alt="auth-two-steps-cover"
                        class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png"
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
                    <h3 class="mb-1">Two Step Verification </h3>
                    <p class="text-start mb-4">
                        We sent a verification code to your mobile. Enter the code from the mobile in the field below.
                        <span class="fw-medium d-block mt-2">******1234</span>
                    </p>
                    <p class="mb-0 fw-medium">Type your 6 digit security code</p>
                    <form id="twoStepsForm" action="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo-1"
                        method="GET">
                        <div class="mb-3">
                            <div
                                class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1" autofocus>
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1">
                                <input type="tel"
                                    class="form-control auth-input h-px-50 text-center numeral-mask mx-1 my-2"
                                    maxlength="1">
                            </div>
                            <input type="hidden" name="otp" />
                        </div>
                        <button class="btn btn-primary d-grid w-100 mb-3">
                            Verify my account
                        </button>
                        <div class="text-center">Didn't get the code?
                            <a href="javascript:void(0);">
                                Resend
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
