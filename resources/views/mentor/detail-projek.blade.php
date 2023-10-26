@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <h5 class="header">Detail Projek</h5>
        <div class="col-xl-12">
            <div class="nav-align-top mb-4">
                <ul class="nav nav-pills mb-3 nav-fill" role="tablist">
                    <li class="">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-projek" aria-controls="tab-projek" aria-selected="true"><i
                                class="tf-icons ti ti-folder-cog ti-xs me-1"></i> Projek <span>
                    </li>
                    <li class="">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                            data-bs-target="#tab-anggota" aria-controls="tab-anggota" aria-selected="false"><i
                                class="tf-icons ti ti-users ti-xs me-1"></i> Anggota</button>
                    </li>
                </ul>
                <div class="tab-content bg-transparent py-0 px-0" style="box-shadow: none">
                    {{-- tab project --}}
                    <div class="tab-pane fade show active" id="tab-projek" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4">
                                <!-- Doughnut Chart -->
                                <div class="card">
                                    <h5 class="card-header">Progres Tim</h5>
                                    <div class="card-body">
                                        <canvas id="doughnutChart" class="chartjs mb-4" data-height="350"></canvas>
                                        <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
                                            <li class="ct-series-0 d-flex flex-column">
                                                <h5 class="mb-0">Progres</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(102, 110, 232);width:35px; height:6px;"></span>
                                                <div class="text-muted">80 %</div>
                                            </li>
                                            <li class="ct-series-1 d-flex flex-column">
                                                <h5 class="mb-0">Selesai</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(40, 208, 148);width:35px; height:6px;"></span>
                                                <div class="text-muted">10 %</div>
                                            </li>
                                            <li class="ct-series-2 d-flex flex-column">
                                                <h5 class="mb-0">Revisi</h5>
                                                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                                                    style="background-color: rgb(253, 172, 52);width:35px; height:6px;"></span>
                                                <div class="text-muted">10 %</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /Doughnut Chart -->
                            </div>
                            <div class="col-lg-8">
                                {{-- card projects --}}
                                <div class="card" style="padding-bottom: 8.6vh">
                                    <div class="card-header">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <div class="fs-4 text-black">
                                                Projek
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; justify-items: center; align-items: center;">
                                                <span>Tanggal Mulai : 20 Januari 2023</span>
                                                <span>Tenggat : 25 Januari 2023</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="d-flex flex-row gap-3">
                                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" style="width: 60px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                        <span class="d-block text-black fs-5">Hummatask</span>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div>Status : Big Project</div>
                                                    <div>Tema : Pengelolaan tugas</div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="progres-bar">
                                                    <div class="d-flex justify-content-between">
                                                        <span>Hari</span>
                                                        <span>24 dari 20 Hari</span>
                                                    </div>
                                                    <div class="d-flex flex-grow-1 align-items-center my-1">
                                                        <div class="progress w-100 me-3" style="height:8px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 54%" aria-valuenow="54" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                            </div>
                                                        </div>
                                                        <span class="text-muted">54%</span>
                                                    </div>
                                                    <div class="tenggat">
                                                        <span>Tenggat kurang 6 hari lagi</span>
                                                    </div>
                                                </div>
                                                <div class="deskripsi mt-2">
                                                    <div class="title text-dark">
                                                        Deskripsi :
                                                    </div>
                                                    <div class="isi">
                                                        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Numquam
                                                        suscipit nihil animi aut placeat doloribus repellat, ipsa sunt, ab
                                                        molestiae quibusdam blanditiis voluptate mollitia perspiciatis
                                                        dolor! Tempora laborum nulla voluptates? Eligendi sit ullam, iure
                                                        hic mollitia, voluptatem quisquam iste distinctio quas praesentium
                                                        aut. Beatae dolore quas ipsa, inventore earum necessitatibus.
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
                    {{-- tab project --}}

                    {{-- tab anggota --}}
                    <div class="tab-pane fade" id="tab-anggota" role="tabpanel">

                        {{-- card logo tim --}}
                        <div class="card py-3" id="logo-tim">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/avatars/2.png') }}" alt class="h-auto rounded-circle"
                                    style="width: 150px">
                                <div class="nama-tim mt-2">
                                    <span class="fs-3 text-black">Hummatask</span>
                                </div>
                            </div>
                        </div>
                        {{-- card logo tim --}}

                        {{-- card anggota --}}
                        <div class="card-anggota mt-4">
                            <div class="row justify-content-center">
                                {{-- for each start --}}
                                <div class="col-xl-4 my-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" style="width: 50px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: start;">
                                                        <span class="text-black fs-5">Rafliansyah</span>
                                                        <span class="text-black fs-6">Ketua Kelompok</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 my-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" style="width: 50px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: start;">
                                                        <span class="text-black fs-5">Rafliansyah</span>
                                                        <span class="text-black fs-6">Ketua Kelompok</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 my-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" style="width: 50px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: start;">
                                                        <span class="text-black fs-5">Rafliansyah</span>
                                                        <span class="text-black fs-6">Ketua Kelompok</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 my-2">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="container">
                                                <div class="d-flex gap-3">
                                                    <img src="{{ asset('assets/img/avatars/2.png') }}" alt
                                                        class="h-auto rounded-circle" style="width: 50px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: start;">
                                                        <span class="text-black fs-5">Rafliansyah</span>
                                                        <span class="text-black fs-6">Ketua Kelompok</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- end for each --}}
                            </div>
                        </div>
                        {{-- card anggota --}}

                    </div>
                    {{-- tab anggota --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>

    <script>
        const cyanColor = '#28dac6',
            orangeLightColor = '#FDAC34';
        let cardColor, headingColor, labelColor, borderColor, legendColor;


        cardColor = config.colors.cardColor;
        headingColor = config.colors.headingColor;
        labelColor = config.colors.textMuted;
        legendColor = config.colors.bodyColor;
        borderColor = config.colors.borderColor;

        const doughnutChart = document.getElementById('doughnutChart');
        if (doughnutChart) {
            const doughnutChartVar = new Chart(doughnutChart, {
                type: 'doughnut',
                data: {
                    labels: ['Selesai', 'Revisi', 'Progres'],
                    datasets: [{
                        data: [10, 10, 80],
                        backgroundColor: [cyanColor, orangeLightColor, config.colors.primary],
                        borderWidth: 0,
                        pointStyle: 'rectRounded'
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 500
                    },
                    cutout: '68%',
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.labels || '',
                                        value = context.parsed;
                                    const output = ' ' + label + ' : ' + value + ' %';
                                    return output;
                                }
                            },
                            // Updated default tooltip UI
                            //   rtl: isRtl,
                            backgroundColor: cardColor,
                            titleColor: headingColor,
                            bodyColor: legendColor,
                            borderWidth: 1,
                            borderColor: borderColor
                        }
                    }
                }
            });
        }
    </script>
@endsection
