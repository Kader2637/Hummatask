@extends('layoutsMentor.app')
@section('content')
    <style>
        .avatar-container {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            max-height: 150px;
            overflow-y: auto;
        }

        .avatar-container::-webkit-scrollbar {
            width: 8px;
            height: 8px;
            /* Lebar scroll */
            background-color: #f0f0f0;
        }

        .avatar-container::-webkit-scrollbar-thumb {
            background-color: #7367f0;
            border-radius: 4px;
        }

        .avatar-container::-webkit-scrollbar-thumb:hover {
            background-color: #4838fb;
        }

        .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin: 5px;
        }

        .icon-text {
            margin-right: 5px;
        }

        .nama-anggota {
            margin-top: 15px;
        }

        @media (min-width: 320px) and (max-width: 499px) {
            .navbar-ul {
                flex-direction: column;
                width: 100%;
                padding-left: 0px;
            }

            .navbar-ul li {
                /* font-size: 10px; */
                display: 'flex';
                justify-content: 'center';
                align-content: 'center';
            }

            .button-document {
                width: 100%;
                margin-bottom: 8px;
            }

            .button-document button {
                width: 100%;
            }

            .image-leader {
                width: 20%;
                hight: 10%;
                border-radius: 20%
                    /* width: 10%;hight:10%;border-radius:20% */
            }

            .image-team {
                width: 100%;
                hight: 100%;
                border-radius: 20%;
                /* width: 80%;hight:80%;border-radius:20% */
            }

            .anggota {
                top: -900px;
                padding-left: 60px;
            }

            .nama-anggota {
                max-width: 70px;
            }

            .anggota-scroll {
                max-width: 200px;
                overflow-x: auto;
            }

            .longor {
                display: flex;
                justify-content: space-between;
            }

            /* Mengubah warna track (latar belakang scroll) */
            .anggota-scroll::-webkit-scrollbar {
                width: 8px;
                height: 8px;
                /* Lebar scroll */
                background-color: #f0f0f0;
                /* Warna latar belakang scroll */
            }

            /* Mengubah tampilan thumb (bagian yang dapat digerakkan) */
            .anggota-scroll::-webkit-scrollbar-thumb {
                background-color: #7367f0;
                /* Warna thumb */
                border-radius: 4px;
                /* Sudut melengkung thumb */
            }

            /* Mengubah tampilan thumb saat digulirkan */
            .anggota-scroll::-webkit-scrollbar-thumb:hover {
                background-color: #4838fb;
                /* Warna thumb saat dihover */
            }
        }

        @media (min-width: 1000px) and (max-width: 2000px) {
            .image-leader {
                width: 15%;
                hight: 10%;
                border-radius: 20%
                    /* width: 10%;hight:10%;border-radius:20% */
            }

            .anggota {
                padding-left: 80px;
            }

            .leader {
                top: 90px;
            }

            .avatar-container {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                /* Mengatur elemen di sebelah kiri */
                max-width: 250px;
                overflow-x: auto;
            }

            .modal-detail {
                width: 450px;
            }
        }

        @media (min-width: 500px) and (max-width: 999px) {
            .image-leader {
                width: 10%;
                hight: -5%;
                border-radius: 10%
                    /* width: 10%;hight:10%;border-radius:20% */
            }

            .anggota {
                padding-left: 70px;
            }

            .leader {
                top: 50px;
            }

            .avatar-container {
                display: flex;
                flex-direction: column;
                justify-content: flex-start;
                /* Mengatur elemen di sebelah kiri */
                max-width: 240px;
                overflow-x: auto;
            }

            .modal-detail {
                width: 430px;
            }
        }

        @media (min-width: 500px) and (max-width: 768px) {
            .navbar-ul li {
                font-size: 14px;
                display: 'flex';
                justify-content: 'center';
                align-content: 'center';
            }
        }
    </style>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3">
            <span class="text-muted fw-light"></span> History
        </h4>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i
                            class="fa-solid fa-calendar-xmark icon-text"></i>Telat
                        Deadline</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i
                            class="fa-solid fa-person-chalkboard icon-text"></i>Selesai
                        Presentasi</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i
                            class="fa-solid fa-user icon-text"></i>Solo</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-team"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i
                            class="fa-solid fa-users icon-text"></i>Team</button>
                </li>
            </div>
            <div class="px-3 button-document" style="margin-left: auto">
                <button class="btn btn-success"><i class="fa-regular fa-file icon-text"></i>document</i></button>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                tabindex="0">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel1" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">TANGGAL TENGGAT</th>
                                    <th scope="col">PROJECT</th>
                                    <th scope="col">TEMA</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Mark
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Solo Project</td>
                                    <td>Sekolah</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(255, 231, 187);color:rgb(255, 149, 0)">tenggat</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Jacob
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Mini Project</td>
                                    <td>Peminjaman</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(255, 231, 187);color:rgb(255, 149, 0)">tenggat</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Larry the Bird
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Big Project</td>
                                    <td>Tiket Konser</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(255, 231, 187);color:rgb(255, 149, 0)">tenggat</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel2" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">TANGGAL TENGGAT</th>
                                    <th scope="col">PROJECT</th>
                                    <th scope="col">TEMA</th>
                                    <th scope="col">STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Mark
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Solo Project</td>
                                    <td>Sekolah</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(187, 210, 255);color:rgb(0, 106, 255)">selesai</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Jacob
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Mini Project</td>
                                    <td>Peminjaman</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(187, 210, 255);color:rgb(0, 106, 255)">selesai</button>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Larry the Bird
                                    </td>
                                    <td>12-10-2023</td>
                                    <td>Big Project</td>
                                    <td>Tiket Konser</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(187, 210, 255);color:rgb(0, 106, 255)">selesai</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                tabindex="0">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel3" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">NAMA</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">PROJECT</th>
                                    <th scope="col">TEMA</th>
                                    <th scope="col">PRESENTASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Mark
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td>Solo Project</td>
                                    <td>Sekolah</td>
                                    <td>10</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Jacob
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td>Solo Project</td>
                                    <td>Peminjaman</td>
                                    <td>8</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Larry the Bird
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td>Solo Project</td>
                                    <td>Tiket Konser</td>
                                    <td>5</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-team" role="tabpanel" aria-labelledby="pills-disabled-tab"
                tabindex="0">
                <div class="card">
                    <div class="card-datatable table-responsive">
                        <table id="jstabel4" class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">TEAM</th>
                                    <th scope="col">KETUA</th>
                                    <th scope="col">ANGGOTA</th>
                                    <th scope="col">PROJECT</th>
                                    <th scope="col">PRESENTASI</th>
                                    <th scope="col">OPSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Hummatech
                                    </td>
                                    <td>king ibnu</td>
                                    <td>
                                        <div class="d-flex align-items-center avatar-group">
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Vinnie Mostowy">
                                                <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                                                <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Jimmy Jackson">
                                                <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Kristine Gill">
                                                <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Nelson Wilson">
                                                <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mini Project</td>
                                    <td>10</td>
                                    <td> <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#modalCenter">
                                            detail
                                        </button></td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Hummatech
                                    </td>
                                    <td>king ibnu</td>
                                    <td>
                                        <div class="d-flex align-items-center avatar-group">
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Vinnie Mostowy">
                                                <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                                                <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Jimmy Jackson">
                                                <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Kristine Gill">
                                                <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Nelson Wilson">
                                                <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mini Project</td>
                                    <td>10</td>
                                    <td><button class="btn btn-primary">detail</button></td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Hummatech
                                    </td>
                                    <td>king ibnu</td>
                                    <td>
                                        <div class="d-flex align-items-center avatar-group">
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Vinnie Mostowy">
                                                <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top" title="Marrie Patty">
                                                <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Jimmy Jackson">
                                                <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Kristine Gill">
                                                <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                            <div class="avatar pull-up" data-bs-toggle="tooltip"
                                                data-popup="tooltip-custom" data-bs-placement="top"
                                                title="Nelson Wilson">
                                                <img src="{{ asset('assets/img/avatars/4.png') }}" alt="Avatar"
                                                    class="rounded-circle">
                                            </div>
                                        </div>
                                    </td>
                                    <td>Mini Project</td>
                                    <td>10</td>
                                    <td><button class="btn btn-primary">detail</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content modal-detail">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="d-flex longor">
                            <div class="row">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">TEAM</label>
                                    <div class="col mb-2">
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width: 150%;hight:150%;border-radius:10%" class="image-team">
                                    </div>
                                    <span style="">Hummatech</span>
                                </div>
                            </div>
                            <div class="col mb-4 anggota">
                                <label for="emailWithTitle" class="form-label">ANGGOTA</label>
                                <div class="avatar-container anggota-scroll">
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                        <span
                                            class="nama-anggota">saputraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa</span>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                        <span class="nama-anggota">saputra</span>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                        <span class="nama-anggota">saputra</span>
                                    </div>
                                    <div class="d-flex">
                                        <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                        <span class="nama-anggota">saputra</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-3 leader">
                                <label for="emailWithTitle" class="form-label">KETUA</label>
                                <div class="col mb-3 d-flex">
                                    <img src="{{ asset('assets/img/avatars/10.png') }}" alt="" style=""
                                        class="image-leader">
                                    <span style="margin-top: 30px;margin-left: 10px">King Ibnu</span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-2" style="padding-top: 10px">
                            <div class="col mb-0"
                                style="display: flex; flex-direction: column;>
                                <label for="emailWithTitle"
                                class="form-label">STATUS</label>
                                <button disabled="disabled" class="btn"
                                    style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0);width: fit-content;margin-top: 4px">Big
                                    Project</button>
                            </div>
                            <div class="col mb-0" style="display: flex; flex-direction: column;">
                                <label for="dobWithTitle" class="form-label">TEMA</label>
                                <span>pengelola tugas</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script>
        jQuery.noConflict();

        jQuery(document).ready(function($) {
            $('#jstabel1').DataTable({
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "ordering": false,

                "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan Data",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari :",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "&#8592;",
                        "sNext": "&#8594;",
                        "sLast": "Terakhir"
                    }
                }
            });
        });

        jQuery(document).ready(function($) {
            $('#jstabel2').DataTable({
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "ordering": false,

                "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan Data",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari :",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "&#8592;",
                        "sNext": "&#8594;",
                        "sLast": "Terakhir"
                    }
                }
            });
        });

        jQuery(document).ready(function($) {
            $('#jstabel3').DataTable({
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "ordering": false,

                "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan Data",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari :",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "&#8592;",
                        "sNext": "&#8594;",
                        "sLast": "Terakhir"
                    }
                }
            });
        });

        jQuery(document).ready(function($) {
            $('#jstabel4').DataTable({
                "lengthMenu": [
                    [5, 10, 15, -1],
                    [5, 10, 15, "All"]
                ],
                "pageLength": 5,

                "order": [],

                "ordering": false,

                "language": {
                    "sProcessing": "Sedang memproses...",
                    "sLengthMenu": "Tampilkan _MENU_ data",
                    "sZeroRecords": "Tidak ditemukan Data",
                    "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                    "sInfoFiltered": "(disaring dari _MAX_ data keseluruhan)",
                    "sInfoPostFix": "",
                    "sSearch": "Cari :",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Pertama",
                        "sPrevious": "&#8592;",
                        "sNext": "&#8594;",
                        "sLast": "Terakhir"
                    }
                }
            });
        });
    </script>
@endsection
