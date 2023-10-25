@extends('layouts.app')


@section('style')
    <style>
        .jumbotron {
            height: 20vh;
        }
    </style>
@endsection

@section('link')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.cs') }}s" />
@endsection

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

@section('content')
    <main class="container-fluid p-3">
        <div class="row">
            <div class=" jumbotron col-12 d-flex flex-column align-items-center justify-content-center">
                <p>Senin,19 oktober 2023</p>
                <p class="fs-3">Selamat datang, Adi Kurniawan</p>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="kanban-title-board fs-5">Tugas yang belum selesai</div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center mb-2" id="navs-tab-sesijalani">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4">
                    <div class="card text-center mb-3">
                        <div class="kanban-item" data-eid="in-progress-1" data-comments="12" data-badge-text="UX"
                            data-badge="success" data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png"
                            data-members="Bruce,Clark">
                            <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                <div class="item-badges">
                                    <div class="badge rounded-pill bg-label-success"> UX</div>
                                </div>
                            </div>
                            <span class="kanban-text text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex,
                                impedit!</span>
                            <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                            class="ti ti-paperclip ti-xs me-1"></i><span class="attachments">4</span></span>
                                    <span class="d-flex align-items-center ms-1"><i
                                            class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                </div>
                                <div class="avatar-group d-flex align-items-center assigned-avatar">
                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="Bruce" data-bs-original-title="Bruce"><img
                                            src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="Clark" data-bs-original-title="Clark"><img
                                            src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="kanban-title-board fs-5">Tugas terbaru</div>
            </div>
        </div>
        <div class="row mt-4 justify-content-center" id="navs-tab-sesijalani">
            @for ($i = 0; $i < 3; $i++)
                <div class="col-lg-4">
                    <div class="card text-center mb-3">
                        <div class="kanban-item" data-eid="in-progress-1" data-comments="12" data-badge-text="UX"
                            data-badge="success" data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png"
                            data-members="Bruce,Clark">
                            <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                <div class="item-badges">
                                    <div class="badge rounded-pill bg-label-success"> UX</div>
                                </div>
                            </div>
                            <span class="kanban-text text-left">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex,
                                impedit!</span>
                            <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                            class="ti ti-paperclip ti-xs me-1"></i><span class="attachments">4</span></span>
                                    <span class="d-flex align-items-center ms-1"><i
                                            class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                </div>
                                <div class="avatar-group d-flex align-items-center assigned-avatar">
                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="Bruce" data-bs-original-title="Bruce"><img
                                            src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="Clark" data-bs-original-title="Clark"><img
                                            src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                            alt="Avatar" class="rounded-circle  pull-up"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </main>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
@endsection
