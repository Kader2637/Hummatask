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
                        <p class="fs-5">{{ \Carbon\Carbon::now()->translatedFormat('l, j F Y') }}</p>
                        <p class="fs-3 text-center">Selamat datang, {{ Auth::user()->username }} divisi {{ Auth::user()->divisi->name ?? ""  }}</p>
                    </div>
                </div>
                <div class="row">
                    @if (count($tugasBelum) > 0 || count($tugas) > 0)
                        <div class="col-lg-5">
                            <div class="kanban-title-board fs-5">Tugas yang belum selesai</div>
                        </div>
                </div>
                <div class="row mt-4 justify-content-start mb-2" id="navs-tab-sesijalani">
                    @php $count = 0; @endphp
                    @foreach ($tugasBelum as $data)
                        <div class="col-12 col-xxl-4 col-lg-4">
                            <div class="card text-center mb-3">
                                <a href="{{ route('tim.board', $data->tim_code) }}" class="card-body py-3 px-3"
                                    data-eid="in-progress-1" data-comments="12" data-badge-text="UX" data-badge="success"
                                    data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png"
                                    data-members="Bruce,Clark">
                                    <div class="d-flex justify-content-start flex-wrap align-items-center mb-2 pb-1">
                                        <div class="item-badges">
                                            <div class="badge rounded-pill bg-label-success">{{ $data->prioritas }}</div>
                                        </div>
                                        @if ($data->dayleft != 0)
                                            <div style="font-size:12px; margin-left:10px;" class="text-warning">
                                                tenggat {{ $data->dayleft }} hari lagi.
                                            </div>
                                        @else
                                            <div style="font-size:12px; margin-left:10px;" class="text-warning">
                                                tenggat hari ini.
                                            </div>
                                        @endif
                                    </div>
                                    <span class="kanban-text text-left">{{ $data->nama }}</span>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                        <div class="d-flex">
                                            <span class="d-flex align-items-center ms-1">
                                                <i class="ti ti-message-dots ti-xs me-1"></i>
                                                <span> {{ $data->comments_count }} </span></span>
                                        </div>
                                        <div class="avatar-group d-flex align-items-center assigned-avatar">
                                            @foreach ($data->user as $item)
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    aria-label="{{ $item->username }}"
                                                    data-bs-original-title="{{ $item->username }}"><img
                                                        src="{{ asset('storage/' . $item->avatar) }}" alt="Avatar"
                                                        class="rounded-circle  pull-up"></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @php $count++; @endphp
                        @if ($count % 3 === 0)
                            <div class="row mt-4 justify-content-between mb-2" id="navs-tab-sesijalani">
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="kanban-title-board fs-5">Tugas terbaru</div>
                    </div>
                </div>
                <div class="row mt-4 d-flex justify-content-start" id="navs-tab-sesijalani">
                    @php $count2 = 0; @endphp
                    @foreach ($tugas as $item)
                        <div class="col-12 col-xxl-4 col-lg-4">
                            <div class="card text-center mb-3">
                                <a href="{{ route('tim.board', $item->tim_code) }}" class="card-body py-3 px-3"
                                    data-eid="in-progress-1" data-comments="12" data-badge-text="UX" data-badge="success"
                                    data-due-date="5 April" data-attachments="4" data-assigned="12.png,5.png"
                                    data-members="Bruce,Clark">
                                    <div class="d-flex justify-content-start flex-wrap align-items-center mb-2 pb-1">
                                        <div class="item-badges">
                                            <div class="badge rounded-pill bg-label-success">{{ $item->prioritas }}</div>
                                        </div>
                                        @if ($item->dayleft != 0)
                                            <div style="font-size:12px; margin-left:10px;" class="text-warning">
                                                tenggat {{ $item->dayleft }} hari lagi.
                                            </div>
                                        @else
                                            <div style="font-size:12px; margin-left:10px;" class="text-warning">
                                                tenggat hari ini.
                                            </div>
                                        @endif
                                    </div>
                                    <span class="kanban-text text-left">{{ $item->nama }}</span>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                        <div class="d-flex">
                                            <span class="d-flex align-items-center ms-1">
                                                <i class="ti ti-message-dots ti-xs me-1"></i>
                                                <span>
                                                    {{ $item->comments_count }}
                                                </span>
                                            </span>
                                        </div>
                                        <div class="avatar-group d-flex align-items-center assigned-avatar">
                                            @foreach ($item->user as $data)
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    aria-label="{{ $data->username }}"
                                                    data-bs-original-title="{{ $data->username }}">
                                                    <img class="rounded-circle"
                                                    src="{{ $data->avatar ? asset('storage/' . $data->avatar) : asset('assets/img/avatars/1.png') }}"
                                                    alt="Avatar" style="object-fit: cover">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        @php $count2++; @endphp
                        @if ($count2 % 3 === 0)
                </div>
                <div class="row mt-4 d-flex justify-content-between" id="navs-tab-sesijalani">
                    @endif
                    @endforeach
                </div>
            @else
                <div class="col">
                    <p class="text-center fw-classic fs-5">Data masih kosong <i class="ti ti-address-book-off"></i></p>
                    <div class="col-lg-12 d-flex justify-content-center">
                        <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                            alt="page-misc-under-maintenance" width="300" class="img-fluid">
                    </div>
                </div>
                @endif
            </main>
        @endsection

        @section('script')
            <script src="{{ asset('assets/js/forms-extras.js') }}"></script>
        @endsection
