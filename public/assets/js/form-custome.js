var i = 0;
$("#add-form").click(function () {
    event.preventDefault();
    ++i;
    $("#form-repeater").append(
        `<div id="form-repeater">
                <div class="row form-column">
                    <input name="day" type="hidden" value="monday">
                    <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                      <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                        Jadwal Ke 1
                      </p>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="mulai[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                      -
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="akhir[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                      <button class="btn btn-label-danger" id="delete-column">
                        <i class="ti ti-x ti-xs me-1"></i>
                        <span class="align-middle">Delete</span>
                      </button>
                    </div>
                    <hr>
                  </div>
                </div>
                `
    );
});

$("#add-form-selasa").click(function () {
    event.preventDefault();
    ++i;
    $("#form-repeater-selasa").append(
        `<div id="form-repeater">
                <div class="row form-column">
                    <input name="day" type="hidden" value="tuesday">
                    <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                      <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                        Jadwal Ke 1
                      </p>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="mulai[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                      -
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="akhir[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                      <button class="btn btn-label-danger" id="delete-column-selasa">
                        <i class="ti ti-x ti-xs me-1"></i>
                        <span class="align-middle">Delete</span>
                      </button>
                    </div>
                    <hr>
                  </div>
                </div>
                `
    );
});

$("#add-form-rabu").click(function () {
    event.preventDefault();
    ++i;
    $("#form-repeater-rabu").append(
        `<div id="form-repeater">
                <div class="row form-column">
                    <input name="day" type="hidden" value="wednesday">
                    <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                      <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                        Jadwal Ke 1
                      </p>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="mulai[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                      -
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="akhir[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                      <button class="btn btn-label-danger" id="delete-column-rabu">
                        <i class="ti ti-x ti-xs me-1"></i>
                        <span class="align-middle">Delete</span>
                      </button>
                    </div>
                    <hr>
                  </div>
                </div>
                `
    );
});

$("#add-form-kamis").click(function () {
    event.preventDefault();
    ++i;
    $("#form-repeater-kamis").append(
        `<div id="form-repeater">
                <div class="row form-column">
                    <input name="day" type="hidden" value="thursday">
                    <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                      <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                        Jadwal Ke 1
                      </p>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="mulai[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                      -
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="akhir[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                      <button class="btn btn-label-danger" id="delete-column-kamis">
                        <i class="ti ti-x ti-xs me-1"></i>
                        <span class="align-middle">Delete</span>
                      </button>
                    </div>
                    <hr>
                  </div>
                </div>
                `
    );
});

$("#add-form-jumat").click(function () {
    event.preventDefault();
    ++i;
    $("#form-repeater-jumat").append(
        `<div id="form-repeater">
                <div class="row form-column">
                    <input name="day" type="hidden" value="friday">
                    <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
                      <p class="text-dark fs-6 mt-3" style="font-weight: 550">
                        Jadwal Ke 1
                      </p>
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="mulai[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
                      -
                    </div>
                    <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
                      <input type="time" name="akhir[]" class="form-control" />
                    </div>
                    <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
                      <button class="btn btn-label-danger" id="delete-column-jumat">
                        <i class="ti ti-x ti-xs me-1"></i>
                        <span class="align-middle">Delete</span>
                      </button>
                    </div>
                    <hr>
                  </div>
                </div>
                `
    );
});

$(document).on("click", "#delete-column", function () {
    event.preventDefault();
    var deleteButton = $(this);

    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin menghapus baris ini ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteButton.closest(".form-column").remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Gagal Menghapus baris ini.", "info");
        }
    });
});

$(document).on("click", "#delete-column-selasa", function () {
    event.preventDefault();
    var deleteButton = $(this);

    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin menghapus baris ini ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteButton.closest(".form-column").remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Gagal Menghapus baris ini.", "info");
        }
    });
});

$(document).on("click", "#delete-column-rabu", function () {
    event.preventDefault();
    var deleteButton = $(this);

    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin menghapus baris ini ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteButton.closest(".form-column").remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Gagal Menghapus baris ini.", "info");
        }
    });
});

$(document).on("click", "#delete-column-kamis", function () {
    event.preventDefault();
    var deleteButton = $(this);

    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin menghapus baris ini ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteButton.closest(".form-column").remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Gagal Menghapus baris ini.", "info");
        }
    });
});

$(document).on("click", "#delete-column-jumat", function () {
    event.preventDefault();
    var deleteButton = $(this);

    Swal.fire({
        title: "Apakah Anda Yakin?",
        text: "Ingin menghapus baris ini ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteButton.closest(".form-column").remove();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire("Batal", "Gagal Menghapus baris ini.", "info");
        }
    });
});
