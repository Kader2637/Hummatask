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
                        <link rel="stylesheet"
                            href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
                    @endsection

                    @section('style')
                        <style>
                            * {
                                font-family: 'Poppins', sans-serif;
                            }

                            .hide-sroll *::-webkit-scrollbar {
                                display: none;
                            }

                            .form-komentar {
                                position: absolute;
                                bottom: 0px;
                                background-color: white;
                                margin-right: 10px;
                            }

                            @media screen and (max-width: 460px) {
                                .card-status-tugas {
                                    width: 100% !important;
                                }

                                #tugas_baru .card {
                                    width: 100% !important;
                                }

                                #dikerjakan .card {
                                    width: 100% !important;
                                }

                                #revisi .card {
                                    width: 100% !important;
                                }

                                #selesai .card {
                                    width: 100% !important;
                                }
                            }


                            .btn-tambah-labels {
                                height: 40px;
                                width: 40px;
                                border-radius: 100%;
                            }
                        </style>
                    @endsection

                    @section('content')
                        <div class="modal fade" id="modalEditLabel" tabindex="-1" style="display: none;"
                            aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2ty">Edit Labels</h5>
                                        <button type="button" onclick="closeModalEditLabel()" class="btn-close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="d-flex"
                                                style="margin-top: 10px;background-color: gray;width: 100%;height: 60px;border-radius: 10px;margin-bottom: 10px;">
                                                <span class="badge m-auto" id="edit-preview-label">
                                                    Label
                                                </span>
                                            </div>
                                            <form id="formEditLabel" method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="Text" class="form-label">Text</label>
                                                        <input type="text" id="editText" class="form-control"
                                                            value="Label" placeholder="Enter text">
                                                    </div>
                                                </div>
                                                <div class="row g-2">
                                                    <div class="mb-3 col-6">
                                                        <label for="background-color-input"
                                                            class="col-md-2 col-form-label">Background</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="color" value="#666EE8"
                                                                id="edit-background-color-input">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3 col">
                                                        <label for="text-color-input"
                                                            class="col-md-2 col-form-label">Text</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control" type="color" value="#FFFFFF"
                                                                id="edit-text-color-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="button"
                                                    class="btn btn-edit-submit-tambah-label btn-primary waves-effect waves-light w-100">Save
                                                    changes</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="tambahLabel" tabindex="-1" style="display: none;" aria-hidden="true">
                            <div class="modal-dialog modal-md" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel2">Labels</h5>
                                        <button type="button" class="btn-close tutup-label"
                                            data-bs-dismiss="tambahLabel"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="col-12">
                                            <div class="nav-align-top nav-tabs-shadow mb-4">
                                                <ul class="nav nav-tabs nav-fill" role="tablist">
                                                    <li class="nav-item" role="presentation">
                                                        <button type="button" class="nav-link active" role="tab"
                                                            data-bs-toggle="tab" data-bs-target="#navs-justified-home"
                                                            aria-controls="navs-justified-home"
                                                            aria-selected="true">Tambah</button>
                                                    </li>
                                                    <li class="nav-item" role="presentation">
                                                        <button type="button" class="nav-link" role="tab"
                                                            data-bs-toggle="tab" data-bs-target="#navs-justified-profile"
                                                            aria-controls="navs-justified-profile" aria-selected="false"
                                                            tabindex="-1">Daftar</button>
                                                    </li>
                                                </ul>
                                                <div class="tab-content" style="box-shadow: 0px 0px 0px">
                                                    <div class="tab-pane fade active show" id="navs-justified-home"
                                                        role="tabpanel">
                                                        <div class="d-flex"
                                                            style="margin-top: 10px;background-color: gray;width: 100%;height: 60px;border-radius: 10px;margin-bottom: 10px;">
                                                            <span class="badge m-auto" id="preview-label">
                                                                Label
                                                            </span>
                                                        </div>
                                                        <form id="formTambahLabel" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col mb-3">
                                                                    <label for="Text" class="form-label">Text</label>
                                                                    <input type="text" id="Text"
                                                                        class="form-control" value="Label"
                                                                        placeholder="Enter text">
                                                                </div>
                                                            </div>
                                                            <div class="row g-2">
                                                                <div class="mb-3 col-6">
                                                                    <label for="background-color-input"
                                                                        class="col-md-2 col-form-label">Background</label>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control" type="color"
                                                                            value="#666EE8" id="background-color-input">
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3 col">
                                                                    <label for="text-color-input"
                                                                        class="col-md-2 col-form-label">Text</label>
                                                                    <div class="col-md-10">
                                                                        <input class="form-control" type="color"
                                                                            value="#FFFFFF" id="text-color-input">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                class="btn btn-submit-tambah-label btn-primary waves-effect waves-light w-100">Save
                                                                changes</button>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade" id="navs-justified-profile"
                                                        role="tabpanel">
                                                        <div class="card">
                                                            <div class="card-datatable table-responsive p-4">
                                                                <table id="daftarLabels" class="dt-responsive table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th scope="col">NO</th>
                                                                            <th scope="col">LABEL</th>
                                                                            <th scope="col">AKSI</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>




                        <div style="height: 80vh" class="container-fluid mt-2">
                            <div class="d-flex mt-3 mb-0  row hide-sroll" style="height: 83vh">
                                <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                                    <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                                        class="p-2  rounded">
                                        <div style="width:100%" class="card card-status-tugas">
                                            <div class="card-body p-2 py-2 row justify-content-between">
                                                <span class="col-8">Tugas baru</span>
                                                <div class="col-4 d-flex justify-content-end cursor-pointer">
                                                    <svg onclick="showForm('tambahTugas')"
                                                        xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                        viewBox="0 0 1024 1024">
                                                        <path fill="currentColor"
                                                            d="M352 480h320a32 32 0 1 1 0 64H352a32 32 0 0 1 0-64z" />
                                                        <path fill="currentColor"
                                                            d="M480 672V352a32 32 0 1 1 64 0v320a32 32 0 0 1-64 0z" />
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
                                                        <input type="text" class="form-control" id="tugas"
                                                            name="tugas">
                                                        <div class="d-flex justify-content-end mt-3">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                                                id="tugas_baru">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="" class="col-lg-3 col-md-6 col-12 py-2">
                                    <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                                        class="p-2  rounded">
                                        <div style="width:100%" class="card card-status-tugas">
                                            <div class="card-body p-2 py-2 row">
                                                <div class="col-8 d-flex align-items-center position-sticky top-0">
                                                    <span style="font-size: 15px" class="">Dikerjakan</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="row row d-flex flex-column justify-content-center align-items-center w-100"
                                                id="dikerjakan">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="" class="col-lg-3 col-md-6 col-12 py-2">
                                    <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                                        class="p-2  rounded">
                                        <div style="width:100%" class="card card-status-tugas">

                                            <div class="card-body p-2 py-2 row">
                                                <div class="col-8 d-flex align-items-center position-sticky top-0">
                                                    <span style="font-size: 15px" class="">Direvisi</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="w-100 row d-flex flex-column justify-content-center align-items-center"
                                                id="revisi">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="" class="col-lg-3 col-md-6 col-12 py-2    ">
                                    <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                                        class="p-2  rounded">
                                        <div style="width:100%" class="card card-status-tugas">
                                            <div class="card-body p-2 py-2 row">
                                                <div class="col-8 d-flex align-items-center position-sticky top-0">
                                                    <span style="font-size: 15px" class="">Selesai</span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-12 d-flex justify-content-center">
                                            <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                                                id="selesai">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Kanban Wrapper -->
                        <div class="kanban-wrapper"></div>


                        <div class="offcanvas offcanvas-start modal fade position-fixed top-0 start-0" id="editTugasBar">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title">Edit Task</h5>
                                <button onclick="closeCanvasEditTugas()" type="button" class="btn-close"
                                    data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="nav nav-tabs tabs-line">
                                    <li class="nav-item col-4">
                                        <button onclick="tutupKomentar()" class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#tab-update">
                                            <i class="ti ti-edit me-2"></i>
                                            <span class="align-middle">Edit</span>
                                        </button>
                                    </li>
                                    <li class="nav-item col-4">
                                        <button onclick="bukaKomentar()" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#komentar">
                                            <i class="ti ti-message-dots ti-xs me-1"></i>
                                            <span class="align-middle">Komentar</span>
                                        </button>
                                    </li>
                                    <li class="nav-item col-4">
                                        <button onclick="tutupKomentar()" class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#aktifitas">
                                            <i class="ti ti-message-dots ti-xs me-1"></i>
                                            <span class="align-middle">Aktifitas</span>
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
                                                <input type="text" id="title" class="form-control" value=""
                                                    name="nama" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="due-date">Deadline</label>

                                                <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                                    name="deadline" id="due-date" />
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="newStatus"> Status</label>
                                                <select class="select2 select2-label form-select" id="status"
                                                    name="newStatus">
                                                    <option data-color="bg-label-success" value="tugas_baru">Tugas Baru
                                                    </option>
                                                    <option data-color="bg-label-warning" value="dikerjakan">
                                                        Dikerjakan</option>
                                                    <option data-color="bg-label-info" value="revisi">Direvisi
                                                    </option>
                                                    <option data-color="bg-label-danger" value="selesai">Selesai</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class a="form-label" for="newPriority">Prioritas</label>
                                                <select class="select2 select2-label form-select" id="newPriority"
                                                    name="newPriority">
                                                    <option data-color="bg-label-success" value="mendesak">Mendesak
                                                    </option>
                                                    <option data-color="bg-label-warning" value="penting">Penting</option>
                                                    <option data-color="bg-label-info" value="biasa">Biasa</option>
                                                    <option data-color="bg-label-info" value="tambahan">Tambahan</option>
                                                    <option data-color="bg-label-secondary" value="opsional">Opsional
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class a="form-label" for="labels">Labels</label>
                                                <div class="d-flex justify-content-between align-items-center w-100 gap-2">
                                                    <div class="select2-primary w-100" data-select2-id="92">
                                                        <div class="position-relative" data-select2-id="91">
                                                        </div>
                                                        <select name="labels[]" id="labels"
                                                            class="select2 form-select select2-hidden-accessible"
                                                            multiple="" data-select2-id="labels" tabindex="-1"
                                                            aria-hidden="true">

                                                        </select>
                                                    </div>
                                                    <button data-bs-toggle="modal" data-bs-target="#tambahLabel"
                                                        type="button"
                                                        class="btn-tambah-labels btn btn-primary text-white d-flex justify-content-center align-items-center rounded-circle bg-primary">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                @if ($tim->status_tim !== 'solo')
                                                    <div class="col-md-12 mb-4" data-select2-id="93">
                                                        <label for="select2Primary" class="form-label">Tugas untuk</label>
                                                        <div class="select2-primary" data-select2-id="92">
                                                            <div class="position-relative" data-select2-id="91">

                                                            </div>
                                                            <select name="penugasan[]" id="select2Primary"
                                                                class="select2 form-select select2-hidden-accessible"
                                                                multiple="" data-select2-id="select2Primary"
                                                                tabindex="-1" aria-hidden="true">

                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="d-flex flex-wrap" style="z-index: 1000000;">
                                                <button type="submit" class="btn btn-primary me-3"
                                                    data-bs-dismiss="offcanvas">
                                                    Update
                                                </button>
                                                <button type="button" class="btn btn-label-secondary"
                                                    data-bs-dismiss="offcanvas">
                                                    Close
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="komentar" role="tabpanel">

                                        <div class="list-komentar mt-3" style="margin-bottom: 80px">

                                        </div>

                                        <div class="form-komentar d-none" style="width: 100%;">
                                            <div class="row w-100 justify-content-center d-flex mb-3">
                                                <div class="col-11">
                                                    <form id="tambahKomentar" method="post">
                                                        @csrf
                                                        <label class="form-label"
                                                            for="bootstrap-maxlength-example2">Komentar</label>
                                                        <div
                                                            class="w-100 d-flex justify-content-between align-items-center gap-2">
                                                            <textarea style="resize: none" id="bootstrap-maxlength-example2"
                                                                class="form-control bootstrap-maxlength-example inp-tambah-komentar" rows="1" maxlength=""
                                                                style="height: 43px;"></textarea>
                                                            <button type="submit" class="btn btn-primary">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24">
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
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                    height="20" viewBox="0 0 24 24">
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

                                    <div class="tab-pane fade" id="aktifitas" role="tabpanel">
                                        <div class="row">
                                            <div class="col-12 tab-aktifitas mb-3">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Activities -->

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
                        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
                        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
                        <script src="{{ asset('utils/hadleLabel.js') }}"></script>
                        <script src="{{ asset('utils/handleFormatDate.js') }}"></script>

                        <script>
                            // let dataEmpty

                            const handleAktifitas = (aktifitas, pelaku, status) => {
                                console.log(aktifitas);
                                const jadwal = formatDate(aktifitas.deadline)

                                const avatar = aktifitas.user.avatar === null ? "assets/img/avatars/1.png" : "storage/" + aktifitas.user
                                    .avatar;

                                const labels = aktifitas.aktifitas_data_label;
                                let elementLabel = " "

                                $.each(labels, (index, data) => {
                                    let dataLabel = data.label;
                                    elementLabel += handleLabel(dataLabel.text, dataLabel.warna_text, dataLabel.warna_bg)
                                })

                                let tugaskan = ""
                                const ditugaskan = aktifitas.aktifitas_data_user;
                                $.each(ditugaskan, (index, data) => {
                                    const dataUser = data.user;
                                    const avatar = dataUser.avatar === null ? "assets/img/avatars/1.png" : "storage/" + dataUser
                                        .avatar;
                                    tugaskan +=
                                        `
        <div class="avatar avatar-xs avatar-aktifitas-${index}" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="${dataUser.username}" data-bs-original-title="${dataUser.username}">
            <img style="object-fit: cover;" src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle pull-up">
        </div>

        `

                                    $(`.avatar-aktifitas-${index}`).tooltip();
                                })

                                const elementPrioritas = prioritas(aktifitas.prioritas)


                                let updatedTimestamp = new Date(aktifitas.created_at);

                                let currentTimestamp = new Date();

                                let timeDifference = currentTimestamp - updatedTimestamp;

                                let minutesAgo = Math.floor(timeDifference / (1000 * 60));
                                let hoursAgo = Math.floor(timeDifference / (1000 * 60 * 60));
                                let daysAgo = Math.floor(timeDifference / (1000 * 60 * 60 * 24));

                                let waktu;

                                if (minutesAgo < 60) {
                                    waktu = `${minutesAgo} menit yang lalu`;
                                } else if (hoursAgo < 24) {
                                    waktu = `${hoursAgo} jam yang lalu`;
                                } else {
                                    waktu = `${daysAgo} hari yang lalu`;
                                }

                                // console.log(tug);
                                if (status === "create") {
                                    return `
            <div class="media d-flex align-items-start my-5">
                <div class="avatar me-2 flex-shrink-0 mt-1">
                    <img style="object-fit: cover" src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle">
                </div>
                <div class="media-body">
                    <p class="mb-0">
                        <span class="fw-medium">${aktifitas.user.username}</span> membuat tugas ${aktifitas.judul}
                    </p>
                    <small class="text-muted">${waktu}</small>
                </div>
            </div>
        `;
                                } else {
                                    return `
        <div class="media mt-3 d-flex align-items-start">
                                                <div class="avatar me-2 flex-shrink-0 mt-1">
                                                <img src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle">
                                                </div>
                                                <div class="media-body">
                                                <p class="mb-0">
                                                    <span class="fw-medium">${aktifitas.user.username}</span> mengupdate tugas ${aktifitas.judul}
                                                    <table class="table">
                                                        <tr>
                                                            <td>Judul</td>
                                                            <td>${aktifitas.judul}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Deadline</td>
                                                            <td>${jadwal}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Status Tugas</td>
                                                            <td>${aktifitas.status_tugas}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Label</td>
                                                            <td class="d-flex flex-wrap gap-1">${elementLabel}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Prioritas</td>
                                                            <td>${elementPrioritas}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Ditugaskan :</td>
                                                            <td class="d-flex tugaskan-aktifitas">${tugaskan}</td>
                                                        </tr>
                                                    </table>
                                                </p>
                                                <small class="text-muted">${waktu}</small>
                                                </div>
     </div>
        `;


                                }
                            };



                            var editPreviewLabel = $('#edit-preview-label');
                            var editInputText = $('#editText');
                            var editBackgroundColorInput = $('#edit-background-color-input');
                            var editTextColorInput = $('#edit-text-color-input');


                            $(".btn-submit-tambah-label").click(function() {
                                var text = $('#Text').val();
                                var warna_bg = $('#background-color-input').val();
                                var warna_text = $('#text-color-input').val();
                                const tim_id = "{{ $tim->id }}";

                                axios.post("{{ route('label.create') }}", {
                                        text,
                                        warna_bg,
                                        warna_text,
                                        tim_id
                                    })
                                    .then((res) => {
                                        getLabels()
                                        var text = $('#Text').val("Label");
                                        var warna_bg = $('#background-color-input').val("#666EE8");
                                        var warna_text = $('#text-color-input').val("#FFFFFF");
                                        updatePreview()
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil!",
                                            text: res.data.success,
                                            showConfirmButton: false,
                                            timer: 2500,
                                        })
                                    })
                                    .catch((err) => {
                                        let data = err.response.data.errors;
                                        let message = "";

                                        // Menggabungkan pesan-pesan validasi menjadi satu pesan
                                        $.each(data, function(key, value) {
                                            message += value + "\n";
                                        });

                                        Swal.fire({
                                            icon: "error",
                                            title: "Error!",
                                            text: (typeof err.response.data.message === "undefined") ? err : message,
                                            showConfirmButton: false,
                                            timer: 2500,
                                        })
                                    })
                            })

                            //  editlabel

                            $(".btn-edit-submit-tambah-label").click(function() {
                                let text = $('#editText').val();
                                let warna_bg = $('#edit-background-color-input').val();
                                let warna_text = $('#edit-text-color-input').val();
                                const tim_id = "{{ $tim->id }}";
                                const label_id = $(this).data('label_id')

                                axios.put("{{ route('label.edit') }}", {
                                        text,
                                        warna_bg,
                                        warna_text,
                                        tim_id,
                                        label_id
                                    })
                                    .then((res) => {
                                        getLabels()
                                        var text = $('#Text').val("Label");
                                        var warna_bg = $('#background-color-input').val("#666EE8");
                                        var warna_text = $('#text-color-input').val("#FFFFFF");
                                        updatePreview()
                                        closeModalEditLabel()
                                        Swal.fire({
                                            icon: "success",
                                            title: "Berhasil!",
                                            text: res.data.success,
                                            showConfirmButton: false,
                                            timer: 2500,
                                        })
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                        Swal.fire({
                                            icon: "error",
                                            title: "Error!",
                                            text: (typeof err.response.data.message === "undefined") ? err : err.response
                                                .data.message,
                                            showConfirmButton: false,
                                            timer: 2500,
                                        })
                                    })
                            })


                            // Fungsi untuk mengupdate tampilan preview
                            function editUpdatePreview() {
                                let text = editInputText.val();
                                let backgroundColor = editBackgroundColorInput.val();
                                let textColor = editTextColorInput.val();

                                editPreviewLabel.text(text);
                                editPreviewLabel.css('background-color', backgroundColor);
                                editPreviewLabel.css('color', textColor);
                            }

                            $('#editText, #edit-background-color-input, #edit-text-color-input').on('input', function() {
                                let text = $('#editText').val();
                                let backgroundColor = $('#edit-background-color-input').val();
                                let textColor = $('#edit-text-color-input').val();

                                // Mengupdate teks, warna latar belakang, dan warna teks pada live preview
                                $('#edit-preview-label').text(text);
                                $('#edit-preview-label').css('background-color', backgroundColor);
                                $('#edit-preview-label').css('color', textColor);
                            });


                            function editLabel(label_id, label_text, warna_bg, warna_text) {
                                console.log(label_id);
                                $(".btn-edit-submit-tambah-label").removeAttr('data-label_id');
                                $("#tambahLabel").hide()
                                $("#editTugasBar").hide()
                                $("#modalEditLabel").addClass("show").css("display", "block")

                                $("#editText").val(label_text);
                                $("#edit-background-color-input").val(warna_bg);
                                $("#edit-text-color-input").val(warna_text);

                                $(".btn-edit-submit-tambah-label").attr('data-label_id', label_id);
                                editUpdatePreview()
                            }

                            function closeModalEditLabel() {
                                $("#tambahLabel").show()
                                // $("#editTugasBar").hide()
                                $("#modalEditLabel").removeClass("show").css("display", "none")
                            }


                            function deleteLabel(label_id) {
                                Swal.fire({
                                    title: "Kamu Yakin?",
                                    text: "Data yang kamu hapus tidak bisa dikembalikan",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Hapus!"
                                }).then((result) => {


                                    if (result.isConfirmed) {


                                        axios.delete("delete-label/" + label_id)
                                            .then((res) => {
                                                getLabels()
                                                $(".tr-label-" + label_id).addClass("d-none");
                                            })
                                            .catch((err) => {
                                                console.log(err);
                                            })

                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Datamu berhasil dihapus",
                                            icon: "success"
                                        });
                                    }

                                });
                            }



                            function getLabels() {
                                const tim_id = "{{ $tim->id }}";
                                axios
                                    .get("ambil-labels/" + tim_id)
                                    .then((res) => {
                                        // Menghapus isi tabel sebelum menambahkan data baru
                                        $("#daftarLabels").DataTable().clear().destroy();
                                        $("#daftarLabels tbody").empty();

                                        const data = res.data;
                                        $.each(data, (index, item) => {
                                            let label =
                                                `<span class="badge" style="background-color: ${item.warna_bg}; color: ${item.warna_text}">${item.text}</span>`;

                                            let row = `
        <tr class="tr-label-${item.id}">
            <td>${index + 1}</td>
            <td>
                ${label}
            </td>
            <td>
                <button onclick="deleteLabel('${item.id}')" class="btn border-none btn-delete-label bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M7 21q-.825 0-1.413-.588T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.588 1.413T17 21H7ZM17 6H7v13h10V6ZM9 17h2V8H9v9Zm4 0h2V8h-2v9ZM7 6v13V6Z"/></svg>
                </button>
                <button onclick="editLabel('${item.id}', '${item.text}', '${item.warna_bg}', '${item.warna_text}')" class="btn border-none btn-delete-label bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M10 14v-2.615l8.944-8.945q.166-.165.348-.228q.183-.064.385-.064q.188 0 .368.064q.18.063.326.21L21.483 3.5q.16.165.242.364q.083.2.083.401t-.06.382q-.061.18-.227.345L12.52 14H10Zm9.465-8.354l1.348-1.361l-1.111-1.17l-1.387 1.381l1.15 1.15ZM5.615 20q-.69 0-1.152-.462Q4 19.075 4 18.385V5.615q0-.69.463-1.152Q4.925 4 5.615 4h8.387l-6.387 6.387v5.998h5.897L20 9.896v8.489q0 .69-.462 1.152q-.463.463-1.153.463H5.615Z"/></svg>
                </button>
            </td>
        </tr>
        `;
                                            $("#daftarLabels tbody").append(row);
                                        });

                                        // Inisialisasi DataTable
                                        $("#daftarLabels").DataTable({
                                            lengthMenu: [
                                                [5, 10, 15, -1],
                                                [5, 10, 15, "All"],
                                            ],
                                            pageLength: 5,
                                            order: [],
                                            ordering: false,
                                            pagingType: "simple_numbers",
                                            language: {
                                                sProcessing: "Sedang memproses...",
                                                sLengthMenu: "Tampilkan data _MENU_",
                                                sZeroRecords: "Tidak ditemukan Data",
                                                sInfo: "Tampil _START_ sampai _END_ dari _TOTAL_ data",
                                                sInfoEmpty: " 0 sampai 0 dari 0 data",
                                                sInfoFiltered: "(disaring dari _MAX_ data keseluruhan)",
                                                sInfoPostFix: "",
                                                sSearch: "Cari :",
                                                sUrl: "",
                                                oPaginate: {
                                                    sFirst: "Pertama",
                                                    sPrevious: "&#8592;",
                                                    sNext: "&#8594;",
                                                    sLast: "Terakhir",
                                                },
                                            },
                                            dom: "lrtip",
                                        });
                                    })
                                    .catch((err) => {
                                        console.log(err);
                                    });
                            }







                            // $(".btn-submit-tambah-label").click(function () {
                            //     var text = $('#Text').val();
                            //     var warna_bg = $('#background-color-input').val();
                            //     var warna_text = $('#text-color-input').val();
                            //     const tim_id = "{{ $tim->id }}";

                            //     axios.post("tambah-label/",{text,warna_bg,warna_text,tim_id})
                            //     .then((res) => {
                            //         var text = $('#Text').val("Label");
                            //         var warna_bg = $('#background-color-input').val("#666EE8");
                            //         var warna_text = $('#text-color-input').val("#FFFFFF");
                            //         updatePreview()
                            //         Swal.fire({
                            //             icon: "success",
                            //             title : "Berhasil!",
                            //             text: res.data.success,
                            //             showConfirmButton : false,
                            //             timer : 2500,
                            //         })
                            //         getLabels()
                            //     })
                            //     .catch((err) => {
                            //         console.log(err);
                            //         Swal.fire({
                            //             icon: "error",
                            //             title : "Error!",
                            //             text: ( typeof err.response.data.message === "undefined" ) ? err : err.response.data.message,
                            //             showConfirmButton : false,
                            //             timer : 2500,
                            //         })
                            //     })
                            //  })



                            var previewLabel = $('#preview-label');
                            var inputText = $('#Text');
                            var backgroundColorInput = $('#background-color-input');
                            var textColorInput = $('#text-color-input');

                            // Fungsi untuk mengupdate tampilan preview
                            function updatePreview() {
                                var text = inputText.val();
                                var backgroundColor = backgroundColorInput.val();
                                var textColor = textColorInput.val();

                                previewLabel.text(text);
                                previewLabel.css('background-color', backgroundColor);
                                previewLabel.css('color', textColor);
                            }


                            $(document).ready(function() {
                                // Mengupdate live preview saat input berubah
                                $('#Text, #background-color-input, #text-color-input').on('input', function() {
                                    var text = $('#Text').val();
                                    var backgroundColor = $('#background-color-input').val();
                                    var textColor = $('#text-color-input').val();

                                    // Mengupdate teks, warna latar belakang, dan warna teks pada live preview
                                    $('#preview-label').text(text);
                                    $('#preview-label').css('background-color', backgroundColor);
                                    $('#preview-label').css('color', textColor);
                                });
                            });


                            function bukaKomentar() {
                                $(".form-komentar").removeClass("d-none")
                                console.log("Buka Komentar");
                            }

                            function tutupKomentar() {
                                console.log("tutup Komentar");
                                $(".form-komentar").addClass("d-none")
                            }

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
                                            userTugaskan = user.filter((element, index) => user.indexOf(element) === index);
                                            console.log(userTugaskan);

                                            userTugaskan.forEach(element => {
                                                let avatar = element.avatar ? 'storage/' + element.avatar :
                                                    'assets/img/avatars/1.png';
                                                if (element === null || element === undefined) {
                                                    tugaskan += "";
                                                } else {
                                                    tugaskan +=
                                                        `
                                                    <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="${element.username}" data-bs-original-title="${element.username}">
                                                        <img style="object-fit: cover;" src="{{ asset('${avatar}') }}" alt="Avatar" class="rounded-circle pull-up">
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
                                                deadline = '-';
                                            }

                                            let wordDeadline;
                                            if (deadline < 0) {

                                                wordDeadline = `${Math.abs(deadline)} hari terlewat`

                                            } else if (deadline == '-') {

                                                wordDeadline = '-'

                                            } else if (deadline == 0) {
                                                wordDeadline = `hari ini`;
                                            } else {
                                                wordDeadline = `${deadline} hari lagi`

                                            }

                                            let elementPrioritas = prioritas(tugas.prioritas)

                                            let dropdownTugas =
                                                `
                                            <div class="dropdown kanban-tasks-item-dropdown cursor-pointer">
                                                    <i class="ti ti-dots-vertical" id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="kanban-tasks-item-dropdown" style="">
                                                        <button onclick="editTugas('${tugas.code}')" type="button" class="dropdown-item" data-bs-toggle="offcanvas" data-bs-target="#editTugasBar">Edit</button>
                                                        <button onclick="deleteTugas('${tugas.code}')" class="dropdown-item" href="javascript:void(0)">Delete</button>
                                                    </div>
                                            </div>

                                            `

                                            if (res.data.status_keanggotaan !== 'active') {
                                                dropdownTugas = ''
                                            }

                                            let labels = ""
                                            $.each(tugas.label, (index, label) => {

                                                labels += handleLabel(label.text, label.warna_text, label.warna_bg);
                                            })

                                            console.log(labels);

                                            const element = $(`<div>`)
                                                .attr("id", "board-" + tugas.code)
                                                .css("width", "100%")
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
                                                            ${wordDeadline}
                                                        </div>
                                                    </div>
                                                    ${dropdownTugas}
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
                                                <div class="d-flex flex-wrap gap-1">
                                                    ${labels}
                                                </div>
                                            </div>
                        `
                                                );
                                            element.find('[data-bs-toggle="tooltip"]').tooltip();


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

                            const today = new Date();
                            const tommorow = new Date(today)
                            tommorow.setDate(today.getDate() + 1);

                            flatpickr("#due-date", {
                                minDate: today,
                                dateFormat: "Y-m-d",
                            });

                            function openModal() {
                                $("#tambahLabel").show()
                                $("#editTugasBar").hide()
                                // $("#tambahLabel").css("display","block");
                                $("#tambahLabel").addClass("show");

                                updatePreview()
                                getLabels()
                            }

                            const modal = $(".modal")

                            $(".btn-tambah-labels").on('click', openModal)

                            function closeCanvasEditTugas() {
                                $("#editTugasBar").hide()
                                $(".modal-backdrop").addClass("d-none");
                            }


                            function bukaCanvasEditTugas() {
                                $("#tambahLabel").hide()
                                $(".modal-backdrop").removeClass(".modal-backdrop")
                                $("#editTugasBar").show();
                            }

                            $('.tutup-label').on('click', function() {
                                $("#tambahLabel").hide()
                                // $(".modal-backdrop").removeClass(".modal-backdrop")
                                $("#editTugasBar").show();
                            });

                            function editTugas(codeTugas) {
                                bukaCanvasEditTugas()
                                console.log(codeTugas);
                                $("#select2Primary").empty();
                                $("#formEditTugas").attr("data-codetugas", codeTugas);
                                $("#tambahKomentar").attr("data-codetugas", codeTugas);

                                $("#labels").empty();

                                axios.get("data-edit-tugas/" + codeTugas)
                                    .then((res) => {

                                        console.log("klik edit code " + codeTugas);
                                        const data = res.data;
                                        // console.log(data);
                                        const user = data.tugas.tim.user;
                                        const userSelected = data.tugas.user;
                                        const labelSelected = data.tugas.label;
                                        const comments = data.tugas.comments;
                                        const aktifitas = data.tugas.aktifitas;


                                        $(".tab-aktifitas").empty()
                                        $.each(aktifitas, (index, data) => {

                                            console.log(data.tugas);
                                            const elements = handleAktifitas(data, data.aktifitas_data_user, data.status);
                                            $(".tab-aktifitas").append(elements)
                                        })

                                        // label

                                        const label = data.labels;


                                        Object.keys(label).forEach(key => {
                                            const labelOption = label[key];

                                            const option = document.createElement('option')
                                            option.value = labelOption.id;
                                            option.textContent = labelOption.text;

                                            labelSelected.forEach(data => {
                                                if (data.id === labelOption.id) {
                                                    option.setAttribute("selected", true);
                                                }
                                            });
                                            $("#labels").append(option);
                                        });

                                        console.log(label);




                                        const optStatusTugas = document.querySelector("#status");

                                        optStatusTugas.querySelectorAll('option').forEach(status => {
                                            if (status.value === data.tugas.status_tugas) {
                                                status.selected = true;
                                                $("#status").trigger("change");
                                            } else {
                                                status.selected = false
                                            }
                                        });



                                        const optPrioritas = document.querySelector("#newPriority")

                                        optPrioritas.querySelectorAll('option').forEach(priority => {
                                            if (priority.value === data.tugas.prioritas) {
                                                priority.selected = true;
                                                $("#newPriority").trigger("change");
                                            } else {
                                                priority.selected = false;
                                            }
                                        });

                                        $("#title").val(data.tugas.nama)
                                        $("#due-date").val(data.tugas.deadline)

                                        if (data.tugas.tim.status_tim !== "solo") {
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
                                        if (comments.length !== 0) {
                                            Object.keys(comments).forEach((keys, i) => {
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
                        <img style="object-fit:cover" src="{{ asset('${avatar}') }}"
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
                                        } else {
                                            const div =
                                                `
                                        <img class="w-50 d-block mx-auto" src="{{ asset('assets/img/no-data.png') }}" />
                                        <h5 class="text-center">Belum ada komentar</h5>
                                        `
                                            $(".list-komentar").append(div);

                                        }

                                    });
                            }


                            $("#formEditTugas").submit(function(e) {
                                e.preventDefault()
                                const nama = $("#title").val();
                                const deadline = $("#due-date").val();
                                const status_tugas = $("#status").val();
                                const prioritas = $("#newPriority").val();
                                const penugasan = $("#select2Primary").val()
                                const labels = $("#labels").val()
                                let codeTugas = $(this).data('codetugas');
                                console.log("edit tugas code " + codeTugas);

                                axios.put("{{ route('editTugas') }}", {
                                        codeTugas,
                                        nama,
                                        deadline,
                                        status_tugas,
                                        penugasan,
                                        prioritas,
                                        labels,
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
                                        // console.log(error);
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
                                                successRes("Berhasil Menghapus komentar");

                                            })
                                            .catch((err) => {
                                                console.log(err);
                                                alertError(err);
                                            })

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
                                console.log("tugas code tercancel" + tugas_code);
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

                                axios.post("tambah-tugas/" + tim_id, {
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
                                        $("#formEditTugas").trigger("reset");

                                    })
                            });

                            function deleteTugas(codetugas) {
                                Swal.fire({
                                    title: "Are you sure?",
                                    text: "You won't be able to revert this!",
                                    icon: "warning",
                                    showCancelButton: true,
                                    confirmButtonColor: "#3085d6",
                                    cancelButtonColor: "#d33",
                                    confirmButtonText: "Yes, delete it!"
                                }).then((result) => {
                                    if (result.isConfirmed) {

                                        axios.delete("delete/tugas/" + codetugas)
                                            .then((res) => {
                                                const data = res.data;
                                                $("#board-" + codetugas).addClass("d-none")
                                                console.log(data);

                                            })
                                            .catch((err) => {
                                                console.log(err);
                                                alertError(err);
                                            })


                                        Swal.fire({
                                            title: "Deleted!",
                                            text: "Your file has been deleted.",
                                            icon: "success"
                                        });
                                    }
                                });

                            }
                        </script>
                    @endsection
