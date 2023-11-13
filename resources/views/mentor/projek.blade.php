@extends('layoutsMentor.app')

@section('style')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js">
        < script >
            <
            script src = "https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" >
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
@endsection

@section('content')
    <div class="container-fluid mt-4 justify-content-center">
        <h5 class="header">Project</h5>
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-projek" aria-controls="navs-pills-top-home"
                            aria-selected="true">Projek</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-pengajuan" aria-controls="navs-pills-top-tim"
                            aria-selected="false" tabindex="-1">Pengajuan Projek</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-tim" aria-controls="navs-pills-top-messages"
                            aria-selected="false" tabindex="-1">Tim</button>
                    </li>
                </ul>
                <div class="tab-content py-0 px-0" style="border: none; background: none; box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-projek" role="tabpanel">
                        <div class="row">
                            <div class="d-flex justify-content-between">
                                <div class="filter col-lg-3 col-md-3 col-sm-3">
                                    <label for="select2Basic" class="form-label">Filter</label>
                                    <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" onchange="filterProjek(this)">
                                        <option value="" disabled selected>Pilih Data</option>
                                        <option value="all">Semua</option>
                                        <option value="solo">Solo Project</option>
                                        <option value="pre_mini">Pre-mini Project</option>
                                        <option value="mini">Mini Project</option>
                                        <option value="big">Big Project</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4" id="projectList">
                                @forelse ($projects as $item)
                                    @php
                                        $anggotaArray = [];
                                        foreach ($item->tim->anggota as $anggota) {
                                            $anggotaArray[] = [
                                                'name' => $anggota->user->username,
                                                'avatar' => $anggota->user->avatar,
                                                'jabatan' => $anggota->jabatan->nama_jabatan,
                                            ];
                                        }
                                        $anggotaJson = json_encode($anggotaArray);
                                        $tanggalMulai = $item->tim->created_at->translatedFormat('Y-m-d');
                                        $totalDeadline = null;
                                        $dayLeft = null;

                                        $deadline = \Carbon\Carbon::parse($item->deadline)->translatedFormat('Y-m-d');
                                        $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
                                        $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now());
                                        $progressPercentage = 100 - ($dayLeft / $totalDeadline) * 100;
                                    @endphp
                                    <div class="col-md-4 col-lg-4 col-sm-4" id="projectList">
                                        <div class="card text-center mb-3 projek-item"
                                            data-status-tim="{{ $item->tim->status_tim }}">
                                            <div class="card-body">
                                                <div class="d-flex flex-row gap-3">
                                                    <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="foto logo"
                                                        style="width: 100px; height: 100px" class="rounded-circle mb-3">
                                                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center;"
                                                        class="">
                                                        <span class="text-black fs-6">{{ $item->tim->nama }}</span>
                                                        <div class="d-flex align-items-center">
                                                            <span
                                                                class="badge bg-label-warning my-1">{{ $item->tim->status_tim }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            <div
                                                                class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                                <div class="d-flex align-items-center">
                                                                    <ul
                                                                        class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                                        @foreach ($item->tim->anggota as $anggota)
                                                                            <li data-bs-toggle="tooltip"
                                                                                data-popup="tooltip-custom"
                                                                                data-bs-placement="top"
                                                                                title="{{ $anggota->user->username }}"
                                                                                class="avatar avatar-sm pull-up">
                                                                                <img class="rounded-circle"
                                                                                    src="{{ $anggota->user->avatar ? Storage::url($anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                                    alt="Avatar">
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="info" class="my-4">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Mulai : </span>
                                                        <div>{{ $item->created_at->translatedFormat('l, j F Y') }}</div>
                                                    </div>
                                                    <div class="d-flex justify-content-between my-3">
                                                        <span>Deadline : </span>
                                                        <div>
                                                            {{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <span>Tema : </span>
                                                        <div>{{ $item->tema->nama_tema }}</div>
                                                    </div>
                                                </div>
                                                <a data-bs-toggle="" data-bs-target="#modalDetailProjek"
                                                    class="w-100 btn btn-primary btn-detail-projek"
                                                    data-logo="{{ asset('storage/' . $item->tim->logo) }}"
                                                    data-namatim="{{ $item->tim->nama }}"
                                                    data-status="{{ $item->tim->status_tim }}"
                                                    data-tema="{{ $item->tema->nama_tema }}"
                                                    data-tglmulai="{{ $item->created_at->translatedFormat('l, j F Y') }}"
                                                    data-deadline="{{ \Carbon\Carbon::parse($item->deadline)->translatedFormat('l, j F Y') }}"
                                                    data-anggota="{{ $anggotaJson }}"
                                                    data-deskripsi="{{ $item->deskripsi }}"
                                                    data-dayleft="{{ $dayLeft }}"
                                                    data-total-deadline="{{ $totalDeadline }}"
                                                    data-progress="{{ $progressPercentage }}"
                                                    data-repo="{{ $item->tim->repository }}"><span
                                                        class="text-white">Detail</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>Tidak ada data project</p>
                                @endforelse
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item first">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevrons-left ti-xs"></i></a>
                                        </li>
                                        <li class="page-item prev">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevron-left ti-xs"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">5</a>
                                        </li>
                                        <li class="page-item next">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevron-right ti-xs"></i></a>
                                        </li>
                                        <li class="page-item last">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevrons-right ti-xs"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-pengajuan" role="tabpanel">
                        <div class="row">
                            <div class="container-fluid mt-4 ">
                                <h5 class="header">Daftar Pengajuan Projek</h5>
                                <div class="row">
                                    @forelse ($pengajuan as $data)
                                        @php
                                            $anggotaArray = [];
                                            foreach ($data->tim->anggota as $anggota) {
                                                $anggotaArray[] = [
                                                    'username' => $anggota->user->username,
                                                    'avatar' => $anggota->user->avatar,
                                                    'jabatan' => $anggota->jabatan->nama_jabatan,
                                                ];
                                            }
                                            $anggotaJson = json_encode($anggotaArray);

                                            $temaArray = [];
                                            foreach ($data->tim->tema as $tema) {
                                                $temaArray[] = [
                                                    'tema_id' => $tema->id,
                                                    'tema_code' => $tema->code,
                                                    'nama_tema' => $tema->nama_tema,
                                                ];
                                            }
                                            $temaJson = json_encode($temaArray);
                                        @endphp
                                        <div class="col-md-6 col-lg-3">
                                            <div class="card text-center mb-3">
                                                <div class="card-body">
                                                    <img src="{{ asset('storage/' . $data->tim->logo) }}" alt="logo tim"
                                                        class="rounded-circle mb-3" style="width: 100px; height: 100px">
                                                    <h5 class="card-title">{{ $data->tim->nama }}</h5>
                                                    <div
                                                        class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                                        <div class="d-flex align-items-center">
                                                            <ul
                                                                class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                                                @foreach ($data->tim->anggota as $anggota)
                                                                    <li data-bs-toggle="tooltip"
                                                                        data-popup="tooltip-custom"
                                                                        data-bs-placement="top"
                                                                        title="{{ $anggota->user->username }}"
                                                                        class="avatar avatar-sm pull-up">
                                                                        <img class="rounded-circle"
                                                                            src="{{ $anggota->user->avatar ? Storage::url($anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                                            alt="Avatar">
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <a><span
                                                            class="badge bg-label-warning mb-3">{{ $data->tim->status_tim }}</span></a>
                                                    <p class="card-text">
                                                        {{ $data->created_at->translatedFormat('l, j F Y') }}</p>
                                                    <a data-bs-toggle="modal" data-bs-target="#modalDetailPengajuan"
                                                        data-nama-tim="{{ $data->tim->nama }}"
                                                        data-type-project="{{ $data->type_project }}"
                                                        data-logo="{{ Storage::url($data->tim->logo) }}"
                                                        data-created-at="{{ $data->created_at->translatedFormat('l, j F Y') }}"
                                                        data-anggota="{{ $anggotaJson }}"
                                                        data-tema="{{ $temaJson }}"
                                                        class="btn btn-primary btn-detail"><span
                                                            class="text-white">Detail</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p>Tidak ada data pengajuan project.</p>
                                    @endforelse
                                </div>
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end">
                                        <li class="page-item first">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevrons-left ti-xs"></i></a>
                                        </li>
                                        <li class="page-item prev">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevron-left ti-xs"></i></a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">1</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">2</a>
                                        </li>
                                        <li class="page-item active">
                                            <a class="page-link" href="javascript:void(0);">3</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">4</a>
                                        </li>
                                        <li class="page-item">
                                            <a class="page-link" href="javascript:void(0);">5</a>
                                        </li>
                                        <li class="page-item next">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevron-right ti-xs"></i></a>
                                        </li>
                                        <li class="page-item last">
                                            <a class="page-link" href="javascript:void(0);"><i
                                                    class="ti ti-chevrons-right ti-xs"></i></a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-tim" role="tabpanel">
                        <div class="row">
                            <div class="mt-2 d-flex justify-content-end">
                                <div id="buatTim" class="d-flex align-items-end">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#modalBuatTim">Buat
                                        Tim</button>
                                </div>
                            </div>
                            @foreach ($tims as $tim)
                                <div class="col-md-6 col-lg-3">
                                    <div class="card text-center mb-3" id="">
                                        <div class="card-body">
                                            <img src="{{ asset('assets/img/avatars/4.png') }}" alt="logo tim"
                                                class="rounded-circle mb-3" style="width: 100px; height: 100px">
                                            <p class="mb-0"><span
                                                    class="badge bg-label-warning mb-3">{{ $tim->status_tim }}</span></p>
                                            <h5 class="card-title">{{ $tim->nama }}</h5>
                                            <p class="card-text">{{ $tim->created_at->translatedFormat('l, j F Y') }}</p>
                                            <a id="" class="btn btn-primary btn-detail-tim" data-bs-toggle=""
                                                data-bs-target="#modal-detail-tim"
                                                data-status_tim="{{ $tim->status_tim }}"
                                                data-anggota_tim="{{ json_encode($tim->user) }}">Detail</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-end mt-2">
                                    <li class="page-item first">
                                        <a class="page-link" href="javascript:void(0);"><i
                                                class="ti ti-chevrons-left ti-xs"></i></a>
                                    </li>
                                    <li class="page-item prev">
                                        <a class="page-link" href="javascript:void(0);"><i
                                                class="ti ti-chevron-left ti-xs"></i></a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="javascript:void(0);">1</a>
                                    </li>
                                    <li class="page-item last">
                                        <a class="page-link" href="javascript:void(0);"><i
                                                class="ti ti-chevrons-right ti-xs"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>



            {{-- Modal buat detail pembuatan tim --}}
            <div class="modal fade" tabindex="-1" id="modal-detail-tim">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Modal Edit</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card-body" id="container-anggota-tim">
                                <h5 id="statustim">Anggota Tim</h5>
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0">
                                        <img src="{{ asset('assets/img/avatars/9.png') }}" style="border-radius: 5px;"
                                            alt="" class="me-3" height="38">
                                    </div>
                                    <div class="flex-grow-1 row" id="list-anggota-tim">
                                        <div class="col-7">
                                            <h6 class="mb-0"></h6>
                                            <small class="text-muted">Not Connected</small>
                                        </div>
                                        <div class="col-5 text-end mt-sm-0 mt-2">
                                            <button class="btn btn-label-secondary btn-icon"><i
                                                    class="ti ti-link ti-sm"></i></button>
                                            <button class="btn btn-label-danger btn-icon"><i
                                                    class="ti ti-delete ti-sm"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal buat detail pembuatan tim --}}



            {{-- Modal detail --}}
            <div class="modal fade" id="modalDetailProjek" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Detail tim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <div class="col-12">
                                    <div class="nav-align-top d-flex justify-between">
                                        <div class="nav nav-pills d-flex justify-content-between my-4" role="tablist">
                                            <div class="d-flex justify-content-between">
                                                <div class="nav-item" role="presentation">
                                                    <button type="button" class="nav-link active button-nav"
                                                        role="tab" data-bs-toggle="tab"
                                                        data-bs-target="#navs-pills-top-home"
                                                        aria-controls="navs-pills-top-home"
                                                        aria-selected="true">Project</button>
                                                </div>
                                                <div class="nav-item button-nav" role="presentation">
                                                    <button type="button" class="nav-link" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile"
                                                        aria-controls="navs-pills-top-profile" aria-selected="false"
                                                        tabindex="-1">Anggota</button>
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <button type="submit" class="btn btn-primary">Edit </button>
                                            </div>
                                        </div>
                                        <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                                            <div class="tab-pane fade active show" id="navs-pills-top-home"
                                                role="tabpanel">
                                                <div class="row">
                                                    <div class="col-lg-4 mb-4">
                                                        <div class="card">
                                                            <h5 class="card-header">Progres Tim</h5>
                                                            <div class="card-body">
                                                                <canvas id="project" class="chartjs mb-4"
                                                                    data-height="267"
                                                                    style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8">
                                                        {{-- card projects --}}
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <div
                                                                    class="d-flex flex-row align-items-center justify-content-between">
                                                                    <div class="fs-4 text-black">
                                                                        Projek
                                                                    </div>
                                                                    <div
                                                                        style="display: flex; flex-direction: column; justify-items: center; align-items: left;">

                                                                        <span>Tanggal Mulai : <span id="tglmulai"></span>
                                                                        </span>

                                                                        <span>Tenggat : <span id="deadline"></span></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr class="my-0">
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-lg-6">
                                                                        <div class="d-flex flex-row gap-3">
                                                                            <img id="logo-tim" src=""
                                                                                alt='logo tim' class="rounded-circle"
                                                                                style="width: 90px; height: 90px">
                                                                            <div
                                                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                                                <span class="d-block text-black fs-5"
                                                                                    id="nama-tim">nama tim</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-4">
                                                                            <div class="mb-3">Status : <span
                                                                                    class="badge bg-label-warning"
                                                                                    id="status"></span>
                                                                            </div>

                                                                            <div>Tema : <span
                                                                                    class="badge bg-label-warning"
                                                                                    id="tema"></span>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6">
                                                                        <div class="progres-bar">
                                                                            <div class="d-flex justify-content-between">
                                                                                <span>Hari</span>
                                                                                <span><span id="dayLeft"></span> dari
                                                                                    <span id="total"></span>
                                                                                    Hari</span>
                                                                            </div>
                                                                            <div
                                                                                class="d-flex flex-grow-1 align-items-center my-1">
                                                                                <div class="progress w-100 me-3"
                                                                                    style="height:8px;background-color: gainsboro">
                                                                                    <div class="progress-bar bg-primary"
                                                                                        role="progressbar"
                                                                                        style="width: 10%"
                                                                                        aria-valuenow="10"
                                                                                        aria-valuemin="0"
                                                                                        aria-valuemax="100">
                                                                                    </div>
                                                                                </div>
                                                                                <span class="text-muted"><span
                                                                                        id="textPercent"></span>%</span>
                                                                            </div>
                                                                            <div class="tenggat">
                                                                                <span>Tenggat kurang <span
                                                                                        id="dayleft"></span> hari
                                                                                    lagi</span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="link mt-2">
                                                                            <div class="title text-dark">
                                                                                Link Repository :
                                                                            </div>
                                                                            <a href="" id="repository"
                                                                                target="_blank"><span class="text-blue"
                                                                                    id="text-repo"></span></a>
                                                                        </div>
                                                                        <div class="deskripsi mt-2">
                                                                            <div class="title text-dark">
                                                                                Deskripsi :
                                                                            </div>
                                                                            <div class="isi" id="deskripsi">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- card projects --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                                <div class="container">
                                                    <div class="row">
                                                        <div
                                                            class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                                                            <div
                                                                class="card-body d-flex flex-column align-items-center justify-content-center">
                                                                <img id="logo-tim2" width="90px" height="90px"
                                                                    class="rounded-circle" src="" alt="">
                                                                <h1 id="nama-tim2" class="mt-2"></h1>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2 justify-content-center align-items-center grid"
                                                        id="anggota-list-Projek">
                                                        {{-- Anggota --}}
                                                        {{-- Anggota --}}
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
            </div>
            {{-- Modal detail --}}

            {{-- Modal Buat Tim --}}
            <form action="" id="createForm" method="post">
                @csrf
                <div class="modal fade" id="modalBuatTim" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">Buat Tim</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="status_tim" class="form-label">Kategori</label>
                                        <select id="status_tim" onchange="run()" name="status_tim"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option value="" disabled selected>Pilih Tim</option>
                                            @foreach ($status_tim as $status)
                                                <option class="text-capitalize" value="{{ $status->id }}">
                                                    {{ $status->status }}</option>
                                            @endforeach
                                        </select>
                                        @error('status_tim')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="kelompok_ketua" style="display: block">
                                    <div class="col mb-3">
                                        <label for="ketuaKelompok" class="form-label">Ketua Kelompok</label>
                                        <select id="ketuaKelompok" name="ketuaKelompok"
                                            class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                            <option value="" disabled selected>Pilih Kelompok</option>
                                        </select>
                                        @error('ketuaKelompok')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row" id="project_ketua" style="display: block">
                                    {{-- <div class="col mb-3">
                                    <label for="KetuaProject" class="form-label">Ketua Projek</label>
                                    <select id="KetuaProject" name="ketuaProjek"
                                        class="select2 form-select form-select-lg selecto" data-allow-clear="true">
                                        <option value="" disabled selected>Pilih Projek</option>
                                    </select>
                                </div> --}}
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="anggota" class="form-label">Anggota</label>
                                        <select id="anggota" name="anggota[]" class="select2 form-select selecto"
                                            multiple>
                                        </select>
                                        @error('anggota')
                                            <p class="text-danger">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-label-secondary"
                                    data-bs-dismiss="modal">Kembali</button>
                                <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            {{-- Modal Buat Tim --}}

            {{-- java script --}}
            {{-- filter projek --}}
            <script>
                function filterProjek(selectElement) {
                    var code = selectElement.value;
                    var projekElements = document.getElementsByClassName('projek-item');

                    for (var i = 0; i < projekElements.length; i++) {
                        var projekElement = projekElements[i];
                        var statusTim = projekElement.getAttribute('data-status-tim');

                        if (code === 'all' || code === statusTim) {
                            projekElement.style.display = 'block';
                        } else {
                            projekElement.style.display = 'none';
                        }
                    }
                }
            </script>
            {{-- filter Projek --}}


            {{-- js detail buat tim --}}
            <script>
                $(document).ready(function() {
                    $('.btn-detail-tim').click(function() {
                        const status = $(this).data('status_tim');
                        const nama = $(this).data('nama');
                        const anggotaTim = $(this).data('anggota_tim');
                        console.log(anggotaTim);

                        const container = $("#container-anggota-tim");

                        const h5 = $("<h5>").attr("id", "statustim").text("Anggota Tim");
                        container.append(h5);

                        $.each(anggotaTim, function(index, anggota) {
                            const div = $("<div>").addClass("d-flex mb-3");

                            const imgDiv = $("<div>").addClass("flex-shrink-0");
                            const img = $("<img>").attr("src", anggota.avatar ? anggota.avatar :
                                    "{{ asset('assets/img/avatars/9.png') }}")
                                .css("border-radius", "5px").addClass("me-3").attr("alt", "").attr("height",
                                    "38");
                            imgDiv.append(img);
                            div.append(imgDiv);

                            const listAnggotaTimDiv = $("<div>").addClass("flex-grow-1 row").attr("id",
                                "list-anggota-tim");
                            const col7Div = $("<div>").addClass("col-7");
                            const h6 = $("<h6>").addClass("mb-0").text(anggota.username);
                            const small = $("<small>").addClass("text-muted").text("Not Connected");
                            col7Div.append(h6);
                            col7Div.append(small);
                            listAnggotaTimDiv.append(col7Div);
                            div.append(listAnggotaTimDiv);

                            const col5Div = $("<div>").addClass("col-5 text-end mt-sm-0 mt-2");
                            const button1 = $("<button>").addClass("btn btn-label-secondary btn-icon");
                            const i1 = $("<i>").addClass("ti ti-link ti-sm");
                            button1.append(i1);
                            const button2 = $("<button>").addClass("btn btn-label-danger btn-icon");
                            const i2 = $("<i>").addClass("ti ti-delete ti-sm");
                            button2.append(i2);
                            col5Div.append(button1);
                            col5Div.append(button2);
                            div.append(col5Div);

                            container.append(div);
                        });

                        $('#modal-detail-tim').modal('show');
                    });
                });
            </script>

            {{-- js detail buat tim --}}

            {{-- js  --}}
            <script>
                $(document).ready(function() {
                    $('.btn-detail-projek').click(function() {
                        var logo = $(this).data('logo');
                        var namatim = $(this).data('namatim');
                        var status = $(this).data('status');
                        var tema = $(this).data('tema');
                        var tglmulai = $(this).data('tglmulai');
                        var deadline = $(this).data('deadline');
                        var anggota = $(this).data('anggota');
                        var deskripsi = $(this).data('deskripsi');
                        var dayLeft = $(this).data('dayleft');
                        var repo = $(this).data('repo');
                        var total = $(this).data('total-deadline');
                        var progress = $(this).data('progress');
                        var progressFormat = Math.round(progress);

                        $('#logo-tim').attr('src', logo);
                        $('#logo-tim2').attr('src', logo);
                        $('#nama-tim').text(namatim);
                        $('#nama-tim2').text(namatim);
                        $('#status').text(status);
                        $('#tema').text(tema);
                        $('#tglmulai').text(tglmulai);
                        $('#deadline').text(deadline);
                        $('#dayLeft').text(dayLeft);
                        $('#dayleft').text(dayLeft);
                        $('#total').text(total);
                        $('#text-repo').text(repo);
                        $('#repository').attr('href', repo);
                        $('#textPercent').text(progressFormat);
                        $('.progress-bar').css('width', progressFormat + '%');
                        $('.progress-bar').attr('aria-valuenow', progressFormat);
                        if (deskripsi) {
                            $('#deskripsi').text(deskripsi);
                        } else {
                            $('#deskripsi').html(
                                '<div class="alert alert-warning d-flex align-items-center mt-3 cursor-pointer" role="alert">' +
                                '<span class="alert-icon text-warning me-2">' +
                                '<i class="ti ti-bell ti-xs"></i>' +
                                '</span>' +
                                'Tim ini belum memiliki deskripsi tema!' +
                                '</div>'
                            );
                        }
                        var anggotaList = $('#anggota-list-Projek');

                        anggotaList.empty();

                        anggota.forEach(function(anggota, index) {
                            var avatarSrc = anggota.avatar ? '/storage/' + anggota.avatar :
                                '/assets/img/avatars/1.png';

                            var anggotaItem = $('<div class="col-lg-4 p-2" style="box-shadow: none">' +
                                '<div class="card">' +
                                '<div class="card-body d-flex gap-3 align-items-center">' +
                                '<div>' +
                                '<img width="30px" height="30px" class="rounded-circle object-cover" src="' +
                                avatarSrc + '" alt="foto user">' +
                                '</div>' +
                                '<div>' +
                                '<h5 class="mb-0" style="font-size: 15px">' + anggota.name + '</h5>' +
                                '<span class="badge bg-label-warning">' + anggota.jabatan + '</span>' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>');
                            anggotaList.append(anggotaItem);
                        });

                        $('#modalDetailProjek').modal('show');

                    });
                });
            </script>
            {{-- js  --}}

            {{-- js select --}}
            <script>
                function run() {
                    const status = document.getElementById('status_tim').value;
                    let project_ketua = document.getElementById('project_ketua');

                    if (status == 2) {
                        project_ketua.style = 'display: none';
                    } else {
                        project_ketua.style = 'display: block';
                    }
                }
            </script>
            {{-- js select --}}

            {{-- ajax buat tim --}}
            <script>
                get()

                function get() {
                    $.ajax({
                        url: "{{ route('Project') }}",
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('#KetuaProject').html('')
                            $('#ketuaKelompok').html('')
                            $('#anggota').html('')
                            $("#KetuaProject").append("<option disabled selected>Pilih Data</option>");
                            $("#ketuaKelompok").append("<option disabled selected>Pilih Data</option>");

                            $.each(data.users, function(index, users) {
                                $("#anggota").append("<option value=" + users.id + ">" + users.username +
                                    "</option>");
                                $("#KetuaProject").append("<option value=" + users.id + ">" + users.username +
                                    "</option>");
                                $("#ketuaKelompok").append("<option value=" + users.id + ">" + users.username +
                                    "</option>");
                            });
                        },
                        error: function(xhr, status, error) {
                            console.error("Terjasi kesalahan : " + error);
                        }
                    });
                }
                $(document).ready(function() {
                    var isCreatingTim = false;
                    // Fungsi untuk menangani pembuatan tim menggunakan AJAX
                    function createTim() {
                        // Mendapatkan data formulir
                        $('#createButton').prop('disabled', true);

                        // Set variabel isCreatingTim menjadi true
                        $('#loader').show();
                        isCreatingTim = true;
                        var formData = new FormData($('#createForm')[0]);
                        // Menggunakan AJAX untuk mengirim data ke server
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('pembuatan.tim') }}',
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                // Tanggapan dari server, bisa ditangani sesuai kebutuhan
                                get();
                                isCreatingTim = false;
                                // Aktifkan kembali button create
                                $('#createButton').prop('disabled', false);
                                // Tutup modal
                                $('#status_tim').val('');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Sukses',
                                    text: 'Data Berhasil Ditambahkan',
                                });
                                $('#ketuaKelompok, #status_tim, #anggota').val(null).trigger('change');
                                $('#modalBuatTim').modal('hide');
                                get();
                                $('#loader').fadeOut();
                            },
                            error: function(error) {
                                $('#modalBuatTim').modal('hide');
                                // Tanggapan error dari server
                                console.log(error);
                                var errorMessage = 'Pastikan data terisi semua.';
                                if (error.responseJSON && error.responseJSON.message) {
                                    errorMessage = error.responseJSON.message;
                                } else if (error.responseJSON && error.responseJSON.errors && error.responseJSON
                                    .errors.anggota) {
                                    errorMessage = 'Data sudah digunakan di opsi lain.';
                                }
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Peringatan',
                                    text: errorMessage,
                                });
                                $('#loader').fadeOut();
                                isCreatingTim = false;

                                // Aktifkan kembali button create
                                $('#createButton').prop('disabled', false);
                            }
                        });
                    }

                    // Menangani submit formulir menggunakan AJAX
                    $('#createForm').submit(function(e) {
                        e.preventDefault(); // Mencegah formulir melakukan submit bawaan
                        createTim(); // Panggil fungsi untuk membuat tim menggunakan AJAX
                    });
                });
            </script>
            {{-- ajax buat tim --}}
            {{-- penutup java script --}}


            {{-- script pengajuan projek --}}
            {{-- Modal Terima --}}
            <div class="modal fade" id="modalTerimaPengajuan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Terima Pengajuan Projek</h5>
                            <button type="button" class="btn-close" data-bs-toggle="modal"
                                data-bs-target="#modalDetailPengajuan" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST" id="terima-project">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="tema" class="form-label">Tema Projek</label>
                                        <select id="temaPengajuan" name="temaInput"
                                            class="select2 form-select form-select-lg" data-allow-clear="true">
                                            <option disabled selected>Pilih Data</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mb-3">
                                        <label for="flatpickr-date" class="form-label">Tentukan Deadline</label>
                                        <div class="alert alert-warning d-flex align-items-center cursor-pointer"
                                            role="alert">
                                            <span class="alert-icon text-warning me-2">
                                                <i class="ti ti-bell ti-xs"></i>
                                            </span>
                                            Jika tidak di isi maka deadline akan menyesuaikan status tim (Jika di isi,
                                            deadline
                                            harus
                                            1 minggu dari sekarang)
                                        </div>
                                        <input type="text" class="form-control" placeholder="YYYY-MM-DD"
                                            name="deadlineInput" id="deadline" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary" data-bs-toggle="modal"
                                        data-bs-target="#modalDetailPengajuan">Kembali</button>
                                    <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal terima --}}

            {{-- Modal Detail --}}
            <div class="modal fade" id="modalDetailPengajuan" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Detail tim</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid mt-4">
                                <h5 class="header">Detail Pengajuan Projek</h5>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="content-profile d-flex flex-wrap flex-row justify-content-between">
                                            <div class="d-flex flex-row gap-3 justify-content-center">
                                                <img src="" id="logo-tim" alt="logo tim"
                                                    style="width: 100px; height: 100px" class="rounded-circle mb-3">
                                                <div
                                                    style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                    <span class="d-block text-black fs-4 mb-2" id="nama-tim"></span>
                                                    <span class="badge bg-label-warning" id="type-project"></span>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-wrap"
                                                style="display: flex; flex-direction: column; justify-items: center; align-items: center; padding: 30px 5px">
                                                <span class="d-block text-black fs-5">Tanggal Pengajuan</span>
                                                <span class="d-block" style="font-size: 13px" id="created-at"></span>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <div style="display: flex; align-content: center; align-items: center;">
                                                <span class="text-black fs-5">Anggota Tim : </span>
                                            </div>
                                            <div>
                                                <button type="button" id="btn-terima" data-bs-toggle="modal"
                                                    data-bs-target="#modalTerimaPengajuan" class="btn btn-success"
                                                    data-tema="">Terima</button>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex flex-row flex-wrap mt-3 justify-content-center align-content-center gap-3">
                                            <!-- Anggota Tim -->
                                            <div class="content-1 col-md-3 col-xl-3 col-sm-12 mb-4">
                                                <div class="card h-100">
                                                    <div class="table-responsive">
                                                        <table class="table table-borderless">
                                                            <tbody id="anggota-list">
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--/ Anggota Tim -->

                                            {{-- List Tema --}}
                                            <div class="content-1 col-md-8 col-xl-8 col-sm-12 mb-4">
                                                <div class="card h-100">
                                                    <h5 class="card-header">List Tema Projek</h5>
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>No.</th>
                                                                    <th>Tema</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tema-list">
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
            </div>
            {{-- Modal Detail --}}


            {{-- script modal detail --}}
            <script>
                $(document).ready(function() {
                    $('.btn-detail').click(function() {
                        var namaTim = $(this).data('nama-tim');
                        var typeProject = $(this).data('type-project');
                        var logo = $(this).data('logo');
                        var createdAt = $(this).data('created-at');
                        var anggota = $(this).data('anggota');
                        var tema = $(this).data('tema');
                        var temaHtml = JSON.stringify(tema);

                        $('#btn-terima').attr('data-tema', temaHtml);
                        $('#nama-tim').text(namaTim);
                        $('#type-project').text(typeProject);
                        $('#created-at').text(createdAt);
                        $('#logo-tim').attr('src', logo);

                        var anggotaList = $('#anggota-list');
                        anggotaList.empty();

                        anggota.forEach(function(anggota, index) {
                            var avatarSrc = anggota.avatar ? '/storage/' + anggota.avatar :
                                '/assets/img/avatars/1.png';

                            var anggotaItem = $(
                                '<tr>' +
                                '<td>' +
                                '<div class="d-flex align-items-center mt-lg-3">' +
                                '<div class="avatar me-3 avatar-sm">' +
                                '<img src="' + avatarSrc +
                                '" alt="Avatar" class="h-auto rounded-circle" />' +
                                '</div>' +
                                '<div class="d-flex flex-column">' +
                                '<h6 class="mb-0">' + anggota.username + '</h6>' +
                                '<small class="text-truncate text-muted">' + anggota.jabatan +
                                '</small>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '</tr>'
                            );

                            anggotaList.append(anggotaItem);
                        });

                        var temaList = $('#tema-list');
                        temaList.empty();

                        tema.forEach(function(tema, index) {
                            var temaItem = $(
                                '<tr>' +
                                '<td>' + (index + 1) + '.' + '</td>' +
                                '<td>' + tema.nama_tema + '</td>' +
                                '</tr>'
                            );
                            temaList.append(temaItem);
                        });
                    });

                    $('#btn-terima').click(function() {
                        var tema = $(this).data('tema');
                        var temaList = $('#temaPengajuan');
                        console.log(tema);
                        console.log(temaList);
                        temaList.empty();
                        tema.forEach(function(tema, index) {
                            temaList.append("<option data-url=" + tema.tema_code + " value=" + tema
                                .tema_id + ">" + tema.nama_tema +
                                "</option>");
                        });

                        temaList.on('change', function() {
                            var selectedTema = $(this).find(':selected').data('url');
                            var formAction =
                                "{{ route('persetujuan-project', ['code' => ':temaId']) }}";
                            formAction = formAction.replace(':temaId', selectedTema);
                            $('#terima-project').attr('action', formAction);
                        });

                    });

                    const oneWeekFromToday = new Date();
                    oneWeekFromToday.setDate(oneWeekFromToday.getDate() + 7);

                    flatpickr("#deadline", {
                        minDate: oneWeekFromToday,
                        dateFormat: "Y-m-d",
                    });

                });
            </script>
            {{-- script modal detail --}}

            {{-- Validasi --}}
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const ajukanModal = document.getElementById('terima-project');

                    ajukanModal.addEventListener('submit', function(event) {
                        const temaInput = document.querySelector('select[name="temaInput"]');
                        const deadlineInput = document.querySelector('input[name="deadlineInput"]');

                        // Validasi input kosong
                        if (temaInput.value.trim() === '') {
                            event.preventDefault(); // Mencegah pengiriman formulir
                            Swal.fire({
                                icon: 'warning',
                                title: 'Peringatan',
                                text: 'Inputkan Tema Project!',
                            });
                            return;
                        }
                    });
                });
            </script>
            {{-- Validasi --}}
            {{-- script pengajuan projek --}}
        </div>
    @endsection

    @section('script')
        <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    @endsection
