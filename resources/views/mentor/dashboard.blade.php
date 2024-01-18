@extends('layoutsMentor.app')

@section('content')
  <div class="container-fluid mt-3">
    <h5 class="mt-3 fs-4">Dashboard Mentor</h5>
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card mb-4">
          <div class="card-body m-0">
            <h5 class="pb-0">Atur Jadwal Presentasi</h5>
            <ul class="nav nav-pills bg-light rounded" role="tablist">
              <li class="nav-item">
                <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Monday' || \Carbon\Carbon::now()->format('l') === 'Saturday' || \Carbon\Carbon::now()->format('l') === 'Sunday' ? 'active' : '' }}"
                  data-bs-toggle="tab" href="#senin" role="tab">Senin</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Tuesday' ? 'active' : '' }}"
                  data-bs-toggle="tab" href="#selasa" role="tab">Selasa</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Wednesday' ? 'active' : '' }}"
                  data-bs-toggle="tab" href="#rabu" role="tab">Rabu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Thursday' ? 'active' : '' }}"
                  data-bs-toggle="tab" href="#kamis" role="tab">Kamis</a>
              </li>
              <li class="nav-item">
                <a class="nav-link {{ \Carbon\Carbon::now()->format('l') === 'Friday' ? 'active' : '' }}"
                  data-bs-toggle="tab" href="#jumat" role="tab">Jumat</a>
              </li>
            </ul>
            <div class="tab-content mt-3">
              @if ($errors->any())
                <script>
                  $(document).ready(function() {
                    let errorText = '';
                    @foreach ($errors->all() as $error)
                      errorText += '{{ $error }}\n';
                    @endforeach

                    Swal.fire({
                      icon: 'error',
                      title: 'Gagal',
                      text: errorText.trim(),
                      timer: 4000,
                      showConfirmButton: false
                    });
                  });
                </script>
              @endif
              <div
                class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Monday' || \Carbon\Carbon::now()->format('l') === 'Saturday' || \Carbon\Carbon::now()->format('l') === 'Sunday' ? 'show active' : '' }}"
                id="senin" role="tabpanel">
                <form id="form-senin" class="form-senin" action="{{ route('presentasi-divisi-create-jam.store') }}"
                  method="POST">
                  @csrf
                  <input type="hidden" name="presentasi_divisi_id" value="{{ $senin->id ?? '' }}">
                  <div id="form-repeater">
                    <div class="d-flex justify-content-end mb-2">
                      <button class="btn btn-primary" type="button" id="buttonSettings" data-bs-toggle="modal"
                        data-bs-target="#modalLimit">Setting Limit</button>
                    </div>
                    @if ($senin)
                      @for ($i = 0; $i < (int) $senin->limit; $i++)
                        <div class="row align-items-center">
                          <input name="day" type="hidden" value="monday">
                          <input type="hidden" name="jadwal_ke[]"
                            value="{{ old('jadwal_ke' . $i, 'Jadwal ke - ' . ($i + 1)) }}">
                          <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                            <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                              Jadwal Ke {{ $i + 1 }}
                            </p>
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="mulai[]"
                              value="{{ old('mulai.' . $i, $senin->limitPresentasiDivisis[$i]->mulai ?? '') }}"
                              class="form-control" />
                          </div>
                          <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                            -
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="akhir[]"
                              value="{{ old('akhir.' . $i, $senin->limitPresentasiDivisis[$i]->akhir ?? '') }}"
                              class="form-control" />
                          </div>
                        </div>
                      @endfor
                    @else
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Setting Limit Terlebih dahulu ! <i
                          class="ti ti-address-book-off"></i></p>
                    @endif
                  </div>
                  <div class="mb-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Tuesday' ? 'show active' : '' }}"
                id="selasa" role="tabpanel">
                <form id="form-selasa" class="form-selasa" action="{{ route('presentasi-divisi-create-jam.store') }}"
                  method="POST">
                  @csrf
                  <input type="hidden" name="presentasi_divisi_id" value="{{ $selasa->id ?? '' }}">
                  <div id="form-repeater">
                    <div class="d-flex justify-content-end mb-2">
                      <button class="btn btn-primary" type="button" id="buttonSettings" data-bs-toggle="modal"
                        data-bs-target="#modalLimitSelasa">Setting
                        Limit</button>
                    </div>
                    @if ($selasa)
                      @for ($i = 0; $i < (int) $selasa->limit; $i++)
                        <div class="row align-items-center">
                          <input name="day" type="hidden" value="tuesday">
                          <input type="hidden" name="jadwal_ke[]"
                            value="{{ old('jadwal_ke' . $i, 'Jadwal ke - ' . ($i + 1)) }}">
                          <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                            <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                              Jadwal Ke {{ $i + 1 }}
                            </p>
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="mulai[]"
                              value="{{ old('mulai.' . $i, $selasa->limitPresentasiDivisis[$i]->mulai ?? '') }}"
                              class="form-control" />
                          </div>
                          <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                            -
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="akhir[]"
                              value="{{ old('akhir.' . $i, $selasa->limitPresentasiDivisis[$i]->akhir ?? '') }}"
                              class="form-control" />
                          </div>
                        </div>
                      @endfor
                    @else
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Setting Limit Terlebih dahulu ! <i
                          class="ti ti-address-book-off"></i></p>
                    @endif
                  </div>
                  <div class="mb-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Wednesday' ? 'show active' : '' }}"
                id="rabu" role="tabpanel">
                <form id="form-rabu" class="form-rabu" action="{{ route('presentasi-divisi-create-jam.store') }}"
                  method="POST">
                  @csrf
                  <input type="hidden" name="presentasi_divisi_id" value="{{ $rabu->id ?? '' }}">
                  <div id="form-repeater">
                    <div class="d-flex justify-content-end mb-2">
                      <button class="btn btn-primary" type="button" id="buttonSettings" data-bs-toggle="modal"
                        data-bs-target="#modalLimitRabu">Setting
                        Limit</button>
                    </div>
                    @if ($rabu)
                      @for ($i = 0; $i < (int) $rabu->limit; $i++)
                        <div class="row align-items-center">
                          <input name="day" type="hidden" value="wednesday">
                          <input type="hidden" name="jadwal_ke[]"
                            value="{{ old('jadwal_ke' . $i, 'Jadwal ke - ' . ($i + 1)) }}">
                          <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                            <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                              Jadwal Ke {{ $i + 1 }}
                            </p>
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="mulai[]"
                              value="{{ old('mulai.' . $i, $rabu->limitPresentasiDivisis[$i]->mulai ?? '') }}"
                              class="form-control" />
                          </div>
                          <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                            -
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="akhir[]"
                              value="{{ old('akhir.' . $i, $rabu->limitPresentasiDivisis[$i]->akhir ?? '') }}"
                              class="form-control" />
                          </div>
                        </div>
                      @endfor
                    @else
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Setting Limit Terlebih dahulu ! <i
                          class="ti ti-address-book-off"></i></p>
                    @endif
                  </div>
                  <div class="mb-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Thursday' ? 'show active' : '' }} "
                id="kamis" role="tabpanel">
                <form id="form-kamis" class="form-kamis" action="{{ route('presentasi-divisi-create-jam.store') }}"
                  method="POST">
                  @csrf
                  <input type="hidden" name="presentasi_divisi_id" value="{{ $kamis->id ?? '' }}">
                  <div id="form-repeater">
                    <div class="d-flex justify-content-end mb-2">
                      <button class="btn btn-primary" type="button" id="buttonSettings" data-bs-toggle="modal"
                        data-bs-target="#modalLimitKamis">Setting
                        Limit</button>
                    </div>
                    @if ($kamis)
                      @for ($i = 0; $i < (int) $kamis->limit; $i++)
                        <div class="row align-items-center">
                          <input name="day" type="hidden" value="thursday">
                          <input type="hidden" name="jadwal_ke[]"
                            value="{{ old('jadwal_ke' . $i, 'Jadwal ke - ' . ($i + 1)) }}">
                          <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                            <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                              Jadwal Ke {{ $i + 1 }}
                            </p>
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="mulai[]"
                              value="{{ old('mulai.' . $i, $kamis->limitPresentasiDivisis[$i]->mulai ?? '') }}"
                              class="form-control" />
                          </div>
                          <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                            -
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="akhir[]"
                              value="{{ old('akhir.' . $i, $kamis->limitPresentasiDivisis[$i]->akhir ?? '') }}"
                              class="form-control" />
                          </div>
                        </div>
                      @endfor
                    @else
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Setting Limit Terlebih dahulu ! <i
                          class="ti ti-address-book-off"></i></p>
                    @endif
                  </div>
                  <div class="mb-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
              <div class="tab-pane {{ \Carbon\Carbon::now()->format('l') === 'Friday' ? 'show active' : '' }}"
                id="jumat" role="tabpanel">
                <form id="form-jumat" class="form-jumat" action="{{ route('presentasi-divisi-create-jam.store') }}"
                  method="POST">
                  @csrf
                  <input type="hidden" name="presentasi_divisi_id" value="{{ $jumat->id ?? '' }}">
                  <div id="form-repeater">
                    <div class="d-flex justify-content-end mb-2">
                      <button class="btn btn-primary" type="button" id="buttonSettings" data-bs-toggle="modal"
                        data-bs-target="#modalLimitJumat">Setting
                        Limit</button>
                    </div>
                    @if ($jumat)
                      @for ($i = 0; $i < (int) $jumat->limit; $i++)
                        <div class="row align-items-center">
                          <input name="day" type="hidden" value="friday">
                          <input type="hidden" name="jadwal_ke[]"
                            value="{{ old('jadwal_ke' . $i, 'Jadwal ke - ' . ($i + 1)) }}">
                          <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                            <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                              Jadwal Ke {{ $i + 1 }}
                            </p>
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="mulai[]"
                              value="{{ old('mulai.' . $i, $jumat->limitPresentasiDivisis[$i]->mulai ?? '') }}"
                              class="form-control" />
                          </div>
                          <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                            -
                          </div>
                          <div class="mb-3 col-lg-6 col-xl-4 col-12 mb-0">
                            <input type="time" name="akhir[]"
                              value="{{ old('akhir.' . $i, $jumat->limitPresentasiDivisis[$i]->akhir ?? '') }}"
                              class="form-control" />
                          </div>
                        </div>
                      @endfor
                    @else
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Setting Limit Terlebih dahulu ! <i
                          class="ti ti-address-book-off"></i></p>
                    @endif
                  </div>
                  <div class="mb-0 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-xl-12">
        <div class="card mb-4">
          <div class="card-body m-0">
            <h5 class="pb-0">Jadwal Presentasi Para Mentor</h5>
            <ul class="nav nav-pills bg-light rounded" role="tablist">
              @foreach ($divisis as $index => $divisi)
                @php
                  $slug = preg_replace('/[^a-zA-Z0-9]+/', '', strtolower($divisi->name));
                @endphp
                <li class="nav-item">
                  <a class="nav-link {{ $index == 0 ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#{{ str_replace('-', ' ', $slug) }}" role="tab">{{ $divisi->name }}</a>
                </li>
              @endforeach
            </ul>
            <div class="tab-content mt-3">
              @foreach ($divisis as $index => $divisi)
                @php
                  $slug = preg_replace('/[^a-zA-Z0-9]+/', '', strtolower($divisi->name));
                @endphp
                <div class="tab-pane {{ $index == 0 ? 'active' : '' }}" id="{{ str_replace('-', ' ', $slug) }}"
                  role="tabpanel">
                  <div class="card">
                    <select class="form-select" id="filterDayTab{{ $divisi->id }}">
                      <option value="all">Semua Hari</option>
                      <option value="Senin">Senin</option>
                      <option value="Selasa">Selasa</option>
                      <option value="Rabu">Rabu</option>
                      <option value="Kamis">Kamis</option>
                      <option value="Jumat">Jumat</option>
                    </select>
                    <div class="card-body m-0">
                      @if ($errors->any())
                        <script>
                          $(document).ready(function() {
                            let errorText = '';
                            @foreach ($errors->all() as $error)
                              errorText += '{{ $error }}\n';
                            @endforeach

                            Swal.fire({
                              icon: 'error',
                              title: 'Gagal',
                              text: errorText.trim(),
                              timer: 4000,
                              showConfirmButton: false
                            });
                          });
                        </script>
                      @endif
                      <div class="table-responsive text-nowrap card-datatable">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Hari</th>
                              <th>Mulai</th>
                              <th>Sampai</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0" id="tableBody{{ $divisi->id }}">
                            @forelse ($dataPresentasi[$divisi->id] as $index => $data)
                              <tr class="dataRow">
                                <td>{{ $index + 1 }}</td>
                                <td>
                                  @if ($data->presentasiDivisi->day == 'monday')
                                    Senin
                                  @elseif($data->presentasiDivisi->day == 'tuesday')
                                    Selasa
                                  @elseif($data->presentasiDivisi->day == 'wednesday')
                                    Rabu
                                  @elseif($data->presentasiDivisi->day == 'thursday')
                                    Kamis
                                  @elseif($data->presentasiDivisi->day == 'friday')
                                    Jumat
                                  @else
                                    {{ $data->presentasiDivisi->day }}
                                  @endif
                                </td>
                                <td>{{ $data->mulai }}</td>
                                <td>{{ $data->akhir }}</td>
                              </tr>
                            @empty
                              <tr>
                                <td colspan="4">
                                  <div class="d-flex justify-content-evenly">
                                    <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt=""
                                      class="mb-0" style="width: 250px;">
                                  </div>
                                  <p class="text-center mb-0 mt-2">Tidak ada Jadwal
                                    Presentasi<i class="ti ti-address-book-off"></i>
                                  </p>
                                </td>
                              </tr>
                            @endforelse
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          $('select[id^="filterDayTab"]').on('change', function() {
            const divisiId = $(this).attr('id').replace('filterDayTab', '');
            const selectedDay = $(this).val();

            $(`#tableBody${divisiId} .dataRow`).show();

            if (selectedDay !== 'all') {
              $(`#tableBody${divisiId} .dataRow`).filter(function() {
                const rowDay = $(this).find('td:eq(1)').text()
                  .trim(); // Assuming the day is in the second <td>
                return rowDay !== selectedDay;
              }).hide();
            }
          });
        });

        $.expr[':'].contains = function(a, i, m) {
          return $(a).text().toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
        };
      </script>

      <div class="col-12 col-xl-12">
        <div class="card">
          <div class="d-flex justify-content-between mx-3 mb-1 mt-4">
            <h5 class="pb-0">Data Presentasi hari ini</h5>
            <a href="{{ route('siswa-presentasi.mentor') }}"
              class="btn btn-primary d-flex justify-content-end">Detail</a>
          </div>
          <div class="table-responsive text-nowrap card-datatable">
            @php
              $no = 1;
            @endphp
            <table id="myTable" class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Tanggal</th>
                  <th>Hari</th>
                  <th>Projek</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @forelse ($presentasi as $i => $item)
                  <tr>
                    <td>{{ $no++ }}</td>
                    <td class=""><img src="{{ asset('storage/' . $item->tim->logo) }}" alt=""
                        style="width: 40px; height: 40px; ;border-radius:50%; margin-right:5px;">
                      {{ $item->tim->nama }}
                    </td>
                    <td>{{ $jadwal[$i] }}</td>
                    <td>{{ $hari[$i] }}</td>
                    <td>{{ $item->tim->status_tim }}</td>
                    <td><span class="badge bg-label-success me-1">{{ $item->status_presentasi }}</span>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8">
                      <div class="d-flex justify-content-evenly">
                        <img src="{{ asset('assets/img/illustrations/noData2.png') }}" alt="" class="mb-0"
                          style="width: 250px;">
                      </div>
                      <p class="text-center mb-0 mt-2">Data tidak tersedia <i class="ti ti-address-book-off"></i></p>
                    </td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    {{-- Modal Presetanasi --}}
    <form action="{{ route('presentasi-divisi.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="modalLimit" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="day" value="monday">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Setting Limit Presentasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="limit" class="form-label">Limit Presentasi</label>
              <input class="form-control" type="number" id="limit" name="limit">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="{{ route('presentasi-divisi.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="modalLimitSelasa" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="day" value="tuesday">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Setting Limit Presentasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="limit" class="form-label">Limit Presentasi</label>
              <input class="form-control" type="number" id="limit" name="limit">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="{{ route('presentasi-divisi.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="modalLimitRabu" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="day" value="wednesday">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Setting Limit Presentasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="limit" class="form-label">Limit Presentasi</label>
              <input class="form-control" type="number" id="limit" name="limit">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="{{ route('presentasi-divisi.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="modalLimitKamis" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="day" value="thursday">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Setting Limit Presentasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="limit" class="form-label">Limit Presentasi</label>
              <input class="form-control" type="number" id="limit" name="limit">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>

    <form action="{{ route('presentasi-divisi.store') }}" method="POST">
      @csrf
      <div class="modal fade" id="modalLimitJumat" tabindex="-1" aria-hidden="true">
        <input type="hidden" name="day" value="friday">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalCenterTitle">Setting Limit Presentasi</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <label for="limit" class="form-label">Limit Presentasi</label>
              <input class="form-control" type="number" id="limit" name="limit">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
              <button type="submit" class="btn btn-primary" id="createButton">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <div class="row mt-3 mb-5 gy-2">
      <div class="col-12 col-lg-4 col-xxl-4 mb-4">
        <div class="card" style="height: 100%">
          <h5 class="card-header">Jumlah Tim Saat Ini</h5>
          <div class="card-body">
            <p id="statusPie" class="text-center statusPie"></p>
            <canvas id="piechart" class="chartjs mb-4 piechart mt-2" data-height="" style="height: 10px;"></canvas>
            <ul class="doughnut-legend d-flex justify-content-around ps-0 mb-2 pt-1 mt-4">
              <li class="ct-series-0 d-flex flex-column">
                <h5 class="mb-0">Big</h5>
                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                  style="background-color: #FE7BE5; height:6px;width:30px;"></span>
                <div class="text-muted"></div>
              </li>
              <li class="ct-series-1 d-flex flex-column">
                <h5 class="mb-0">Mini</h5>
                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                  style="background-color: #974EC3; height:6px; width: 30px;"></span>
                <div class="text-muted"></div>
              </li>
              <li class="ct-series-1 d-flex flex-column">
                <h5 class="mb-0">Pre-mini</h5>
                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                  style="background-color: #504099; height:6px; width:30px;"></span>
                <div class="text-muted"></div>
              </li>
              <li class="ct-series-0 d-flex flex-column">
                <h5 class="mb-0">Solo</h5>
                <span class="badge badge-dot my-2 cursor-pointer rounded-pill"
                  style="background-color: #313866; height:6px;width:30px;"></span>
                <div class="text-muted"></div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!-- /Doughnut Chart -->

      <!-- Scatter Chart -->
      <div class="col-lg-8 col-md-8 col-12 col-xxl-8 mb-4">
        <div class="card" style="height: 100%; width: 100%">
          <div class="card-header header-elements">
            <h5 class="card-title mb-0">Data Anak Magang</h5>
            <div class="card-action-element ms-auto py-0">
              {{-- <div class="dropdown">
                                <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                                    aria-expanded="false"><i class="ti ti-calendar"></i></button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Today</a>
                                    </li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Yesterday</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7
                                            Days</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            30
                                            Days</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a href="javascript:void(0);"
                                            class="dropdown-item d-flex align-items-center">Current
                                            Month</a></li>
                                    <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last
                                            Month</a></li>
                                </ul>
                            </div> --}}
              <div class="dropdown">
                <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="ti ti-calendar"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <form method="get">
                      <input type="hidden" value="{{ $currentYear }}">
                      <button type="submit"
                        class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                        Sekarang
                        <i class="ti ti-calendar-event"></i></button>
                    </form>
                  </li>
                  <li>
                    <form method="get">
                      <input type="hidden" name="year" value="{{ $year - 1 }}">
                      <button type="submit"
                        class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                        Sebelumnya
                        <i class="ti ti-calendar-minus"></i></button>
                    </form>
                  </li>
                  <li>
                    <form method="get">
                      <input type="hidden" name="year" value="{{ $year + 1 }}">
                      <button type="submit"
                        class="dropdown-item d-flex align-items-center justify-content-between">Tahun
                        Selanjutnya
                        <i class="ti ti-calendar-plus"></i></button>
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body d-flex pt-2">
            <canvas id="barChart" class="chartjs" data-height="480" style="height: 400px;"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script src="{{ asset('assets/vendor/libs/chartjs/chartjs.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/jquery/jquery1e84.js?id=0f7eb1f3a93e3e19e8505fd8c175925a') }}"></script>
  <script src="{{ asset('assets/vendor/libs/popper/popper0a73.js?id=baf82d96b7771efbcc05c3b77135d24c') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/js/bootstraped84.js?id=9a6c701557297a042348b5aea69e9b76') }}"></script> --}}
  <script src="{{ asset('assets/vendor/libs/node-waves/node-waves259f.js?id=4fae469a3ded69fb59fce3dcc14cd638') }}">
  </script>
  <script
    src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar6188.js?id=44b8e955848dc0c56597c09f6aebf89a') }}">
  </script>
  <script src="{{ asset('assets/vendor/libs/hammer/hammer2de0.js?id=0a520e103384b609e3c9eb3b732d1be8') }}"></script>
  <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead60e7.js?id=f6bda588c16867a6cc4158cb4ed37ec6') }}">
  </script>
  <script src="{{ asset('assets/vendor/js/menu2dc9.js?id=c6ce30ded4234d0c4ca0fb5f2a2990d8') }}"></script>
  <script src="{{ asset('assets/vendor/libs/autosize/autosize.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
  <script src="{{ asset('assets/vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
  <script src="{{ asset('assets/js/form-custome.js') }}"></script>
  {{-- <script src="{{ asset('assets/vendor/libs/jquery-repeater/jquery-repeater.js') }}"></script>
  <script src="{{ asset('assets/js/forms-extras.js') }}"></script> --}}

  <script>
    const cardColor = 'grey';
    const headingColor = '#FDAC34';
    const black = '#fff';

    const piechart = document.getElementById('piechart');
    const statusPie = document.getElementById('statusPie');
    const processedData = @json($chart);

    if (piechart) {
      const pie = processedData.map(data => data[0]);
      const jumlah = processedData.map(data => data[1]);

      const doughnutChartVar = new Chart(piechart, {
        type: 'doughnut',
        data: {
          labels: pie,
          datasets: [{
            data: jumlah,
            backgroundColor: [cardColor, '#313866', '#504099', '#974EC3', '#FE7BE5'],
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
                const amountDescription = label === 'Jumlah Solo' ? 'Jumlah Solo' : label ===
                  'Jumlah Pre Mini' ? 'Jumlah Pre Mini' : 'Jumlah Mini';
                return `Jumlah ${amountDescription}: ${value}`;
              }
            }
          }
        }
      });

      if (jumlah.slice(1).every(value => value === 0)) {
        statusPie.style.display = 'block';
        piechart.style.display = 'none';

        const img = document.createElement('img');
        img.src = '{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}';
        img.alt = 'Belum Ada Tim';
        img.style.width = '200px';

        const h6Text = 'Tidak Ada Tim <i class="ti ti-address-book-off"></i>';
        const h6Element = document.createElement('h6');
        h6Element.classList.add('text-center', 'mt-4');
        h6Element.innerHTML = h6Text;

        statusPie.innerHTML = '';
        statusPie.appendChild(h6Element);
        statusPie.appendChild(img);
      } else {
        statusPie.style.display = 'none';
        piechart.style.display = 'block';
        statusPie.textContent = '';
      }
    }

    let barCardColor, barHeadingColor, barLabelColor, barBorderColor, barLegendColor;
    let year = @json($year);
    let currentYear = @json($currentYear);
    var chartData = @json($chartData);

    if (chartData) {
      const barChartCanvas = document.getElementById('barChart').getContext('2d');

      const barChartVar = new Chart(barChartCanvas, {
        type: 'bar',
        data: {
          labels: chartData.map(data => data.month),
          datasets: [{
            label: 'Tim Mini',
            data: chartData.map(data => parseInt(data.mini)),
            backgroundColor: chartData.map(data => data.color),
            borderColor: 'transparent',
            maxBarThickness: 15,
            borderRadius: {
              topRight: 15,
              topLeft: 15
            }
          }, {
            label: 'Tim Premini',
            data: chartData.map(data => parseInt(data.pre_mini)),
            backgroundColor: chartData.map(data => data.piecolor),
            borderColor: 'transparent',
            maxBarThickness: 15,
            borderRadius: {
              topRight: 15,
              topLeft: 15
            }
          }, {
            label: 'Tim Big',
            data: chartData.map(data => parseInt(data.big)),
            backgroundColor: chartData.map(data => data.colors),
            borderColor: 'transparent',
            maxBarThickness: 15,
            borderRadius: {
              topRight: 15,
              topLeft: 15
            }
          }, {
            label: 'Data Akun User',
            data: chartData.map(data => parseInt(data['1'])),
            backgroundColor: chartData.map(data => data.colorwait),
            borderColor: 'transparent',
            maxBarThickness: 15,
            borderRadius: {
              topRight: 15,
              topLeft: 15
            }
          }],
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: {
            duration: 500
          },
          plugins: {
            tooltip: {
              backgroundColor: barCardColor,
              titleColor: barHeadingColor,
              bodyColor: barLegendColor,
              borderWidth: 1,
              borderColor: barBorderColor
            },
            legend: {
              display: false
            }
          },
          scales: {
            x: {
              grid: {
                color: barBorderColor,
                drawBorder: true,
                borderColor: barBorderColor
              },
              ticks: {
                color: barLabelColor
              }
            },
            y: {
              min: 0,
              max: 300,
              grid: {
                color: barBorderColor,
                drawBorder: true,
                borderColor: barBorderColor
              },
              ticks: {
                stepSize: 100,
                color: barLabelColor
              }
            }
          }
        }
      });
    }
  </script>
@endsection
