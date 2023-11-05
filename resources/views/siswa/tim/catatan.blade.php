@extends('layouts.tim')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
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

    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <form class="card" action="{{ route('catatan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                    <span class="card-header fs-4">Catatan</span>
                    <span class="card-header">
                        <button type="button" class="btn btn-label-danger mx-2" data-bs-toggle="modal"
                            data-bs-target="#modalTolak">Reset</button>
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalTerima">Simpan</button>
                    </span>
                </div>
                <input type="file" id="fileInput" accept="image/*" class="d-none">
                <div class="card-body p-0 px-3 pb-4 m-0">
                    <div id="editor">
                        <div>
                        </div>
                    </div>
                    <textarea name="content" id="content" cols="30" rows="10" class="d-none"></textarea>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endsection
