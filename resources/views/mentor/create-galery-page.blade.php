@extends('layoutsMentor.app')

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <span class="fs-4 text-capitalize">Tambah {{ request()->type }}</span>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Kembali</a>
                </div>
            </div>
            <div class="card-body">
                <form id="myForm"
                    action="{{ request()->type == 'album' ? route('galery.create') : route('logo.create') }}"
                    method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Judul</label>
                        <input type="text" name="judul" class="form-control" id="judul"
                            placeholder="Isi judul {{ request()->type }}">
                    </div>
                    @if (request()->type == 'album')
                        <div class="mb-3">
                            <label for="" class="form-label">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" name="keterangan" class="form-control" cols="30" rows="10"
                                placeholder="Isi keterangan {{ request()->type }}"></textarea>
                        </div>
                    @endif
                    <div class="mb-3">
                        <div class="container p-0">
                            <label for="" class="form-label">Dropzone</label>
                            <div id="dropzone" class="dropzone"></div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        Dropzone.autoDiscover = false;

        $(document).ready(function() {
            var myDropzone = new Dropzone("#dropzone", {
                url: '#',
                paramName: "file",
                maxFilesize: 10,
                acceptedFiles: ".png, .jpg, .jpeg",
                addRemoveLinks: true,
                dictDefaultMessage: "Seret file di sini atau klik untuk mengunggah",
                dictRemoveFile: "Hapus",
                dictInvalidFileType: "Jenis file ini tidak diizinkan.",
                success: function(file, response) {},
                error: function(file, response) {}
            });
            $('#myForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData($('#myForm')[0]);

                myDropzone.files.forEach(function(file) {
                    formData.append('file[]', file);
                });

                var url = $(this).attr('action');

                var judul = $('#judul').val();

                if (!judul) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Judul tidak boleh kosong.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return;
                }

                var keteranganElement = $('#keterangan');
                if (keteranganElement.length > 0) {
                    var keterangan = keteranganElement.val();

                    if (!keterangan) {
                        // Tampilkan pesan kesalahan jika keterangan kosong
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Keterangan tidak boleh kosong.',
                            showConfirmButton: false,
                            timer: 3000
                        });
                        return; // Hentikan pengiriman formulir jika ada kesalahan
                    }
                }

                if (myDropzone.files.length === 0) {
                    // Tampilkan pesan kesalahan jika Dropzone kosong
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Dropzone tidak boleh kosong.',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    return; // Hentikan pengiriman formulir jika ada kesalahan
                }

                $.ajax({
                    url: url,
                    type: 'POST', // Sesuaikan dengan metode HTTP yang sesuai
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            // Tampilkan SweetAlert dengan pesan dari response.success
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: response.success,
                                showConfirmButton: false,
                                timer: 3000
                            });

                            // Reset form
                            $('#myForm')[0].reset();

                            // Reset Dropzone
                            myDropzone.removeAllFiles();

                            // ridirek
                            window.location = '{{ route('galery') }}';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });

        });
    </script>
@endsection
