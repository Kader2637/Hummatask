@extends('layoutsMentor.app')

@section('style')
  <style>
    .hide-sroll *::-webkit-scrollbar {
      display: none;
    }
  </style>
@endsection

@section('content')
  <div class="container-fluid mt-5">
    <div class="col-12">
      <div class="d-flex justify-content-between align-items-center">
        <div>
          <p class="fs-4 mb-0">Detail Project Tim {{ Str::limit($project->tim->nama, 15) }}</p>
        </div>
        <div>
          <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
        </div>
      </div>
      <div class="nav-align-top d-flex justify-between">
        <div class="nav nav-tabs d-flex justify-content-between my-4" role="tablist">
          <div class="card w-100    ">
            <div class="d-flex justify-content-between">
              <div class="nav-item w-25" role="presentation">
                <button type="button" class="nav-link active button-nav" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home"
                  aria-selected="true">Project</button>
              </div>
              <div class="nav-item w-25 button-nav" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false"
                  tabindex="-1">Anggota</button>
              </div>
              <div class="nav-item w-25" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-catatan" aria-controls="navs-pills-catatan" aria-selected="false"
                  tabindex="-1">Catatan</button>
              </div>
              <div class="nav-item w-25" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-board" aria-controls="navs-pills-board" aria-selected="false"
                  tabindex="-1">Board</button>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-content bg-transparent pb-0" style="box-shadow: none;">
          {{-- Project Tab --}}
          <div class="tab-pane fade show active" id="navs-pills-top-home" role="tabpanel">
            <div class="row">
              <div class="col-lg-4 mb-4">
                <div class="card">
                  <h5 class="card-header">Progres Tim</h5>
                  <div class="card-body">
                    <p id="chart-status" class="text-center chart-status"></p>
                    <canvas id="project" class="chartjs mb-4" data-height="267"
                      style="display: block; box-sizing: border-box; height: 200px; width: 200px;"></canvas>
                    <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1">
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
                        Project
                      </div>
                      <div class="d-flex flex-column mt-1">
                        <span>Tanggal Mulai :
                          {{ $project->created_at->translatedFormat('l, d F Y') }}</span>
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
                              class="rounded-circle mb-3" style="width: 90px; height: 90px; object-fit: cover">
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
                                <span class="badge bg-label-warning">Pre Mini
                                  Project</span>
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
                            <span><span id="dayLeft">{{ $day['dayleft'] }}</span> dari
                              <span id="total">{{ $day['totalDeadline'] }}</span>
                              Hari</span>
                          </div>
                          <div class="d-flex flex-grow-1 align-items-center my-1">
                            <div class="progress w-100 me-3" style="height:8px;background-color: gainsboro">
                              <div class="progress-bar bg-primary" role="progressbar"
                                style="width: {{ $day['progresspercent'] }}%"
                                aria-valuenow="{{ $day['progresspercent'] }}" aria-valuemin="0" aria-valuemax="100">
                              </div>
                            </div>
                            <span class="text-muted"><span
                                id="textPercent">{{ $day['progresspercent'] }}</span>%</span>
                          </div>
                          <div class="tenggat">
                            <span>Tenggat kurang <span id="dayleft">{{ $day['dayleft'] }}</span>
                              hari
                              lagi</span>
                          </div>
                        </div>
                        <div class="link mt-2">
                          <div class="title text-dark">
                            Link Repository :
                          </div>
                          <a href="{{ $project->tim->repository }}" id="repository" target="_blank"><span
                              class="text-blue" id="text-repo">{{ $project->tim->repository }}</span></a>
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
          {{-- Anggota Tab --}}
          <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
            <div class="container">
              <div class="row">
                <div class="card cursor-default col-12 d-flex align-items-center justify-content-center">
                  <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <img src="{{ asset('storage/' . $project->tim->logo) }}" style="object-fit: cover" width="90px"
                      height="90px" class="rounded-circle" alt="">
                    <h1 class="mt-2">{{ $project->tim->nama }}</h1>
                  </div>
                </div>
              </div>
              <div class="row mt-2 justify-content-center align-items-center grid">
                @foreach ($project->tim->anggota_profile() as $data)
                  <div class="col-lg-4 p-2" style="box-shadow: none">
                    <div class="card">
                      <div class="card-body d-flex gap-3 align-items-center">
                        <div>
                          <img width="30px" height="30px" class="rounded-circle object-cover"
                            src="{{ $data->user->avatar ? asset('storage/' . $data->user->avatar) : asset('assets/img/avatars/1.png') }}"
                            alt="">
                        </div>
                        <div>
                          <h5 class="mb-0" style="font-size: 15px">
                            {{ $data->user->username }}</h5>
                          @if ($data->status == 'active')
                            <span class="badge bg-label-warning">{{ $data->jabatan->nama_jabatan }}</span>
                          @elseif ($data->status == 'kicked')
                            <span class="badge bg-label-danger">Mantan anggota </span>
                          @endif
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
          {{-- Catatan Tab --}}
          <div class="tab-pane fade" id="navs-pills-catatan" role="tabpanel">
            <div class="w-100 card p-3">
              <div class="d-flex align-items-start w-100">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist"
                  aria-orientation="vertical">
                  @if ($catatan)
                    @foreach ($catatan as $index => $catatanItem)
                      <button class="nav-link text-truncate d-inline-block mb-2 {{ $loop->index == 0 ? 'active' : '' }}"
                        style="max-width: 150px" id="v-pills-{{ $catatanItem->id }}-tab" data-bs-toggle="pill"
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
                    <div class="tab-pane fade {{ $loop->index == 0 ? 'show active' : '' }}"
                      id="v-pills-{{ $catatanTab->id }}" role="tabpanel"
                      aria-labelledby="v-pills-{{ $catatanTab->id }}-tab" tabindex="0">
                      <div class="w-100">
                        <form action="{{ route('mentor.update.catatan', $project->code) }}" method="POST">
                          @method('PUT')
                          @csrf
                          <div class="form-repeater d-flex flex-column justify-content-center align-items-center">
                            <input type="hidden" name="tim_id" value="{{ $catatanTab->tim_id }}">
                            @forelse ($catatanTab->catatanDetail as $i => $data)
                              @php
                                $hideDeleteButton = count($catatanTab->catatanDetail) === 1;
                              @endphp
                              <div class="form-add row mb-3 w-100">
                                <div class="col-11 col-md-{{ $hideDeleteButton ? '12' : '11' }}">
                                  <label for="catatan" class="mb-2 form-label">Catatan
                                    {{ ++$i }}</label>
                                  <input type="text" value="{{ $data->catatan_text }}" name="catatan_text[]"
                                    class="form-control">
                                  <input type="hidden" name="id[]" value="{{ $data->id }}">
                                </div>
                                <div class="col-1 col-md-1 d-flex align-items-end">
                                  @unless ($hideDeleteButton)
                                    <button type="submit" data-id="{{ $data->id }}"
                                      class="btn btn-icon btn-delete-catatan d-flex justify-content-center align-items-center btn-label-danger mx-2 waves-effect me-3">
                                      <i class="ti ti-trash text-danger"></i>
                                    </button>
                                  @endunless
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
                      <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                        style="width: 250px;">
                    </div>
                    <p class="text-center mb-5 mt-2">Tim ini tidak memiliki catatan ! <i class="ti ti-address-book-off"></i></p>
                  @endforelse
                </div>
              </div>
            </div>
          </div>
          {{-- Board Tab --}}
          <div class="tab-pane fade" id="navs-pills-board" role="tabpanel">
            <div style="height: 80vh" class="container-fluid mt-2">
              <div class="d-flex mt-3 mb-0  row hide-sroll" style="height: 83vh">
                <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                  <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                    class="p-2  rounded">
                    <div style="width:100%" class="card card-status-tugas">
                      <div class="card-body p-2 py-2 row justify-content-between">
                        <span class="col-8">Tugas baru</span>
                      </div>
                    </div>
                    @forelse ($board['boardTugasBaru'] as $item)
                      <div class="col-12 d-flex justify-content-center">
                        <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                          id="tugas_baru">
                          <div id="board-{{ $item->code }}" class="col-12 p-2 mt-3 card" style="width: 100%;">
                            <div>
                              <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                <div class="d-flex align-items-center gap-2">
                                  <div class="item-badges">
                                    @switch($item->prioritas)
                                      @case('mendesak')
                                        <div class="badge rounded-pill bg-label-danger">
                                          {{ $item->prioritas }}
                                        </div>
                                      @break

                                      @case('penting')
                                        <div class="badge rounded-pill bg-label-warning">
                                          {{ $item->prioritas }}
                                        </div>
                                      @break

                                      @case('biasa')
                                        <div class="badge rounded-pill bg-label-info">
                                          {{ $item->prioritas }}
                                        </div>
                                      @break

                                      @case('tambahan')
                                        <div class="badge rounded-pill bg-label-primary">
                                          {{ $item->prioritas }}
                                        </div>
                                      @break

                                      @default
                                        <div class="badge rounded-pill bg-label-secondary">
                                          {{ $item->prioritas }}
                                        </div>
                                    @endswitch
                                  </div>
                                  @php
                                    $deadline = \Carbon\Carbon::parse($item->deadline);
                                    $now = \Carbon\Carbon::now()->startOfDay();
                                    $diffInDays = $deadline->diffInDays($now);
                                  @endphp

                                  @if ($diffInDays == 0)
                                    Hari ini
                                  @elseif ($diffInDays > 0)
                                    {{ $diffInDays }} hari lagi
                                  @else
                                    {{ abs($diffInDays) }} hari terlewat
                                  @endif
                                </div>
                              </div>
                              <span class="kanban-text">{{ $item->nama }}</span>
                              <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                <div class="d-flex">
                                  <span class="d-flex align-items-center ms-1">
                                    <i class="ti ti-message-dots ti-xs me-1"></i>
                                    <span>{{ $item->comments->count() }}</span>
                                  </span>
                                </div>
                                <div class="avatar-group d-flex align-items-center assigned-avatar">
                                  @if ($project->tim->status_tim !== 'solo')
                                    @foreach ($item->user as $data)
                                      <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="{{ $data->username }}"
                                        data-bs-original-title="{{ $data->username }}">
                                        <img style="object-fit: cover;"
                                          src="{{ $data->avatar ? Storage::url($data->avatar) : asset('assets/img/avatars/1.png') }}"
                                          alt="Avatar" class="rounded-circle pull-up">
                                      </div>
                                    @endforeach
                                  @else
                                    @foreach ($item->user as $data)
                                      <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                        aria-label="{{ $data->username }}"
                                        data-bs-original-title="{{ $data->username }}">
                                        <img style="object-fit: cover;"
                                          src="{{ $data->avatar ? Storage::url($data->avatar) : asset('assets/img/avatars/1.png') }}"
                                          alt="Avatar" class="rounded-circle pull-up">
                                      </div>
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                              <div class="d-flex flex-wrap gap-1">
                                @if ($item->label)
                                  @foreach ($item->label as $item)
                                    <span class="badge"
                                      style="color: {{ $item->warna_text }} ; background-color: {{ $item->warna_bg }} ">{{ $item->text }}</span>
                                  @endforeach
                                @endif
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      @empty
                        <div class="col-12 d-flex justify-content-center">
                          <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                            id="tugas_baru">
                            <div id="board" class="col-12 p-2 mt-3 card" style="width: 100%;">
                              <div>
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                </div>
                                <span class="kanban-text">Tidak ada tugas.</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      @endforelse
                    </div>
                  </div>
                  <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                    <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                      class="p-2  rounded">
                      <div style="width:100%" class="card card-status-tugas">
                        <div class="card-body p-2 py-2 row justify-content-between">
                          <span class="col-8">Dikerjakan</span>
                        </div>
                      </div>
                      @forelse ($board['boardDikerjakan'] as $item)
                        <div class="col-12 d-flex justify-content-center">
                          <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                            id="tugas_baru">
                            <div id="board-78842ef7-83ab-43da-8404-e0c0cc750daa" class="col-12 p-2 mt-3 card"
                              style="width: 100%;">
                              <div>
                                <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                  <div class="d-flex align-items-center gap-2">
                                    <div class="item-badges">
                                      @switch($item->prioritas)
                                        @case('mendesak')
                                          <div class="badge rounded-pill bg-label-danger">
                                            {{ $item->prioritas }}
                                          </div>
                                        @break

                                        @case('penting')
                                          <div class="badge rounded-pill bg-label-warning">
                                            {{ $item->prioritas }}
                                          </div>
                                        @break

                                        @case('biasa')
                                          <div class="badge rounded-pill bg-label-info">
                                            {{ $item->prioritas }}
                                          </div>
                                        @break

                                        @case('tambahan')
                                          <div class="badge rounded-pill bg-label-primary">
                                            {{ $item->prioritas }}
                                          </div>
                                        @break

                                        @default
                                          <div class="badge rounded-pill bg-label-secondary">
                                            {{ $item->prioritas }}
                                          </div>
                                      @endswitch
                                    </div>
                                    @php
                                      $deadline = \Carbon\Carbon::parse($item->deadline);
                                      $now = \Carbon\Carbon::now()->startOfDay();
                                      $diffInDays = $deadline->diffInDays($now);
                                    @endphp

                                    @if ($diffInDays == 0)
                                      Hari ini
                                    @elseif ($diffInDays > 0)
                                      {{ $diffInDays }} hari lagi
                                    @else
                                      {{ abs($diffInDays) }} hari terlewat
                                    @endif
                                  </div>
                                </div>
                                <span class="kanban-text">{{ $item->nama }}</span>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                  <div class="d-flex">
                                    <span class="d-flex align-items-center ms-1">
                                      <i class="ti ti-message-dots ti-xs me-1"></i>
                                      <span>{{ $item->comments->count() }}</span>
                                    </span>
                                  </div>
                                  <div class="avatar-group d-flex align-items-center assigned-avatar">
                                    @if ($project->tim->status_tim !== 'solo')
                                      @foreach ($item->user as $item)
                                        <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                          aria-label="{{ $item->username }}"
                                          data-bs-original-title="{{ $item->username }}">
                                          <img style="object-fit: cover;"
                                            src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                            alt="Avatar" class="rounded-circle pull-up">
                                        </div>
                                      @endforeach
                                    @else
                                      @foreach ($item->user as $item)
                                        <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                          aria-label="{{ $item->username }}"
                                          data-bs-original-title="{{ $item->username }}">
                                          <img style="object-fit: cover;"
                                            src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                            alt="Avatar" class="rounded-circle pull-up">
                                        </div>
                                      @endforeach
                                    @endif
                                  </div>
                                </div>
                                <div class="d-flex flex-wrap gap-1">
                                  @if ($item->label)
                                    @foreach ($item->label as $item)
                                      <span class="badge"
                                        style="color: {{ $item->warna_text }} ; background-color: {{ $item->warna_bg }} ">{{ $item->text }}</span>
                                    @endforeach
                                  @endif
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        @empty
                          <div class="col-12 d-flex justify-content-center">
                            <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                              id="tugas_baru">
                              <div id="board" class="col-12 p-2 mt-3 card" style="width: 100%;">
                                <div>
                                  <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                  </div>
                                  <span class="kanban-text">Tidak ada tugas.</span>
                                  <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endforelse
                      </div>
                    </div>
                    <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                      <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                        class="p-2  rounded">
                        <div style="width:100%" class="card card-status-tugas">
                          <div class="card-body p-2 py-2 row justify-content-between">
                            <span class="col-8">Direvisi</span>
                          </div>
                        </div>
                        @forelse ($board['boardRevisi'] as $item)
                          <div class="col-12 d-flex justify-content-center">
                            <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                              id="tugas_baru">
                              <div id="board-78842ef7-83ab-43da-8404-e0c0cc750daa" class="col-12 p-2 mt-3 card"
                                style="width: 100%;">
                                <div>
                                  <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    <div class="d-flex align-items-center gap-2">
                                      <div class="item-badges">
                                        @switch($item->prioritas)
                                          @case('mendesak')
                                            <div class="badge rounded-pill bg-label-danger">
                                              {{ $item->prioritas }}
                                            </div>
                                          @break

                                          @case('penting')
                                            <div class="badge rounded-pill bg-label-warning">
                                              {{ $item->prioritas }}
                                            </div>
                                          @break

                                          @case('biasa')
                                            <div class="badge rounded-pill bg-label-info">
                                              {{ $item->prioritas }}
                                            </div>
                                          @break

                                          @case('tambahan')
                                            <div class="badge rounded-pill bg-label-primary">
                                              {{ $item->prioritas }}
                                            </div>
                                          @break

                                          @default
                                            <div class="badge rounded-pill bg-label-secondary">
                                              {{ $item->prioritas }}
                                            </div>
                                        @endswitch
                                      </div>
                                      @php
                                        $deadline = \Carbon\Carbon::parse($item->deadline);
                                        $now = \Carbon\Carbon::now()->startOfDay();
                                        $diffInDays = $deadline->diffInDays($now);
                                      @endphp

                                      @if ($diffInDays == 0)
                                        Hari ini
                                      @elseif ($diffInDays > 0)
                                        {{ $diffInDays }} hari lagi
                                      @else
                                        {{ abs($diffInDays) }} hari terlewat
                                      @endif
                                    </div>
                                  </div>
                                  <span class="kanban-text">{{ $item->nama }}</span>
                                  <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                    <div class="d-flex">
                                      <span class="d-flex align-items-center ms-1">
                                        <i class="ti ti-message-dots ti-xs me-1"></i>
                                        <span>{{ $item->comments->count() }}</span>
                                      </span>
                                    </div>
                                    <div class="avatar-group d-flex align-items-center assigned-avatar">
                                      @if ($project->tim->status_tim !== 'solo')
                                        @foreach ($item->user as $item)
                                          <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="{{ $item->username }}"
                                            data-bs-original-title="{{ $item->username }}">
                                            <img style="object-fit: cover;"
                                              src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                              alt="Avatar" class="rounded-circle pull-up">
                                          </div>
                                        @endforeach
                                      @else
                                        @foreach ($item->user as $item)
                                          <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                            aria-label="{{ $item->username }}"
                                            data-bs-original-title="{{ $item->username }}">
                                            <img style="object-fit: cover;"
                                              src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                              alt="Avatar" class="rounded-circle pull-up">
                                          </div>
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                                  <div class="d-flex flex-wrap gap-1">
                                    @if ($item->label)
                                      @foreach ($item->label as $item)
                                        <span class="badge"
                                          style="color: {{ $item->warna_text }} ; background-color: {{ $item->warna_bg }} ">{{ $item->text }}</span>
                                      @endforeach
                                    @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          @empty
                            <div class="col-12 d-flex justify-content-center">
                              <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                                id="tugas_baru">
                                <div id="board" class="col-12 p-2 mt-3 card" style="width: 100%;">
                                  <div>
                                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                    </div>
                                    <span class="kanban-text">Tidak ada tugas.</span>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endforelse
                        </div>
                      </div>
                      <div style="" class="col-lg-3 col-md-6 col-12 py-2   ">
                        <div style="max-height: 80vh; overflow:auto; overflow-x:hidden;background-color: #edeaea"
                          class="p-2  rounded">
                          <div style="width:100%" class="card card-status-tugas">
                            <div class="card-body p-2 py-2 row justify-content-between">
                              <span class="col-8">Selesai</span>
                            </div>
                          </div>
                          @forelse ($board['boardSelesai'] as $item)
                            <div class="col-12 d-flex justify-content-center">
                              <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                                id="tugas_baru">
                                <div id="board-78842ef7-83ab-43da-8404-e0c0cc750daa" class="col-12 p-2 mt-3 card"
                                  style="width: 100%;">
                                  <div>
                                    <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                      <div class="d-flex align-items-center gap-2">
                                        <div class="item-badges">
                                          @switch($item->prioritas)
                                            @case('mendesak')
                                              <div class="badge rounded-pill bg-label-danger">
                                                {{ $item->prioritas }}
                                              </div>
                                            @break

                                            @case('penting')
                                              <div class="badge rounded-pill bg-label-warning">
                                                {{ $item->prioritas }}
                                              </div>
                                            @break

                                            @case('biasa')
                                              <div class="badge rounded-pill bg-label-info">
                                                {{ $item->prioritas }}
                                              </div>
                                            @break

                                            @case('tambahan')
                                              <div class="badge rounded-pill bg-label-primary">
                                                {{ $item->prioritas }}
                                              </div>
                                            @break

                                            @default
                                              <div class="badge rounded-pill bg-label-secondary">
                                                {{ $item->prioritas }}
                                              </div>
                                          @endswitch
                                        </div>
                                        @php
                                          $deadline = \Carbon\Carbon::parse($item->deadline);
                                          $now = \Carbon\Carbon::now()->startOfDay();
                                          $diffInDays = $deadline->diffInDays($now);
                                        @endphp

                                        @if ($diffInDays == 0)
                                          Hari ini
                                        @elseif ($diffInDays > 0)
                                          {{ $diffInDays }} hari lagi
                                        @else
                                          {{ abs($diffInDays) }} hari terlewat
                                        @endif
                                      </div>
                                    </div>
                                    <span class="kanban-text">{{ $item->nama }}</span>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                      <div class="d-flex">
                                        <span class="d-flex align-items-center ms-1">
                                          <i class="ti ti-message-dots ti-xs me-1"></i>
                                          <span>{{ $item->comments->count() }}</span>
                                        </span>
                                      </div>
                                      <div class="avatar-group d-flex align-items-center assigned-avatar">
                                        @if ($project->tim->status_tim !== 'solo')
                                          @foreach ($item->user as $item)
                                            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                              aria-label="{{ $item->username }}"
                                              data-bs-original-title="{{ $item->username }}">
                                              <img style="object-fit: cover;"
                                                src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                                alt="Avatar" class="rounded-circle pull-up">
                                            </div>
                                          @endforeach
                                        @else
                                          @foreach ($item->user as $item)
                                            <div class="avatar avatar-xs" data-bs-toggle="tooltip" data-bs-placement="top"
                                              aria-label="{{ $item->username }}"
                                              data-bs-original-title="{{ $item->username }}">
                                              <img style="object-fit: cover;"
                                                src="{{ $item->avatar ? Storage::url($item->avatar) : asset('assets/img/avatars/1.png') }}"
                                                alt="Avatar" class="rounded-circle pull-up">
                                            </div>
                                          @endforeach
                                        @endif
                                      </div>
                                    </div>
                                    <div class="d-flex flex-wrap gap-1">
                                      @if ($item->label)
                                        @foreach ($item->label as $item)
                                          <span class="badge"
                                            style="color: {{ $item->warna_text }} ; background-color: {{ $item->warna_bg }} ">{{ $item->text }}</span>
                                        @endforeach
                                      @endif
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @empty
                              <div class="col-12 d-flex justify-content-center">
                                <div class="row d-flex flex-column justify-content-center align-items-center w-100"
                                  id="tugas_baru">
                                  <div id="board" class="col-12 p-2 mt-3 card" style="width: 100%;">
                                    <div>
                                      <div class="d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1">
                                      </div>
                                      <span class="kanban-text">Tidak ada tugas.</span>
                                      <div class="d-flex justify-content-between align-items-center flex-wrap mt-2 pt-1">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            @endforelse
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
          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

          <script>
            var i = 0;
            $('#tambahCatatan').click(function() {
              ++i;
              $('.form-repeater').append(
                `<div class="form-add row mb-3 w-100">
                <div class="col-11 col-md-11">
                    <label for="catatan" class="mb-2 form-label">Catatan Baru</label>
                    <input type="text" name="catatan_text[]" class="form-control">
                    <input type="hidden" name="id[]" value="0">
                </div>
                <div class="col-1 col-md-1 d-flex align-items-end">
                    <button type="button" class="btn btn-icon btn-danger button-delete-repeater">
                    <i class="ti ti-trash text-white"></i></button>
                </div>
            </div>
            `)
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
                  Swal.fire({
                    icon: 'success',
                    title: 'Terhapus!',
                    text: 'Catatan berhasil dihapus.',
                    showConfirmButton: false,
                    timer: 3000
                  });
                }
              });
            });

            $(document).on('click', '.btn-delete-catatan', function(event) {
              event.preventDefault();
              var catatanDetailId = $(this).data('id');
              var csrfToken = $('meta[name="csrf-token"]').attr('content');
              var $formCatatanRepeater = $(this).parents('.form-add');

              swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin ingin menghapus baris catatan ini?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
              }).then(function(result) {
                if (result.isConfirmed) {
                  $.ajax({
                    url: '/mentor/catatan/delete/mentor/' + catatanDetailId,
                    type: 'DELETE',
                    headers: {
                      'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                      var remainingForms = $formCatatanRepeater.siblings('.form-add').length;

                      if (remainingForms === 1) {
                        $('.btn-delete-catatan').remove();
                      };

                      $formCatatanRepeater.remove();

                      Swal.fire({
                        icon: 'success',
                        title: 'Terhapus!',
                        text: 'Catatan berhasil dihapus.',
                        showConfirmButton: false,
                        timer: 3000
                      });
                    },
                    error: function(error) {
                      console.log(error.responseJSON.message);
                    }
                  });
                }
              });
            });
          </script>

          {{-- pie chart --}}
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              const cardColor = 'grey';
              const headingColor = '#FDAC34';
              const black = '#fff';

              const doughnutChart = document.getElementById('project');
              const chartStatus = document.querySelector('.chart-status');

              if (doughnutChart) {
                const processedData = @json($chartData);

                const labels = processedData.map(data => data[0]);
                const values = processedData.map(data => data[1]);

                const doughnutChartVar = new Chart(doughnutChart, {
                  type: 'doughnut',
                  data: {
                    labels: labels,
                    datasets: [{
                      data: values,
                      backgroundColor: [cardColor, '#F9ED69', '#F08A5D', '#B83B5E',
                        '#6A2C70'
                      ],
                      hoverOffset: 4
                    }]
                  },
                  options: {
                    responsive: true,
                    animation: {
                      duration: 500
                    },
                    plugins: {
                      legend: {
                        display: false
                      },
                      tooltip: {
                        callbacks: {
                          label: function(context) {
                            const label = context.label || '';
                            const value = context.parsed;
                            const output = ' ' + label + ' : ' + value;
                            return output;
                          }
                        },
                        backgroundColor: cardColor,
                        titleColor: black,
                        bodyColor: black,
                        borderWidth: 1,
                        borderColor: cardColor,
                        afterLabel: function(context) {
                          const datasetIndex = context.datasetIndex;
                          const dataIndex = context.dataIndex;
                          const data = doughnutChartVar.data.datasets[datasetIndex].data;
                          const label = doughnutChartVar.data.labels[dataIndex];
                          const value = data[dataIndex];

                          // Menampilkan jumlah saat kursor mengarah ke elemen chart
                          return `Jumlah ${label}: ${value}`;
                        }
                      }
                    }
                  }
                });

                if (values.slice(1).every(value => value === 0)) {

                  chartStatus.style.display = 'block';
                  doughnutChart.style.display = 'none';
                  const img = document.createElement('img');
                  img.src = '{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}';
                  img.alt = 'Belum Ada Tugas';
                  img.style.width = '200px';

                  const h6Text = 'Tidak Ada Tugas <i class="ti ti-address-book-off"></i>';
                  const h6Element = document.createElement('h6');
                  h6Element.classList.add('text-center', 'mt-4');
                  h6Element.innerHTML = h6Text;

                  chartStatus.innerHTML = '';
                  chartStatus.appendChild(h6Element);
                  chartStatus.appendChild(img);
                } else {
                  chartStatus.style.display = 'none';
                  doughnutChart.style.display = 'block';
                  chartStatus.textContent = '';
                }
              }
            });
          </script>
        @endsection
