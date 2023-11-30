@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />


    <style>
        @media screen and (max-width:768px){
            .nav-item{
                font-size : 10px;
            }
        }

    </style>

@endsection

@section('content')
    {{-- modal --}}

    <div class="modal fade" id="aturUrutan" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">Atur urutan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col" data-select2-id="45">
                            <label for="select2Basic" class="form-label">Atur Urutan</label>
                            <div class="position-relative" data-select2-id="44">
                                <select id="select2Basic"
                                    class="select2 form-select form-select-lg select2-accessible"
                                    data-allow-clear="false" data-select2-id="select2Basic" tabindex="-1"
                                    aria-hidden="false" name="urutan" data-bs-code="">
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#detailPresentasi"
                        class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button"  onclick="kirimProsesGantiUrutan()" data-bs-toggle="modal" data-bs-target="#detailPresentasi"
                        class="btn btn-primary waves-effect waves-light">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail presentasi tim --}}
    <div class="modal fade" id="detailTim" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel3">History Presentasi Tim</h5>
              <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#detailPresentasi" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <h6 style="font-size: 15px;">Statistik Tim</h6>
                        <div class="row gap-2 mt-2">
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                      <div class="card-title mb-0">
                                        <h5 id="persentasiRevisiSelesai" class="mb-0 me-2"></h5>
                                        <small>Keberhasilan dalam mengerjakan revisi</small>
                                      </div>
                                      <div class="card-icon">
                                        <span class="badge bg-label-primary rounded-pill p-2">
                                          <i class="ti ti-cpu ti-sm"></i>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12">
                                <div class="card h-100">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                      <div class="card-title mb-0">
                                        <h5 class="mb-0 me-2" id="historyTotalPresentasi">3</h5>
                                        <small>Total Presentasi</small>
                                      </div>
                                      <div class="card-icon">
                                        <span class="badge bg-label-success rounded-pill p-2">
                                          <i class="ti ti-server ti-sm"></i>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-12">
                                    <div class="card h-100">
                                      <div class="card-body d-flex justify-content-between align-items-center">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="rounded-circle" style="width:50px; height:50px;" src="{{ asset('assets/img/avatars/10.png') }}" alt="">
                                            </div>
                                            <div class="col-8">
                                                <p class="m-0 text-secondary" id="history-ketua-tim"></p>
                                                <span class="badge bg-label-primary">Ketua Tim</span>
                                            </div>
                                        </div>
                                      </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 mt-5  mt-lg-0">
                        <h6 style="font-size: 15px;" >History Presentasi</h6>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="demo-inline-spacing mt-3">
                                  <div id="list-group" class="list-group">

                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary waves-effect" data-bs-toggle="modal" data-bs-target="#detailPresentasi">Close</button>
            </div>
          </div>
        </div>
      </div>
    {{-- modal detail presentasi tim --}}


    {{-- Modal Selesai Project --}}

    <div class="modal fade" id="Finish" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="selesaiPresentasiForm" method="post">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selesai Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">

                            <div class="col">
                                <span>Status Revisi</span> <br><br>
                                <input type="radio" value="selesai" name="status_revisi" id="selesai">
                                <label for="selesai">Selesai</label>
                                <input type="radio" value="tidak_selesai" name="status_revisi" id="tidak">
                                <label for="tidak">Tidak selesai</label>

                                <br>
                                <br>
                                <br>

                                <label for="feedback" class="mb-3">Feedback <span
                                        class="badge bg-label-warning">opsional</span> </label>
                                <textarea type="text" class="form-control" id="feedback" placeholder="Beri Feedback Presentasi"
                                    style="height: 150px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Kembali</button>
                        <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Selesai Project --}}

    {{-- Modal Tolak Presentasi --}}

    <div class="modal fade" id="Reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="tolakPresentasiForm" method="post">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="mt-1">Alasan</label>
                        <textarea id="alasan" type="text" name="alasan" class="form-control" placeholder="Beri alasan penolakan"
                            style="height: 150px; resize: none"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Close</button>
                        <button type="setuju" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#detailPresentasi">Setuju</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Modal Tolak Presentasi --}}


    <div class="modal fade" id="detailPresentasi" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container mt-3 p-md-4 p-0">
                        <h5 id="judulModal"></h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header p-md-4 px-0">
                                        <div class="nav-align-top d-flex justify-between">
                                            <div class="nav nav-pills d-flex justify-content-between row" role="tablist">
                                                <div class="nav-item col-lg-3 col-md-3" role="presentation">
                                                    <button type="button" class="nav-link active" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#navs-pills-top-home"
                                                        aria-controls="navs-pills-top-home" data-bs-toggle="popover"
                                                        data-bs-placement="top" data-bs-original-title="Tooltip Text"
                                                        aria-selected="true"><i
                                                            class="ti ti-news me-2"></i>Pengajuan</button>
                                                </div>
                                                <div class="nav-item col-lg-3 col-md-3" role="presentation">
                                                    <button type="button" class="nav-link" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile"
                                                        aria-controls="navs-pills-top-profile" aria-selected="false"
                                                        tabindex="-1"><i
                                                            class="ti ti-presentation-analytics me-2"></i>Presentasi</button>
                                                </div>
                                                <div class="nav-item col-lg-3 col-md-3" role="presentation">
                                                    <button type="button" class="nav-link" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#navs-pills-top-baru"
                                                        aria-controls="navs-pills-top-profile" aria-selected="false"
                                                        tabindex="-1"><i
                                                            class="ti ti-adjustments-horizontal me-2"></i>Belum
                                                        Presentasi</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                                <div class="">
                                    <div class="">
                                        <div class=" text-nowrap">
                                            <div class="container">
                                                <div class="row d-md-block d-none">
                                                    <div class="alert alert-secondary alert-dismissible d-flex align-items-baseline" role="alert">
                                                        <span class="alert-icon alert-icon-lg text-secondary me-2">
                                                          <i class="ti ti-bookmark ti-sm"></i>
                                                        </span>
                                                        <div class="d-flex flex-column ps-1">
                                                          <h5 class="alert-heading mb-2">Tab Pengajuan Presentasi</h5>
                                                          <p class="mb-0">Tab pengajuan presentasi berisi data data pengajuan presentasi dari siswa magang</p>
                                                          </button>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="row" id="row-persetujuan">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                <div class="container">
                                    <div class="row mb-3 d-md-block d-none">
                                        <div class="alert alert-secondary alert-dismissible d-flex align-items-baseline" role="alert">
                                            <span class="alert-icon alert-icon-lg text-secondary me-2">
                                              <i class="ti ti-bookmark ti-sm"></i>
                                            </span>
                                            <div class="d-flex flex-column ps-1">
                                              <h5 class="alert-heading mb-2">Tab Presentasi</h5>
                                              <p class="mb-0">Tab presentasi berisi data data presentasi yang sudah dikonfirmasi. Tab presentasi juga berisi data data tentang tim yang mengajukan presentasi, kamu dapat menghover kearah icon untuk mengetahui penjelasan data tersebut</p>
                                              </button>
                                            </div>
                                          </div>
                                    </div>
                                </div>
                                <div class="row" id="row-konfirmasi">


                                </div>
                            </div>
                            <div class="tab-pane fade" id="navs-pills-top-baru" role="tabpanel">
                                <div class="container">
                                    <div class="row mb-3 d-md-block d-none">
                                        <div class="alert alert-secondary alert-dismissible d-flex align-items-baseline" role="alert">
                                            <div class="col-auto">
                                                <span class="alert-icon alert-icon-lg text-secondary me-2">
                                                    <i class="ti ti-bookmark ti-sm"></i>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="d-flex flex-column ps-1">
                                                    <h5 class="alert-heading mb-2">Tab Belum Presentasi</h5>
                                                    <p class="mb-0">Tab Belum presentasi berisi data data tim dalam seminggu yang belum mengajukan presentasi</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card overflow-auto">
                                    <div class="card-header ">
                                        <div class="table text-nowrap">
                                            <table id="jstabel3" class="table">
                                                <div class="">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Kategori Project</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    <tbody id="tr-belum-presentasi">

                                                    </tbody>
                                                </div>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                    <button type="button" data-bs-dismiss="modal" class="btn btn-danger waves-effect position-absolute rounded-circle" style="top: -10px; right: -10px; width:40px; height:40px;">X</button>

            </div>
        </div>
    </div>

    {{-- modal --}}


    <div class="container mt-3">
        <h2 class="fs-4 mt-3">Presentasi</h2>
        <div class="row">
            @forelse ($historyPresentasi as $history)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-black">

                            <img width="300" height="auto" class="img-fluid"
                                src="{{ asset('assets/img/presentasi.png') }}" alt="">
                            <div class="d-flex justify-content-around align-items-center">
                                <span class="badge bg-label-info">Minggu ke-{{ $history->noMinggu }}</span>
                                <span class="badge bg-label-primary">{{ $history->bulan }}</span>
                            </div>
                            <div class="d-flex justify-content-around align-items-center gap-3  mt-3">
                                <button onclick="tampilkanDetail('{{ $history->code }}')" data-bs-toggle="modal"
                                    data-bs-target="#detailPresentasi" class="btn btn-primary w-100">Detail</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
            <div class="container">
                <img style="width: 40%;" class="d-block mx-auto" src="{{ asset('assets/img/no-data-presentasi.png') }}" alt="">
                <h3 style="margin-top: -20px;" class="text-center text-primary">Belum ada History Presentasi</h3>
            </div>

            @endforelse
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script src="{{ asset('assets/js/forms-editors.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/js/forms-tagify.js') }}"></script>
    <script src="{{ asset('assets/js/forms-typeahead.js') }}"></script>
    <script src="{{ asset('utils/Kategory.js') }}" ></script>
    <script src="{{ asset('utils/handleFormatDate.js') }}"></script>
    <script>

function tampilkanDetail(code)
        {
            axios.post('tampil-detail-presentasi/' + code)
                .then((res) => {
                    let data1 = res.data.presentasi;
                    let data2 = res.data.konfirmasi;
                    let data3 = res.data.belum_presentasi;
                    let codeHistory =  res.data.codeHistory

                    $('#judulModal').text(`Presentasi / ${res.data.judulModal}`)

                    document.getElementById('row-persetujuan').innerHTML = ''

                    if( data1.length === 0 )
                    {

                        let div = document.createElement('div')
                        div.className = "container"
                        div.id = "notFound-1"
                        let children =
                        `
                        <div class="row" style="height:50vh;">
                            <div class ="col-12 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{ asset('assets/img/illustrations/noData.png') }}" width="200" />
                                <h3>Sedang Tidak ada Pengajuan</h3>
                            </div>
                        </div>
                        `
                        div.innerHTML = children;

                        document.getElementById('row-persetujuan').appendChild(div);

                    } else {

                        Object.keys(data1).forEach((key) => {
                        let presentasi = data1[key]
                        console.log(presentasi.jadwal);
                        const jadwal = formatDate(presentasi.jadwal)

                        let div = document.createElement('div')
                        div.id = "card-persetujuan-" + presentasi.code;
                        div.className = "col-md-6 col-lg-4";
                        let childrend =
                            `
                   <div class="card text-center mb-3">
                        <div class="card-body">
                            <img src="{{ asset('storage/${presentasi.tim.logo}') }}" alt="logo tim" class="rounded-circle mb-3 border-primary border-2" style="width: 150px; height: 150px; object-fit: cover; ">
                            <div class="d-flex justify-content-center align-items-center gap-2 flex-column">
                                <h4 class="card-title text-capitalize">${presentasi.tim.nama}</h4>
                                <a href="#"><span class="badge bg-label-warning mb-3">${presentasi.tim.status_tim}</span></a>
                            </div>
                            <p class="card-text">${jadwal}</p>

                            <div class="d-flex justify-content-center gap-2">
                                <button onclick="tolakPresentasi('${presentasi.code}','${code}')" data-bs-toggle="modal" data-bs-target="#Reject" class="px-3 py-1 btn btn-danger" >Tolak</button>
                                <button onclick="setujuiPresentasi('${presentasi.code}','${code}')" class="px-3 py-1 btn btn-success" >Setujui</button>
                            </div>
                        </div>
                    </div>
                `

                        div.innerHTML = childrend;
                        document.getElementById('row-persetujuan').appendChild(div);
                    });

                    }

                    console.log(data2)
                    document.getElementById('row-konfirmasi').innerHTML = ''
                    if( data2[0].length == 0 ){

                        let div = document.createElement('div')
                        div.className = "container"
                        div.id = "notFound-2"
                        let children =
                        `
                        <div class="row" style="height:50vh;">
                            <div class ="col-12 d-flex flex-column justify-content-center align-items-center ">
                                <img src="{{ asset('assets/img/illustrations/noData2.png') }}" width="200" />
                                <h3>Sedang Tidak ada presentasi</h3>
                            </div>
                        </div>
                        `
                        div.innerHTML = children;

                        document.getElementById('row-konfirmasi').appendChild(div);


                    }else{



                    document.getElementById('row-konfirmasi').innerHTML = "";
                    Object.keys(data2[0]).forEach((key) => {
                        let presentasi = data2[0][key]
                        let presentasi_date = data2[1][key]
                        let totalPresentasi = data2[2][key]
                        let presentasiDitolak = data2[3][key]
                        let revisiSelesai = data2[4][key]
                        let revisiTidakSelesai = data2[5][key]
                        let deadline = data2[6][key]
                        let dataPresentasiTim = data2[7][key]

                        let kategoryTim;
                        if(presentasi.tim.status_tim === "solo"){
                            kategoryTim = "Solo Project"
                        }
                        if(presentasi.tim.status_tim === "pre_mini"){
                            kategoryTim = "Pre Mini Project"
                        }
                        if(presentasi.tim.status_tim === "mini"){
                            kategoryTim = "Mini Project"
                        }
                        if(presentasi.tim.status_tim === "big"){
                            kategoryTim = "Big Project"
                        }

                        let div = document.createElement('div')
                        div.id = "card-konfirmasi-" + presentasi.code;
                        div.className = "col-md-6 col-lg-3";

                        let childrend =
                            `
                    <div class="card text-center mb-3">
                            <div class="card-body">
                                <div style="width: 30px; height: 30px; top: -10px;left : -10px;" class="rounded bg-primary d-flex justify-content-center align-items-center text-white position-absolute">
                                    ${presentasi.urutan}
                                </div>
                                <img src="{{ asset('storage/${presentasi.tim.logo}') }}" alt="logo tim" class="rounded-circle mb-3 border-primary border-2" style="width: 100px; height: 100px; object-fit: cover; ">
                                <div class="d-flex justify-content-center align-items-center gap-2 flex-column flex-wrap">
                                    <h4 class="card-title text-capitalize text-secondary mb-0">${presentasi.tim.nama}</h4>
                                    <div class="d-flex flex-column gap-2">
                                    <span class="badge bg-label-warning d-flex align-items-center justify-content-center flex-column" style="" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-success" data-bs-placement="top" title="Status Tim"    >${kategoryTim}</span>

                                    </div>
                                    <div class="d-flex justify-content-around align-items-center w-100 mb-2 gap-2">
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="tooltip-success" data-bs-placement="top" title="Data pengajuan presentasi yang selesai"    class="badge bg-label-success">
                                            <i class="fas fa-chalkboard"></i>
                                            ${totalPresentasi}
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="tooltip-success" data-bs-placement="top" title="Data pengajuan presentasi yang ditolak"    class="badge bg-label-danger">
                                            <i class="fas fa-chalkboard"></i>
                                            ${presentasiDitolak}
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="tooltip-success" data-bs-placement="top" title="Data Revisi yang selesai"      class="badge bg-label-success">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            ${revisiSelesai}
                                        </span>
                                        <span data-bs-toggle="tooltip" data-bs-custom-class="tooltip-success" data-bs-placement="top" title="Data Revisi yang tidak selesai"   class="badge bg-label-danger ">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            ${revisiTidakSelesai}
                                        </span>
                                    </div>

                                </div>

                                <div class="d-flex justify-content-center gap-2 align-items-center">
                                        <button onclick="tampilDetailTim('${presentasi.tim.code}','${codeHistory}')"  data-bs-toggle="modal" data-bs-target="#detailTim" class="btn btn-outline-warning d-flex justify-content-center align-items-center p-3 btn-detail-tim" style="font-size:15px; width:20px;height:20px;">
                                            <i class="fas fa-info-circle"></i>
                                        </button>
                                        <button class="border-0 bg-transparent text-white bg-primary p-3 d-flex justify-content-center align-items-center rounded" style="font-size:20px;width:20px;height:20px;" onclick="aturUrutan('${presentasi.code}','${codeHistory}')" data-bs-toggle="modal" id="btnUrutan" data-bs-target="#aturUrutan" >
                                            <i class="fas fa-list-ol"></i>
                                        </button>
                                        <button class="btn btn-success" onclick="sudahPresentasi('${presentasi.code}','${codeHistory}')"  data-bs-toggle="modal" data-bs-target="#Finish" >Konfirmasi</button>
                                </div>
                            </div>
                    </div>
                    `

                        div.innerHTML = childrend
                        document.getElementById('row-konfirmasi').appendChild(div)
                    })
                    }



                    if ($.fn.DataTable.isDataTable('#jstabel3')) {
                        $("#jstabel3").DataTable().destroy();
                     }

                    document.getElementById('tr-belum-presentasi').innerHTML = ""
                    Object.keys(data3).forEach((keys, i) => {
                        let presentasi = data3[keys].tim;
                        let tr = document.createElement('tr');
                        let child;
                        let cell1 = document.createElement('td');
                        cell1.textContent = i + 1;

                        let cell3 = document.createElement('td');
                        cell3.textContent = presentasi.status_tim;

                        let cell5 = document.createElement('td');
                        cell5.innerHTML = `<span class="badge bg-label-warning">Belum Presentasi</span>`;


                        let defaultImg = "assets/img/avatars/1.png";
                        let avatarUser =  (presentasi.user[0].avatar === null)  ?   defaultImg : "storage/"+presentasi.user[0].avatar
                        if (presentasi.status_tim === "solo") {
                            let cell2 = document.createElement('td');
                            cell2.innerHTML = `<img src="{{ asset('${ avatarUser }') }}" alt=""
                          style="border-radius: 50%; width:40px; height:40px;object-fit:cover;"> ${presentasi.user[0].username}`;
                            tr.appendChild(cell1);
                            tr.appendChild(cell2);
                            tr.appendChild(cell3);
                            tr.appendChild(cell5);
                        } else {
                            let cell2 = document.createElement('td');
                            cell2.innerHTML = `<img src="{{ asset('storage/${presentasi.logo}') }}" alt=""
                          style="border-radius: 50%; width:40px; height:40px;object-fit:cover;"> ${presentasi.nama}`;
                            tr.appendChild(cell1);
                            tr.appendChild(cell2);
                            tr.appendChild(cell3);
                            tr.appendChild(cell5);
                        }

                        document.getElementById('tr-belum-presentasi').appendChild(tr);
                    });

                    $('#jstabel3').DataTable({
                        responsive:true,
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




                })
                .catch((err) => {
                    console.log(err);
                })
        }

        const tampilDetailTim = (codeTim,codeHistory) =>{
            document.getElementById('list-group').innerHTML=""
            axios.get('ambil-detail-history-presentasi/'+codeHistory+'/'+codeTim )
            .then((res) => {
                const history = res.data.history;
                const tim = res.data.tim;
                const presentasi = res.data.presentasi;
                const presentaseRevisi = res.data.presentaseRevisi;

                $('#persentasiRevisiSelesai').text(`${(presentaseRevisi).toFixed(2)}%`)
                $('#historyTotalPresentasi').text(`${presentasi[0].length}`)
                $('#history-ketua-tim').text(`${tim.ketua_tim[0].username}`)

                const kosong = (presentasi[0].length === 0 ? true : false);
                console.log(kosong);
                presentasi[0].forEach((data,i) => {

                    let waktu = presentasi[1][i]
                    const div = document.createElement('div')
                    let children;


                    if (kosong) {
                            children = `
                                <h1>Belum pernah presentasi</h1>
                            `;
                            console.log("kosong");
                        } else {
                            console.log("ada");
                            children = `
                                ${(data === presentasi[0][0]
                                    ? '<a href="javascript:void(0);" class="list-group-item list-group-item-action flex-column align-items-start active">'
                                    : ''
                                )}
                                <a class="list-group-item list-group-item-action flex-column align-items-start ${(data === presentasi[0][0] ? 'active' : '' )}">
                                    <div class="d-flex justify-content-between w-100">
                                        <h5 class="mb-1">${data.judul}</h5>
                                        <small class="text-muted">${waktu} hari lalu</small>
                                    </div>
                                    <p class="mb-1 text-white">${data.deskripsi}</p>

                                </a>
                            `;
                        }



                    div.innerHTML = children
                    document.getElementById('list-group').appendChild(div);

                });





            })
            .catch((err) => {
                console.log(err);
            })
        }

        const aturUrutan = (code,codeHistory) =>{

            document.getElementById('select2Basic').setAttribute('data-bs-code',code);
            document.getElementById('select2Basic').setAttribute('data-bs-codeHistory',codeHistory);


            axios.get('ambil-urutan/'+codeHistory)
            .then((res) => {
                const data = res.data.presentasi;

                document.getElementById('select2Basic').innerHTML = "";
                // $("#select2Basic").select2();
                    Object.keys(data).forEach(key => {
                    let presentasi = data[key]
                    let option = document.createElement('option')
                    option.textContent = "Urutan ke-"+presentasi.urutan;
                    option.value = presentasi.urutan;
                    option.name = "optUrutan";
                    document.getElementById('select2Basic').appendChild(option);
                });

            })
            .catch((err) => {
                Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: "404 Route tidak ditemukan"
                    });
                console.log(err);
            })




        }

        const kirimProsesGantiUrutan = () =>
        {
            const code = document.getElementById('select2Basic').getAttribute('data-bs-code');
            const codeHistory = document.getElementById('select2Basic').getAttribute('data-bs-codeHistory');
            const urutanTergantikan = document.getElementById("select2Basic").value;
            console.log( typeof urutanTergantikan);

                axios.put('atur-urutan/'+code,{urutanTergantikan,codeHistory})
                .then((res) => {

                document.getElementById('row-konfirmasi').innerHTML = "";
                axios.get('ambil-urutan/'+codeHistory)
                .then((resNew) => {

                    const data = resNew.data;
                    const presentasi = data.presentasi;
                    console.log(resNew.data);

                    tampilkanDetail(codeHistory);


                    if (res.data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Sukses',
                            text: res.data.success
                        })
                    }
                    if (res.data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: res.data.error
                        })
                    }






                })

                .catch((err) => {
                    console.log(err);
                })

            })
            .catch((err) => {

                Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: "404 Route tidak ditemukan"
                        })

            })
        }



        const tolakPresentasi = (code,codeHistory) => {
            const form = document.getElementById("tolakPresentasiForm")
            form.addEventListener("submit", function(e) {
                e.preventDefault();
                let alasan = $('#alasan').val()
                console.log(alasan);

                axios.put('penolakan-presentasi/' + code, {
                        alasan
                    })
                    .then((response) => {
                        console.log(response.data);

                        if (response.data.error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: response.data.error
                            })
                        }

                        if (response.data.success) {

                            tampilkanDetail(codeHistory);
                            Swal.fire({
                                icon: 'success',
                                title: 'Sukses',
                                text: 'Berhasil Menolak Presentasi'
                            })
                        }

                    })
                    .catch((err) => {
                        console.log(err)
                    })
            })
        }


        const setujuiPresentasi = (code,codeHistory) => {
            axios.put('persetujuan-presentasi/' + code)
                .then((res) => {
                    // document.getElementById('card-persetujuan-' + code).classList.add('d-none');

                    const presentasi = res.data.presentasi;
                    const totalPresentasi = res.data.totalPresentasi;
                    const presentasiDitolak = res.data.presentasiDitolak;
                    const revisiSelesai = res.data.revisiSelesai;
                    const revisiTidakSelesai = res.data.revisiTidakSelesai;
                    const codeHistory = res.data.codeHistory;
                    const kategoryTim = handleKategory(presentasi.tim.status_tim)

                    tampilkanDetail(codeHistory);



                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses',
                        text: 'Berhasil Menyetujui Presentasi'
                    })


                })
                .catch((err) => {
                    console.log(err);
                });
        };


        function sudahPresentasi(code,codeHistory) {
            const persetujuan = "selesai"
            const form = document.getElementById('selesaiPresentasiForm')
            form.addEventListener("submit", (e) => {
                e.preventDefault();
                const feedback = document.getElementById('feedback').value

                try {
                    const status_revisi = document.querySelector("[name='status_revisi']:checked").value

                    axios.put('konfirmasi-presentasi/' + code, {
                            feedback,
                            status_revisi,
                            persetujuan
                        })
                        .then((res) => {
                            if(res.data.error){
                                setTimeout(()=>{
                                swal.fire({
                               icon: 'error',
                                title: 'Error',
                                text: res.data.error
                                        })
                                }, 400)
                            }else{

                                setTimeout(()=>{
                                swal.fire({
                               icon: 'success',
                                title: 'Sukses',
                                text: "Berhasil Mengkonfirmasi Presentasi"
                                        })
                                }, 400)

                                document.getElementById('card-konfirmasi-' + code).classList.add('d-none');
                                tampilkanDetail(codeHistory);

                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                        .finally(() => {
                            const form = document.getElementById('selesaiPresentasiForm').reset()
                        })
                } catch (error) {

                    setTimeout(() => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Status revisi tidak boleh kosong'
                        })
                    }, 400);

                }




            })


        };

    </script>
@endsection
