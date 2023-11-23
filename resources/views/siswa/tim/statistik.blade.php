@extends('layouts.tim')

@section('style')
    <style>
.user-kontribusi {
    position: relative;
    display: flex;
    align-items: center;
    margin-bottom: 4px;
    padding: 12px;
    background-color: #ffffff;
    border-radius: 8px;
    transition: transform 0.3s, box-shadow 0.3s;
    cursor: pointer;
}

.user-kontribusi:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.user-kontribusi img {
    border-radius: 50%;
    margin-right: 10px;
    width: 34px;
    height: 34px;
}

.user-kontribusi h6 {
    margin-bottom: 0;
}

.user-kontribusi small {
    color: #777777;
}

.user-kontribusi .user-progress {
    background-color: #f1f1f1;
    height: 6px;
    border-radius: 3px;
    overflow: hidden;
}

.user-kontribusi .user-progress-bar {
    height: 100%;
    background-color: #7385f0;
    transition: width 0.3s;
}

.user-kontribusi.active {
    transform: scale(1.01);
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
}

.user-kontribusi.active .user-progress-bar {
    width: 100%;
}

.user-kontribusi.active h6 {
    color: #7385f0;
    font-weight: bold;
}

    </style>
@endsection

@section('link')
<link rel="stylesheet" href="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/vendor/css/pages/app-logistics-dashboard.css">
@endsection

@section('content')
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">Kontribusi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false" tabindex="-1">Project</button>
                    </li>
                </ul>
                <div class="tab-content py-0 px-0" style="border: none; background: none; box-shadow: none;">
                    <div class="tab-pane fade active show " id="navs-pills-top-home" role="tabpanel">
                        <div class="row justify-content-between ">
                            <div class="col-lg-5 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="m-0 me-2">Kontribusi</h5>
                                            <small class="text-muted">Daftar kontribusi setiap anggota</small>
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn p-0" type="button" id="salesByCountry"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="salesByCountry"
                                                style="">
                                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="p-0 m-0">
                                            @foreach ($anggota as $i => $user)
                                            <li class="d-flex align-items-center mb-4 user-kontribusi" id="user-kontribusi-{{ $user->uuid }}" onclick="getKontribusi('{{ $user->uuid }}')">
                                                <img style="object-fit: cover;"
                                                @if ($user->avatar !== null)
                                                src="{{ Storage::url($user->avatar) }}"
                                                @else
                                                src="{{ asset('assets/img/avatars/1.png') }}"
                                                @endif
                                                    alt="User" class="rounded-circle me-3" width="34">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <div class="d-flex align-items-center">
                                                            <h6 class="mb-0 me-1">{{ $user->username }}</h6>
                                                        </div>
                                                        <small class="text-muted">{{ $jabatan[$i] }}</small>
                                                    </div>
                                                    <div class="user-progress">
                                                        <div class="user-progress-bar"></div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between pb-0">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-0">Statistik Kontribusi</h5>
                                            <small class="text-muted">Detail kontribusi setiap anggota</small>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-4 col-md-12 col-lg-4">
                                                <div class="mt-lg-4 mt-lg-2 mb-lg-4 mb-2 pt-1">
                                                    <h1 class="mb-0" id="totalKontribusiTugas">2</h1>
                                                    <p class="mb-0">Kontribusi Tugas</p>
                                                </div>
                                                <ul class="p-0 m-0">
                                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pt-2 pb-1">
                                                        <div class="badge rounded bg-label-primary p-1"><i
                                                                class="ti ti-ticket ti-sm"></i></div>
                                                        <div>
                                                            <h6 class="mb-0 text-nowrap">Tugas Mendesak</h6>
                                                            <small class="text-muted" id="tugasMendesak">1</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex gap-3 align-items-center mb-lg-3 pb-1">
                                                        <div class="badge rounded bg-label-info p-1"><i
                                                                class="ti ti-circle-check ti-sm"></i></div>
                                                        <div>
                                                            <h6 class="mb-0 text-nowrap">Tugas Penting</h6>
                                                            <small class="text-muted" id="tugasPenting">0</small>
                                                        </div>
                                                    </li>
                                                    <li class="d-flex gap-3 align-items-center pb-1">
                                                        <div class="badge rounded bg-label-warning p-1"><i
                                                                class="ti ti-clock ti-sm"></i></div>
                                                        <div>
                                                            <h6 class="mb-0 text-nowrap">Tugas Biasa</h6>
                                                            <small class="text-muted" id="tugasBiasa">1</small>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-12 col-sm-8 col-md-12 col-lg-8" style="position: relative;">
                                                <div id="supportTracker" style="min-height: 235.4px;">
                                                    <div id="apexchartsg5pxtswq"
                                                        class="apexcharts-canvas apexchartsg5pxtswq apexcharts-theme-light"
                                                        style="width: 277px; height: 235.4px;"><svg id="SvgjsSvg1621"
                                                            width="277" height="235.4"
                                                            xmlns="http://www.w3.org/2000/svg" version="1.1"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg"
                                                            xmlns:data="ApexChartsNS" transform="translate(0, 0)"
                                                            style="background: transparent;">
                                                            <g id="SvgjsG1623"
                                                                class="apexcharts-inner apexcharts-graphical"
                                                                transform="translate(-13.5, -10)">
                                                                <defs id="SvgjsDefs1622">
                                                                    <clipPath id="gridRectMaskg5pxtswq">
                                                                        <rect id="SvgjsRect1625" width="312"
                                                                            height="345" x="-3" y="-1" rx="0"
                                                                            ry="0" opacity="1"
                                                                            stroke-width="0" stroke="none"
                                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <clipPath id="forecastMaskg5pxtswq"></clipPath>
                                                                    <clipPath id="nonForecastMaskg5pxtswq"></clipPath>
                                                                    <clipPath id="gridRectMarkerMaskg5pxtswq">
                                                                        <rect id="SvgjsRect1626" width="310"
                                                                            height="347" x="-2" y="-2" rx="0"
                                                                            ry="0" opacity="1"
                                                                            stroke-width="0" stroke="none"
                                                                            stroke-dasharray="0" fill="#fff"></rect>
                                                                    </clipPath>
                                                                    <linearGradient id="SvgjsLinearGradient1631"
                                                                        x1="1" y1="0" x2="0"
                                                                        y2="1">
                                                                        <stop id="SvgjsStop1632" stop-opacity="1"
                                                                            stop-color="rgba(115,103,240,1)"
                                                                            offset="0.3"></stop>
                                                                        <stop id="SvgjsStop1633" stop-opacity="0.6"
                                                                            stop-color="rgba(255,255,255,0.6)"
                                                                            offset="0.7"></stop>
                                                                        <stop id="SvgjsStop1634" stop-opacity="0.6"
                                                                            stop-color="rgba(255,255,255,0.6)"
                                                                            offset="1"></stop>
                                                                    </linearGradient>
                                                                    <linearGradient id="SvgjsLinearGradient1642"
                                                                        x1="1" y1="0" x2="0"
                                                                        y2="1">
                                                                        <stop id="SvgjsStop1643" stop-opacity="1"
                                                                            stop-color="rgba(115,103,240,1)"
                                                                            offset="0.3"></stop>
                                                                        <stop id="SvgjsStop1644" stop-opacity="0.6"
                                                                            stop-color="rgba(115,103,240,0.6)"
                                                                            offset="0.7"></stop>
                                                                        <stop id="SvgjsStop1645" stop-opacity="0.6"
                                                                            stop-color="rgba(115,103,240,0.6)"
                                                                            offset="1"></stop>
                                                                    </linearGradient>
                                                                </defs>
                                                                <g id="SvgjsG1627" class="apexcharts-radialbar">
                                                                    <g id="SvgjsG1628">
                                                                        <g id="SvgjsG1629" class="apexcharts-tracks">
                                                                            <g id="SvgjsG1630"
                                                                                class="apexcharts-radialbar-track apexcharts-track"
                                                                                rel="1">
                                                                                <path id="apexcharts-radialbarTrack-0"
                                                                                    d="M 83.47585697010521 235.85564722791077 A 108.16036585365855 108.16036585365855 0 1 1 235.8556472279108 222.52414302989476"
                                                                                    fill="none" fill-opacity="1"
                                                                                    stroke="rgba(255,255,255,0.85)"
                                                                                    stroke-opacity="1"
                                                                                    stroke-linecap="butt"
                                                                                    stroke-width="20.071951219512197"
                                                                                    stroke-dasharray="0"
                                                                                    class="apexcharts-radialbar-area"
                                                                                    data:pathOrig="M 83.47585697010521 235.85564722791077 A 108.16036585365855 108.16036585365855 0 1 1 235.8556472279108 222.52414302989476">
                                                                                </path>
                                                                            </g>
                                                                        </g>
                                                                        <g id="SvgjsG1636">
                                                                            <g id="SvgjsG1641"
                                                                                class="apexcharts-series apexcharts-radial-series"
                                                                                seriesName="CompletedxTask" rel="1"
                                                                                data:realIndex="0">
                                                                                <path id="SvgjsPath1646"
                                                                                    d="M 83.47585697010521 235.85564722791077 A 108.16036585365855 108.16036585365855 0 1 1 261.16036585365856 153"
                                                                                    fill="none" fill-opacity="0.85"
                                                                                    stroke="url(#SvgjsLinearGradient1642)"
                                                                                    stroke-opacity="1"
                                                                                    stroke-linecap="butt"
                                                                                    stroke-width="20.071951219512197"
                                                                                    stroke-dasharray="10"
                                                                                    class="apexcharts-radialbar-area apexcharts-radialbar-slice-0"
                                                                                    data:angle="230" data:value="0"
                                                                                    index="0" j="0"
                                                                                    data:pathOrig="M 83.47585697010521 235.85564722791077 A 108.16036585365855 108.16036585365855 0 1 1 261.16036585365856 153"
                                                                                    >
                                                                                </path>
                                                                            </g>
                                                                            <circle id="SvgjsCircle1637"
                                                                                r="93.12439024390245" cx="153"
                                                                                cy="153"
                                                                                class="apexcharts-radialbar-hollow"
                                                                                fill="transparent"></circle>
                                                                            <g id="SvgjsG1638"
                                                                                class="apexcharts-datalabels-group"
                                                                                transform="translate(0, 0) scale(1)"
                                                                                style="opacity: 1;"><text
                                                                                    id="SvgjsText1639"
                                                                                    font-family="Public Sans" x="153"
                                                                                    y="133" text-anchor="middle"
                                                                                    dominant-baseline="auto"
                                                                                    font-size="13px" font-weight="500"
                                                                                    fill="#a5a3ae"
                                                                                    class="apexcharts-text apexcharts-datalabel-label"
                                                                                    style="font-family: &quot;Public Sans&quot;;"> Tugas Diselesaikan </text><text id="SvgjsText1640"
                                                                                    font-family="Public Sans" x="153"
                                                                                    y="179" text-anchor="middle"
                                                                                    dominant-baseline="auto"
                                                                                    font-size="38px" font-weight="500"
                                                                                    fill="#5d596c"
                                                                                    class="apexcharts-text apexcharts-datalabel-value"
                                                                                    style="font-family: &quot;Public Sans&quot;;"></text>
                                                                            </g>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                                <line id="SvgjsLine1647" x1="0" y1="0"
                                                                    x2="306" y2="0" stroke="#b6b6b6"
                                                                    stroke-dasharray="0" stroke-width="1"
                                                                    stroke-linecap="butt" class="apexcharts-ycrosshairs">
                                                                </line>
                                                                <line id="SvgjsLine1648" x1="0" y1="0"
                                                                    x2="306" y2="0" stroke-dasharray="0"
                                                                    stroke-width="0" stroke-linecap="butt"
                                                                    class="apexcharts-ycrosshairs-hidden">
                                                                </line>
                                                            </g>
                                                            <g id="SvgjsG1624" class="apexcharts-annotations"></g>
                                                        </svg>
                                                        <div class="apexcharts-legend"></div>
                                                    </div>
                                                </div>
                                                <div class="resize-triggers">
                                                    <div class="expand-trigger">
                                                        <div style="width: 302px; height: 304px;"></div>
                                                    </div>
                                                    <div class="contract-trigger"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="row">
                            <div class="col-xl-12 mb-4 order-5 order-xxl-0 tab-project">
                                <div class="card card-project">
                                  <div class="card-header">
                                    <div class="card-title mb-0">
                                      <h5 class="m-0">Progres Pengerjaan Tugas</h5>
                                    </div>
                                  </div>
                                  <div class="card-body">
                                    <div class="d-none d-lg-flex vehicles-progress-labels mb-4 ">
                                      <div class=" overflow-hidden label-tugas_baru vehicles-progress-label on-the-way-text">Tugas Baru</div>
                                      <div class=" overflow-hidden label-tugas_dikerjakan vehicles-progress-label unloading-text">Tugas Dikerjakan</div>
                                      <div class=" overflow-hidden label-tugas_selesai vehicles-progress-label loading-text">Tugas Selesai</div>
                                      <div class=" overflow-hidden label-tugas_direvisi vehicles-progress-label waiting-text text-nowrap">Tugas Direvisi</div>
                                    </div>
                                    <div class="vehicles-overview-progress progress rounded-2 my-4 w-100" style="height: 46px;">
                                      <div class="bar-tugas_baru progress-bar fw-medium text-start bg-body text-dark px-3 rounded-0" role="progressbar"  aria-valuenow="39.7" aria-valuemin="0" aria-valuemax="100">39.7%</div>
                                      <div class="bar-tugas_dikerjakan progress-bar fw-medium text-start bg-primary px-3" role="progressbar"  aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">28.3%</div>
                                      <div class="bar-tugas_selesai progress-bar fw-medium text-start text-bg-info px-3" role="progressbar"  aria-valuenow="17.4" aria-valuemin="0" aria-valuemax="100">17.4%</div>
                                      <div class="bar-tugas_direvisi progress-bar fw-medium text-start bg-gray-900 px-2 rounded-0 px-lg-2 px-xxl-3" role="progressbar"  aria-valuenow="14.6" aria-valuemin="0" aria-valuemax="100">14.6%</div>
                                    </div>
                                    <div class="table-responsive">
                                      <table class="table card-table">
                                        <tbody class="table-border-bottom-0">
                                          <tr>
                                            <td class="w-50 ps-0">
                                              <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 1.5H11a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1h1.5"/><rect width="5" height="2.5" x="4.5" y=".5" rx="1"/><path d="M7 6v4m2-2H5"/></g></svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Tugas Baru</h6>
                                              </div>
                                            </td>
                                            <td class="text-end pe-0 text-nowrap">
                                              <h6 class="mb-0 jml_tugas_baru">2 Tugas</h6>
                                            </td>
                                            <td class="text-end pe-0">
                                              <span class="fw-medium persentase_tugas_baru">39.7%</span>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-50 ps-0">
                                              <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 1.5H11a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1h1.5"/><rect width="5" height="2.5" x="4.5" y=".5" rx="1"/><path d="M4.5 5.5h5M4.5 8h5m-5 2.5h5"/></g></svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Tugas Dikerjakan</h6>
                                              </div>
                                            </td>
                                            <td class="text-end pe-0 text-nowrap">
                                              <h6 class="mb-0 jml_tugas_dikerjakan">4 Tugas</h6>
                                            </td>
                                            <td class="text-end pe-0">
                                              <span class="fw-medium persentase_tugas_dikerjakan"></span>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-50 ps-0">
                                              <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 1.5H11a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1h1.5"/><rect width="5" height="2.5" x="4.5" y=".5" rx="1"/><path d="m4.5 8.5l2 1.5L9 6"/></g></svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Tugas Selesai</h6>
                                              </div>
                                            </td>
                                            <td class="text-end pe-0 text-nowrap">
                                              <h6 class="mb-0 jml_tugas_selesai">5 Tugas</h6>
                                            </td>
                                            <td class="text-end pe-0">
                                              <span class="fw-medium persentase_tugas_selesai"></span>
                                            </td>
                                          </tr>
                                          <tr>
                                            <td class="w-50 ps-0">
                                              <div class="d-flex justify-content-start align-items-center">
                                                <div class="me-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M9.5 1.5H11a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-10a1 1 0 0 1 1-1h1.5"/><rect width="5" height="2.5" x="4.5" y=".5" rx="1"/><path d="m5.5 6.5l3 3m0-3l-3 3"/></g></svg>
                                                </div>
                                                <h6 class="mb-0 fw-normal">Tugas Direvisi</h6>
                                              </div>
                                            </td>
                                            <td class="text-end pe-0 text-nowrap">
                                              <h6 class="mb-0 jml_tugas_direvisi">1 Tugas</h6>
                                            </td>
                                            <td class="text-end pe-0">
                                              <span class="fw-medium persentase_tugas_direvisi"></span>
                                            </td>
                                          </tr>
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
@endsection

@section('script')
<script src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/js/app-logistics-dashboard.js"></script>
    <script>



        getKontribusi("{{ $tim->user[0]->uuid }}")

        function getKontribusi(uuid){


            const code =  "{{ $tim->code }}";
            console.log(uuid);
            $(".user-kontribusi").removeClass("active");
            $("#user-kontribusi-"+uuid).addClass('active');

            axios.get(`data-kontribusi/${code}/${uuid}`)
            .then((res) => {

                const data = res.data;
                const tugasTerkontribusi = data.tugasTerkontribusi.length;
                const tugasMendesak = data.tugasMendesak;
                const tugasPenting = data.tugasPenting;
                const tugasBiasa = data.tugasBiasa;
                const persentase = data.presentaseTugasSelesai;

                console.log(data);

                $("#totalKontribusiTugas").html(tugasTerkontribusi);
                $("#tugasMendesak").html(tugasMendesak);
                $("#tugasPenting").html(tugasPenting);
                $("#tugasBiasa").html(tugasBiasa);
                $("#SvgjsText1640").html(`${persentase.toFixed(2)}%`)

            })
            .catch((err) => {
                console.log(err);
            })
        }

        getProgress("{{ $tim->code }}")
        function getProgress(codeTim){
            axios.get("data-progres/"+codeTim)
            .then((res) => {
                const data = res.data;
                console.log(data);

                if(data.tugas_baru === 0 && data.tugas_dikerjakan === 0 && data.tugas_selesai === 0 && data.tugas_direvisi ===0){
                    $(".card-project")
                    .addClass("d-flex justify-content-center align-items-center")
                    .html(
                        `
                        <img width="30%" class="mb-0" src="{{ asset('assets/img/no-data.png') }}" />
                        <h4 style="margin-top:-3%" class="mb-5" >Timmu belum pernah memiliki tugas</h4>
                        `
                    );
                }



                $(".jml_tugas_baru").html(`${data.tugas_baru} tugas`)
                $(".jml_tugas_dikerjakan").html(`${data.tugas_dikerjakan} tugas`)
                $(".jml_tugas_selesai").html(`${data.tugas_selesai} tugas`)
                $(".jml_tugas_direvisi").html(`${data.tugas_direvisi} tugas`)

                $(".persentase_tugas_baru").html(data.persentase_tugas_baru.toFixed(1)+"%")
                $(".persentase_tugas_dikerjakan").html(data.persentase_tugas_dikerjakan.toFixed(1)+"%")
                $(".persentase_tugas_selesai").html(data.persentase_tugas_selesai.toFixed(1)+"%")
                $(".persentase_tugas_direvisi").html(data.persentase_tugas_direvisi.toFixed(1)+"%")

                $(".bar-tugas_baru").css("width",`${data.persentase_tugas_baru.toFixed(1)}%`);
                $(".bar-tugas_dikerjakan").css("width",`${data.persentase_tugas_dikerjakan.toFixed(1)}%`);
                $(".bar-tugas_selesai").css("width",`${data.persentase_tugas_selesai.toFixed(1)}%`);
                $(".bar-tugas_direvisi").css("width",`${data.persentase_tugas_direvisi.toFixed(1)}%`);

                $(".bar-tugas_baru").html(`${data.persentase_tugas_baru.toFixed(1)}%`);
                $(".bar-tugas_dikerjakan").html(`${data.persentase_tugas_dikerjakan.toFixed(1)}%`);
                $(".bar-tugas_selesai").html(`${data.persentase_tugas_selesai.toFixed(1)}%`);
                $(".bar-tugas_direvisi").html(`${data.persentase_tugas_direvisi.toFixed(1)}%`);

                $(".label-tugas_baru").css("width",`${data.persentase_tugas_baru.toFixed(1)}%`);
                $(".label-tugas_dikerjakan").css("width",`${data.persentase_tugas_dikerjakan.toFixed(1)}%`);
                $(".label-tugas_selesai").css("width",`${data.persentase_tugas_selesai.toFixed(1)}%`);
                $(".label-tugas_direvisi").css("width",`${data.persentase_tugas_direvisi.toFixed(1)}%`);

            })
            .catch((err) => {
                console.log(err);
            })
        }

    </script>
@endsection

