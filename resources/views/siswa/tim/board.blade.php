                    @extends('layouts.tim')


                    @section('link')
                        <!-- Vendor Styles -->
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/jkanban/jkanban.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/katex.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/editor.css') }}" />
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}" />

                        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/app-kanban.css') }}" />

                        <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
                    @endsection

                    @section('style')
                        <style>
                            .form-komentar {
                                position: absolute;
                                bottom: 0px;
                                background-color: white;
                                margin-right: 10px;
                            }
                        </style>
                    @endsection

                    @section('content')
                        <div style="height: 80vh" class="container-fluid row mt-2">
                            <div class="d-flex mt-3 mb-0  " style="width: 100%; gap:50px; ">
                                <div style="" class="col-3">
                                    <div class="card">
                                        <div class="card-body p-2 py-2 row">
                                            <div class="col-8 d-flex align-items-center">
                                                <span style="font-size: 15px" class="">Tugas Baru</span>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end cursor-pointer">
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
                                                    @csrf
                                                    <label for="tugas">Nama Tugas</label>
                                                    <input type="text" class="form-control" id="tugas" name="tugas">
                                                    <div class="d-flex justify-content-end mt-3">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="row d-flex flex-column justify-content-center align-items-center w-100" id="tugas_baru">

                                        </div>
                                    </div>
                                </div>

                                <div style="" class=" col-3 ">
                                    <div class="card">
                                        <div class="card-body p-2 py-2 row">
                                            <div class="col-8 d-flex align-items-center">
                                                <span style="font-size: 15px" class="">Dikerjakan</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="row row d-flex flex-column justify-content-center align-items-center w-100" id="dikerjakan">
                                        </div>
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
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="w-100 row d-flex flex-column justify-content-center align-items-center" id="revisi">

                                        </div>
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
                                    <div class="col-12 d-flex justify-content-center">
                                        <div class="row d-flex flex-column justify-content-center align-items-center w-100" id="selesai">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kanban Wrapper -->
                        <div class="kanban-wrapper"></div>


                        <div class="offcanvas offcanvas-end kanban-update-item-sidebar" id="editTugasBar">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title">Edit Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-update">
                                            <i class="ti ti-edit me-2"></i>
                                            <span class="align-middle">Edit</span>
                                        </button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#komentar">
                                            <i class="ti ti-message-dots ti-xs me-1"></i>
                                            <span class="align-middle">Komentar</span>
                                        </button>
                                    </li>
                                </ul>
                                <div class="tab-content px-0 pb-0">
                                    <!-- Update item/tasks -->
                                    <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
                                        <form id="formEditTugas" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-3">
                                                <label class="form-label" for="title">Nama Tugas</label>
                                                <input type="text" id="title" class="form-control" value="" name="nama" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="due-date">Deadline</label>
                                                <input type="date" id="due-date" name="deadline" value="" class="form-control"
                                                    placeholder="Enter Deadline" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="newStatus"> Status</label>
                                                <select class="select2 select2-label form-select" id="status" name="newStatus">
                                                    <option data-color="bg-label-success" value="tugas_baru">Tugas Baru</option>
                                                    <option data-color="bg-label-warning" value="dikerjakan">
                                                        Dikerjakan</option>
                                                    <option data-color="bg-label-info" value="revisi">Direvisi
                                                    </option>
                                                    <option data-color="bg-label-danger" value="selesai">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class a="form-label" for="newPriority">Prioritas</label>
                                                <select class="select2 select2-label form-select" id="newPriority" name="newPriority">
                                                    <option data-color="bg-label-success" value="mendesak">Mendesak</option>
                                                    <option data-color="bg-label-warning" value="penting">Penting</option>
                                                    <option data-color="bg-label-info" value="biasa">Biasa</option>
                                                    <option data-color="bg-label-info" value="tambahan">Tambahan</option>
                                                    <option data-color="bg-label-secondary" value="opsional">Opsional</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                @if ($tim->status_tim !== 'solo')
                                                    <div class="col-md-12 mb-4" data-select2-id="93">
                                                        <label for="select2Primary" class="form-label">Tugas untuk</label>
                                                        <div class="select2-primary" data-select2-id="92">
                                                            <div class="position-relative" data-select2-id="91">

                                                            </div>
                                                            <select name="penugasan[]" id="select2Primary"
                                                                class="select2 form-select select2-hidden-accessible" multiple=""
                                                                data-select2-id="select2Primary" tabindex="-1" aria-hidden="true">

                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            @endif
                                            <div class="d-flex flex-wrap">
                                                <button type="submit" class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                                    Update
                                                </button>
                                                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                                    Close
                                                </button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- Activities -->

                                <div class="tab-pane fade" id="komentar" role="tabpanel">

                                    <div class="list-komentar mt-3" style="margin-bottom: 80px">

                                    </div>

                                    <div class="form-komentar" style="width: 100%;">
                                        <div class="row w-100 justify-content-center d-flex mb-3">
                                            <div class="col-11">
                                                <form id="tambahKomentar" method="post">
                                                    @csrf
                                                    <label class="form-label" for="bootstrap-maxlength-example2">Komentar</label>
                                                    <div class="w-100 d-flex justify-content-between align-items-center gap-2">
                                                        <textarea style="resize: none" id="bootstrap-maxlength-example2"
                                                            class="form-control bootstrap-maxlength-example inp-tambah-komentar" rows="1" maxlength=""
                                                            style="height: 43px;"></textarea>
                                                        <button type="submit" class="btn btn-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                viewBox="0 0 24 24">
                                                                <g fill="none">
                                                                    <path
                                                                        d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z" />
                                                                    <path fill="currentColor"
                                                                        d="m21.433 4.861l-6 15.5a1 1 0 0 1-1.624.362l-3.382-3.235l-2.074 2.073a.5.5 0 0 1-.853-.354v-4.519L2.309 9.723a1 1 0 0 1 .442-1.691l17.5-4.5a1 1 0 0 1 1.181 1.329ZM19 6.001L8.032 13.152l1.735 1.66L19 6Z" />
                                                                </g>
                                                            </svg>
                                                        </button>
                                                        <button type="button" onclick="cancelEdit()"
                                                            class="btn btn-danger btn-edit-komentar d-none">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                                viewBox="0 0 24 24">
                                                                <path fill="currentColor"
                                                                    d="M6.4 19L5 17.6l5.6-5.6L5 6.4L6.4 5l5.6 5.6L17.6 5L19 6.4L13.4 12l5.6 5.6l-1.4 1.4l-5.6-5.6L6.4 19Z" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
                        <script src="{{ asset('utils/handleErrorResponse.js') }}"></script>
                        <!-- END: Page Vendor JS-->
                        <!-- BEGIN: Theme JS-->
                        <script src="{{ asset('assets/js/mainf696.js?id=8bd0165c1c4340f4d4a66add0761ae8a') }}"></script>

                        <!-- END: Theme JS-->
                        <!-- Pricing Modal JS-->
                        <!-- END: Pricing Modal JS-->
                        <!-- BEGIN: Page JS-->
                        {{-- <script src="{{ asset('assets/js/app-kanban.js') }}"></script> --}}
                        <!-- END: Page JS-->
                        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
                        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.js') }}" />
                        <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
                        <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
                        {{-- <script src="{{ asset('assets/js/forms-tagify.js') }}"></script> --}}
                        <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
                        <script src="{{ asset('utils/prioritas.js') }}"></script>

                        <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
                        <script src="{{ asset('assets/js/extended-ui-perfect-scrollbar.js') }}"></script>
                        <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
                        <script src="{{ asset('utils/handleSuccessResponse.js') }}"></script>

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

                            get()


                            function get() {
                                axios.get("ambil-data-tugas/{{ $code }}")
                                    .then((res) => {
                                        const dataTugas = res.data.tugas;

                                        $('#tugas_baru').empty()
                                        $('#dikerjakan').empty()
                                        $('#revisi').empty()
                                        $('#selesai').empty()
                                        // TugasBaru
                                        dataTugas.forEach((data, index) => {
                                            const tugas = data;
                                            const {
                                                user
                                            } = tugas;
                                            let tugaskan = "  ";
                                            let avatar = user.avatar ? 'storage/' + user.avatar : 'assets/img/avatars/1.png';
                                            userTugaskan = user.filter((element, index) => user.indexOf(element) === index);
                                            userTugaskan.forEach(element => {
                                                if (element === null || element === undefined) {
                                                    tugaskan += "";
                                                } else {
                                                    tugaskan +=
                                                        `
                                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="${element.username}" data-bs-original-title="${element.username}">
                                                        <img src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle pull-up">
                                                    </div>
                                                    `;
                                                }



                                            });

                                            let deadline;
                                            if (tugas.deadline !== null) {
                                                const hariIni = new Date();

                                                const hariDeadline = new Date(tugas.deadline);
                                                deadline = Math.ceil((hariDeadline - hariIni) / (1000 * 60 * 60 * 24));

                                            } else {
                                                deadline = 0;
                                            }

                                            let elementPrioritas = prioritas(tugas.prioritas)

                                            const element = $(`<div>`)
                                                .attr("id", "board-" + tugas.code)
                                                .addClass('col-12 p-2 mt-3 card')
                                                .html(
                                                    `
                                            <div>
                                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="item-badges">
                                                            ${elementPrioritas}
                                                        </div>
                                                        <div style="font-size:12px">
                                                            ${deadline} hari lagi
                                                        </div>
                                                    </div>
                                                    <div class="dropdown kanban-tasks-item-dropdown">
                                                    <i class="ti ti-dots-vertical" id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item-dropdown" style="">
                                                        <button onclick="editTugas('${tugas.code}')" type="button" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#editTugasBar">Edit</button>
                                                        <button onclick="deleteTugas('${tugas.code}')" class="dropdown-item" href="javascript:void(0)">Delete</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                <span class="kanban-text">${tugas.nama}</span>
                                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                                    <div class="d-flex">
                                                    <span class="d-flex align-items-center ms-1">
                                                        <i class="ti ti-message-dots ti-xs me-1"></i>
                                                        <span>${tugas.comments.length}</span>
                                                    </span>
                                                    </div>
                                                    <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                        ${tugaskan}
                                                    </div>
                                                </div>
                                            </div>
                        `
                                                );


                                            if (tugas.status_tugas === "tugas_baru") {
                                                $('#tugas_baru').append(element)
                                            } else if (tugas.status_tugas === "dikerjakan") {
                                                $("#dikerjakan").append(element)
                                            } else if (tugas.status_tugas === "revisi") {
                                                $("#revisi").append(element)
                                            } else {
                                                $("#selesai").append(element)
                                            }
                                        });

                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    });

                            }



                            function editTugas(codeTugas) {
                                console.log(codeTugas);
                                $("#select2Primary").empty();
                                $("#formEditTugas").attr("data-codetugas", codeTugas);
                                $("#tambahKomentar").attr("data-codetugas", codeTugas);

                                axios.get("data-edit-tugas/" + codeTugas)
                                    .then((res) => {

                                        console.log("klik edit code " + codeTugas);
                                        const data = res.data;
                                        console.log(data);
                                        const user = data.tugas.tim.user;
                                        const userSelected = data.user;
                                        const comments = data.tugas.comments;


                                        const optStatusTugas = document.querySelector("#status")

                                        optStatusTugas.querySelectorAll('option').forEach(status => {
                                            if (status.value === data.status_tugas) {
                                                status.selected = true
                                            } else {
                                                status.selected = false
                                            }
                                        });

                                        const optPrioritas = document.querySelector("#newPriority")

                                        optPrioritas.querySelectorAll('option').forEach(priority => {
                                            if (priority.value === data.prioritas) {
                                                priority.selected = true
                                            } else {
                                                priority.selected = false
                                            }
                                        });




                                        $("#title").val(data.tugas.nama)
                                        $("#due-date").val(data.tugas.deadline)

                                        if(data.tugas.tim.status_tim !== "solo"){
                                            Object.keys(user).forEach(key => {
                                                const userOption = user[key];
                                                const option = document.createElement('option')
                                                option.value = userOption.uuid;
                                                option.textContent = userOption.username

                                                userSelected.forEach(data => {
                                                    if (data.uuid === userOption.uuid) {
                                                            option.setAttribute("selected", true);
                                                    }
                                                });
                                                $("#select2Primary").append(option);
                                            });
                                        }

                                        $(".list-komentar").empty();

                                        console.log(comments);
                                        Object.keys(comments).forEach((keys,i) =>
                                        {
                                            const jadwal = res.data.komentarTerbuat[i];
                                            const komentar = comments[keys];
                                            console.log(jadwal);
                                            let div = document.createElement("div");


                                            const user = komentar.user;
                                            div.className =
                                            "media mb-4 d-flex align-items-start card flex-row px-3 py-2 mb-3 w-100";
                                            div.style.overflowWrap = "anywhere";
                                            div.setAttribute('id', 'komentar-' + komentar.id);

                                            let avatar = user.avatar ? 'storage/' + user.avatar : 'assets/img/avatars/1.png';

                                            let editButtonKomentar =
                                                `
                    <div class="dropdown kanban-tasks-item-dropdown dropdown-edit">
                                <i class="ti ti-dots-vertical cursor-pointer" id="kanban-tasks-item" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"></i>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item" style="">
                                <button onclick="editKomentar('${komentar.id}','${komentar.text}')" type="button" class="dropdown-item">Edit</button>
                                <button onclick="deleteKomentar('${komentar.id}')" class="dropdown-item" href="javascript:void(0)">Delete</button>
                                </div>
                            </div>

                    `



                                            let elementComments = `
                        <div class="avatar me-2 flex-shrink-0 mt-1">
                        <img src="{{ asset('${avatar}') }}"
                            alt="Avatar" class="rounded-circle">
                        </div>
                        <div class="d-flex flex-column w-100">
                        <div class="media-body">
                            <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-medium">${komentar.user.username} <small class="text-muted">${jadwal}</small></span>
                            ${

                                ( komentar.user.id == "{{ Auth::user()->id }}" )

                                ?

                                editButtonKomentar

                            : ''


                            }
                            </div>
                            <span class="mb-0" style="font-size: 13px;">${komentar.text}</span>
                        </div>
                        </div>
                    `;

                                            div.innerHTML = elementComments;
                                            $(".list-komentar").append(div);
                                        });

                                    });
                            }


                            $("#formEditTugas").submit(function(e) {
                                e.preventDefault()
                                const nama = $("#title").val();
                                const deadline = $("#due-date").val();
                                const status_tugas = $("#status").val();
                                const prioritas = $("#newPriority").val();
                                const penugasan = $("#select2Primary").val()
                                let codeTugas = $(this).data('codetugas');
                                console.log("edit tugas code " + codeTugas);

                                axios.put("{{ route('editTugas') }}", {
                                        codeTugas,
                                        nama,
                                        deadline,
                                        status_tugas,
                                        penugasan,
                                        prioritas
                                    })
                                    .then((res) => {
                                        console.log(res.data);
                                        $('#tugas_baru').empty()
                                        $('#dikerjakan').empty()
                                        $('#revisi').empty()
                                        $('#selesai').empty()
                                        get();
                                        successRes("Berhasil mengedit tugas")
                                        $("#title").trigger('reset')
                                        $("#due-date").trigger('reset')
                                        $("#status").trigger('reset')
                                        $("#newPrioritas").trigger('reset')
                                        $(this).removeData('codetugas');
                                        console.log(codeTugas);

                                    })
                                    .catch((error) => {
                                        alertError(error)
                                        console.log(error);
                                        $(this).removeData('codetugas')

                                    })

                            })


                            function deleteKomentar(komentar_id) {


                                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: "btn btn-success",
                        cancelButton: "btn btn-danger"
                    },
                    buttonsStyling: false
                    });
                                swalWithBootstrapButtons.fire({
                    title: "Apakah kamu yakin?",
                    text: "Datamu tidak bisa dipulihkan setelah ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Hapus",
                    cancelButtonText: "Batal",
                    reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {


                        axios.delete("hapus-komentar/" + komentar_id)
                                    .then((res) => {
                                        $("#komentar-" + komentar_id).addClass("d-none");
                                        console.log(res.data);

                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    })

                                    successRes("Berhasil Menghapus komentar");
                    } else if (

                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire({
                        title: "Terbatalkan",
                        text: "Datamu sekarang aman:)",
                        icon: "error"
                        });
                    }
                    });
                            }

                            function editKomentar(komentar_id, text) {
                                $("#tambahKomentar").removeData("data-komentar-id");
                                $("#tambahKomentar").attr("data-komentar-id", komentar_id);
                                $(".inp-tambah-komentar").val(text);
                                $("#komentar-" + komentar_id).addClass("border border-primary");
                                $(".btn-edit-komentar").removeClass("d-none");
                                $(".dropdown-edit").empty();
                            }

                            function cancelEdit() {
                                let komentar_id = $("#tambahKomentar").data("komentar-id");
                                let tugas_code = $("#tambahKomentar").data("codetugas");
                                console.log("tugas code tercancel"+tugas_code);
                                console.log("Ini cancel");
                                editTugas(tugas_code);
                                get()

                                $(".btn-edit-komentar").addClass("d-none");
                                $("#komentar-" + komentar_id).removeClass("border border-primary");

                                // Mengubah nilai komentar_id menjadi 0
                                komentar_id = 0;

                                $("#tambahKomentar").removeData("komentar-id");
                                $("#tambahKomentar").removeAttr("data-komentar-id");
                                $("#tambahKomentar").trigger("reset");

                                console.log(komentar_id);
                            }

                            $("#tambahKomentar").submit(function(event) {
                                event.preventDefault();
                                const text = $(".inp-tambah-komentar").val();
                                const tugas_code = $(this).data("codetugas");
                                let komentar_id = $(this).data("komentar-id");
                                console.log(komentar_id);

                                if (typeof komentar_id == 'undefined') {
                                    komentar_id = 0;
                                    console.log(komentar_id);
                                } else {
                                    console.log(komentar_id);
                                }

                                axios.post("tambah-komentar", {
                                        tugas_code,
                                        text,
                                        komentar_id
                                    })
                                    .then((res) => {
                                        console.log("komentar =>" + komentar_id);
                                        console.log(komentar_id);
                                        editTugas(tugas_code);
                                        $("#tambahKomentar").trigger("reset");
                                        let komentar_tes_id = $("#tambahKomentar").data("komentar-id");
                                        console.log("kometar tes id 1 =>" + komentar_tes_id);
                                        $(".btn-edit-komentar").addClass("d-none");
                                        $("#komentar-" + komentar_id).removeClass("border border-primary");
                                        komentar_tes_id = 0; // Menghapus nilai komentar_id
                                        console.log("komentar_tes_id 2 =>" + komentar_tes_id);
                                        $(this).removeData("komentar-id");
                                        $(this).removeAttr("data-komentar-id");
                                        $(this).removeData('codetugas');
                                        successRes("Berhasil membuat komentar")
                                        get();
                                    })
                                    .catch((error) => {

                                        // komentar_id = 0;
                                        alertError(error)

                                        console.log(error);
                                        // $(this).removeData("komentar-id");
                                        // $(this).removeData('codetugas');
                                        // $(".btn-edit-komentar").addClass("d-none");
                                        // $("#komentar-"+komentar_id).removeClass("border border-primary");
                                        // $(this).removeData('codetugas');

                                    })
                            })




                            $("#formTambahTugas").submit((event) => {
                                event.preventDefault();
                                const nama = $('#tugas').val();
                                const tim_id = "{{ $tim->code }}";

                                axios.post("tambah-tugas/"+tim_id, {
                                        nama,
                                        tim_id
                                    })
                                    .then((res) => {
                                        $('#tugas_baru').empty()
                                        $('#dikerjakan').empty()
                                        $('#revisi').empty()
                                        $('#selesai').empty()
                                        get();
                                        $("#formTambahTugas").trigger("reset");
                                        console.log(res.data);
                                        successRes("Berhasil membuat tugas baru")
                                        $("#formEditTugas").attr("data-codetugas", "");

                                    })
                                    .catch((error) => {
                                        alertError(error);
                                    })
                            });

                            function deleteTugas(codetugas) {
                                const swalWithBootstrapButtons = Swal.mixin({
                                    customClass: {
                                        confirmButton: "btn btn-success",
                                        cancelButton: "btn btn-danger"
                                    },
                                    buttonsStyling: false
                                });
                                swalWithBootstrapButtons.fire({
                                    title: "Apakah Kamu Yakin?",
                                    text: "Data yang kamu hapus tidak bisa dipulihkan",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonText: "Iya",
                                    cancelButtonText: "Tidak",
                                    reverseButtons: true
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        axios.delete("delete/tugas/" + codetugas)
                                            .then((res) => {
                                                const data = res.data;
                                                $("#board-" + codetugas).addClass("d-none")
                                                console.log(data);

                                                swalWithBootstrapButtons.fire({
                                                    title: "Terhapus!",
                                                    text: "Datamu berhasil terhapus.",
                                                    icon: "success"
                                                });

                                            })
                                            .catch((err) => {
                                                console.log(err);
                                            })

                                    } else if (
                                        /* Read more about handling dismissals below */
                                        result.dismiss === Swal.DismissReason.cancel
                                    ) {
                                        swalWithBootstrapButtons.fire({
                                            title: "Batal!",
                                            text: "Datamu batal dihapus",
                                            icon: "error"
                                        });
                                    }
                                });
                            }
                        </script>
                    @endsection
