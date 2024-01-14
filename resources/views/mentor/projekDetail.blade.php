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
                data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false"
                tabindex="-1">Anggota</button>
            </div>
            <div class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                data-bs-target="#navs-pills-catatan" aria-controls="navs-pills-catatan" aria-selected="false"
                tabindex="-1">Catatan</button>
            </div>
          </div>
        </div>
        <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
          <div class="tab-pane fade active show" id="navs-pills-top-home" role="tabpanel">
            <div class="row">
              <div class="col-lg-4 mb-4">
                <div class="card">
                  <h5 class="card-header text-dark">Progres Tim</h5>
                  <div class="card-body">
                    <p id="" class="text-center chart-status"></p>
                    <canvas id="" class="chartjs mb-4 mt-2 piechart-project" data-height="267"
                      style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                    <ul class="doughnut-legend d-flex justify-content-evenly ps-0 mb-2 pt-1">
                      <li class="ct-series-0 d-flex flex-column">
                        <h5 class="mb-0" style="font-size: 13px">Tugas Baru</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                          style="background-color: #6A2C70; height: 6px; width: 30px;"></span>
                        <div class="text-muted"></div>
                      </li>
                      <li class="ct-series-1 d-flex flex-column">
                        <h5 class="mb-0" style="font-size: 13px">Dikerjakan</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                          style="background-color: #B83B5E; height: 6px; width: 30px;"></span>
                        <div class="text-muted"></div>
                      </li>
                      <li class="ct-series-1 d-flex flex-column">
                        <h5 class="mb-0" style="font-size: 13px">Revisi</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                          style="background-color: #F08A5D; height: 6px; width: 30px;"></span>
                        <div class="text-muted"></div>
                      </li>
                      <li class="ct-series-1 d-flex flex-column">
                        <h5 class="mb-0" style="font-size: 13px">Selesai</h5>
                        <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                          style="background-color: #F9ED69; height: 6px; width: 30px;"></span>
                        <div class="text-muted"></div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-8">
                {{-- card projects --}}
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between">
                      <div class="fs-4 text-dark fw-medium">
                        Projek
                      </div>
                      <div class="d-flex flex-column mt-1">
                        <span>Tanggal Mulai : {{ $project->created_at->translatedFormat('l, d F Y') }}</span>
                        <span>Tenggat :
                          {{ \Carbon\Carbon::parse($project->deadline)->translatedFormat('l, j F Y') }}</span>
                      </div>
                    </div>
                  </div>
                  <hr class="my-0">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-5 align-items-center justify-content-center d-flex flex-column">
                        <div>
                          <div class="text-center">
                            <img id="logo-tim" src="{{ asset('storage/' . $project->tim->logo) }}" alt='logo tim'
                              class="rounded-circle mb-3" style="width: 90px; height: 90px">
                          </div>
                          <div class="d-flex flex-column justify-content-center align-items-center">
                            <span class="d-block text-black fs-5" id="nama-tim">{{ $project->tim->nama }}</span>
                          </div>
                        </div>
                        <div class="row w-80 mt-3">
                          <div class="col-md-6 col-12 justify-content-center align-items-center d-flex flex-column">
                            <div>
                              <p class="mb-1 text-center">Status</p>
                            </div>
                            <div>
                              @if ($project->tim->status_tim == 'solo')
                                <span class="badge bg-label-danger">Solo Project</span>
                              @elseif ($project->tim->status_tim == 'pre_mini')
                                <span class="badge bg-label-warning">Pre Mini Project</span>
                              @elseif ($project->tim->status_tim == 'mini')
                                <span class="badge bg-label-success">Mini Project</span>
                              @else
                                <span class="badge bg-label-primary">Big Project</span>
                              @endif
                            </div>
                          </div>
                          <div class="col-md-6 col-12 justify-content-center align-items-center d-flex flex-column">
                            <div>
                              <p class="mb-1 text-center">Tema</p>
                            </div>
                            <div>
                              <span class="badge bg-label-warning" id="tema">{{ $project->tema->nama_tema }}</span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-7">
                        <div class="progres-bar">
                          <div class="d-flex justify-content-between">
                            <span>Hari</span>
                            <span><span id="dayLeft"></span> dari
                              <span id="total"></span>
                              Hari</span>
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
                            <span>Tenggat kurang <span id="dayleft"></span>
                              hari
                              lagi</span>
                          </div>
                        </div>
                        <div class="link mt-2">
                          <div class="title text-dark">
                            Link Repository :
                          </div>
                          <a href="" id="repository" target="_blank"><span class="text-blue"
                              id="text-repo">{{ $project->tim->repository }}</span></a>
                        </div>
                        <div class="deskripsi my-2">
                          <div class="title text-dark mb-0">
                            Deskripsi :
                          </div>
                          <div class="isi mt-2" id="deskripsi">
                            {{ $project->deskripsi }}
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
                    <img src="{{ asset('storage/' . $project->tim->logo) }}" width="90px" height="90px"
                      class="rounded-circle" alt="">
                    <h1 class="mt-2">{{ $project->tim->nama }}</h1>
                  </div>
                </div>
              </div>
              <div class="row mt-2 justify-content-center align-items-center grid">
                @foreach ($project->tim->anggota as $data)
                  <div class="col-lg-4 p-2" style="box-shadow: none">
                    <div class="card">
                      <div class="card-body d-flex gap-3 align-items-center">
                        <div>
                          <img width="30px" height="30px" class="rounded-circle object-cover"
                            src="{{ asset('storage/' . $data->user->avatar) }}" alt="">
                        </div>
                        <div>
                          <h5 class="mb-0" style="font-size: 15px">{{ $data->user->username }}</h5>
                          <span class="badge bg-label-warning">{{ $data->jabatan->nama_jabatan }}</span>
                          @if ($data->user->status_kelulusan === 0)
                            <span class="badge bg-label-success me-2">Belum Lulus</span>
                          @elseif($data->user->status_Kelulusan === 1)
                            <span class="badge bg-label-success me-2">Lulus</span>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-catatan" role="tabpanel">
            <div class="w-100 card p-3">
              <div class="d-flex align-items-start w-100">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                  aria-orientation="vertical">
                  @if ($catatan)
                    @foreach ($catatan as $index => $catatanItem)
                      <button class="nav-link text-truncate d-inline-block mb-2" style="max-width: 150px"
                        id="v-pills-{{ $catatanItem->id }}-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-{{ $catatanItem->id }}" type="button" role="tab"
                        aria-controls="v-pills-{{ $catatanItem->id }}"
                        aria-selected="true">{{ $catatanItem->title }}</button>
                    @endforeach
                  @else
                    <p>Catatan Tidak Ada</p>
                  @endif
                </div>
                <div class="tab-content w-100" id="v-pills-tabContent">
                  @forelse ($catatan as $index => $catatanTab)
                    <div class="tab-pane fade" id="v-pills-{{ $catatanTab->id }}" role="tabpanel"
                      aria-labelledby="v-pills-{{ $catatanTab->id }}-tab" tabindex="0">
                      <div class="w-100">
                        <form action="{{ route('mentor.update.catatan', $project->code) }}" method="POST">
                          @method('PUT')
                          @csrf
                          <div class="form-repeater d-flex flex-column justify-content-center align-items-center">
                            @forelse ($catatanTab->catatanDetail as $data)
                              <div class="form-add row mb-3 w-100">
                                <div class="col-11 col-md-11">
                                  <input type="text" value="{{ $data->catatan_text }}" name="catatan_text[]"
                                    class="form-control">
                                </div>
                                <div class="col-1 col-md-1">
                                  <button type="button" class="btn btn-icon btn-danger button-delete-repeater">
                                    <i class="ti ti-trash text-white"></i>
                                  </button>
                                </div>
                              </div>
                            @empty
                              <p>Data Catatan Detail Tidak Ditemukan</p>
                            @endforelse
                          </div>
                          <div style="padding: 0px 11px 0px 11px" class="w-100">
                            <button type="button" id="tambahCatatan" class="btn btn-primary me-2">Tambah</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  @empty
                    <div class="d-flex justify-content-evenly">
                      <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0" style="width: 250px;">
                    </div>
                    <p class="text-center mb-5 mt-2">Setting Limit Terlebih dahulu ! <i class="ti ti-address-book-off"></i></p>
                  @endforelse
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
  <script>
    var i = 0;
    $('#tambahCatatan').click(function() {
      ++i;
      $('.form-repeater').append(
        `<div class="form-add row mb-3 w-100">
          <div class="col-11 col-md-11">
              <input type="text" name="catatan_text[]" class="form-control">
          </div>
          <div class="col-1 col-md-1">
              <button type="button" class="btn btn-icon btn-danger button-delete-repeater">
              <i class="ti ti-trash text-white"></i>
          </button>
      </div>
  </div>`
      )
    })

    $(document).on('click', '.button-delete-repeater', function(event) {
      event.preventDefault();
      var $formCatatanRepeater = $(this).closest('.form-add');

      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah Anda yakin ingin menghapus baris catatan ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, hapus',
        cancelButtonText: 'Batal'
      }).then(function(result) {
        if (result.isConfirmed) {
          $formCatatanRepeater.remove();
          Swal.fire(
            'Terhapus!',
            'Catatan berhasil dihapus.',
            'success'
          );
        }
      });
    });
  </script>
@endsection
