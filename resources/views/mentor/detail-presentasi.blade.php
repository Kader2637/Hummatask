@extends('layoutsMentor.app')

@section('style')
@endsection

@section('content')
    <div class="container-fluid mt-5 justify-content-center">
        <div class="card-header fs-5">
            Daftar Presentasi di minggu ke {{ $history->noMinggu }} bulan {{ $history->bulan }} tahun {{ $history->tahun }}
        </div>
        <div class="row mt-4">
            @forelse ($unconfirmedPresentasi as $item)
                <div class="col-md-6 col-lg-4">
                    <div class="card text-center mb-3 tim-item" data-status-tim="{{ $item->tim->status_tim }}">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $item->tim->logo) }}" alt="logo tim" class="rounded-circle mb-3"
                                style="width: 100px; height: 100px; object-fit: cover">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="d-flex align-items-center pt-1 mb-3 justify-content-center">
                                    <div class="d-flex align-items-center">
                                        <ul class="list-unstyled d-flex align-items-center avatar-group mb-0">
                                            @foreach ($item->tim->anggota_tim() as $anggota)
                                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                    data-bs-placement="bottom" title="{{ $anggota->user->username }}"
                                                    class="avatar avatar-sm pull-up">
                                                    <img class="rounded-circle"
                                                        src="{{ $anggota->user->avatar ? asset('storage/' . $anggota->user->avatar) : asset('assets/img/avatars/1.png') }}"
                                                        alt="Avatar" style="object-fit: cover">
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center mb-2 gap-2">
                                <span class="badge bg-label-warning">
                                    @if ($item->tim->status_tim == 'solo')
                                        Solo Project
                                    @elseif ($item->tim->status_tim == 'pre_mini')
                                        Pre-mini Project
                                    @elseif ($item->tim->status_tim == 'mini')
                                        Mini Project
                                    @elseif ($item->tim->status_tim == 'big')
                                        Big Project
                                    @endif
                                </span>
                                <span class="badge bg-label-primary text-capitalize">{{ $item->tim->divisi->name }}</span>
                            </div>
                            <span class="badge bg-label-primary text-capitalize">Sedang Presentasi</span>
                            <h5 class="card-title my-2 text-capitalize">{{ $item->tim->nama }}</h5>
                            <p class="card-text" data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                data-bs-placement="bottom" title="Jadwal Presentasi"> 
                                {{ $item->jadwal_ke }} {{ $item->mulai }}-{{ $item->akhir }}
                            </p>
                            <div class="d-flex justify-content-around align-items-center gap-3 mt-3">
                                <button data-bs-toggle="modal" data-bs-target="#konfirmasi-presentasi-{{ $item->code }}"
                                    class="btn btn-success w-100 confirm-btn">Konfirmasi Presentasi</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal Konfirmasi Project --}}
                <div class="modal fade" id="konfirmasi-presentasi-{{ $item->code }}" tabindex="-1"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <form id="selesaiPresentasiForm" action="{{ route('konfirmasiPresentasi', $item->code) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Selesai Presentasi</h5>
                                    <button type="button" class="btn-close" data-bs-toggle="modal"
                                        data-bs-target="#detailPresentasi" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <label for="status_revisi" class="form-label">Status Revisi</label>
                                            <div class="form-check">
                                                <input type="radio" value="selesai" name="status_revisi"
                                                    class="form-check-input" id="selesai">
                                                <label for="selesai" class="form-check-label">Selesai</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="radio" value="tidak_selesai" name="status_revisi"
                                                    class="form-check-input" id="tidak">
                                                <label for="tidak" class="form-check-label">Tidak selesai</label>
                                            </div>
                                            <label for="feedback" class="form-label mb-3">Feedback <span
                                                    class="badge bg-label-warning">Opsional</span></label>
                                            <textarea type="text" name="feedback" class="form-control" id="feedback" placeholder="Beri Feedback Presentasi"
                                                style="height: 150px; resize: none"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                        data-bs-target="#detailPresentasi">Kembali</button>
                                    <button type="submit" class="btn btn-success" data-bs-toggle="modal"
                                        data-bs-target="#detailPresentasi">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- Modal Konfirmasi Project --}}
            @empty
                <h6 class="text-center mt-4">Tidak Ada presentasi <i class="ti ti-address-book-off"></i></h6>
                <div class="mt-4 mb-3 d-flex justify-content-evenly">
                    <img src="{{ asset('assets/img/illustrations/page-misc-under-maintenance.png') }}"
                        alt="page-misc-under-maintenance" width="300" class="img-fluid">
                </div>
            @endforelse

        @endsection

        @section('script')
        @endsection
