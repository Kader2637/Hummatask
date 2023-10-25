@extends('layouts.tim')

@section('content')
    <div class="container d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">Hari ini</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false" tabindex="-1">Minggu Ini</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false" tabindex="-1">Semua</button>
                    </li>
                </ul>
                <div class="tab-content" style="border: none; background: none; box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            @for ($i = 0; $i < 3; $i++)
                                <div class="col-md-4 mt-3">
                                    <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                        data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                        data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges">
                                                <div class="badge rounded-pill bg-label-success"> UX</div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle ti ti-dots-vertical"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                        href="javascript:void(0)">Copy task link</a><a class="dropdown-item"
                                                        href="javascript:void(0)">Duplicate task</a><a
                                                        class="dropdown-item delete-task"
                                                        href="javascript:void(0)">Delete</a></div>
                                            </div>
                                        </div><span class="kanban-text">Research FAQ page UX</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                        class="ti ti-paperclip ti-xs me-1"></i><span
                                                        class="attachments">4</span></span> <span
                                                    class="d-flex align-items-center ms-1"><i
                                                        class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Bruce"
                                                    data-bs-original-title="Bruce"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Clark"
                                                    data-bs-original-title="Clark"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="row">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-md-4 mt-3">
                                    <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                        data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                        data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges">
                                                <div class="badge rounded-pill bg-label-success"> UX</div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle ti ti-dots-vertical"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                        href="javascript:void(0)">Copy task link</a><a
                                                        class="dropdown-item" href="javascript:void(0)">Duplicate
                                                        task</a><a class="dropdown-item delete-task"
                                                        href="javascript:void(0)">Delete</a></div>
                                            </div>
                                        </div><span class="kanban-text">Research FAQ page UX</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                        class="ti ti-paperclip ti-xs me-1"></i><span
                                                        class="attachments">4</span></span> <span
                                                    class="d-flex align-items-center ms-1"><i
                                                        class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Bruce"
                                                    data-bs-original-title="Bruce"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Clark"
                                                    data-bs-original-title="Clark"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="row">
                            @for ($i = 0; $i < 12; $i++)
                                <div class="col-md-4 mt-3">
                                    <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                        data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                        data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges">
                                                <div class="badge rounded-pill bg-label-success"> UX</div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle ti ti-dots-vertical"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                        href="javascript:void(0)">Copy task link</a><a
                                                        class="dropdown-item" href="javascript:void(0)">Duplicate
                                                        task</a><a class="dropdown-item delete-task"
                                                        href="javascript:void(0)">Delete</a></div>
                                            </div>
                                        </div><span class="kanban-text">Research FAQ page UX</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                        class="ti ti-paperclip ti-xs me-1"></i><span
                                                        class="attachments">4</span></span> <span
                                                    class="d-flex align-items-center ms-1"><i
                                                        class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Bruce"
                                                    data-bs-original-title="Bruce"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Clark"
                                                    data-bs-original-title="Clark"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
