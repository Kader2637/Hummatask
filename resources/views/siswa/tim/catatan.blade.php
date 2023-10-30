@extends('layouts.tim')

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
    {{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}
@endsection

@section('content')
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="d-flex flex-row flex-wrap justify-content-between p-0 m-0">
                    <span class="card-header fs-4">Catatan</span>
                    <span class="card-header">
                        <button type="button" class="btn btn-label-danger mx-2" data-bs-toggle="modal"
                            data-bs-target="#modalTolak">Reset</button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modalTerima">Simpan</button>
                    </span>
                </div>
                <div class="card-body p-0 px-3 pb-4 m-0">
                    <div id="editor">
                        <div>
                            <p> Cupcake ipsum dolor sit amet. Halvah cheesecake chocolate bar gummi bears cupcake. Pie
                                macaroon
                                bear claw. Soufflé I love candy canes I love cotton candy I love. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
@endsection
