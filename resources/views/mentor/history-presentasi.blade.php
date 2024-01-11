@extends('layoutsMentor.app')

@section('content')
  <div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3">
      <span class="text-muted fw-light"></span> History
    </h4>
    <div class="d-flex card flex-md-row align-items-center justify-content-between">
      <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
            type="button" role="tab" aria-controls="pills-home" aria-selected="true" data-tab="1"><i
              class="fa-solid fa-calendar-xmark icon-text me-2"></i>Telat Presentasi</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
            type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2"><i
              class="fa-solid fa-person-chalkboard icon-text me-2"></i>Selesai Presentasi</button>
        </li>
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
                  <th scope="col">TEAM</th>
                  <th scope="col">DEADLINE</th>
                  <th scope="col">PROJECT</th>
                  <th scope="col">TEMA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bababoi</td>
                  <td>15/90/2400</td>
                  <td>Big Project</td>
                  <td>E-Commers</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
        <div class="card">
          <div class="card-datatable table-responsive">
            <table id="jstabel2" class="dt-responsive table">
              <thead>
                <tr>
                  <th scope="col">NO</th>
                  <th scope="col">TEAM</th>
                  <th scope="col">TANGGAl</th>
                  <th scope="col">PROJECT</th>
                  <th scope="col">TEMA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Bababoi</td>
                  <td>15/90/2400</td>
                  <td>Big Project</td>
                  <td>E-Commers</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Detail tim</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="container-fluid">
              <div class="col-12">
                <div class="nav-align-top d-flex justify-between">
                  <div class="nav nav-pills d-flex justify-content-between my-4  py-2 px-3 shadow" role="tablist">
                    <div class="d-flex justify-content-between">
                      <div class="nav-item" role="presentation">
                        <button type="button" class="nav-link active button-nav" role="tab" data-bs-toggle="tab"
                          data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                          aria-selected="true">Project</button>
                      </div>
                      <div class="nav-item button-nav" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                          data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                          aria-selected="false" tabindex="-1">Anggota</button>
                      </div>
                      <div class="nav-item button-nav" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                          data-bs-target="#board" aria-controls="board" aria-selected="false"
                          tabindex="-1">Board</button>
                      </div>
                    </div>
                  </div>
                  <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                      <div class="row">
                        <div class="col-lg-12">
                          {{-- card projects --}}
                          <div class="card">
                            <div class="card-header">
                              <div class="d-flex flex-row align-items-center justify-content-between">
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
                                <div class="col-lg-4 d-flex flex-column justify-content-center align-items-center">
                                  <div class="d-flex flex-column gap-3 justify-content-center align-items-center">
                                    <div>
                                      <img id="logo-tim" src="" alt='logo tim' class="rounded-circle"
                                        style="width: 90px; height: 90px">
                                    </div>
                                    <div>
                                      <span class="d-block text-black fs-5" id="nama-tim">nama tim</span>
                                    </div>
                                  </div>
                                  <div class="row w-60 mt-3">
                                    <div
                                      class="col-md-6 col-12 justify-content-center align-items-center d-flex flex-column">
                                      <div>
                                        <p class="mb-1 text-center">Status</p>
                                      </div>
                                      <div>
                                        <span class="badge bg-label-warning" id="status"></span>
                                      </div>
                                    </div>
                                    <div
                                      class="col-md-6 col-12 justify-content-center align-items-center d-flex flex-column">
                                      <div>
                                        <p class="mb-1 text-center">Tema</p>
                                      </div>
                                      <div>
                                        <span class="badge bg-label-warning" id="tema"></span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="col-lg-8">
                                  <div class="progres-bar">
                                    <div class="d-flex justify-content-between">
                                      <span>Hari</span>
                                      <span><span id="dayLeft"></span> dari <span id="total"></span> Hari</span>
                                    </div>
                                    <div class="d-flex flex-grow-1 align-items-center my-1">
                                      <div class="progress w-100 me-3" style="height:8px;background-color: gainsboro">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 10%"
                                          aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                      </div>
                                      <span class="text-muted"><span id="textPercent"></span>%</span>
                                    </div>
                                    <div class="tenggat">
                                      <span>Tenggat kurang <span id="dayleft"></span> hari lagi</span>
                                    </div>
                                  </div>
                                  <div class="link mt-2">
                                    <div class="title text-dark">
                                      Link Repository :
                                    </div>
                                    <a href="" id="repository" target="_blank"><span class="text-blue"
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
                      <div class="container-fluid">
                        <div class="row">
                          <div class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                            <div class="card-body d-flex flex-column align-items-center justify-content-center">
                              <img id="logo-tim2" width="90px" height="90px" class="rounded-circle" src=""
                                alt="">
                              <h1 id="nama-tim2" class="mt-2"></h1>
                            </div>
                          </div>
                        </div>
                        <div class="row mt-2 justify-content-center align-items-center grid" id="anggota-list">
                          {{-- Anggota --}}
                          {{-- Anggota --}}
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="board" role="tabpanel">
                      <div class="container-fluid">
                        <div style="height: 80vh" class="container-fluid mt-2">
                          <div class="d-flex mt-3 mb-0  row hide-sroll" style="height: 83vh">
                            <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                              <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                                class="p-2  rounded">
                                <div style="width:100%" class="card card-status-tugas">
                                  <div class="card-body p-2 py-2 row justify-content-between">
                                    <span class="col-8">Tugas </span>
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
@endsection
