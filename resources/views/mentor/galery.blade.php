@extends('layoutsMentor.app')
@section('style')
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;family=Playball&amp;display=swap"
        rel="stylesheet">

     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">

    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/owlcarousel/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script> --}}
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    {{-- <script src="{{ asset('js/main.js') }}"></script> --}}
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="alert alert-info alert-dismissible d-flex align-items-baseline mt-2" role="alert">
            <span class="alert-icon alert-icon-lg text-info me-2">
                <i class="ti ti-photo-heart ti-lg"></i>
            </span>
            <div class="d-flex flex-column ps-1">
                <h5 class="alert-heading mb-2">Galery</h5>
                <p class="mb-0">Halaman ini berisi data data album siswa magang</p>
                </button>
            </div>
        </div>
        <div class="d-flex card flex-md-row align-items-center justify-content-between">
            <div class=" nav nav-pills mb-3 mt-3 d-flex flex-wrap navbar-ul px-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-galery-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-galery" type="button" role="tab" aria-controls="pills-galery"
                        aria-selected="true" data-tab="1"><i class="menu-icon ti ti-album album-rounded"></i>
                        Album</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2">
                        <i class="menu-icon ti ti-address-book "></i>Logo</button>
                </li>
            </div>
        </div>
        <div class="tab-content px-0 mt-2" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-galery" role="tabpanel" aria-labelledby="pills-galery-tab"
                tabindex="0">
                <div class="container-fluid">
                    <div class="container d-flex justify-content-center mb-2 mt-3">
                        <button id="" class="btn btn-outline-primary py-2 px-4 d-xl-inline-block rounded"
                            data-bs-toggle="modal" data-bs-target="#createGalery">Tambah
                            Foto</button>
                    </div>
                </div>
                <!-- Navbar End -->
                <!-- Events Start -->
                <div class="container-fluid event py-2">
                    <div class="container">
                        <div class="tab-class text-center">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane fade show p-0 active">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4" id="galery">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4">
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100"
                                                            src="" alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href=""
                                                                data-lightbox="event-12" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100"
                                                            src="" alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href=""
                                                                data-lightbox="event-13" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Events End -->
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                tabindex="0">
                <div class="container-fluid">
                    <div class="container d-flex justify-content-center mb-2 mt-3">
                        <button id="" class="btn btn-outline-primary py-2 px-4 d-xl-inline-block rounded"
                            data-bs-toggle="modal" data-bs-target="#createLogo">Tambah
                            Logo</button>
                    </div>
                </div>
                <!-- Navbar End -->
                <!-- Events Start -->
                <div class="container-fluid event py-2">
                    <div class="container">
                        <div class="tab-class text-center">
                            <div class="tab-content">
                                <div id="tab-1" class="tab-pane fade show p-0 active">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4" id="logo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4">
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100"
                                                            src="" alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href=""
                                                                data-lightbox="event-12" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100"
                                                            src="" alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href=""
                                                                data-lightbox="event-13" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Events End -->
            </div>
        </div>
    </div>

    {{-- modal logo --}}
    <div class="modal fade" id="createLogo" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <form id="createLogoForm" data-create-logo="{{ route('logo.create') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel1">
                            Logo
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="previewImage" class="mb-3" style="width: 200px;"></div>
                        <div class="mb-3">
                            <label for="recipient-name" class="control-label">Judul :</label>
                            <input type="text" class="form-control" name="judulLogo">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="control-label">Foto :</label>
                            <input type="file" class="form-control" name="fotoLogo" id="previewImage">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- modal logo --}}

    {{-- modal create galery --}}
    <div class="modal fade" id="createGalery" tabindex="-1" aria-labelledby="exampleModalLabel2">
        <form id="createGaleryForm" data-create-route="{{ route('galery.create') }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel2">
                            Galery
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="img" class="mb-3" style="width: 200px;"></div>
                        <div class="mb-3">
                            <label for="recipient-name" class="control-label">Judul :</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="control-label">Foto :</label>
                            <input type="file" class="form-control" name="foto" id="img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- modal create galery --}}

    {{-- modal updata galery --}}
    @foreach ($galery as $item)
        <div class="modal fade" id="updateGalery{{ $item->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $item->id }}">
            <form class="updateGaleryModal" action="{{ route('galery.update', ['id' => $item->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                                Galery
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="previewImage{{ $item->id }}" class="mb-3" style="width: 200px;"></div>
                            <img src="{{ asset('storage/img/' . $item->foto) }}" alt=""
                                style="width: 100px; margin-bottom: 10px; border-radius: 5px;">
                            <div class="mb-3">
                                <label for="recipient-name" class="control-label">Judul :</label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="control-label">Foto :</label>
                                <input type="file" class="form-control" name="foto"
                                    id="previewImage{{ $item->id }}" value="{{ $item->foto }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger text-danger font-medium"
                                data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
    {{-- modal updata galery --}}

    {{-- modal update logo --}}
    @foreach ($logo as $item)
        <div class="modal fade" id="updateLogo{{ $item->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel{{ $item->id }}">
            <form class="updateLogoModal" action-logo="{{ route('logo.update', ['id' => $item->id]) }}" method="post"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex align-items-center">
                            <h4 class="modal-title" id="exampleModalLabel{{ $item->id }}">
                                Logo
                            </h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="previewImage{{ $item->id }}" class="mb-3" style="width: 200px;"></div>
                            <img src="{{ asset('storage/img/' . $item->foto) }}" alt=""
                                style="width: 100px; margin-bottom: 10px; border-radius: 5px;">
                            <div class="mb-3">
                                <label for="recipient-name" class="control-label">Judul :</label>
                                <input type="text" class="form-control" name="judul" value="{{ $item->judul }}">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="control-label">Foto :</label>
                                <input type="file" class="form-control" name="foto"
                                    id="previewImage{{ $item->id }}" value="{{ $item->foto }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-danger text-danger font-medium"
                                data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="submit" class="btn btn-success">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
    {{-- modal update logo --}}


    {{-- js galery --}}
    <script>
        $(document).ready(function() {
            var isSubmitting = false; // Flag untuk menandakan apakah sedang melakukan pengiriman data

            $('#createGaleryForm').submit(function(e) {
                e.preventDefault();

                if (isSubmitting) {
                    return; // Jika sedang melakukan pengiriman data, hentikan eksekusi lebih lanjut
                }

                isSubmitting =
                    true; // Set flag menjadi true untuk menandakan sedang melakukan pengiriman data

                var judul = $('input[name="judul"]').val();
                var foto = $('input[name="foto"]').val();

                if (!judul || !foto) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });

                    isSubmitting = false; // Set flag kembali menjadi false setelah validasi error
                    return;
                }

                var formData = new FormData($(this)[0]);

                var createGalery = $(this).data('create-route');

                $.ajax({
                    type: "POST",
                    url: createGalery,
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil menambahkan data',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Tutup modal setelah SweetAlert ditutup
                                $('#createGalery').modal('hide');

                                // Hapus class overlay yang menutupi halaman
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                window.location.reload();

                                loadGalery();
                            }
                        });
                    },
                    error: function(error) {
                        // console.error('Error:', error);
                    },
                    complete: function() {
                        isSubmitting =
                            false; // Set flag kembali menjadi false setelah pengiriman data selesai
                    }
                });
            });
        });

        function loadGalery() {
            $.ajax({
                type: "GET",
                url: "{{ route('get.galery') }}", // Gantilah dengan endpoint API yang sesuai
                success: function(data) {
                    // Ganti HTML sesuai data yang diterima dari server
                    let html = '';
                    data.galery.forEach(function(item) {
                        html += `
                            <div class="col-md-6 col-lg-3 wow bounceInUp" data-wow-delay="0.1s">
                                <div class="event-img position-relative">
                                    <img class="img-fluid rounded "
                                        src="{{ asset('storage/img/') }}/${item.foto}"
                                        alt="" width="300px" height="300px" style="object-fit:cover">
                                    <div class="event-overlay d-flex flex-column p-4">
                                        <h4 class="me-auto">${item.judul}</h4>
                                        <div class="my-auto">
                                            <a class="btn btn-outline-primary"
                                                href="{{ asset('storage/img/') }}/${item.foto}"
                                                data-lightbox="event-5"><i class="bi bi-eye"></i></a>
                                            <button type="button"
                                                class="btn btn-outline-success " data-id=""
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateGalery${item.id}"><i
                                                class="bi bi-pencil-square"></i></button>
                                            <form action="{{ route('galery.delete', ['']) }}/${item.id}" method="post" id="deleteForm${item.id}">
                                                    @method('DELETE')
                                                    @csrf
                                                <button type="button" class="btn btn-outline-danger delete-icon" data-id="${item.id}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });

                    // Set HTML di elemen #galery
                    $('#galery').html(html);
                },
                error: function(error) {
                    $('#galery').html('<p>Error: Ada kesalahan</p>');
                }
            });
        }
        $(document).ready(function() {
            loadGalery();
        })
    </script>
    {{-- js galery --}}

    {{-- edit galery --}}
    <script>
        $(document).ready(function() {
            $('.updateGaleryModal').submit(function(e) {
                e.preventDefault();

                var form = $(this); // Simpan referensi form yang sedang di-submit

                var judul = form.find('input[name="judul"]').val();
                var foto = form.find('input[name="foto"]').val();

                if (!judul.trim() || !foto) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });
                    return;
                }

                var formData = new FormData(form[0]);

                var updateGalery = form.attr('action');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: updateGalery,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil Mengubah Data',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var modalId = form.closest('.modal').attr('id');
                                $('#' + modalId).modal('hide');

                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                window.location.reload();

                                loadGalery();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // console.error('Error', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat mengubah data.',
                        });
                    },
                    complete: function(xhr, status) {
                        // console.log(xhr);
                        // console.log(status);
                    }
                });
            });
        });
    </script>
    {{-- edit galery --}}

    {{-- js logo --}}
    <script>
        $(document).ready(function() {
            var Button = false; // Flag untuk menandakan apakah sedang melakukan pengiriman data

            $('#createLogoForm').submit(function(e) {
                e.preventDefault();

                if (Button) {
                    return; // Jika sedang melakukan pengiriman data, hentikan eksekusi lebih lanjut
                }

                Button =
                    true; // Set flag menjadi true untuk menandakan sedang melakukan pengiriman data

                var judulLogo = $('input[name="judulLogo"]').val();
                var fotoLogo = $('input[name="fotoLogo"]').val();

                if (!judulLogo || !fotoLogo) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });

                    Button = false; // Set flag kembali menjadi false setelah validasi error
                    return;
                }

                var formDataLogo = new FormData($(this)[0]);

                var createLogo = $(this).data('create-logo');

                $.ajax({
                    type: "POST",
                    url: createLogo,
                    data: formDataLogo,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil menambahkan data',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Tutup modal setelah SweetAlert ditutup
                                $('#createLogo').modal('hide');

                                // Hapus class overlay yang menutupi halaman
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                window.location.reload();

                                loadLogo();
                            }
                        });
                    },
                    error: function(error) {
                        // console.error('Error:', error);
                    },
                    complete: function() {
                        Button =
                            false; // Set flag kembali menjadi false setelah pengiriman data selesai
                    }
                });
            });
        });

        function loadLogo() {
            $.ajax({
                type: "GET",
                url: "{{ route('get.galery') }}", // Gantilah dengan endpoint API yang sesuai
                success: function(data) {
                    // Ganti HTML sesuai data yang diterima dari server
                    let html = '';
                    data.logo.forEach(function(itemLogo) {
                        html += `
                            <div class="col-md-6 col-lg-3 wow bounceInUp" data-wow-delay="0.1s">
                                <div class="event-img position-relative">
                                    <img class="img-fluid rounded "
                                        src="{{ asset('storage/img/') }}/${itemLogo.foto}"
                                        alt="" width="300px" height="300px" style="object-fit:cover">
                                    <div class="event-overlay d-flex flex-column p-4">
                                        <h4 class="me-auto">${itemLogo.judul}</h4>
                                        <div class="my-auto">
                                            <a class="btn btn-outline-primary"
                                                href="{{ asset('storage/img/') }}/${itemLogo.foto}"
                                                data-lightbox="event-5"><i class="bi bi-eye"></i></a>
                                            <button type="button"
                                                class="btn btn-outline-success " data-id=""
                                                data-bs-toggle="modal"
                                                data-bs-target="#updateLogo${itemLogo.id}"><i
                                                    class="bi bi-pencil-square"></i></button>
                                            <form
                                                action="{{ route('galery.delete', ['']) }}/${itemLogo.id}"
                                                method="post" id="deleteForm${itemLogo.id}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-outline-danger delete-icon"
                                                    data-id="${itemLogo.id}"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                    });

                    // Set HTML di elemen #galery
                    $('#logo').html(html);
                },
                error: function(error) {
                    $('#logo').html('<p>Error: Ada kesalahan</p>');
                }
            });
        }
        $(document).ready(function() {
            loadLogo();
        })
    </script>
    {{-- js logo --}}

    {{-- edit logo --}}
    <script>
        $(document).ready(function() {
            $('.updateLogoModal').submit(function(e) {
                e.preventDefault();

                var form = $(this); // Simpan referensi form yang sedang di-submit

                var judul = form.find('input[name="judul"]').val();
                var foto = form.find('input[name="foto"]').val();

                if (!judul.trim() || !foto) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });
                    return;
                }

                var formData = new FormData(form[0]);

                var updateLogo = form.attr('action-logo');
                var csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: "POST",
                    url: updateLogo,
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(data) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil Mengubah Data',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                var modalId = form.closest('.modal').attr('id');
                                $('#' + modalId).modal('hide');

                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                                window.location.reload();

                                loadLogo();
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        // console.error('Error', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan saat mengubah data.',
                        });
                    },
                    complete: function(xhr, status) {
                    }
                });
            });
        });
    </script>
    {{-- edit logo --}}

    {{-- swicth alert delete --}}
    <script>
        $(document).ready(function() {
            // Menggunakan event delegation untuk tombol delete
            $(document).on('click', '.delete-icon', function(e) {
                e.preventDefault();

                let formId = $(this).data('id');
                let deleteForm = document.getElementById('deleteForm' + formId);

                Swal.fire({
                    title: 'Apakah kamu yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Hapus!',
                    customClass: {
                        cancelButton: 'btn btn-label-secondary',
                        confirmButton: 'btn btn-danger me-3',
                    },
                    buttonsStyling: false,
                }).then(function(confirmDelete) {
                    if (confirmDelete.isConfirmed) {
                        deleteForm.submit();

                        Swal.fire({
                            title: 'Success',
                            text: 'Berhasil menghapus data',
                            icon: 'success'
                        });
                    }
                });
            });
        });
    </script>
    {{-- swicth alert delete --}}
@endsection
