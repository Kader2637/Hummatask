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
            <h2 class="fs-2">Apa bidang pekerjaan anda?</h2>
            <p class="w-50">Ini akan membantu kami untuk menyesuaikan web untuk anda. Kami untuk membantu menemukan fitur
                yang sesuai dengan bidang pekerjaan anda</p>
            <p>pilih semua yang sesuai</p>

            <div class="d-flex flex-wrap gap-2">
                @foreach ($bidangs as $i => $bidang)
                    <label class="flex-wrap" for="{{ $bidang->id }}">
                        <button type="button" class="btn btn-outline-primary px-3" id="{{ $bidang->id }}"
                            onclick="toggleCheckbox('{{ $bidang->id }}')">{{ $bidang->bidang }}</button>
                        <input class="d-none" type="checkbox" name="bidang[]" id="{{ $bidang->id }}"
                            value="{{ $bidang->bidang }}">
                    </label>
                @endforeach
            </div>
            <div class="d-flex mt-5 gap-3">
                <button id="next" class="btn btn-outline-secondary">
                    Selanjutnya
                </button>
            </div>

        </div>
    </div>

    <script>
        var checkboxes = document.querySelectorAll('input[name="bidang');

        function toggleCheckbox(checkboxId) {
            let checkbox = document.getElementById(checkboxId);
            let button = document.getElementById(checkboxId)
            let storageId = []
            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                let storageId = JSON.parse(localStorage.getItem('storagePekerjaanId')) || [];
                if (storageId.indexOf(checkboxId) === -1) {
                    storageId.push(checkboxId);
                    localStorage.setItem('storagePekerjaanId', JSON.stringify(storageId));
                }

                button.classList.remove('btn-outline-primary');
                button.classList.add('btn-primary');
            } else {
                button.classList.remove('btn-primary');
                button.classList.add('btn-outline-primary');

                let storageId = JSON.parse(localStorage.getItem('storagePekerjaanId')) || [];
                const index = storageId.indexOf(checkboxId);
                if (index > -1) {
                    storageId.splice(index, 1);
                    localStorage.setItem('storagePekerjaanId', JSON.stringify(storageId));
                }
            }
        }

        window.addEventListener('load', function() {
            localStorage.removeItem('storagePekerjaanId');
        });

        function updateNextButtonColor() {
            let storagePekerjaanId = JSON.parse(localStorage.getItem('storagePekerjaanId'));
            let selanjutnyaButton = document.querySelector('#next');

            if (storagePekerjaanId && storagePekerjaanId.length > 0) {
                selanjutnyaButton.classList.remove('btn-outline-secondary');
                selanjutnyaButton.classList.add('btn-primary');
            } else {
                selanjutnyaButton.classList.remove('btn-primary');
                selanjutnyaButton.classList.add('btn-outline-secondary');
            }
        }

        setInterval(updateNextButtonColor, 100);
    </script>
@endsection
