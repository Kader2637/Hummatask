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
                            <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                data-badge-text="UX" data-badge="success" data-due-date="5 April" data-attachments="4"
                                data-assigned="12.png,5.png" data-members="Bruce,Clark">
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
                                                class="dropdown-item delete-task" href="javascript:void(0)">Delete</a></div>
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
    {{-- <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script> --}}

    <!-- END: Theme JS-->
    <!-- Pricing Modal JS-->
    <!-- END: Pricing Modal JS-->
    <!-- BEGIN: Page JS-->
    <script src="{{ asset('assets/js/app-kanban.js') }}"></script>
    <!-- END: Page JS-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
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

                })

                .catch(error => {
                    console.log(error)
                })

        })
    </script>
@endsection
