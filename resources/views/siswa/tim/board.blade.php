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

    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
@endsection

@section('content')
    {{-- Canvas  --}}

    <div id="editCanvas" class="offcanvas offcanvas-end kanban-update-item-sidebar">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Edit Tugas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav nav-tabs tabs-line row" role="tablist">
                <li class="nav-item col-4" role="presentation">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update" aria-selected="true"
                        role="tab">
                        <i class="ti ti-edit me-2"></i>
                        <span class="align-middle">Edit</span>
                    </button>
                </li>
                <li class="nav-item col-4" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-komentar" aria-selected="false"
                        role="tab">
                        <i class="ti ti-message me-2"></i>
                        <span class="align-middle">Komentar</span>
                    </button>
                </li>
                <li class="nav-item col-4" role="presentation">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-activity" aria-selected="false"
                        role="tab" tabindex="-1">
                        <i class="ti ti-trending-up me-2"></i>
                        <span class="align-middle">Activity</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content px-0 pb-0">
                <!-- Update item/tasks -->
                <div class="tab-pane fade active show" id="tab-update" role="tabpanel">
                    <form class="mt-2">
                        <div class="mb-3">
                            <label class="form-label" for="title">Tugas</label>
                            <input type="text" id="title" class="form-control" placeholder="Enter Title">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="due-date">Deadline</label>
                            <input type="date" id="due-date" class="form-control flatpickr-input"
                                placeholder="Enter Due Date" readonly="readonly">
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="inputStatusTugas">Status Tugas</label>
                            <select name="inputStatusTugas" id="inputStatusTugas">
                                <option value="" disabled selected>Pilih</option>
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="label">Tingkat Prioritas</label>
                            <div class="position-relative">
                                <select
                                    class="select2 select2-label form-select select2-hidden-accessible" id="label"
                                    data-select2-id="label" tabindex="-1" aria-hidden="true">
                                    <option data-color="bg-label-success" value="UX" data-select2-id="2">UX</option>
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
                                    <option data-color="bg-label-primary" value="Charts &amp; Maps">
                                        Charts &amp; Maps
                                    </option>
                                </select>
                                <div class="d-none">


                                <span class="select2 select2-container select2-container--default d-none hidden" dir="ltr"
                                    data-select2-id="1" style="width: 352px;"><span class="selection d-none"><span
                                            class="select2-selection select2-selection--single" role="combobox"
                                            aria-haspopup="true" aria-expanded="false" tabindex="0"
                                            aria-disabled="false" aria-labelledby="select2-label-container"><span
                                                class="select2-selection__rendered" id="select2-label-container"
                                                role="textbox" aria-readonly="true" title="UX">
                                                <div class="badge bg-label-success rounded-pill"> UX</div>
                                            </span><span class="select2-selection__arrow" role="presentation"><b
                                                    role="presentation"></b></span></span></span><span
                                        class="dropdown-wrapper" aria-hidden="true"></span></span>
                                    </div>
                                    </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tugaskan ke</label>
                            <div class="assigned d-flex flex-wrap">
                                <div class="avatar avatar-xs me-1" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="Bruce" data-bs-original-title="Bruce"><img
                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                        alt="Avatar" class="rounded-circle "></div>
                                <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                    aria-label="Clark" data-bs-original-title="Clark"><img
                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                        alt="Avatar" class="rounded-circle "></div>
                                <div class="avatar avatar-xs ms-1"><span
                                        class="avatar-initial rounded-circle bg-label-secondary"><i
                                            class="ti ti-plus ti-xs text-heading"></i></span></div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Comment</label>
                            <div class="comment-editor border-bottom-0 ql-container ql-snow">
                                <div class="ql-editor ql-blank" data-gramm="false" contenteditable="true"
                                    data-placeholder="Write a Comment... ">
                                    <p><br></p>
                                </div>
                                <div class="ql-clipboard" contenteditable="true" tabindex="-1"></div>
                                <div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer"
                                        target="_blank" href="about:blank"></a><input type="text"
                                        data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL"><a
                                        class="ql-action"></a><a class="ql-remove"></a></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <div class="comment-toolbar ql-toolbar ql-snow">
                                    <span class="ql-formats me-0">
                                        <button class="ql-bold" type="button"><svg viewBox="0 0 18 18">
                                                <path class="ql-stroke"
                                                    d="M5,4H9.5A2.5,2.5,0,0,1,12,6.5v0A2.5,2.5,0,0,1,9.5,9H5A0,0,0,0,1,5,9V4A0,0,0,0,1,5,4Z">
                                                </path>
                                                <path class="ql-stroke"
                                                    d="M5,9h5.5A2.5,2.5,0,0,1,13,11.5v0A2.5,2.5,0,0,1,10.5,14H5a0,0,0,0,1,0,0V9A0,0,0,0,1,5,9Z">
                                                </path>
                                            </svg></button>
                                        <button class="ql-italic" type="button"><svg viewBox="0 0 18 18">
                                                <line class="ql-stroke" x1="7" x2="13" y1="4"
                                                    y2="4"></line>
                                                <line class="ql-stroke" x1="5" x2="11" y1="14"
                                                    y2="14"></line>
                                                <line class="ql-stroke" x1="8" x2="10" y1="14"
                                                    y2="4"></line>
                                            </svg></button>
                                        <button class="ql-underline" type="button"><svg viewBox="0 0 18 18">
                                                <path class="ql-stroke"
                                                    d="M5,3V9a4.012,4.012,0,0,0,4,4H9a4.012,4.012,0,0,0,4-4V3"></path>
                                                <rect class="ql-fill" height="1" rx="0.5" ry="0.5"
                                                    width="12" x="3" y="15"></rect>
                                            </svg></button>
                                        <button class="ql-link" type="button"><svg viewBox="0 0 18 18">
                                                <line class="ql-stroke" x1="7" x2="11" y1="7"
                                                    y2="11"></line>
                                                <path class="ql-even ql-stroke"
                                                    d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z">
                                                </path>
                                                <path class="ql-even ql-stroke"
                                                    d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z">
                                                </path>
                                            </svg></button>
                                        <button class="ql-image" type="button"><svg viewBox="0 0 18 18">
                                                <rect class="ql-stroke" height="10" width="12" x="3" y="4"></rect>
                                                <circle class="ql-fill" cx="6" cy="7" r="1"></circle>
                                                <polyline class="ql-even ql-fill"
                                                    points="5 12 5 11 7 9 8 10 11 7 13 9 13 12 5 12"></polyline>
                                            </svg></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <button type="button" class="btn btn-primary me-3 waves-effect waves-light"
                                data-bs-dismiss="offcanvas">
                                Update
                            </button>
                            <button type="button" class="btn btn-label-danger waves-effect" data-bs-dismiss="offcanvas">
                                Delete
                            </button>
                        </div>
                    </form>
                </div>

                {{-- komentar --}}
                <div class="tab-pane fade" id="tab-komentar" role="tabpanel">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/2.png"
                                alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="media-body">
                            <p class="mb-0">
                                <span class="fw-medium">Martian</span> added moved
                                Charts &amp; Maps task to the done board.
                            </p>
                            <small class="text-muted">Today 10:00 AM</small>
                        </div>
                    </div>
                    <div class="media mb-4 d-flex align-items-start">
                        <div class="avatar me-2 flex-shrink-0 mt-1">
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/4.png"
                                alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="media-body">
                            <p class="mb-0">
                                <span class="fw-medium">Ray</span> Added moved
                                <span class="fw-medium">Forms &amp; Tables</span> task
                                from in progress to done.
                            </p>
                            <small class="text-muted">Today 7:45 AM</small>
                        </div>
                    </div>
                    <div class="media mb-4 d-flex align-items-start">
                        <div class="avatar me-2 flex-shrink-0 mt-1">
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                alt="Avatar" class="rounded-circle">
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


                <!-- Activities -->
                <div class="tab-pane fade" id="tab-activity" role="tabpanel">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/2.png"
                                alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="media-body">
                            <p class="mb-0">
                                <span class="fw-medium">Martian</span> added moved
                                Charts &amp; Maps task to the done board.
                            </p>
                            <small class="text-muted">Today 10:00 AM</small>
                        </div>
                    </div>
                    <div class="media mb-4 d-flex align-items-start">
                        <div class="avatar me-2 flex-shrink-0 mt-1">
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/4.png"
                                alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="media-body">
                            <p class="mb-0">
                                <span class="fw-medium">Ray</span> Added moved
                                <span class="fw-medium">Forms &amp; Tables</span> task
                                from in progress to done.
                            </p>
                            <small class="text-muted">Today 7:45 AM</small>
                        </div>
                    </div>
                    <div class="media mb-4 d-flex align-items-start">
                        <div class="avatar me-2 flex-shrink-0 mt-1">
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                alt="Avatar" class="rounded-circle">
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
                            <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                alt="Avatar" class="rounded-circle">
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

    {{-- End Canvas --}}


    <div style="height: 80vh;overflow-x: auto; " class="container-fluid row mt-2">
        <div class="d-flex mt-3 mb-0 pb-5 " style="width: auto; overflow-x: auto ; gap:50px;">

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
                    <div class="row mt-3">

                        @forelse ($tugas_baru as $tugas)
                            {{-- Kondisi dimana tugas yang tampil hanya tugas baru --}}
                            <div class="kanban-item card py-2 px-3" data-bs-toggle="offcanvas"
                                data-bs-target="#editCanvas" aria-controls="editCanvas" data-eid="in-progress-1"
                                data-comments="12" data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges">
                                        <div class="badge rounded-pill bg-label-success"> UX</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown">
                                        <i class=" ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)">Copy task link</a><a
                                                class="dropdown-item" href="javascript:void(0)">Duplicate task</a><a
                                                class="dropdown-item delete-task" href="javascript:void(0)">Delete</a>
                                        </div>
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
                            <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4"
                                data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="item-badges">
                                        <div class="badge rounded-pill bg-label-success"> UX</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" id="{{ $tugas->uuid }}"
                                            style=""><a class="dropdown-item" href="javascript:void(0)">Copy task
                                                link</a><a class="dropdown-item" href="javascript:void(0)">Duplicate
                                                task</a><a class="dropdown-item delete-task"
                                                href="javascript:void(0)">Delete</a>
                                        </div>
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
                                        <div class="badge rounded-pill bg-label-success"> UX</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)">Copy task link</a><a
                                                class="dropdown-item" href="javascript:void(0)">Duplicate task</a><a
                                                class="dropdown-item delete-task" href="javascript:void(0)">Delete</a>
                                        </div>
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
                                        <div class="badge rounded-pill bg-label-success"> UX</div>
                                    </div>
                                    <div class="dropdown kanban-tasks-item-dropdown"><i
                                            class="dropdown-toggle ti ti-dots-vertical" id="kanban-tasks-item-dropdown"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                        <div class="dropdown-menu dropdown-menu-end"
                                            aria-labelledby="kanban-tasks-item-dropdown" style=""><a
                                                class="dropdown-item" href="javascript:void(0)">Copy task link</a><a
                                                class="dropdown-item" href="javascript:void(0)">Duplicate task</a><a
                                                class="dropdown-item delete-task" href="javascript:void(0)">Delete</a>
                                        </div>
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
    <!-- END: Page Vendor JS-->
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>

    <!-- END: Theme JS-->
    <!-- Pricing Modal JS-->
    <!-- END: Pricing Modal JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/app-kanban.js') }}"></script>
    <!-- END: Page JS-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        // let dataEmpty
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

                    document.getElementById('notFound').classList.add('d-none')
                    // Tambahkan elemen baru ke dalam div dengan id "tugas_baru"
                    const tugasBaru = document.getElementById('tugas_baru');
                    tugasBaru.appendChild(newElement);

                })


                .catch(error => {
                    console.log(error)
                })

        })
    </script>
@endsection
