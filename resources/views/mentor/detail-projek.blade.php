@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-5">
        <div class="col-12">
            <div class="nav-align-top d-flex justify-between">
                <div class="nav nav-pills d-flex justify-content-between my-4" role="tablist">
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
                    </div>
                </div>
                <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
                    <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-4 mb-4">
                                <div class="card">
                                    <h5 class="card-header">Progres Tim</h5>
                                    <div class="card-body">
                                        <canvas id="project" class="chartjs mb-4" data-height="267"
                                            style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                {{-- card projects --}}
                                <div class="card">
                                    <div class="card-header">
                                        <div class="d-flex flex-row align-items-center justify-content-between">
                                            <div class="fs-4 text-black">
                                                Projek
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; justify-items: center; align-items: left;">
                                                @php
                                                    $tanggalMulai = $tim->created_at->translatedFormat('Y-m-d');
                                                    $deadline = \Carbon\Carbon::parse($project->deadline)->translatedFormat('Y-m-d');
                                                    $totalDeadline = \Carbon\Carbon::parse($deadline)->diffInDays($tanggalMulai);
                                                    $dayLeft = \Carbon\Carbon::parse($deadline)->diffInDays(\Carbon\Carbon::now());
                                                @endphp
                                                <span>Tanggal Mulai :
                                                    {{ $tim->created_at->translatedFormat('l, j F Y') }}</span>
                                                @if (@isset($project))
                                                    <span>Tenggat :
                                                        {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('l, j F Y') }}</span>
                                                @else
                                                    <span>Tenggat : Pending </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="d-flex flex-row gap-3">
                                                    <img src="{{ asset($tim->logo) }}" alt='logo tim'
                                                        class="h-auto rounded-circle" style="width: 60px">
                                                    <div
                                                        style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                                                        <span class="d-block text-black fs-5">{{ $tim->nama }}</span>
                                                    </div>
                                                </div>
                                                <div class="mt-4">
                                                    <div class="mb-3">Status : <span
                                                            class="badge bg-label-warning">{{ $tim->status_tim }}</span>
                                                    </div>
                                                    @php
                                                        $now = \Carbon\Carbon::now();
                                                        $deadline = \Carbon\Carbon::parse($project->deadline);
                                                        $daysRemaining = $now->diffInDays($deadline);
                                                    @endphp
                                                    @if (@isset($project->tema->nama_tema))
                                                        <div>Tema : <span
                                                                class="badge bg-label-warning">{{ $project->tema->nama_tema }}</span>
                                                        @else
                                                            <div>Tema : <span class="badge bg-label-warning">Pending</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="progres-bar">
                                                <div class="d-flex justify-content-between">
                                                    <span>Hari</span>
                                                    <span>{{ $dayLeft }} dari {{ $totalDeadline }} Hari</span>
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
                                                    <span>Tenggat kurang {{$dayLeft}} hari lagi</span>
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
                <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                    <div class="container">
                        <div class="row">
                            <div class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                                    <img width="90px" height="90px" class="rounded-circle" src="{{ asset($tim->logo) }}"
                                        alt="">
                                    <h1>{{ $tim->nama }}</h1>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 justify-content-center align-items-center grid">
                            {{-- Anggota --}}
                            @forelse ($anggota as $item)
                                <div class="col-lg-4 p-2" style="box-shadow: none">
                                    <div class="card">
                                        <div class="card-body d-flex gap-3 align-items-center">
                                            <div>
                                                <img width="30px" height="30px" class="rounded-circle object-cover"
                                                    src="{{ asset($item->user->avatar) }}" alt="foto user">
                                            </div>
                                            <div>
                                                <h5 class="mb-0" style="font-size: 15px">
                                                    {{ $item->user->username }}</h5>
                                                <span
                                                    class="badge bg-label-warning">{{ $item->jabatan->nama_jabatan }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Tidak ada data anggota</p>
                            @endforelse
                            {{-- Anggota --}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/charts-chartjs.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const project = document.getElementById('project');
        const data = {
            labels: [
                'Progres',
                'Selesai',
                'Revisi'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [12, 8, 2],
                backgroundColor: [
                    'rgb(102, 110, 232)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4
            }]
        };
        new Chart(project, {
            type: 'pie',
            data: data
        })
    </script>
@endsection
