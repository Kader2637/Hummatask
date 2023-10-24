@extends('layouts.tim')

@section('style')
<link rel="preconnect" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-iconsea04.css?id=6ad8bc28559d005d792d577cf02a2116') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome8a69.css?id=a2997cb6a1c98cc3c85f4c99cdea95b5') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons80a8.css?id=121bcc3078c6c2f608037fb9ca8bce8d') }}" />
<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core6cc1.css?id=9dd8321ea008145745a7d78e072a6e36') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-defaultfc79.css?id=a4539ede8fbe0ee4ea3a81f2c89f07d9') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demof1ed.css?id=ddd2feb83a604f9e432cdcb29815ed44') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-wavesd178.css?id=aa72fb97dfa8e932ba88c8a3c04641bc') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar7358.css?id=280196ccb54c8ae7e29ea06932c9a4b6') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeaheadb5e1.css?id=2603197f6b29a6654cb700bd9367e2a3') }}" />
@endsection

@section('content')
    <div class="container mt-5">
        <div class="col-12">
            <div class="nav-align-top d-flex justify-between">
                    <div class="nav nav-pills d-flex justify-content-between" role="tablist">
                        <div class="d-flex justify-content-between">
                          <div class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">Project</button>
                         </div>
                         <div class="nav-item" role="presentation">
                            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false" tabindex="-1">Anggota</button>
                         </div>
                    </div>

                    <div class="" role="presentation">
                        <button class="btn btn-primary">
                            Ajukan Project
                        </button>
                    </div>
                </div>
                <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="card">
                                    <h5 class="card-header">Progres Tim</h5>
                                    <div class="card-body">
                                      <canvas id="doughnutChart" class="chartjs mb-4" data-height="350" height="794" width="794" style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                      <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                        <li class="ct-series-0 d-flex flex-column">
                                          <h5 class="mb-0" style="font-size: 15px">Proses</h5>
                                          <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(102, 110, 232);width:35px; height:6px;"></span>
                                        </li>
                                        <li class="ct-series-1 d-flex flex-column">
                                          <h5 class="mb-0" style="font-size: 15px">Selesai</h5>
                                          <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
                                        </li>
                                        <li class="ct-series-2 d-flex flex-column">
                                          <h5 class="mb-0" style="font-size: 15px">Revisi</h5>
                                          <span class="badge badge-dot my-2 cursor-pointer rounded-pill" style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="card">
                                <div class="card-header border d-flex justify-content-between align-items-center py-1 px-3 ">
                                  <div style="font-size: 15px">Project</div>
                                  <table class="" style="font-size: 10px">
                                    <tr>
                                      <td class="">Tanggal Dimulai :</td>
                                      <td class="">21 Agustus 2022</td>
                                    </tr>
                                    <tr>
                                      <td>Tanggal Berakhir :</td>
                                      <td>21 Desember 2022</td>
                                    </tr>
                                  </table>
                                </div>
                                <div class="card-body mt-3">
                                  <div class="row">
                                    <div class="col-6 d-flex flex-column">
                                        <div class="d-flex align-items-center gap-4">
                                          <img width="50px" height="50px" class="rounded-circle border border-primary" src="{{ asset('assets/img/avatars/1.png') }}" alt="">
                                          <div class="fw-bold">Hummatask</div>
                                        </div>

                                        <div class="mt-3">
                                          <p style="margin-bottom: 0px" class="fw-semibold text-dark">Status :</p>
                                          <span class="badge bg-label-warning">Big Project</span>
                                        </div>

                                        <div class="mt-2">
                                          <p style="margin-bottom: 0px" class="fw-semibold text-dark">Tema :</p>
                                          <span class="badge bg-label-primary">Pengelolaan Tugas</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="d-flex justify-content-between" style="font-size: 12px">
                                        <p style="font-size: 12px">Hari</p>
                                        <div class="d-flex gap-1">
                                          <p>24</p>
                                          <p>dari</p>
                                          <p>30</p>
                                          <p>hari</p>
                                        </div>
                                      </div>
                                      <div class="progress mt-1">
                                        <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                                      </div>
                                      <p style="font-size: 12px;">Deadline anda 6 hari lagi</p>

                                      <p class="mb-0 text-dark fw-semibold">Deskipsi :</p>
                                      <p class="" style="font-size: 12px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ducimus voluptas veniam, impedit quaerat mollitia distinctio quod. Dolor facilis molestiae esse.</p>

                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                       <div class="container">
                        <div class="row">
                          <div class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                              <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                <img width="90px" height="90px" class="rounded-circle" src="{{ asset('assets/img/avatars/10.png') }}" alt="">
                                <h1>HummaTaask</h1>
                              </div>
                          </div>
                      </div>
                      <div class="row mt-2 justify-content-center align-items-center grid">
                        @for ($i =0 ; $i < 5 ; $i++)
                        <div class="col-lg-4 p-2" style="box-shadow: none">
                          <div class="card">
                            <div class="card-body d-flex gap-3 align-items-center">
                              <div>
                                  <img width="30px" height="30px" class="rounded-circle object-cover" src="{{asset('assets/img/avatars/12.png')}}" alt="">
                              </div>
                              <div>
                                  <h5 class="mb-0" style="font-size: 15px">Muhhamad Rafli</h5>
                                  <span class="badge bg-label-warning">Ketua Tim</span>
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
    </div>

    <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
@endsection
