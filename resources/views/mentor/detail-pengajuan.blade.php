@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('content')
    <div class="container-fluid mt-4">
        <h5 class="header">Detail Pengajuan Projek</h5>
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap flex-row gap-4 justify-content-between">
                    <div class="d-flex flex-row gap-3">
                        <img src="{{ asset('assets/img/avatars/2.png') }}" alt class="h-auto rounded-circle mb-3">
                        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center">
                            <span class="d-block text-black fs-4">Hummatask</span>
                            <span class="d-block">Big Project</span>
                        </div>
                    </div>
                    <div
                        style="display: flex; flex-direction: column; justify-items: center; align-items: center; padding: 30px 5px">
                        <span class="d-block text-black fs-5">Tanggal Pengajuan</span>
                        <span class="d-block" style="font-size: 13px">10 Januari 2022</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div style="display: flex; align-content: center; align-items: center;">
                        <span class="text-black fs-5">Team</span>
                    </div>
                    <div>
                        <button type="button" class="btn btn-label-danger mx-2" data-bs-toggle="modal"
                            data-bs-target="#modalTolak">Tolak</button>
                        <button type="button" class="btn btn-label-success" data-bs-toggle="modal"
                            data-bs-target="#modalTerima">Terima</button>
                    </div>
                </div>
                <div class="d-flex flex-row gap-1 mt-3">
                    <!-- Anggota Tim -->
                    <div class="col-md-4 col-xl-3 mb-4">
                        <div class="card h-100">
                            <div class="table-responsive">
                                <table class="table table-borderless">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center mt-lg-3">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/1.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Maven Analytics</h6>
                                                        <small class="text-truncate text-muted">Business
                                                            Intelligence</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/2.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Zsazsa McCleverty</h6>
                                                        <small class="text-truncate text-muted">Digital
                                                            Marketing</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/3.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Nathan Wagner</h6>
                                                        <small class="text-truncate text-muted">UI/UX Design</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/4.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Emma Bowen</h6>
                                                        <small class="text-truncate text-muted">React Native</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/5.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">John Phillips</h6>
                                                        <small class="text-truncate text-muted">iOS Developer</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="https://demos.pixinvent.com/vuexy-html-laravel-admin-template/demo/assets/img/avatars/6.png"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Amy Patterson</h6>
                                                        <small class="text-truncate text-muted">Java Developer</small>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--/ Anggota Tim -->

                    {{-- List Tema --}}
                    <div class="col-md-8 col-xl-9 mb-4">
                        <div class="card h-100">
                            <h5 class="card-header">List Tema Projek</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tema</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Jual Beli Makanan</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeskripsi">Tampilkan</button></td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jual Beli Hewan</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeskripsi">Tampilkan</button></td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Jual Beli Minuman</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeskripsi">Tampilkan</button></td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Jual Beli Senjata</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeskripsi">Tampilkan</button></td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Jual Beli Buku</td>
                                            <td><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalDeskripsi">Tampilkan</button></td>
                                        </tr>
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

    <!-- Modal Tolak -->
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
    <!-- Modal Tolak-->

    <!-- Modal Terima-->
    <div class="modal fade" id="modalTerima" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Terima Pengajuan Projek</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col mb-3">
                            <label for="select2Basic" class="form-label">Tema Projek</label>
                            <select id="select2Basic" name="temaProjek" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
                                <option value="a">Jual beli Makanan</option>
                                <option value="b">Jual beli Hewan</option>
                                <option value="b">Jual beli Minuman</option>
                                <option value="b">Jual beli Senjata</option>
                                <option value="b">Jual beli Buku</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="flatpickr-date" class="form-label">Tentukan Deadline</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="flatpickr-date" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="feedback" class="form-label">Feedback</label>
                            <textarea style="resize: none" cols="1" rows="8" name="feedback" id="feedback" class="form-control"
                                placeholder="Beri Feedback (opsional)"></textarea>
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
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
                        consectetur et. Donec sed odio dui. Donec ullamcorper nulla non metus auctor fringilla.</p>
                    <p>Cras mattis consectetur purus sit amet fermentum. Cras justo odio, dapibus ac facilisis in, egestas
                        eget quam. Morbi leo risus, porta ac consectetur ac, vestibulum at eros.</p>
                    <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur et. Vivamus sagittis lacus vel augue
                        laoreet rutrum faucibus dolor auctor.</p>
                    <p>Aenean lacinia bibendum nulla sed consectetur. Praesent commodo cursus magna, vel scelerisque nisl
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
