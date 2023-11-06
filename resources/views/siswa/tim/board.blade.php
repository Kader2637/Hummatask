@extends('layouts.tim')


@section('link')
    <!-- Vendor Styles -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}" />
    <style>
        .komentar{
            overflow-y: auto;
            max-height: 320px;
        }
    </style>

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
@endsection

@section('content')
    <div style="height: 80vh;overflow-x: auto; " class="container-fluid row mt-2">
        <div class="d-flex mt-3 mb-0 pb-5 " style="width: 100%; overflow-x: auto ; gap:50px;">

            <div style="" class="col-3">
                <div class="card">
                    <div class="card-body p-2 py-2 row">
                        <div class="col-8 d-flex align-items-center">
                            <span style="font-size: 15px" class="">Tugas Baru</span>
                        </div>
                        <div class="col-4 d-flex justify-content-end">
                            <svg onclick="showForm('tambahTugas')" xmlns="http://www.w3.org/2000/svg" width="20"
                                height="20" viewBox="0 0 1024 1024">
                                <path fill="currentColor" d="M352 480h320a32 32 0 1 1 0 64H352a32 32 0 0 1 0-64z" />
                                <path fill="currentColor" d="M480 672V352a32 32 0 1 1 64 0v320a32 32 0 0 1-64 0z" />
                                <path fill="currentColor"
                                    d="M512 896a384 384 0 1 0 0-768a384 384 0 0 0 0 768zm0 64a448 448 0 1 1 0-896a448 448 0 0 1 0 896z" />
                            </svg>
                        </div>
                    </div>
                    <div class="row p-3 d-none" id="tambahTugas">
                        <div class="col-12">
                            <form id="formTambahTugas" method="post">
                                <label for="tugas">Nama Tugas</label>
                                <input type="text" class="form-control" id="tugas" name="tugas">
                                <div class="d-flex justify-content-end mt-3">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12" id="tugas_baru">
                    <div class="row">

                        @forelse ($tugas_baru as $tugas)
                            {{-- Kondisi dimana tugas yang tampil hanya tugas baru --}}
                            <div class="col-12 mt-3">
                                <div class="kanban-item card p-4">
                                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                        <div class="item-badges">
                                            <div class="badge rounded-pill bg-label-success">{{ $tugas->prioritas }}</div>
                                        </div>
                                        <div class="dropdown kanban-tasks-item-dropdown">
                                            <i class=" ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                    class="dropdown-item" href="javascript:void(0)"
                                                    data-bs-toggle="offcanvas"
                                                    data-bs-target="#barTugas{{ $tugas->id }}">Edit</a>
                                                <form id="deleteTaskForm" action="{{ route('delete.tugas') }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="text" name="nama" value="{{ $tugas->nama }}"
                                                        style="display: none;">
                                                    <a class="dropdown-item delete-task"
                                                        href="javascript:void(0)" onclick="konfirmasi({{$tugas->id}})">Delete</a>
                                            </div>
                                            </form>
                                        </div>
                                    </div><span class="kanban-text">{{ $tugas->nama }}</span>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                        <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                    class="ti ti-paperclip ti-xs me-1"></i><span
                                                    class="attachments">4</span></span> <span
                                                class="d-flex align-items-center ms-1"><i
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
                        @empty
                            <div id="notFound" class="card bg-secondary">
                                <div class="card-body">
                                    <p>Belum ada Tugas di timmu</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div style="" class=" col-3">
                <div class="card">
                    <div class="card-body p-2 py-2 row">
                        <div class="col-8 d-flex align-items-center">
                            <span style="font-size: 15px" class="">Dikerjakan</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($tugas_dikerjakan as $tugas)
                        <div class="col-12 mt-3">
                            <div class="kanban-item card p-4">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges">
                                        <div class="badge rounded-pill bg-label-success">{{ $tugas->prioritas }}</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown">
                                        <i class=" ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#barKerja{{ $tugas->id }}">Edit</a>
                                            <form id="deleteTaskForm" action="{{ route('delete.tugas') }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="nama" value="{{ $tugas->nama }}"
                                                    style="display: none;">
                                                <a class="dropdown-item delete-task" href="javascript:void(0)" onclick="konfirmasi({{$tugas->id}})">Delete</a>
                                        </div>
                                        </form>
                                    </div>
                                </div><span class="kanban-text">{{ $tugas->nama }}</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                    <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                class="ti ti-paperclip ti-xs me-1"></i><span
                                                class="attachments">4</span></span> <span
                                            class="d-flex align-items-center ms-1"><i
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
                    @endforeach
                </div>
            </div>
            <div style="" class=" col-3">
                <div class="card">
                    <div class="card-body p-2 py-2 row">
                        <div class="col-8 d-flex align-items-center">
                            <span style="font-size: 15px" class="">Direvisi</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($tugas_revisi as $tugas)
                        <div class="col-12 mt-3">
                            <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4"
                                data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges">
                                        <div class="badge rounded-pill bg-label-success">{{ $tugas->prioritas }}</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown">
                                        <i class=" ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#barRevisi{{ $tugas->id }}">Edit</a>
                                            <form id="deleteTaskForm" action="{{ route('delete.tugas') }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="nama" value="{{ $tugas->nama }}"
                                                    style="display: none;">
                                                <a class="dropdown-item delete-task" href="javascript:void(0)" onclick="konfirmasi({{$tugas->id}})">Delete</a>
                                        </div>
                                        </form>
                                    </div>
                                </div><span class="kanban-text">{{ $tugas->nama }}</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                    <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                class="ti ti-paperclip ti-xs me-1"></i><span
                                                class="attachments">4</span></span> <span
                                            class="d-flex align-items-center ms-1"><i
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
                    @endforeach
                </div>
            </div>
            <div style="" class=" col-3">
                <div class="card">
                    <div class="card-body p-2 py-2 row">
                        <div class="col-8 d-flex align-items-center">
                            <span style="font-size: 15px" class="">Selesai</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($tugas_selesai as $tugas)
                        <div class="col-12 mt-3">
                            <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4"
                                data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges">
                                        <div class="badge rounded-pill bg-label-success">{{ $tugas->prioritas }}</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown">
                                        <i class=" ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)"
                                                data-bs-toggle="offcanvas"
                                                data-bs-target="#barSelesai{{ $tugas->id }}">Edit</a>
                                            <form id="deleteTaskForm" action="{{ route('delete.tugas') }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="text" name="nama" value="{{ $tugas->nama }}"
                                                    style="display: none;">
                                                <a class="dropdown-item delete-task" href="javascript:void(0)" onclick="konfirmasi({{$tugas->id}})">Delete</a>
                                        </div>
                                        </form>
                                    </div>
                                </div><span class="kanban-text">{{ $tugas->nama }}</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                    <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                class="ti ti-paperclip ti-xs me-1"></i><span
                                                class="attachments">4</span></span> <span
                                            class="d-flex align-items-center ms-1"><i
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Kanban Wrapper -->
    <div class="kanban-wrapper"></div>

    @foreach ($tugas_baru as $tugas)
        <div class="offcanvas offcanvas-end kanban-update-item-sidebar" id="barTugas{{ $tugas->id }}">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body overflow-hidden">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#tab-update{{ $tugas->id }}">
                            <i class="ti ti-edit me-2"></i>
                            <span class="align-middle">Edit</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tugas_baru{{ $tugas->id }}">
                            <i class="ti ti-message-dots ti-xs me-1"></i>
                            <span class="align-middle">Komentar</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content px-0 pb-0">
                    <!-- Update item/tasks -->
                    <div class="tab-pane fade show active" id="tab-update{{ $tugas->id }}" role="tabpanel">
                        <form method="POST" id="comment-form" action="{{ route('ubahStatus') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label" for="title">Nama Tugas</label>
                                <input type="text" id="title{{ $tugas->id }}" class="form-control"
                                    value="{{ $tugas->nama }}" name="nama" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="due-date">Deadline</label>
                                <input type="date" id="due-date" name="deadline" value="{{ $tugas->deadline }}"
                                    class="form-control" placeholder="Enter Deadline" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="newStatus">Status</label>
                                <select class="select2 select2-label form-select" id="status" name="newStatus">
                                    <option data-color="bg-label-success" value="tugas_baru"
                                        {{ $tugas->status_tugas === 'tugas_baru' ? 'selected' : '' }}>Tugas Baru</option>
                                    <option data-color="bg-label-warning"
                                        value="dikerjakan"{{ $tugas->status_tugas === 'dikerjakan' ? 'selected' : '' }}>
                                        Dikerjakan</option>
                                    <option data-color="bg-label-info"
                                        value="revisi"{{ $tugas->status_tugas === 'revisi' ? 'selected' : '' }}>Direvisi
                                    </option>
                                    <option data-color="bg-label-danger" value="selesai"
                                        {{ $tugas->status_tugas === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class a="form-label" for="newPriority">Prioritas</label>
                                <select class="select2 select2-label form-select" id="newPriority" name="newPriority">
                                    <option data-color="bg-label-success" value="penting"
                                        {{ $tugas->prioritas === 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option data-color="bg-label-warning" value="urgen"
                                        {{ $tugas->prioritas === 'urgen' ? 'selected' : '' }}>Urgen</option>
                                    <option data-color="bg-label-info" value="mendesak"
                                        {{ $tugas->prioritas === 'mendesak' ? 'selected' : '' }}>Mendesak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class a="form-label" for="label">Anggota</label>
                                <select class="select2 select2-label form-select" id="label">
                                    <option data-color="bg-label-success" value="UX">UX</option>
                                    <option data-color="bg-label-warning" value="Images">
                                        Images
                                    </option>
                                    <option data-color="bg-label-info" value="Info">Info</option>
                                    <option data-color="bg-label-danger" value="Code Review">
                                        Code Review
                                    </option>
                                    <option data-color="bg-label-secondary" value="App">
                                        App
                                    </option>
                                    <option data-color="bg-label-primary" value="Charts & Maps">
                                        Charts & Maps
                                    </option>
                                </select>
                            </div>

                            <div class="d-flex flex-wrap">
                                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                    Update
                                </button>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                    close
                                </button>
                            </div>
                        </form>

                    </div>
                    <!-- Activities -->

                    <div class="tab-pane fade" id="tugas_baru{{ $tugas->id }}" role="tabpanel">
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="media-body komentar" id="comments-container" style="margin-bottom: 200px">
                                @foreach ($tugas->comments as $comment)
                                    <div style="" class="media d-flex align-items-start">
                                        <div class="avatar me-2 flex-shrink-0 mt-1">
                                            <img src="{{ $comment->user->avatar}}" alt="Avatar"
                                                class="rounded-circle" />
                                        </div>
                                        <div class="media-body">
                                            <p class="mb-1">
                                                <span class="fw-medium">{{ $comment->user->username }}</span>
                                            </p>
                                            <div class="mb-1">
                                                <textarea class="form-control" rows="3" disabled>{{ $comment->text }}</textarea>
                                            </div>
                                            <small class="text-muted">{{ $comment->created_at }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <form action="{{ route('tim.addComment') }}" method="POST"
                            id="comment-form-{{ $tugas->id }}">
                            @csrf
                            <div class="mb-4 position-fixed bottom-0 bg-white pt-1">
                                <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                                <input type="text" name="tugas_id" value="{{ $tugas->id }}"
                                    style="display: none;">
                                <textarea class="form-control position-fix bottom-0 mb-3" id="exampleFormControlTextarea1" name="text"
                                    rows="3" style="width: 350px"></textarea>
                                <button type="submit" class="btn btn-primary">Add Comment</button>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

    @foreach ($tugas_dikerjakan as $tugas)
        <div class="offcanvas offcanvas-end kanban-update-item-sidebar" id="barKerja{{ $tugas->id }}">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#tab-update{{ $tugas->id }}">
                            <i class="ti ti-edit me-2"></i>
                            <span class="align-middle">Edit</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#dikerjakan{{ $tugas->id }}">
                            <i class="ti ti-message-dots ti-xs me-1"></i>
                            <span class="align-middle">Komentar</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content px-0 pb-0">
                    <!-- Update item/tasks -->
                    <div class="tab-pane fade show active" id="tab-update{{ $tugas->id }}" role="tabpanel">
                        <form method="POST" action="{{ route('ubahStatus') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label" for="title">Nama Tugas</label>
                                <input type="text" id="title{{ $tugas->id }}" class="form-control"
                                    value="{{ $tugas->nama }}" name="nama" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="due-date">Deadline</label>
                                <input type="date" id="due-date" name="deadline" class="form-control"
                                    value="{{ $tugas->deadline }}" placeholder="Enter Deadline" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="newStatus"> Status</label>
                                <select class="select2 select2-label form-select" id="status" name="newStatus">
                                    <option data-color="bg-label-success" value="tugas_baru"
                                        {{ $tugas->status_tugas === 'tugas_baru' ? 'selected' : '' }}>Tugas Baru</option>
                                    <option data-color="bg-label-warning"
                                        value="dikerjakan"{{ $tugas->status_tugas === 'dikerjakan' ? 'selected' : '' }}>
                                        Dikerjakan</option>
                                    <option data-color="bg-label-info"
                                        value="revisi"{{ $tugas->status_tugas === 'revisi' ? 'selected' : '' }}>Direvisi
                                    </option>
                                    <option data-color="bg-label-danger" value="selesai"
                                        {{ $tugas->status_tugas === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class a="form-label" for="newPriority">Prioritas</label>
                                <select class="select2 select2-label form-select" id="newPriority" name="newPriority">
                                    <option data-color="bg-label-success" value="penting"
                                        {{ $tugas->prioritas === 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option data-color="bg-label-warning" value="urgen"
                                        {{ $tugas->prioritas === 'urgen' ? 'selected' : '' }}>Urgen</option>
                                    <option data-color="bg-label-info" value="mendesak"
                                        {{ $tugas->prioritas === 'mendesak' ? 'selected' : '' }}>Mendesak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">anggota</label>
                                <div class="d-flex">
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

                            <div class="mb-4">
                                <label class="form-label">Komentar</label>
                                <div class="mb-3">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap">
                                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                    Update
                                </button>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Activities -->

                    <div class="tab-pane fade" id="dikerjakan{{ $tugas->id }}" role="tabpanel">
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> Left the board.
                                </p>
                                <small class="text-muted">Today 11:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> mentioned
                                    <span class="text-primary">@bruce</span> in
                                    a comment.
                                </p>
                                <small class="text-muted">Today 10:20 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Martian</span> added moved
                                    Charts & Maps task to the done board.
                                </p>
                                <small class="text-muted">Today 10:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Commented on App
                                    review task.
                                </p>
                                <small class="text-muted">Today 8:32 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> was assigned
                                    task of code review.
                                </p>
                                <small class="text-muted">Today 8:30 PM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> assigned task UX
                                    Research to
                                    <span class="text-primary">@martian</span>
                                </p>
                                <small class="text-muted">Today 8:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Ray</span> Added moved
                                    <span class="fw-medium">Forms & Tables</span> task
                                    from in progress to done.
                                </p>
                                <small class="text-muted">Today 7:45 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Complete all the
                                    tasks assigned to him.
                                </p>
                                <small class="text-muted">Today 7:17 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> added task to
                                    update new images.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> moved task
                                    <span class="fw-medium">FAQ UX</span> from in
                                    progress to done board.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> added new board
                                    with name <span class="fw-medium">Done</span>.
                                </p>
                                <small class="text-muted">Yesterday 3:00 PM</small>
                            </div>
                        </div>
                        <div class="media d-flex align-items-center">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> added new task
                                    in progress board.
                                </p>
                                <small class="text-muted">Yesterday 12:00 PM</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($tugas_revisi as $tugas)
        <div class="offcanvas offcanvas-end kanban-update-item-sidebar" id="barRevisi{{ $tugas->id }}">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#tab-update{{ $tugas->id }}">
                            <i class="ti ti-edit me-2"></i>
                            <span class="align-middle">Edit</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#revisi{{ $tugas->id }}">
                            <i class="ti ti-message-dots ti-xs me-1"></i>
                            <span class="align-middle">Komentar</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content px-0 pb-0">
                    <!-- Update item/tasks -->
                    <div class="tab-pane fade show active" id="tab-update{{ $tugas->id }}" role="tabpanel">
                        <form method="POST" action="{{ route('ubahStatus') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label" for="title">Nama Tugas</label>
                                <input type="text" id="title{{ $tugas->id }}" class="form-control"
                                    value="{{ $tugas->nama }}" name="nama" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="due-date">Deadline</label>
                                <input type="date" id="due-date" name="deadline" value="{{ $tugas->deadline }}"
                                    class="form-control" placeholder="Enter Deadline" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="newStatus"> Status</label>
                                <select class="select2 select2-label form-select" id="status" name="newStatus">
                                    <option data-color="bg-label-success" value="tugas_baru"
                                        {{ $tugas->status_tugas === 'tugas_baru' ? 'selected' : '' }}>Tugas Baru</option>
                                    <option data-color="bg-label-warning"
                                        value="dikerjakan"{{ $tugas->status_tugas === 'dikerjakan' ? 'selected' : '' }}>
                                        Dikerjakan</option>
                                    <option data-color="bg-label-info"
                                        value="revisi"{{ $tugas->status_tugas === 'revisi' ? 'selected' : '' }}>Direvisi
                                    </option>
                                    <option data-color="bg-label-danger" value="selesai"
                                        {{ $tugas->status_tugas === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class a="form-label" for="newPriority">Prioritas</label>
                                <select class="select2 select2-label form-select" id="newPriority" name="newPriority">
                                    <option data-color="bg-label-success" value="penting"
                                        {{ $tugas->prioritas === 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option data-color="bg-label-warning" value="urgen"
                                        {{ $tugas->prioritas === 'urgen' ? 'selected' : '' }}>Urgen</option>
                                    <option data-color="bg-label-info" value="mendesak"
                                        {{ $tugas->prioritas === 'mendesak' ? 'selected' : '' }}>Mendesak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Assigned</label>
                                <div class="assigned d-flex flex-wrap"></div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>

                            <div class="d-flex flex-wrap">
                                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                    Update
                                </button>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Activities -->

                    <div class="tab-pane fade" id="revisi{{ $tugas->id }}" role="tabpanel">
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> Left the board.
                                </p>
                                <small class="text-muted">Today 11:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> mentioned
                                    <span class="text-primary">@bruce</span> in
                                    a comment.
                                </p>
                                <small class="text-muted">Today 10:20 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Martian</span> added moved
                                    Charts & Maps task to the done board.
                                </p>
                                <small class="text-muted">Today 10:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Commented on App
                                    review task.
                                </p>
                                <small class="text-muted">Today 8:32 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> was assigned
                                    task of code review.
                                </p>
                                <small class="text-muted">Today 8:30 PM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> assigned task UX
                                    Research to
                                    <span class="text-primary">@martian</span>
                                </p>
                                <small class="text-muted">Today 8:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Ray</span> Added moved
                                    <span class="fw-medium">Forms & Tables</span> task
                                    from in progress to done.
                                </p>
                                <small class="text-muted">Today 7:45 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Complete all the
                                    tasks assigned to him.
                                </p>
                                <small class="text-muted">Today 7:17 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> added task to
                                    update new images.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> moved task
                                    <span class="fw-medium">FAQ UX</span> from in
                                    progress to done board.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> added new board
                                    with name <span class="fw-medium">Done</span>.
                                </p>
                                <small class="text-muted">Yesterday 3:00 PM</small>
                            </div>
                        </div>
                        <div class="media d-flex align-items-center">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> added new task
                                    in progress board.
                                </p>
                                <small class="text-muted">Yesterday 12:00 PM</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($tugas_selesai as $tugas)
        <div class="offcanvas offcanvas-end kanban-update-item-sidebar" id="barSelesai{{ $tugas->id }}">
            <div class="offcanvas-header border-bottom">
                <h5 class="offcanvas-title">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="nav nav-tabs tabs-line">
                    <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab"
                            data-bs-target="#tab-update{{ $tugas->id }}">
                            <i class="ti ti-edit me-2"></i>
                            <span class="align-middle">Edit</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#selesai{{ $tugas->id }}">
                            <i class="ti ti-message-dots ti-xs me-1"></i>
                            <span class="align-middle">Komentar</span>
                        </button>
                    </li>
                </ul>
                <div class="tab-content px-0 pb-0">
                    <!-- Update item/tasks -->
                    <div class="tab-pane fade show active" id="tab-update{{ $tugas->id }}" role="tabpanel">
                        <form method="POST" action="{{ route('ubahStatus') }}">
                            @csrf
                            @method('PATCH')
                            <div class="mb-3">
                                <label class="form-label" for="title">Nama Tugas</label>
                                <input type="text" id="title{{ $tugas->id }}" class="form-control"
                                    value="{{ $tugas->nama }}" name="nama" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="due-date">Deadline</label>
                                <input type="date" id="due-date" name="deadline" value="{{ $tugas->deadline }}"
                                    class="form-control" placeholder="Enter Deadline" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="newStatus"> Status</label>
                                <select class="select2 select2-label form-select" id="status" name="newStatus">
                                    <option data-color="bg-label-success" value="tugas_baru"
                                        {{ $tugas->status_tugas === 'tugas_baru' ? 'selected' : '' }}>Tugas Baru</option>
                                    <option data-color="bg-label-warning"
                                        value="dikerjakan"{{ $tugas->status_tugas === 'dikerjakan' ? 'selected' : '' }}>
                                        Dikerjakan</option>
                                    <option data-color="bg-label-info"
                                        value="revisi"{{ $tugas->status_tugas === 'revisi' ? 'selected' : '' }}>Direvisi
                                    </option>
                                    <option data-color="bg-label-danger" value="selesai"
                                        {{ $tugas->status_tugas === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class a="form-label" for="newPriority">Prioritas</label>
                                <select class="select2 select2-label form-select" id="newPriority" name="newPriority">
                                    <option data-color="bg-label-success" value="penting"
                                        {{ $tugas->prioritas === 'penting' ? 'selected' : '' }}>Penting</option>
                                    <option data-color="bg-label-warning" value="urgen"
                                        {{ $tugas->prioritas === 'urgen' ? 'selected' : '' }}>Urgen</option>
                                    <option data-color="bg-label-info" value="mendesak"
                                        {{ $tugas->prioritas === 'mendesak' ? 'selected' : '' }}>Mendesak</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Assigned</label>
                                <div class="assigned d-flex flex-wrap"></div>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Komentar</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="d-flex flex-wrap">
                                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                    Update
                                </button>
                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                    Close
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- Activities -->

                    <div class="tab-pane fade" id="selesai{{ $tugas->id }}" role="tabpanel">
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> Left the board.
                                </p>
                                <small class="text-muted">Today 11:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> mentioned
                                    <span class="text-primary">@bruce</span> in
                                    a comment.
                                </p>
                                <small class="text-muted">Today 10:20 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Martian</span> added moved
                                    Charts & Maps task to the done board.
                                </p>
                                <small class="text-muted">Today 10:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Commented on App
                                    review task.
                                </p>
                                <small class="text-muted">Today 8:32 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> was assigned
                                    task of code review.
                                </p>
                                <small class="text-muted">Today 8:30 PM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> assigned task UX
                                    Research to
                                    <span class="text-primary">@martian</span>
                                </p>
                                <small class="text-muted">Today 8:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/4.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Ray</span> Added moved
                                    <span class="fw-medium">Forms & Tables</span> task
                                    from in progress to done.
                                </p>
                                <small class="text-muted">Today 7:45 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/1.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Barry</span> Complete all the
                                    tasks assigned to him.
                                </p>
                                <small class="text-muted">Today 7:17 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-success rounded-circle">HJ</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Jordan</span> added task to
                                    update new images.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <img src="../../demo/assets/img/avatars/6.png" alt="Avatar" class="rounded-circle" />
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Dianna</span> moved task
                                    <span class="fw-medium">FAQ UX</span> from in
                                    progress to done board.
                                </p>
                                <small class="text-muted">Today 7:00 AM</small>
                            </div>
                        </div>
                        <div class="media mb-4 d-flex align-items-start">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-danger rounded-circle">CK</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Clark</span> added new board
                                    with name <span class="fw-medium">Done</span>.
                                </p>
                                <small class="text-muted">Yesterday 3:00 PM</small>
                            </div>
                        </div>
                        <div class="media d-flex align-items-center">
                            <div class="avatar me-2 flex-shrink-0 mt-1">
                                <span class="avatar-initial bg-label-secondary rounded-circle">BW</span>
                            </div>
                            <div class="media-body">
                                <p class="mb-0">
                                    <span class="fw-medium">Bruce</span> added new task
                                    in progress board.
                                </p>
                                <small class="text-muted">Yesterday 12:00 PM</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('script')
    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    {{-- <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
    </script>
    <script
        src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}">
    </script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}">
    </script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/katex.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/quill/quill.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    {{-- <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script> --}}

    <!-- END: Theme JS-->
    <!-- Pricing Modal JS-->
    <!-- END: Pricing Modal JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/app-kanban.js') }}"></script>
    <!-- END: Page JS-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadComments() {
                $.ajax({ // Ganti $ajax menjadi $.ajax
                    url: "/comments",
                    type: "GET",
                    success: function(data) {
                        const comments = data.map(comment => `<div>${comment.text}</div>`).join('');
                        $("#comments-container").html(comments);
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            }
            loadComments();

            @foreach ($tugas_baru as $tugas)
                $("#comment-form-{{ $tugas->id }}").submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: "{{ route('tim.addComment') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        success: function(data) {
                            loadComments();
                            $("#comment-form-{{ $tugas->id }}")[0].reset();
                        },
                        error: function(error) {
                            console.error(error);
                        }
                    });
                });
            @endforeach
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var deleteTaskLink = document.querySelector(".delete-task");

            deleteTaskLink.addEventListener("click", function() {
                Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus tugas ini?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("deleteTaskForm").submit();
                    }
                });
            });
        });
        function konfirmasi(id){
            Swal.fire({
                    title: 'Konfirmasi',
                    text: 'Apakah Anda yakin ingin menghapus tugas ini?',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("deleteTaskForm").submit();
                    }
                });
        }
    </script>

    <script>
        // let dataEmpty

        axios.get("{{ route('dataTugas', $tim->uuid) }}")
            .then(res => {
                const data = res.data;

                console.log("{{ $tim->uuid }}");

            })

        function showForm(id) {
            let status = false;

            if (!status) {
                document.getElementById(id).classList.toggle('d-none')
                status = true
            } else {
                document.getElementById(id).classList.toggle('d-none')
                status = false
            }
        }

        // tambah tugas
        const formTambahTugas = document.getElementById('formTambahTugas');
        formTambahTugas.addEventListener('submit', (event) => {
            event.preventDefault();
            const nama = document.getElementById('tugas').value
            const tim_uuid = "{{ $tim->uuid }}"

            // axios untuk tambah tugas
            axios.post("tambah-tugas", {
                    nama,
                    tim_uuid
                })
                .then(res => {
                    const newData = res.data;

                    const newElement = document.createElement('div');
                    newElement.classList.add('kanban-item', 'card', 'p-4', 'mt-3');
                    newElement.setAttribute('data-eid', 'in-progress-1');
                    newElement.setAttribute('data-comments', '12');
                    newElement.setAttribute('data-badge-text', 'UX');
                    newElement.setAttribute('data-badge', 'success');
                    newElement.setAttribute('data-due-date', '5 April');
                    newElement.setAttribute('data-attachments', '4');
                    newElement.setAttribute('data-assigned', '12.png,5.png');
                    newElement.setAttribute('data-members', 'Bruce,Clark');

                    newElement.innerHTML = `
      <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1 ">
        <div class="item-badges">
          <div class="badge rounded-pill bg-label-success">UX</div>
        </div>
        <div class="dropdown kanban-tasks-item-dropdown">
          <i class="dropdown-toggle ti ti-dots-vertical" id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
          <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item-dropdown" style="">
            <a class="dropdown-item" href="javascript:void(0)">Copy task link</a>
            <a class="dropdown-item" href="javascript:void(0)">Duplicate task</a>
            <a class="dropdown-item delete-task" href="javascript:void(0)">Delete</a>
          </div>
        </div>
      </div>
      <span class="kanban-text">${newData.nama}</span>
      <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
        <div class="d-flex">
          <span class="d-flex align-items-center me-2">
            <i class="ti ti-paperclip ti-xs me-1"></i>
            <span class="attachments">4</span>
          </span>
          <span class="d-flex align-items-center ms-1">
            <i class="ti ti-message-dots ti-xs me-1"></i>
            <span>12</span>
          </span>
        </div>
        <div class="avatar-group d-flex align-items-center assigned-avatar">
          <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bruce" data-bs-original-title="Bruce">
            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png" alt="Avatar" class="rounded-circle pull-up">
          </div>
          <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Clark" data-bs-original-title="Clark">
            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png" alt="Avatar" class="rounded-circle pull-up">
          </div>
        </div>
      </div>
    `;

                    // Tambahkan elemen baru ke dalam div dengan id "tugas_baru"
                    const tugasBaru = document.getElementById('tugas_baru');
                    tugasBaru.appendChild(newElement);

                    document.getElementById('notFound').classList.add('d-none')

                })

                .catch(error => {
                    console.log(error)
                })

        })
    </script>
@endsection
