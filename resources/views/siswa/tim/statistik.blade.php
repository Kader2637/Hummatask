@extends('layouts.tim')

@section('content')
    <div class="container-fluid d-flex mt-5 justify-content-center">
        <div class="col-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                            aria-selected="true">Kontribusi</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                            aria-selected="false" tabindex="-1">Keaktifan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages"
                            aria-selected="false" tabindex="-1">Project</button>
                    </li>
                </ul>
                <div class="tab-content py-0 px-0" style="border: none; background: none; box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
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
                                                <li class="d-flex align-items-center mb-4" id="user-kontribusi-{{ $user->uuid }}" onclick="getKontribusi('{{ $user->uuid }}')">
                                                    <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/svg/flags/us.svg"
                                                        alt="User" class="rounded-circle me-3" width="34">
                                                    <div
                                                        class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                        <div class="me-2">
                                                            <div class="d-flex align-items-center">
                                                                <h6 class="mb-0 me-1">{{ $user->username }}</h6>
                                                            </div>

                                                            {{-- <small class="text-muted">{{ $user->anggota->jabatan[0]->nama_jabatan }}</small> --}}
                                                        </div>
                                                        <div class="user-progress">
                                                            <p
                                                                class="text-success fw-medium mb-0 d-flex justify-content-center gap-1">
                                                                {{ $user->tugas->count() }} Tugas
                                                            </p>
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
                                        {{-- <div class="dropdown">
                                      <button class="btn p-0" type="button" id="supportTrackerMenu" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti ti-dots-vertical ti-sm text-muted"></i>
                                      </button>
                                      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="supportTrackerMenu">
                                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                      </div>
                                    </div> --}}
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
                                                                                    data:angle="230" data:value="85"
                                                                                    index="0" j="0"
                                                                                    data:pathOrig="M 83.47585697010521 235.85564722791077 A 108.16036585365855 108.16036585365855 0 1 1 261.16036585365856 153">
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
                                                                    class="apexcharts-ycrosshairs-hidden"></line>
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
                    <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                        <div class="row">
                            @for ($i = 0; $i < 6; $i++)
                                <div class="col-md-4 mt-3">
                                    <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                        data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                        data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges">
                                                <div class="badge rounded-pill bg-label-success"> UX</div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle ti ti-dots-vertical"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                        href="javascript:void(0)">Copy task link</a><a
                                                        class="dropdown-item" href="javascript:void(0)">Duplicate
                                                        task</a><a class="dropdown-item delete-task"
                                                        href="javascript:void(0)">Delete</a></div>
                                            </div>
                                        </div><span class="kanban-text">Research FAQ page UX</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                        class="ti ti-paperclip ti-xs me-1"></i><span
                                                        class="attachments">4</span></span> <span
                                                    class="d-flex align-items-center ms-1"><i
                                                        class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Bruce"
                                                    data-bs-original-title="Bruce"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Clark"
                                                    data-bs-original-title="Clark"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-top-messages" role="tabpanel">
                        <div class="row">
                            @for ($i = 0; $i < 12; $i++)
                                <div class="col-md-4 mt-3">
                                    <div class="kanban-item card p-4" data-eid="in-progress-1" data-comments="12"
                                        data-badge-text="UX" data-badge="success" data-due-date="5 April"
                                        data-attachments="4" data-assigned="12.png,5.png" data-members="Bruce,Clark">
                                        <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                            <div class="item-badges">
                                                <div class="badge rounded-pill bg-label-success"> UX</div>
                                            </div>
                                            <div class="dropdown kanban-tasks-item-dropdown"><i
                                                    class="dropdown-toggle ti ti-dots-vertical"
                                                    id="kanban-tasks-item-dropdown" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false"></i>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="kanban-tasks-item-dropdown"><a class="dropdown-item"
                                                        href="javascript:void(0)">Copy task link</a><a
                                                        class="dropdown-item" href="javascript:void(0)">Duplicate
                                                        task</a><a class="dropdown-item delete-task"
                                                        href="javascript:void(0)">Delete</a></div>
                                            </div>
                                        </div><span class="kanban-text">Research FAQ page UX</span>
                                        <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                            <div class="d-flex"> <span class="d-flex align-items-center me-2"><i
                                                        class="ti ti-paperclip ti-xs me-1"></i><span
                                                        class="attachments">4</span></span> <span
                                                    class="d-flex align-items-center ms-1"><i
                                                        class="ti ti-message-dots ti-xs me-1"></i><span> 12 </span></span>
                                            </div>
                                            <div class="avatar-group d-flex align-items-center assigned-avatar">
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Bruce"
                                                    data-bs-original-title="Bruce"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/12.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
                                                <div class="avatar avatar-xs" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" aria-label="Clark"
                                                    data-bs-original-title="Clark"><img
                                                        src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                        alt="Avatar" class="rounded-circle  pull-up"></div>
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
@endsection

@section('script')
    <script>
        function getKontribusi(uuid){



            const code =  "{{ $tim->code }}";
            axios.get(`data-kontribusi/${code}/${uuid}`)
            .then((res) => {

                const data = res.data;
                const tugasTerkontribusi = data.tugasTerkontribusi.length;
                const tugasMendesak = data.tugasMendesak;
                const tugasPenting = data.tugasPenting;
                const tugasBiasa = data.tugasBiasa;
                const persentase = data.presentaseTugasSelesai;

                console.log(tugasMendesak);

                $("#totalKontribusiTugas").html(tugasTerkontribusi);
                $("#tugasMendesak").html(tugasMendesak);
                $("#tugasPenting").html(tugasPenting);
                $("#tugasBiasa").html(tugasBiasa);
                $("#SvgjsText1640").html(`${persentase}%`)



            })
            .catch((err) => {
                console.log(err);
            })
        }
    </script>
@endsection

