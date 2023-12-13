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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('assets/lib/lightbox/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
@endsection

@section('content')
    {{-- tampilan album & logo --}}
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
            <div class="nav nav-pills mb-3 mt-3 d-flex justify-content-center flex-wrap navbar-ul px-3" id="pills-tab"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-galery-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-galery" type="button" role="tab" aria-controls="pills-galery"
                        aria-selected="true" data-tab="1"><i class="menu-icon ti ti-album album-rounded"></i>
                        Album Dashboard</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        type="button" role="tab" aria-controls="pills-profile" aria-selected="false" data-tab="2">
                        <i class="menu-icon ti ti-address-book "></i>Logo Sekolah</button>
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
                                            <ul class="pagination mt-3 d-flex justify-content-center" id="pagination"></ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4">
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100" src="" alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href="" data-lightbox="event-12" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100" src=""
                                                            alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href="" data-lightbox="event-13" class="my-auto"><i
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
                                            <ul class="pagination mt-3 d-flex justify-content-center" id="paginationLogo">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div id="tab-4" class="tab-pane fade show p-0">
                                    <div class="row g-4">
                                        <div class="col-lg-12">
                                            <div class="row g-4">
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100" src=""
                                                            alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href="" data-lightbox="event-12" class="my-auto"><i
                                                                    class="fas fa-search-plus text-dark fa-2x"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-3">
                                                    <div class="event-img position-relative">
                                                        <img class="img-fluid rounded w-100" src=""
                                                            alt="">
                                                        <div class="event-overlay d-flex flex-column p-4">
                                                            <h4 class="me-auto">Cocktail</h4>
                                                            <a href="" data-lightbox="event-13" class="my-auto"><i
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
    {{-- tampilan album & logo --}}

    {{-- modal create logo --}}
    <div class="modal fade" id="createLogo" tabindex="-1" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="createLogoForm" data-create-logo="{{ route('logo.create') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
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
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal create logo --}}

    {{-- modal create galery --}}
    <div class="modal fade" id="createGalery" tabindex="-1" aria-labelledby="exampleModalLabel2">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="createGaleryForm" data-create-route="{{ route('galery.create') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel2">
                            Galery
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="img" class="mb-3" style="width: 200px;"></div>
                        <div class="mb-3">
                            <label for="" class="control-label">Judul :</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Keterangan :</label>
                            <textarea name="keterangan" class="form-control" cols="5" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Foto :</label>
                            <input type="file" class="form-control" name="foto" id="img">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal create galery --}}

    {{-- modal edit galery --}}
    <div class="modal fade" id="modal-edit-galery" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-update-galery" method="put" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Galery
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="" class="mb-3" style="width: 200px;"></div>
                        <img id="logogalery" src="" alt=""
                            style="width: 100px; margin-bottom: 10px; border-radius: 5px;">
                        <div class="mb-3">
                            <label for="" class="control-label">Judul :</label>
                            <input type="text" class="form-control" name="judul" value="judul" id="judulgalery">
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Keterangan :</label>
                            <textarea name="keterangan" class="form-control" cols="5" rows="3" value="keterangan"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="" class="control-label">Foto :</label>
                            <input type="file" class="form-control" name="foto" id="logogalery" value="foto">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit galery --}}

    {{-- modal edit logo --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="form-update" method="put" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header d-flex align-items-center">
                        <h4 class="modal-title" id="exampleModalLabel">
                            Logo
                        </h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img id="logos" src="" alt=""
                            style="width: 100px; margin-bottom: 10px; border-radius: 5px;">
                        <div class="mb-3">
                            <label for="recipient-name" class="control-label">Judul :</label>
                            <input type="text" class="form-control" name="judul" id="judulLogo" value="judulLogo">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="control-label">Foto :</label>
                            <input type="file" class="form-control" name="foto" id="logos" value="fotoLogo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-danger text-danger font-medium"
                            data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit" class="btn btn-primary" id="submit-btn">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal edit logo --}}

    {{-- js get & create galery --}}
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
                var keterangan = $('textarea[name="keterangan"]').val();

                if (!judul || !foto) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });

                    isSubmitting = false; // Set flag kembali menjadi false setelah validasi error
                    return;
                }

                if (judul.length > 30) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'judul maksimal 30 karakter!',
                    });

                    isSubmitting = false;
                    return;
                }

                if (keterangan.length > 250) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'judul maksimal 250 karakter!',
                    });

                    isSubmitting = false;
                    return;
                }

                var file = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                var fotoExt = foto.substr(foto.lastIndexOf('.'));

                if (!file.exec(fotoExt)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jenis file yang diizinkan hanya jpg, jpeg, png !',
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
                        $('#createGalery').modal('hide');
                        Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Berhasil menambahkan data',
                            })

                            .then((result) => {
                                if (result.isConfirmed) {
                                    loadGalery();
                                    $('#createGaleryForm')[0].reset();
                                    // Hapus class overlay yang menutupi halaman
                                    $('body').removeClass('modal-open');
                                    $('.modal-backdrop').remove();
                                }
                            });
                    },
                    error: function(error) {
                        var errorData = response.responseJSON;
                        Swal.fire({
                            title: 'error',
                            icon: 'Error',
                            text: 'Terjadi kesalahan ' + error,
                            showConfirmButton: true,
                            timer: 2000
                        });
                    },
                    complete: function() {
                        isSubmitting =
                            false; // Set flag kembali menjadi false setelah pengiriman data selesai
                    }
                });
            });
        });

        function loadGalery(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('get.galery') }}",
                data: {
                    page: page
                },
                success: function(data) {
                    if (data.galery.data.length > 0) {
                        let html = '';
                        data.galery.data.forEach(function(item) {
                            html += `
                        <div class="col-md-6 col-lg-3 wow bounceInUp" data-wow-delay="0.1s">
                                <div class="event-img position-relative" style="width:100% !important; height: 206px !important; overflow: hidden !important;">
                                    <img class="img-fluid rounded"
                                        src="{{ asset('storage/public/img/${item.foto}') }}"
                                        alt="" style="object-fit: cover !important; width: 100% !important; height: 100% !important">
                                    <div class="event-overlay d-flex flex-column p-4">
                                        <h4 class="me-auto fs-5 fw-light" style="color: white;">${item.judul}</h4>
                                        <div class="my-auto">
                                            <a class="btn btn-primary"
                                                href="{{ asset('storage/public/img/${item.foto}') }}"
                                                data-lightbox="event-5"><i class="bi bi-eye"></i></a>
                                            <button type="button"
                                                class="btn btn-success button-edit-galery" data-idgalery="${item.id}"
                                                data-judulgalery="${item.judul}"
                                                data-keterangan="${item.keterangan}"
                                                data-fotogalery="${item.foto}"><i
                                                class="bi bi-pencil-square"></i></button>
                                            <form action="{{ route('galery.delete', ['']) }}/${item.id}" method="post" id="deleteForm${item.id}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button" class="btn btn-danger delete-icon" data-id="${item.id}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        </div>`;
                        });
                        $('#galery').html(html);
                        $('.button-edit-galery').click(function() {
                            var id = $(this).data('idgalery');
                            var judulgalery = $(this).data('judulgalery');
                            var keterangan = $(this).data('keterangan');
                            var fotogalery = $(this).data('fotogalery');

                            $('#judulgalery').val(judulgalery);
                            $('#keterangan').val(keterangan);
                            $('#fotogalery').attr('src', fotogalery);
                            $('#logogalery').attr('src', '{{ asset('storage/img/') }}/' +
                                    fotogalery)
                                .attr('alt', 'Logo')
                                .css({
                                    'width': '100px',
                                    'margin-bottom': '10px',
                                    'border-radius': '5px'
                                });

                            var formData = {
                                id: id,
                                judulgalery: judulgalery,
                                keterangan: keterangan,
                                fotogalery: fotogalery
                            };

                            setFormValues('form-update-galery', formData);
                            $('#form-update-galery').data('id', id);
                            $('#modal-edit-galery').modal('show');
                        });

                        let paginationHtml = '<nav><ul class="pagination">';

                        paginationHtml +=
                            `<li class="page-item ${data.galery.current_page === 1 ? 'disabled' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadGalery(${data.galery.current_page - 1})">Previous</a></li>`;

                        for (let i = 1; i <= data.galery.last_page; i++) {
                            paginationHtml +=
                                `<li class="page-item ${i === data.galery.current_page ? 'active' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadGalery(${i})">${i}</a></li>`;
                        }

                        paginationHtml +=
                            `<li class="page-item ${data.galery.current_page === data.galery.last_page ? 'disabled' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadGalery(${data.galery.current_page + 1})">Next</a></li>`;

                        paginationHtml += '</ul></nav>';

                        // Ubah bagian ini sesuai dengan elemen HTML yang dituju untuk menampilkan paginasi
                        document.getElementById('pagination').innerHTML = paginationHtml;
                    } else {
                        $('#galery').html(
                            '<div class="justify-content-center" style="display: flex;"><img src="{{ asset('assets/img/illustrations/noData.png') }}" alt="page-misc-under-maintenance" width="500"></div>'
                        );
                    }
                },
                error: function(error) {
                    $('#galery').html('<p>Error: Ada kesalahan</p>');
                }
            });
        }

        $(document).ready(function() {
            loadGalery();
        });
    </script>
    {{-- js get & create galery --}}

    {{-- script edit galery --}}
    <script>
        $(document).ready(function() {
            var isSubmitting = false;

            function emptyForm(formId) {
                $('#' + formId)[0].reset();
            }

            $('#form-update-galery').on('submit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                var formData = new FormData(this);

                formData.append('_method', 'PUT');

                if (isSubmitting) {
                    return; // Jika sedang melakukan pengiriman data, hentikan eksekusi lebih lanjut
                }

                isSubmitting =
                    true; // Set flag menjadi true untuk menandakan sedang melakukan pengiriman data

                var judul = $('input[value="judul"]').val();
                var keterangan = $('textarea[value="keterangan"]').val();
                var foto = $('input[value="foto"]').val();

                if (judul.length > 30) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'judul maksimal 30 karakter!',
                    });

                    isSubmitting = false;
                    return;
                }

                if (keterangan.length > 100) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'judul maksimal 100 karakter!',
                    });

                    isSubmitting = false;
                    return;
                }

                if (foto) {
                    var file = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                    var fotoExt = foto.substr(foto.lastIndexOf('.'));

                    if (!file.exec(fotoExt)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Jenis file yang diizinkan hanya jpg, jpeg, png !',
                        });
                        isSubmitting = false; // Set flag kembali menjadi false setelah validasi error
                        return;
                    }

                }



                $.ajax({
                    url: "galery-update/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil",
                            icon: "success",
                            text: "Berhasil mengubah data!",
                            showConfirmButton: false,
                            timer: 2000
                        });

                        loadGalery()
                        $('#modal-edit-galery').modal('hide');
                        emptyForm('form-update-galery');
                        console.log(response);
                    },
                    error: function(response) {
                        var errorData = response.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan' + errorData,
                            showConfirmButton: true,
                            timer: 2000
                        });
                    },
                    complete: function() {
                        isSubmitting =
                            false;
                    }
                });
            });
        });
    </script>
    {{-- script edit galery --}}

    {{-- js get & create logo --}}
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

                if (judulLogo.length > 40) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Judul maksimal 40 karakter'
                    });

                    Button = false;
                    return;
                }

                if (!judulLogo || !fotoLogo) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Pastikan data terisi semua!',
                    });

                    Button = false; // Set flag kembali menjadi false setelah validasi error
                    return;
                }

                var file = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                var fotoExt = fotoLogo.substr(fotoLogo.lastIndexOf('.'));

                if (!file.exec(fotoExt)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Jenis file yang diizinkan hanya jpg, jpeg, png !',
                    });
                    isSubmitting = false; // Set flag kembali menjadi false setelah validasi error
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
                        $('#createLogo').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Berhasil menambahkan data'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                loadLogo()
                                $('#createLogoForm')[0].reset();
                                // Hapus class overlay yang menutupi halaman
                                $('body').removeClass('modal-open');
                                $('.modal-backdrop').remove();
                            }
                        });
                    },
                    error: function(error) {
                        var errorData = response.responseJSON;
                        Swal.fire({
                            title: 'error',
                            icon: 'Error',
                            text: 'Terjadi kesalahan ' + error,
                            showConfirmButton: true,
                            timer: 2000
                        });
                    },
                    complete: function() {
                        Button =
                            false; // Set flag kembali menjadi false setelah pengiriman data selesai
                    }
                });
            });
        });
        loadLogo()

        function getDataAttributes(element) {
            var attributes = {};
            $(element).each(function() {
                $.each(this.attributes, function() {
                    if (this.specified && this.name.startsWith('data-')) {
                        var key = this.name.substr(5); // Menghapus "data-" dari awal nama atribut
                        attributes[key] = this.value;
                    }
                });
            });
            return attributes;
        }

        function setFormValues(formId, formData) {
            // Mengisi nilai-nilai input dalam formulir dengan data yang diberikan
            var form = document.getElementById(formId);
            for (var key in formData) {
                if (formData.hasOwnProperty(key)) {
                    var input = form.querySelector('[name="' + key + '"]');
                    if (input) {
                        input.value = formData[key];
                    }
                }
            }
        }

        function loadLogo(page = 1) {
            $.ajax({
                type: "GET",
                url: "{{ route('get.galery') }}",
                data: {
                    page: page
                },
                success: function(data) {
                    // Ganti HTML sesuai data yang diterima dari server
                    if (data.logo.data.length > 0) {
                        let html = '';
                        data.logo.data.forEach(function(itemLogo) {
                            html += `
                            <div class="col-md-6 col-lg-3 wow bounceInUp" data-wow-delay="0.1s">
                                <div class="event-img position-relative" style="width:100% !important; height: 206px !important; overflow: hidden !important;">
                                    <img class="img-fluid rounded "
                                        src="{{ asset('storage/public/img/${itemLogo.foto}') }}"
                                        alt="" style="object-fit: cover !important; width: 100% !important; height: 100% !important">
                                    <div class="event-overlay d-flex flex-column p-4">
                                        <h4 class="me-auto fs-5 fw-light" style="color: white;">${itemLogo.judul}</h4>
                                        <div class="my-auto">
                                            <a class="btn btn-primary"
                                                href="{{ asset('storage/public/img/${itemLogo.foto}') }}"
                                                data-lightbox="event-5"><i class="bi bi-eye"></i></a>
                                                <button type="button"
                                                class="btn btn-success button-edit"
                                                id="${itemLogo.id}"
                                                data-id="${itemLogo.id}"
                                                data-judullogo="${itemLogo.judul}"
                                                data-fotologo="${itemLogo.foto}">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            <form action="{{ route('galery.delete', '') }}/${itemLogo.id}" method="post" id="deleteForm${itemLogo.id}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="button"
                                                    class="btn btn-danger delete-icon"
                                                    data-id="${itemLogo.id}"><i
                                                        class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
                        });
                        $('#logo').html(html);
                        $('.button-edit').click(function() {
                            var id = $(this).data('id');
                            var judullogo = $(this).data('judullogo');
                            var fotologo = $(this).data('fotologo');

                            $('#judulLogo').val(judullogo);
                            $('#fotoLogo').attr('src', fotologo);
                            $('#logos').attr('src', '{{ asset('storage/img/') }}/' + fotologo)
                                .attr('alt', 'Logo')
                                .css({
                                    'width': '100px',
                                    'margin-bottom': '10px',
                                    'border-radius': '5px'
                                });

                            var formData = {
                                id: id,
                                judullogo: judullogo,
                                fotologo: fotologo
                            };

                            setFormValues('form-update', formData);
                            $('#form-update').data('id', id);
                            $('#modal-edit').modal('show');
                        });

                        let paginate = '<nav><ul class="pagination">';

                        paginate +=
                            `<li class="page-item ${data.logo.current_page === 1 ? 'disabled' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadLogo(${data.logo.current_page - 1})">Previous</a></li>`;

                        for (let B = 1; B <= data.logo.last_page; B++) {
                            paginate +=
                                `<li class="page-item ${B === data.logo.current_page ? 'active' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadLogo(${B})">${B}</a></li>`;
                        }

                        paginate +=
                            `<li class="page-item ${data.logo.current_page === data.logo.last_page ? 'disabled' : ''}"><a class="page-link" href="javascript:void(0)" onclick="loadLogo(${data.logo.current_page + 1})">Next</a></li>`;

                        paginate += '</ul></nav>';

                        // Ubah bagian ini sesuai dengan elemen HTML yang dituju untuk menampilkan paginasi
                        document.getElementById('paginationLogo').innerHTML = paginate;

                    } else {
                        $('#logo').html(
                            '<div class="justify-content-center" style="display: flex;"><img src="{{ asset('assets/img/illustrations/noData.png') }}" alt="page-misc-under-maintenance" width="500"></div>'
                        );
                    }
                    // Set HTML di elemen #galery
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
    {{-- js get & create logo --}}

    {{-- script edit logo --}}
    <script>
        $(document).ready(function() {
            var isSubmitting = false;

            function emptyForm(id) {
                $('#' + id)[0].reset();
            }
            $('#form-update').on('submit', function(e) {
                e.preventDefault();
                const id = $(this).data('id');
                var formData = new FormData(this);

                formData.append('_method', 'PUT');

                if (isSubmitting) {
                    return; // Jika sedang melakukan pengiriman data, hentikan eksekusi lebih lanjut
                }

                isSubmitting =
                    true; // Set flag menjadi true untuk menandakan sedang melakukan pengiriman data

                var judulLogo = $('input[value="judulLogo"]').val();
                var fotoLogo = $('input[value="fotoLogo"]').val();

                if (judulLogo.length > 40) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'judul maksimal 40 karakter!',
                    });

                    isSubmitting = false;
                    return;
                }

                if (fotoLogo) {
                    var fileLogo = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
                    var Logo = fotoLogo.substr(fotoLogo.lastIndexOf('.'));
                    if (!fileLogo.exec(Logo)) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Jenis file yang diizinkan hanya jpg, jpeg, png !',
                        });
                        isSubmitting = false; // Set flag kembali menjadi false setelah validasi error
                        return;
                    }
                }



                $.ajax({
                    url: "logo-update/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            title: "Berhasil",
                            icon: "success",
                            text: "Berhasil mengubah data!",
                            showConfirmButton: false,
                            timer: 2000
                        });

                        loadLogo()
                        $('#modal-edit').modal('hide');
                        emptyForm('form-update');
                        console.log(response);
                    },
                    error: function(response) {
                        var errorData = response.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan' + errorData,
                            showConfirmButton: true,
                            timer: 2000
                        });
                    },
                    complete: function() {
                        isSubmitting =
                            false;
                    }
                });
            });
        });
    </script>
    {{-- script edit logo --}}

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
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('galery.delete', '') }}/" + formId,
                            data: $(deleteForm).serialize(),
                            dataType: "JSON",
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success',
                                    text: 'Berhasil menghapus data',
                                    icon: 'success',
                                    timer: 2000
                                }).then(function() {
                                    loadLogo(),
                                        loadGalery()
                                });
                            },
                            error: function(xhr, status, error) {
                                Swal.fire({
                                    title: 'Error',
                                    icon: 'error',
                                    text: 'Terjadi kesalahan'
                                });
                            }
                        });

                    }
                });
            });
        });
    </script>
    {{-- swicth alert delete --}}
@endsection
