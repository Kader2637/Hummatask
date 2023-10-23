@extends('auth.templates.template')

@section('content')
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5J3LMKC" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>

    <div class="container-fluid">
        <header class="p-4 d-flex flex-row align-items-center gap-2">
            <div class="app-brand mb-4 d-flex align-items-center">
                <a href="{{ route('login') }}" class="app-brand-link gap-2">
                    <span class="app-brand-logo demo"><svg width="32" height="20" viewBox="0 0 32 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                fill="#7367F0" />
                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                fill="#7367F0" />
                        </svg>
                    </span>
                </a>
            </div>
            <div class="fs-4"><span>Hummatask</span></div>
        </header>

        <div class="container">
            <h2 class="fs-2" style="font-weight: 400">Apa peran utama anda?</h2>
            <p class="w-75">Ini akan membantu kami untuk menyesuaikan web untuk anda. Kami mungkin juga akan menghubungi
                anda untuk membantu menemukan fitur yang sesuai dengan bidang pekerjaan anda</p>
            <div>
                <div class="row w-50 gy-3">
                    @foreach ($perans as $item)
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content" for="customRadioIcon1">
                                    <span class="custom-option-body">
                                        <i class='ti ti-briefcase'></i>
                                        <span class="custom-option-title"> {{ $item->peran }} </span>
                                    </span>
                                    <input name="customDeliveryRadioIcon" class="form-check-input" type="radio"
                                        value="{{ $item->id }}" id="customRadioIcon1" />
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex mt-4 gap-3">
                <button onclick="next()" type="button" id="lanjutkan-button" class="btn btn-outline-secondary">
                    Lanjutkan
                </button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let selectedPeran = null;

            $('input[name="customDeliveryRadioIcon"]').on('change', function() {
                selectedPeran = $(this).val();
                let lanjutkanButton = $('#lanjutkan-button');

                localStorage.setItem('selectedPeran', selectedPeran);

                if (selectedPeran) {
                    lanjutkanButton.removeClass('btn-outline-secondary').addClass('btn-primary');
                    lanjutkanButton.on('click', next);
                } else {
                    lanjutkanButton.removeClass('btn-primary').addClass('btn-outline-secondary');
                    lanjutkanButton.off('click');
                }
            });

            if (selectedPeran) {
                $('#peran').val(selectedPeran);
                $('#lanjutkan-button').removeClass('btn-outline-secondary').addClass('btn-primary');
            }

            function next() {
                if (selectedPeran === "siswa") {
                    // Lakukan sesuatu jika "Siswa Magang" dipilih
                } else if (selectedPeran === "mentor") {
                    // Lakukan sesuatu jika "Mentor" dipilih
                }
            }
        });
    </script>
@endsection
