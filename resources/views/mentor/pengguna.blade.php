@extends('layoutsMentor.app')
@section('content')
    <style>
        .icon-button {
            background: none;
            border: none;
        }

        .icon-text {
            margin-right: 5px;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <ul class="nav nav-pills mb-3 mt-3" style="padding-left: 20px" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true"><i
                            class="fa-solid fa-users icon-text"></i>Siswa</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false"><i
                            class="fa-solid fa-user-group icon-text"></i>Ketua
                        Magang</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i
                            class="fa-solid fa-user-tie icon-text"></i>Mentor</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-team"
                        type="button" role="tab" aria-controls="pills-contact" aria-selected="false"><i
                            class="fa-solid fa-user-slash icon-text"></i>Histori Ketua
                        Magang</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    {{-- <div class="card"> --}}
                    <div class="row g-3 align-items-center">
                        <div class="d-flex flex-row gap-2 justify-content-between py-3 px-4">
                            <div class="d-flex flex-row gap-1">
                                <label for="inputPassword6" class="col-form-label"
                                    style="padding-right: 5px;padding-left: 5px">Search Filter</label>
                                <input type="text" class="form-control" style="width:200px;">
                            </div>
                            <div class="d-flex">
                                <div class="col" style="padding-left: auto">
                                    <button class="btn btn-success"><i
                                            class="fa-regular fa-file icon-text"></i>Import</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-data"><i
                                            class="fa-solid fa-plus icon-text"></i>Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
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
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">siswa</button>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                                    data-bs-target="#detail"><i class="ti ti-eye me-1"></i> Detail</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-data"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Jacob
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">siswa</button>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-eye me-1"></i> Detail</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Larry the Bird
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color: rgb(255, 231, 187);color:rgb(255, 149, 0)"">siswa</button>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-eye me-1"></i> Detail</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}

                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                    tabindex="0">
                    {{-- <div class="card"> --}}
                    <div class="row g-3 align-items-center">
                        <div class="d-flex flex-row gap-2 justify-content-between py-3 px-4">
                            <div class="d-flex flex-row gap-1">
                                <label for="inputPassword6" class="col-form-label"
                                    style="padding-right: 5px;padding-left: 5px">Search Filter</label>
                                <input type="text" class="form-control" style="width:200px;">
                            </div>
                            <div class="d-flex">
                                <div class="col" style="padding-left: auto">
                                    <button class="btn btn-success"><i
                                            class="fa-regular fa-file icon-text"></i>Import</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-data"><i
                                            class="fa-solid fa-plus icon-text"></i>Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Adi
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Ketua
                                            Magang</button></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-eye me-1"data-bs-toggle="modal"
                                                        data-bs-target="#detail-ketua"></i> Detail</a>
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-data"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Meilani
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Wakil
                                            Ketua</button></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-eye me-1"></i> Detail</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                    tabindex="0">
                    {{-- <div class="card"> --}}
                    <div class="row g-3 align-items-center">
                        <div class="d-flex flex-row gap-2 justify-content-between py-3 px-4">
                            <div class="d-flex flex-row gap-1">
                                <label for="inputPassword6" class="col-form-label"
                                    style="padding-right: 5px;padding-left: 5px">Search Filter</label>
                                <input type="text" class="form-control" style="width:200px;">
                            </div>
                            <div class="d-flex">
                                <div class="col" style="padding-left: auto">
                                    <button class="btn btn-success"><i
                                            class="fa-regular fa-file icon-text"></i>Import</button>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-data"><i
                                            class="fa-solid fa-plus icon-text"></i>Tambah</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Yudas
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Mentor</button>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#edit-data"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Bagas
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Mentor</button>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
                <div class="tab-pane fade" id="pills-team" role="tabpanel" aria-labelledby="pills-disabled-tab"
                    tabindex="0">
                    {{-- <div class="card"> --}}
                    <div class="row g-3 align-items-center">
                        <div class="d-flex flex-row gap-2 justify-content-between py-3 px-4">
                            <div class="d-flex flex-row gap-1">
                                <label for="inputPassword6" class="col-form-label"
                                    style="padding-right: 5px;padding-left: 5px">Search Filter</label>
                                <input type="text" class="form-control" style="width:200px;">
                            </div>
                        </div>
                    </div>
                    <div class="card-datatable table-responsive">
                        <table class="dt-responsive table">
                            <thead>
                                <tr>
                                    <th scope="col">NO</th>
                                    <th scope="col">USER</th>
                                    <th scope="col">EMAIL</th>
                                    <th scope="col">STATUS</th>
                                    <th scope="col">MASA JABATAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Adi
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Ketua
                                            Magang</button></td>
                                    <td>10 Januari s.d 10 Februari</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width:30px;hight:30px;border-radius:50%">
                                        Meilani
                                    </td>
                                    <td>Example@gmail.com</td>
                                    <td><button disabled="disabled" class="btn"
                                            style="background-color:  rgb(255, 231, 187);color:rgb(255, 149, 0)">Wakil
                                            Ketua</button></td>
                                    <td>10 Januari s.d 10 Februari</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    {{-- </div> --}}
                </div>
            </div>

            {{-- modal add data --}}
            <div class="modal fade" id="add-data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Email</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="select2Basic" class="form-label">Status Role</label>
                                    <select id="select2Basic" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

             {{-- modal edit data --}}
             <div class="modal fade" id="edit-data" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Name</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Email</label>
                                    <input type="text" id="nameWithTitle" class="form-control"
                                        placeholder="Enter Email">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="select2Basic" class="form-label">Status Role</label>
                                    <select id="select2Basic" class="select2 form-select form-select-lg"
                                        data-allow-clear="true">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                        <option value="CA">California</option>
                                        <option value="NV">Nevada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>


            {{-- modal team --}}
            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="emailWithTitle" class="form-label">TEAM</label>
                                <div class="col mb-3">
                                    <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                        style="width: 80%;hight:80%;border-radius:20%">
                                    <span>Hummatech</span>
                                </div>
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">ANGGOTA</label>
                                    <div class="avatar-container">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/img/avatars/5.png') }}" alt="Avatar"
                                                style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                            <span>saputra</span>
                                        </div>
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/img/avatars/12.png') }}" alt="Avatar"
                                                style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                            <span>saputra</span>
                                        </div>
                                        <img src="{{ asset('assets/img/avatars/9.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                        <img src="{{ asset('assets/img/avatars/6.png') }}" alt="Avatar"
                                            style="width:30px;hight:30px;border-radius:50%" class="avatar">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">KETUA</label>
                                    <div class="col mb-3">
                                        <img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                            style="width: 10%;hight:10%;border-radius:20%">
                                    </div>
                                </div>
                            </div>
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="emailWithTitle" class="form-label">KETUA</label>
                                    <input type="email" id="emailWithTitle" class="form-control"
                                        placeholder="xxxx@xxx.xx">
                                </div>
                                <div class="col mb-0">
                                    <label for="dobWithTitle" class="form-label">DOB</label>
                                    <input type="date" id="dobWithTitle" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- end modal team --}}

            {{-- modal detail --}}
            <div class="modal fade" id="detail" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- User Card -->
                                {{-- <div class="card mb-4"> --}}
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class=" d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                                src="{{ asset('assets/img/avatars/15.png') }}" height="100"
                                                width="100" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4 class="mb-2">Violet Mendoza</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                                    </div>
                                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-4">
                                                <span class="fw-medium me-1">Name:</span>
                                                <span>Violet Mendoza</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Email:</span>
                                                <span>Example@gmail.com</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Contact:</span>
                                                <span>(+62) 832-2321-2886</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Status:</span>
                                                <span class="badge bg-label-warning">siswa</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <!-- /User Card -->

                            </div>
                        </div>
                        {{-- end modal detail --}}
                    </div>
                </div>
            </div>

            {{-- modal detail ketua dan wakil --}}
            <div class="modal fade" id="detail-ketua" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <!-- User Card -->
                                {{-- <div class="card mb-4"> --}}
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class=" d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mb-3 pt-1 mt-4"
                                                src="{{ asset('assets/img/avatars/15.png') }}" height="100"
                                                width="100" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4 class="mb-2">Violet Mendoza</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
                                    </div>
                                    <p class="mt-4 small text-uppercase text-muted">Details</p>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-4">
                                                <span class="fw-medium me-1">Name:</span>
                                                <span>Violet Mendoza</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Email:</span>
                                                <span>Example@gmail.com</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Contact:</span>
                                                <span>(+62) 832-2321-2886</span>
                                            </li>
                                            <li class="mb-4 pt-1">
                                                <span class="fw-medium me-1">Status:</span>
                                                <span class="badge bg-label-warning">siswa</span>
                                                <span class="badge bg-label-warning">ketua magang</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                {{-- </div> --}}
                                <!-- /User Card -->

                            </div>
                        </div>
                        {{-- end modal detail --}}
                    </div>
                </div>
            </div>
        </div>
        @endsection
