<div class="container-fluid mt-3">
    <h5>Presentasi</h5>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="nav-align-top d-flex justify-between">
                        <div class="nav nav-pills d-flex justify-content-between row" role="tablist">
                            <div class="nav-item col-lg-3 col-md-6" role="presentation" >
                                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                                data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                                data-bs-toggle="popover" data-bs-placement="top" data-bs-original-title="Tooltip Text"
                                    aria-selected="true"><i class="ti ti-news me-2"></i>Pengajuan</button>
                            </div>
                            <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile"
                                    aria-selected="false" tabindex="-1"><i
                                        class="ti ti-presentation-analytics me-2"></i>Presentasi</button>
                            </div>
                            <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-top-baru" aria-controls="navs-pills-top-profile"
                                    aria-selected="false" tabindex="-1"><i
                                        class="ti ti-adjustments-horizontal me-2"></i>Belum Presentasi</button>
                            </div>
                            <div class="nav-item col-lg-3 col-md-6" role="presentation">
                                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                                    data-bs-target="#navs-pills-top-start" aria-controls="navs-pills-top-profile"
                                    aria-selected="false" tabindex="-1"><i
                                        class="ti ti-clock-exclamation me-2"></i>Telat</button>
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
                    <div class="table-responsive text-nowrap">
                        <div class="container">
                            <div class="row" id="row-persetujuan">
                                @forelse ( $persetujuan_presentasi as $presentasi )
                                <div class="col-md-6 col-lg-4" id="card-persetujuan-{{ $presentasi->code }}" >
                                    <div class="card text-center mb-3">
                                        <div class="card-body">
                                            <img src="{{ asset('storage/' . $presentasi->tim->logo) }}" alt="logo tim" class="rounded-circle mb-3 border-primary border-2" style="width: 150px; height: 150px; object-fit: cover; ">
                                            <div class="d-flex justify-content-center align-items-center gap-2">
                                                <h4 class="card-title text-capitalize">tes</h4>
                                            <a href="#"><span class="badge bg-label-warning mb-3">solo</span></a>
                                            </div>
                                            <p class="card-text">{{ \Carbon\Carbon::parse($presentasi->jadwal)->isoFormat('DD MMMM YYYY') }}</p>

                                           <div class="d-flex justify-content-center gap-2">
                                                <button onclick="tolakPresentasi('{{ $presentasi->code }}')" data-bs-toggle="modal" data-bs-target="#Reject" class="px-3 py-1 btn btn-danger" >Tolak</button>
                                                <button onclick="setujuiPresentasi('{{ $presentasi->code }}')" class="px-3 py-1 btn btn-success" >Setujui</button>
                                           </div>
                                        </div>
                                    </div>
                                </div>
                                @empty

                                @endforelse
                            </div>
                        </div>
                     </div>
                </div>
            </div>
        </div>

        {{-- Modal Tolak Presentasi --}}

        <div class="modal fade" id="Reject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <form id="tolakPresentasiForm" method="post">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tolak Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label for="" class="mt-1">Alasan</label>
                        <textarea id="alasan" type="text" name="alasan" class="form-control" placeholder="Beri alasan penolakan" style="height: 150px; resize: none"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button  type="setuju" class="btn btn-success" data-bs-dismiss="modal">Setuju</button>
                    </div>
                </form >
                </div>
            </div>
        </div>

        {{-- Modal Tolak Presentasi --}}

        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div class="row" id="row-konfirmasi">

                @forelse ($konfirmasi_presentasi as $presentasi )
                <div id="card-konfirmasi-{{ $presentasi->code }}" class="col-md-6 col-lg-4">
                    <div class="card text-center mb-3">
                        <div class="card-body">
                            <div style="width: 30px; height: 30px; top: -10px; right: -10px;" class="rounded bg-primary d-flex justify-content-center align-items-center text-white position-absolute">
                                {{ $presentasi->urutan }}
                            </div>
                            <img src="{{ asset('storage/' . $presentasi->tim->logo) }}" alt="logo tim" class="rounded-circle mb-3 border-primary border-2" style="width: 150px; height: 150px; object-fit: cover; ">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <h4 class="card-title text-capitalize">tes</h4>
                            <a href="#"><span class="badge bg-label-warning mb-3">solo</span></a>
                            </div>


                            <div class="card-text">{{ \Carbon\Carbon::parse($presentasi->jadwal)->isoFormat('DD MMMM YYYY') }}</div>
                           <div class="d-flex justify-content-center gap-2">
                                 <button class="btn btn-primary" >Urutan</button>
                                 <button class="btn btn-success" >Konfirmasi</button>
                           </div>
                        </div>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>

        {{-- Modal Atur Ulang Presentasi --}}
        <div class="modal fade" id="Reset" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="formAturJadwal" method="post">
                        @csrf
                        @method("PUT")
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atur Ulang Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="flatpickr-date" class="form-label">Tentukan ulang tanggal
                                    presentasi</label>
                                <input name="jadwal" type="text" value="" class="form-control" placeholder="YYYY-MM-DD"
                                    id="flatpickr-date" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-success" data-bs-dismiss="modal" >Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- Modal Atur Ulang Presentasi --}}

        {{-- Modal Selesai Project --}}

        <div class="modal fade" id="Finish" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form id="selesaiPresentasiForm" method="post">
                        @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Selesai Presentasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <label for="feedback" class="mb-3">Feedback</label>
                                <textarea type="text" class="form-control" id="feedback" placeholder="Beri Feedback Presentasi"
                                    style="height: 150px; resize: none"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                        <button type="submit" data-bs-dismiss="modal" class="btn btn-success">Simpan</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Selesai Project --}}

        <div class="tab-pane fade" id="navs-pills-top-baru" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <div class="table-responsive text-nowrap">
                        <table id="jstabel3" class="table">
                            <div class="">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;"> Hidan</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                        <td><span class="badge bg-label-warning">Belum Presentasi</span></td>
                                    </tr>
                                </tbody>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="navs-pills-top-start" role="tabpanel">
            <div class="card">
                <div class="card-header">
                    <div class="table-responsive text-nowrap">
                        <table id="jstabel4" class="table">
                            <div class="">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Hari</th>
                                        <th>Project</th>
                                        <th>Tema</th>
                                    </tr>
                                </thead>
                                @php
                                    $no = 1;
                                @endphp
                                <tbody>
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td><img src="{{ asset('assets/img/avatars/10.png') }}" alt=""
                                                style="border-radius: 50%; width:40px;"> Hidan</td>
                                        <td>21-03-2023</td>
                                        <td>Senin</td>
                                        <td>Solo Project</td>
                                        <td>Sekolah</td>
                                    </tr>
                                </tbody>
                            </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
