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
                <div class="col-12">
                    <div class="row d-flex flex-column justify-content-center align-items-center" id="tugas_baru">

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
                <div class="row row d-flex flex-column justify-content-center align-items-center" id="dikerjakan">

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
                <div class="row d-flex flex-column justify-content-center align-items-center" id="revisi">

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
                <div class="row d-flex flex-column justify-content-center align-items-center" id="selesai">

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
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#selesai">
                        <i class="ti ti-message-dots ti-xs me-1"></i>
                        <span class="align-middle">Komentar</span>
                    </button>
                </li>
            </ul>
            <div class="tab-content px-0 pb-0">
                <!-- Update item/tasks -->
                <div class="tab-pane fade show active" id="tab-update" role="tabpanel">
                    <form id="formEditTugas" method="POST" >
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
                                <option data-color="bg-label-secondari" value="opsional">Opsional</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-12 mb-4" data-select2-id="93">
                                <label for="select2Primary" class="form-label">Tugas untuk</label>
                                <div class="select2-primary" data-select2-id="92">
                                    <div class="position-relative" data-select2-id="91"></div>
                                    <select name="penugasan[]" id="select2Primary"
                                            class="select2 form-select select2-hidden-accessible" multiple=""
                                            data-select2-id="select2Primary" tabindex="-1" aria-hidden="true">

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap">
                            <button type="submit"  class="btn btn-primary me-3" data-bs-dismiss="offcanvas">
                                Update
                            </button>
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
                <!-- Activities -->

                <div class="tab-pane fade" id="selesai" role="tabpanel">

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
    {{-- <script src="{{ asset('assets/js/app-kanban.js') }}"></script> --}}
    <!-- END: Page JS-->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/toastr/toastr.js') }}" />
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/forms-tagify.js') }}"></script> --}}
    <script src="{{ asset('assets/vendor/libs/bloodhound/bloodhound.js') }}"></script>
    <script src="{{ asset('utils/prioritas.js') }}" ></script>
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
                        const {user} = tugas
                        let tugaskan = '';
                        let avatar = user.avatar ? 'storage/' + user.avatar : 'assets/img/avatars/1.png';
                        user.forEach(element => {
        if (element === null || element === undefined) {
            tugaskan = "";
        } else {
            tugaskan =
                `
                <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Bruce" data-bs-original-title="${element.username}">
                    <img src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle pull-up">
                </div>
                `;
        }



    });

                        let deadline;
                        if(tugas.deadline !== null)
                        {
                            const hariIni = new Date();

                        const hariDeadline = new Date(tugas.deadline);
                         deadline = Math.ceil((hariDeadline-hariIni) / (1000*60*60*24));

                        }
                        else{
                            deadline = 0;
                        }

                        let elementPrioritas = prioritas(tugas.prioritas)

                        const element = $(`<div>`)
                            .attr("id","board-"+tugas.code)
                            .addClass('col-12 p-2 mt-3 card px-4')
                            .html(
                                `
                        <div>
                            <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1  ">
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
                                    <button onclick="editTugas('${tugas.code}')" type="button" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#editTugasBar" >Edit</button>
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
            axios.get("data-edit-tugas/" + codeTugas)
            .then((res) => {

                console.log("klik edit code "  +   codeTugas);
                const data = res.data
                const user = data.tim.user;
                const userSelected = data.user

                    const optStatusTugas = document.querySelector("#status")

                    optStatusTugas.querySelectorAll('option').forEach(status => {
                        if(status.value === data.status_tugas){
                            status.selected = true
                        }else{
                            status.selected = false
                        }
                    });


                    const optPrioritas = document.querySelector("#newPriority")

                    optPrioritas.querySelectorAll('option').forEach(priority => {
                        if(priority.value === data.prioritas){
                            priority.selected = true
                        }else{
                            priority.selected = false
                        }
                    });


                    console.log(data);

                    $("#title").val(data.nama)
                    $("#due-date").val(data.deadline)

                    Object.keys(user).forEach(key => {
                    const userOption = user[key];
                    console.log(userOption);
                    const option = document.createElement('option')
                    option.value = userOption.uuid;
                    option.textContent = userOption.username

                    userSelected.forEach(data=>{
                        if(data.uuid === userOption.uuid){
                            option.setAttribute("selected",true);
                        }
                    })
                        $("#select2Primary").append(option);
                    });


                })
        }





        $("#formEditTugas").submit(function (e) {
            e.preventDefault()


            const nama = $("#title").val();
            const deadline = $("#due-date").val();
            const status_tugas = $("#status").val();
            const prioritas = $("#newPriority").val();
            const penugasan = $("#select2Primary").val()
            let codeTugas = $(this).data('codetugas');
            console.log("edit tugas code "+ codeTugas);

            axios.put("{{ route('editTugas') }}",{codeTugas,nama,deadline,status_tugas,penugasan,prioritas})
            .then((res) => {


                $('#tugas_baru').empty()
               $('#dikerjakan').empty()
              $('#revisi').empty()
                 $('#selesai').empty()

                get();

                $("#title").trigger('reset')
                $("#due-date").trigger('reset')
                $("#status").trigger('reset')
                $("#newPrioritas").trigger('reset')
                $(this).removeData('codetugas');
               console.log(codeTugas);


            })
            .catch((err) => {
                console.log(err);
            })

        })


        $("#formTambahTugas").submit((event)=>{
                event.preventDefault();


                const nama = $('#tugas').val();
                const tim_id = "{{ $tim->code }}";

                axios.post("{{ route('tim.tambah-tugas') }}",{nama,tim_id})
                .then((res) => {
                    $('#tugas_baru').empty()
                    $('#dikerjakan').empty()
                    $('#revisi').empty()
                    $('#selesai').empty()
                    get();
                    $("#formTambahTugas").trigger("reset");
                    console.log(res.data);
                    Swal.fire({
                        icon: 'success',
                        title : "Sukses",
                        text : "Sukses Membuat Tugas",
                        timer : 800,
                    })

                    $("#formEditTugas").attr("data-codetugas","");

                })
                .catch((err) => {
                    console.log(err);
                })
            });

            function deleteTugas (codetugas){
                axios.delete("delete/tugas/"+codetugas)
                .then((res) => {
                    const data = res.data;
                    $("#board-"+codetugas).addClass("d-none")
                    console.log(data);
                })
                .catch((err) => {
                    console.log(err);
                })
            }


    </script>
@endsection
