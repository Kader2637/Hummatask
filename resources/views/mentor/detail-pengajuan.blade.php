@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('content')
    <style>
        @media (max-width: 590px) {
            .content-1 {
                width: 100%;
            }

            .content-profile {
                display: flex;
                justify-items: center justify-content: center;
                align-items: center;
                align-content: center
            }

            @media (max-width: 767px) {
                .content-profile {
                    flex-direction: column;
                    gap: 0;
                    padding: 10px;
                }

                .content-profile>div {
                    width: 100%;
                    text-align: center;
                }

                .content-profile img {
                    width: 100px;
                }

                .content-profile span {
                    text-align: center;
                }
            }
        }
    </style>

    <div class="container-fluid mt-4">
        <h5 class="header">Detail Pengajuan Projek</h5>
        <div class="card">
            <div class="card-body">
                <div class="content-profile d-flex flex-wrap flex-row justify-content-between">
                    <div class="d-flex flex-row gap-3 justify-content-center">
                        <img src="{{ asset('assets/img/avatars/2.png') }}" alt class="h-auto rounded-circle mb-3">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <span class="d-block text-black fs-4">{{ $projects->tim->nama }}</span>
                            <span class="d-block">{{ $projects->tim->status_tim }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap"
                        style="display: flex; flex-direction: column; justify-items: center; align-items: center; padding: 30px 5px">
                        <span class="d-block text-black fs-5">Tanggal Pengajuan</span>
                        <span class="d-block"
                            style="font-size: 13px">{{ $projects->created_at->translatedFormat('l, j F Y') }}</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div style="display: flex; align-content: center; align-items: center;">
                        <span class="text-black fs-5">Tim</span>
                    </div>
                    <div>
                        @if ($projects->status_project == 'notapproved')
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalTerima">Terima</button>
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-row flex-wrap mt-3 justify-content-center align-content-center gap-2">
                    <!-- Anggota Tim -->
                    <div class="content-1 col-md-3 col-xl-4 col-sm-12 mb-4">
                        <div class="card h-100">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        @forelse ($projects->tim->anggota as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center mt-lg-3">
                                                        <div class="avatar me-3 avatar-sm">
                                                            <img src="{{ $item->user->avatar }}" alt="Avatar"
                                                                class="rounded-circle" />
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="mb-0">{{ $item->user->username }}</h6>
                                                            <small
                                                                class="text-truncate text-muted">{{ $item->jabatan->nama_jabatan }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td>
                                                    Data tidak ada.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/ Anggota Tim -->

                    {{-- List Tema --}}
                    <div class="content-1 col-md-7 col-xl-7 col-sm-12 mb-4">
                        <div class="card h-100">
                            <h5 class="card-header">List Tema Projek</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tema</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @forelse ($tema as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->nama_tema }}</td>
                                            @empty
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- List Tema --}}

                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Modal Tolak -->
    <div class="modal fade" id="modalTolak" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Tolak Pengajuan Projek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="alasanPenolakan" class="form-label">Alasan Penolakan</label>
                            <textarea style="resize: none" cols="1" rows="8" name="alasanPenolakan" id="alasanPenolakan"
                                class="form-control" placeholder="Beri Alasan Penolakan"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Tolak--> --}}

    <!-- Modal Terima-->
    <div class="modal fade" id="modalTerima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Terima Pengajuan Projek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('persetujuan-project', $projects->code) }}" method="POST" id="terima-project">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col mb-3">
                                <label for="select2Basic" class="form-label">Tema Projek</label>
                                <select id="select2Basic" name="temaInput" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option value="" disabled selected>Pilih Data</option>
                                    @foreach ($tema as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_tema }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="flatpickr-date" class="form-label">Tentukan Deadline (Opsional)</label>
                                <input type="text" class="form-control" placeholder="YYYY-MM-DD" name="deadlineInput"
                                    id="flatpickr-date" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Validasi --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ajukanModal = document.getElementById('terima-project');
            console.log(ajukanModal);

            ajukanModal.addEventListener('submit', function(event) {
                console.log('kontol');
                const temaInput = document.querySelector('select[name="temaInput"]');
                const deadlineInput = document.querySelector('input[name="deadlineInput"]');
                console.log(temaInput.value.trim);
                console.log(deadlineInput.value.trim);


                // Validasi input kosong
                if (temaInput.value.trim() === '') {
                    event.preventDefault(); // Mencegah pengiriman formulir
                    Swal.fire({
                        icon: 'warning',
                        title: 'Peringatan',
                        text: 'Inputkan Tema Project!',
                    });
                    return;
                }
            });
        });
    </script>
    {{-- Validasi --}}

    <!-- Modal Terima-->

    <!-- Modal Deskripsi Project-->
    <div class="modal fade" id="modalDeskripsi" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeskripsiTitle">Deskripsi Projek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in,
                        egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel
                        augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque
                        nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Deskripsi Project-->
@endsection

@section('script')
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
@endsection
