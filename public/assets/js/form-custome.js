document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-senin");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const waktuMulai = form.querySelectorAll('input[name^="mulai["]');
            const waktuAkhir = form.querySelectorAll('input[name^="akhir["]');

            let isValid = true;

            waktuMulai.forEach(function (input, index) {
                const mulaiValue = input.value.trim();
                const akhirValue = waktuAkhir[index].value.trim();

                if (mulaiValue === "" || akhirValue === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Input waktu jadwal harus diisi!",
                });

                event.preventDefault();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-selasa");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const waktuMulai = form.querySelectorAll('input[name^="mulai["]');
            const waktuAkhir = form.querySelectorAll('input[name^="akhir["]');

            let isValid = true;

            waktuMulai.forEach(function (input, index) {
                const mulaiValue = input.value.trim();
                const akhirValue = waktuAkhir[index].value.trim();

                if (mulaiValue === "" || akhirValue === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Input waktu jadwal harus diisi!",
                });

                event.preventDefault();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-rabu");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const waktuMulai = form.querySelectorAll('input[name^="mulai["]');
            const waktuAkhir = form.querySelectorAll('input[name^="akhir["]');

            let isValid = true;

            waktuMulai.forEach(function (input, index) {
                const mulaiValue = input.value.trim();
                const akhirValue = waktuAkhir[index].value.trim();

                if (mulaiValue === "" || akhirValue === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Input waktu jadwal harus diisi!",
                });

                event.preventDefault();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-kamis");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const waktuMulai = form.querySelectorAll('input[name^="mulai["]');
            const waktuAkhir = form.querySelectorAll('input[name^="akhir["]');

            let isValid = true;

            waktuMulai.forEach(function (input, index) {
                const mulaiValue = input.value.trim();
                const akhirValue = waktuAkhir[index].value.trim();

                if (mulaiValue === "" || akhirValue === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Input waktu jadwal harus diisi!",
                });

                event.preventDefault();
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".form-jumat");

    forms.forEach(function (form) {
        form.addEventListener("submit", function (event) {
            const waktuMulai = form.querySelectorAll('input[name^="mulai["]');
            const waktuAkhir = form.querySelectorAll('input[name^="akhir["]');

            let isValid = true;

            waktuMulai.forEach(function (input, index) {
                const mulaiValue = input.value.trim();
                const akhirValue = waktuAkhir[index].value.trim();

                if (mulaiValue === "" || akhirValue === "") {
                    isValid = false;
                }
            });

            if (!isValid) {
                Swal.fire({
                    icon: "error",
                    title: "Error!",
                    text: "Input waktu jadwal harus diisi!",
                });

                event.preventDefault();
            }
        });
    });
});

// Submit Disable
document.addEventListener("DOMContentLoaded", function () {
    function setupFormRepeater(formRepeaterId) {
        var submitButton = document.querySelector(
            "#" + formRepeaterId + ' button[type="submit"]'
        );
        var formRepeater = document.getElementById(formRepeaterId);

        if (!formRepeater || !submitButton) {
            return;
        }

        submitButton.disabled = true;

        formRepeater.addEventListener("input", function (event) {
            var targetInput = event.target;
            var inputName = targetInput.name;

            if (
                inputName &&
                (inputName.includes("mulai") || inputName.includes("akhir"))
            ) {
                submitButton.disabled = false;
            }
        });
    }

    setupFormRepeater("form-selasa");
    setupFormRepeater("form-rabu");
    setupFormRepeater("form-kamis");
    setupFormRepeater("form-jumat");
});
document.addEventListener("DOMContentLoaded", function () {
    var submitButton = document.querySelector('button[type="submit"]');
    var formRepeater = document.getElementById("form-repeater");

    submitButton.disabled = true;

    formRepeater.addEventListener("input", function (event) {
        var targetInput = event.target;
        var inputName = targetInput.name;

        if (
            inputName &&
            (inputName.includes("mulai") || inputName.includes("akhir"))
        ) {
            submitButton.disabled = false;
        }
    });
});

// $(document).ready(function () {
//     $(".delete-data-column").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         if (response.success) {
//                             $("#form-repeater .form-column[data-id='" + dataId + "']").remove();
//                             Swal.fire('Berhasil!', response.success, 'success');
//                         } else {
//                             console.error('Unexpected response:', response);
//                         }
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-selasa").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         if (response.success) {
//                             $("#form-selasa #form-repeater-item-selasa .form-column[data-id='" + dataId + "']").remove();
//                             Swal.fire('Berhasil!', response.success, 'success');
//                         } else {
//                             console.error('Unexpected response:', response);
//                         }
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-rabu").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         if (response.success) {
//                             $("#form-rabu #form-repeater-item-rabu .form-column[data-id='" + dataId + "']").remove();
//                             Swal.fire('Berhasil!', response.success, 'success');
//                         } else {
//                             console.error('Unexpected response:', response);
//                         }
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-kamis").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         if (response.success) {
//                             $("#form-kamis #form-repeater-item-kamis .form-column[data-id='" + dataId + "']").remove();
//                             Swal.fire('Berhasil!', response.success, 'success');
//                         } else {
//                             console.error('Unexpected response:', response);
//                         }
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-jumat").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         if (response.success) {
//                             $("#form-jumat #form-repeater-item-jumat .form-column[data-id='" + dataId + "']").remove();
//                             Swal.fire('Berhasil!', response.success, 'success');
//                         } else {
//                             console.error('Unexpected response:', response);
//                         }
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-selasa").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");
//         console.log(dataId);

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         $(
//                             "#form-repeater .form-repeater-item[data-id='" +
//                                 dataId +
//                                 "']"
//                         ).remove();
//                         Swal.fire("Berhasil!", response.success, "success");
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-rabu").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");
//         console.log(dataId);

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         $(
//                             "#form-repeater .form-repeater-item[data-id='" +
//                                 dataId +
//                                 "']"
//                         ).remove();
//                         Swal.fire("Berhasil!", response.success, "success");
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-kamis").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");
//         console.log(dataId);

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         $(
//                             "#form-repeater .form-repeater-item[data-id='" +
//                                 dataId +
//                                 "']"
//                         ).remove();
//                         Swal.fire("Berhasil!", response.success, "success");
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// $(document).ready(function () {
//     $(".delete-data-column-jumat").on("click", function (event) {
//         event.preventDefault();
//         var dataId = $(this).data("id");
//         console.log(dataId);

//         Swal.fire({
//             title: "Apakah Anda Yakin?",
//             text: "Anda tidak akan dapat mengembalikan ini!",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonText: "Ya, hapus!",
//             cancelButtonText: "Tidak",
//             reverseButtons: true,
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 $.ajax({
//                     url: "/mentor/presentasi-divisi/" + dataId,
//                     type: "DELETE",
//                     headers: {
//                         "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
//                             "content"
//                         ),
//                     },
//                     success: function (response) {
//                         $(
//                             "#form-repeater .form-repeater-item[data-id='" +
//                                 dataId +
//                                 "']"
//                         ).remove();
//                         Swal.fire("Berhasil!", response.success, "success");
//                     },
//                     error: function (error) {
//                         console.error("Error:", error);
//                         Swal.fire("Gagal!", "Gagal menghapus data.", "error");
//                     },
//                 });
//             }
//         });
//     });
// });

// function setInitialActiveTab() {
//     var lastActiveTab = localStorage.getItem("lastActiveTab");
//     var currentDay = new Date().getDay();

//     $(".nav-link.day-tab").removeClass("active");
//     $(".tab-pane").removeClass("active");

//     if (lastActiveTab) {
//         $('a[data-bs-toggle="tab"][href="#' + lastActiveTab + '"]').addClass(
//             "active"
//         );
//         $("#" + lastActiveTab).addClass("active");
//     } else {
//         var dayTabId = "";
//         if (currentDay === 0 || currentDay === 6) {
//             dayTabId = "senin";
//         } else {
//             switch (currentDay) {
//                 case 1:
//                     dayTabId = "senin";
//                     break;
//                 case 2:
//                     dayTabId = "selasa";
//                     break;
//                 case 3:
//                     dayTabId = "rabu";
//                     break;
//                 case 4:
//                     dayTabId = "kamis";
//                     break;
//                 case 5:
//                     dayTabId = "jumat";
//                     break;
//             }
//         }

//         if (dayTabId) {
//             $('a[data-bs-toggle="tab"][href="#' + dayTabId + '"]').addClass(
//                 "active"
//             );
//             $("#" + dayTabId).addClass("active");
//         }
//     }
// }

// function clearLocalStorage() {
//     console.log("Calling clearLocalStorage");
//     localStorage.removeItem("lastActiveTab");
// }

// $(document).ready(function () {
//     setInitialActiveTab();

//     handleFormSubmission("form-senin", "form-repeater", "senin");
//     handleFormSubmission("form-selasa", "form-repeater-selasa", "selasa");
//     handleFormSubmission("form-rabu", "form-repeater-rabu", "rabu");
//     handleFormSubmission("form-kamis", "form-repeater-kamis", "kamis");
//     handleFormSubmission("form-jumat", "form-repeater-jumat", "jumat");

//     setInterval(clearLocalStorage, 60000);
// });

// $("#add-form").click(function (event) {
//     event.preventDefault();

//     ++i;
//     $("#form-repeater").append(
//         `<div class="form-repeater-item">
//             <div class="row form-column align-items-center">
//                 <input name="day" type="hidden" value="monday">
//                 <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
//                     <p class="text-dark fs-6 mt-3" style="font-weight: 550">
//                         Jadwal Baru
//                     </p>
//                 </div>
//                 <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                     <input type="time" name="mulai[]" class="form-control" />
//                     <div class="invalid-feedback" id="invalid-mulai-${i}"></div>
//                 </div>
//                 <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
//                     -
//                 </div>
//                 <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                     <input type="time" name="akhir[]" class="form-control" />
//                     <div class="invalid-feedback" id="invalid-akhir-${i}"></div>
//                 </div>
//                 <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
//                     <button class="btn btn-label-danger delete-column">
//                         <i class="ti ti-x ti-xs me-1"></i>
//                         <span class="align-middle">Delete</span>
//                     </button>
//                 </div>
//                 <hr>
//             </div>
//         </div>`
//     );

//     updateFormColumnText();
// });

// function updateFormColumnText() {
//     var formColumns = $(".form-repeater-item");
//     var belumAdaJadwalText = $("#belum-ada-jadwal");

//     if (formColumns.length > 0) {
//         belumAdaJadwalText.hide();
//     } else {
//         belumAdaJadwalText.show();
//     }
// }

// $(document).on("click", ".delete-column", function (event) {
//     event.preventDefault();
//     var deleteButton = $(this);

//     Swal.fire({
//         title: "Apakah Anda Yakin?",
//         text: "Anda tidak akan dapat mengembalikan ini!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, hapus!",
//         cancelButtonText: "Tidak",
//         reverseButtons: true,
//     }).then((result) => {
//         if (result.isConfirmed) {
//             deleteButton.closest(".form-repeater-item").remove();
//             --i;
//             updateFormColumnText();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         }
//     });
// });

// $("#form-senin").submit(function (event) {
//     var isValid = true;

//     $(".form-repeater").each(function (index) {
//         var mulaiInput = $(this).find("input[name='mulai[]']");
//         var mulaiValue = mulaiInput.val();

//         if (!mulaiValue.trim()) {
//             isValid = false;
//             $(`#invalid-mulai-${index + 1}`).text(
//                 "Inputan waktu mulai harus diisi."
//             );
//         } else {
//             $(`#invalid-mulai-${index + 1}`).text("");
//         }

//         var akhirInput = $(this).find("input[name='akhir[]']");
//         var akhirValue = akhirInput.val();

//         if (!akhirValue.trim()) {
//             isValid = false;
//             $(`#invalid-akhir-${index + 1}`).text(
//                 "Inputan waktu akhir harus diisi."
//             );
//         } else {
//             $(`#invalid-akhir-${index + 1}`).text("");
//         }
//     });

//     if (isValid) {
//     } else {
//         event.preventDefault();
//         Swal.fire({
//             title: "Gagal!",
//             text: "Inputan waktu harus diisi.",
//             icon: "error",
//         });
//     }
// });

// // Hari Selasa
// var iSelasa = 0;

// $("#add-form-selasa").click(function (event) {
//     event.preventDefault();

//     ++iSelasa;
//     $("#form-repeater-selasa").append(
//         `<div class="form-repeater-item-selasa">
//         <div class="row form-column align-items-center">
//             <input name="day" type="hidden" value="tuesday">
//             <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
//                 <p class="text-dark fs-6 mt-3" style="font-weight: 550">
//                     Jadwal Baru
//                 </p>
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="mulai[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-mulai-${iSelasa}"></div>
//             </div>
//             <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
//                 -
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="akhir[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-akhir-${iSelasa}"></div>
//             </div>
//             <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
//                 <button class="btn btn-label-danger delete-column-selasa">
//                     <i class="ti ti-x ti-xs me-1"></i>
//                     <span class="align-middle">Delete</span>
//                 </button>
//             </div>
//             <hr>
//         </div>
//     </div>`
//     );

//     updateFormColumnTextSelasa();
// });

// $(document).on("click", ".delete-column-selasa", function (event) {
//     event.preventDefault();
//     var deleteButton = $(this);

//     Swal.fire({
//         title: "Apakah Anda Yakin?",
//         text: "Anda tidak akan dapat mengembalikan ini!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, hapus!",
//         cancelButtonText: "Tidak",
//         reverseButtons: true,
//     }).then((result) => {
//         if (result.isConfirmed) {
//             deleteButton.closest(".form-repeater-item-selasa").remove();
//             --iSelasa;
//             updateFormColumnTextSelasa();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         }
//     });
// });

// function updateFormColumnTextSelasa() {
//     var formColumns = $(".form-repeater-item-selasa");
//     var belumAdaJadwalText = $("#belum-ada-jadwal-selasa");

//     if (formColumns.length > 0) {
//         belumAdaJadwalText.hide();
//     } else {
//         belumAdaJadwalText.show();
//     }
// }

// $("#form-selasa").submit(function (event) {
//     var isValid = true;

//     $(".form-repeater-item-selasa").each(function (index) {
//         var mulaiInput = $(this).find("input[name='mulai[]']");
//         var mulaiValue = mulaiInput.val();

//         if (!mulaiValue.trim()) {
//             isValid = false;
//             $(`#invalid-mulai-${index + 1}`).text(
//                 "Inputan waktu mulai harus diisi."
//             );
//         } else {
//             $(`#invalid-mulai-${index + 1}`).text("");
//         }

//         var akhirInput = $(this).find("input[name='akhir[]']");
//         var akhirValue = akhirInput.val();

//         if (!akhirValue.trim()) {
//             isValid = false;
//             $(`#invalid-akhir-${index + 1}`).text(
//                 "Inputan waktu akhir harus diisi."
//             );
//         } else {
//             $(`#invalid-akhir-${index + 1}`).text("");
//         }
//     });

//     if (isValid) {
//     } else {
//         event.preventDefault();
//         Swal.fire({
//             title: "Gagal!",
//             text: "Inputan waktu harus diisi.",
//             icon: "error",
//         });
//     }
// });

// // Hari Rabu
// var iRabu = 0;

// $("#add-form-rabu").click(function (event) {
//     event.preventDefault();
//     ++iRabu;
//     $("#form-repeater-rabu").append(
//         `<div class="form-repeater-item-rabu">
//       <div class="row form-column align-items-center">
//           <input name="day" type="hidden" value="wednesday">
//           <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
//               <p class="text-dark fs-6 mt-3" style="font-weight: 550">
//                   Jadwal Baru
//               </p>
//           </div>
//           <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//               <input type="time" name="mulai[]" class="form-control" />
//               <div class="invalid-feedback" id="invalid-mulai-${iRabu}"></div>
//           </div>
//           <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
//               -
//           </div>
//           <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//               <input type="time" name="akhir[]" class="form-control" />
//               <div class="invalid-feedback" id="invalid-akhir-${iRabu}"></div>
//           </div>
//           <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
//               <button class="btn btn-label-danger delete-column-rabu">
//                   <i class="ti ti-x ti-xs me-1"></i>
//                   <span class="align-middle">Delete</span>
//               </button>
//           </div>
//           <hr>
//       </div>
//   </div>`
//     );

//     updateFormColumnTextRabu();
// });

// $(document).on("click", ".delete-column-rabu", function (event) {
//     event.preventDefault();
//     var deleteButton = $(this);

//     Swal.fire({
//         title: "Apakah Anda Yakin?",
//         text: "Anda tidak akan dapat mengembalikan ini!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, hapus!",
//         cancelButtonText: "Tidak",
//         reverseButtons: true,
//     }).then((result) => {
//         if (result.isConfirmed) {
//             deleteButton.closest(".form-repeater-item-rabu").remove();
//             --iRabu;
//             updateFormColumnTextRabu();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         }
//     });
// });

// function updateFormColumnTextRabu() {
//     var formColumns = $(".form-repeater-item-rabu");
//     var belumAdaJadwalText = $("#belum-ada-jadwal-rabu");

//     if (formColumns.length > 0) {
//         belumAdaJadwalText.hide();
//     } else {
//         belumAdaJadwalText.show();
//     }
// }

// $("#form-rabu").submit(function (event) {
//     var isValid = true;

//     $(".form-repeater-item-rabu").each(function (index) {
//         var mulaiInput = $(this).find("input[name='mulai[]']");
//         var mulaiValue = mulaiInput.val();

//         if (!mulaiValue.trim()) {
//             isValid = false;
//             $(`#invalid-mulai-${index + 1}`).text(
//                 "Inputan waktu mulai harus diisi."
//             );
//         } else {
//             $(`#invalid-mulai-${index + 1}`).text("");
//         }

//         var akhirInput = $(this).find("input[name='akhir[]']");
//         var akhirValue = akhirInput.val();

//         if (!akhirValue.trim()) {
//             isValid = false;
//             $(`#invalid-akhir-${index + 1}`).text(
//                 "Inputan waktu akhir harus diisi."
//             );
//         } else {
//             $(`#invalid-akhir-${index + 1}`).text("");
//         }
//     });

//     if (isValid) {
//     } else {
//         event.preventDefault();
//         Swal.fire({
//             title: "Gagal!",
//             text: "Inputan waktu harus diisi.",
//             icon: "error",
//         });
//     }
// });

// // Hari Kamis
// var iKamis = 0;

// $("#add-form-kamis").click(function (event) {
//     event.preventDefault();
//     ++iKamis;
//     $("#form-repeater-kamis").append(
//         `<div class="form-repeater-item-kamis">
//         <div class="row form-column align-items-center">
//             <input name="day" type="hidden" value="thursday">
//             <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
//                 <p class="text-dark fs-6 mt-3" style="font-weight: 550">
//                     Jadwal Baru
//                 </p>
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="mulai[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-mulai-${iKamis}"></div>
//             </div>
//             <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
//                 -
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="akhir[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-akhir-${iKamis}"></div>
//             </div>
//             <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
//                 <button class="btn btn-label-danger delete-column-kamis">
//                     <i class="ti ti-x ti-xs me-1"></i>
//                     <span class="align-middle">Delete</span>
//                 </button>
//             </div>
//             <hr>
//         </div>
//     </div>`
//     );

//     updateFormColumnTextKamis();
// });

// $(document).on("click", ".delete-column-kamis", function (event) {
//     event.preventDefault();
//     var deleteButton = $(this);

//     Swal.fire({
//         title: "Apakah Anda Yakin?",
//         text: "Anda tidak akan dapat mengembalikan ini!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, hapus!",
//         cancelButtonText: "Tidak",
//         reverseButtons: true,
//     }).then((result) => {
//         if (result.isConfirmed) {
//             deleteButton.closest(".form-repeater-item-kamis").remove();
//             --iKamis;
//             updateFormColumnTextKamis();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         }
//     });
// });

// function updateFormColumnTextKamis() {
//     var formColumns = $(".form-repeater-item-kamis");
//     var belumAdaJadwalText = $("#belum-ada-jadwal-kamis");

//     if (formColumns.length > 0) {
//         belumAdaJadwalText.hide();
//     } else {
//         belumAdaJadwalText.show();
//     }
// }

// $("#form-kamis").submit(function (event) {
//     var isValid = true;

//     $(".form-repeater-item-kamis").each(function (index) {
//         var mulaiInput = $(this).find("input[name='mulai[]']");
//         var mulaiValue = mulaiInput.val();

//         if (!mulaiValue.trim()) {
//             isValid = false;
//             $(`#invalid-mulai-${index + 1}`).text(
//                 "Inputan waktu mulai harus diisi."
//             );
//         } else {
//             $(`#invalid-mulai-${index + 1}`).text("");
//         }

//         var akhirInput = $(this).find("input[name='akhir[]']");
//         var akhirValue = akhirInput.val();

//         if (!akhirValue.trim()) {
//             isValid = false;
//             $(`#invalid-akhir-${index + 1}`).text(
//                 "Inputan waktu akhir harus diisi."
//             );
//         } else {
//             $(`#invalid-akhir-${index + 1}`).text("");
//         }
//     });

//     if (isValid) {
//     } else {
//         event.preventDefault();
//         Swal.fire({
//             title: "Gagal!",
//             text: "Inputan waktu harus diisi.",
//             icon: "error",
//         });
//     }
// });

// // Hari Jumat
// var iJumat = 0;

// $("#add-form-jumat").click(function (event) {
//     event.preventDefault();
//     ++iJumat;
//     $("#form-repeater-jumat").append(
//         `<div class="form-repeater-item-jumat">
//         <div class="row form-column align-items-center">
//             <input name="day" type="hidden" value="friday">
//             <div class="mb-3 col-lg-9 col-xl-2 col-4 mb-0">
//                 <p class="text-dark fs-6 mt-3" style="font-weight: 550">
//                     Jadwal Baru
//                 </p>
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="mulai[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-mulai-${iJumat}"></div>
//             </div>
//             <div class="mb-3 col-lg-1 col-xl-1 col-1 mb-0 text-center mt-2">
//                 -
//             </div>
//             <div class="mb-3 col-lg-6 col-xl-3 col-12 mb-0">
//                 <input type="time" name="akhir[]" class="form-control" />
//                 <div class="invalid-feedback" id="invalid-akhir-${iJumat}"></div>
//             </div>
//             <div class="mb-3 col-lg-12 col-xl-2 col-12 mb-0">
//                 <button class="btn btn-label-danger delete-column-jumat">
//                     <i class="ti ti-x ti-xs me-1"></i>
//                     <span class="align-middle">Delete</span>
//                 </button>
//             </div>
//             <hr>
//         </div>
//     </div>`
//     );

//     updateFormColumnTextJumat();
// });

// $(document).on("click", ".delete-column-jumat", function (event) {
//     event.preventDefault();
//     var deleteButton = $(this);

//     Swal.fire({
//         title: "Apakah Anda Yakin?",
//         text: "Anda tidak akan dapat mengembalikan ini!",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonText: "Ya, hapus!",
//         cancelButtonText: "Tidak",
//         reverseButtons: true,
//     }).then((result) => {
//         if (result.isConfirmed) {
//             deleteButton.closest(".form-repeater-item-jumat").remove();
//             --iJumat;
//             updateFormColumnTextJumat();
//         } else if (result.dismiss === Swal.DismissReason.cancel) {
//         }
//     });
// });

// function updateFormColumnTextJumat() {
//     var formColumns = $(".form-repeater-item-jumat");
//     var belumAdaJadwalText = $("#belum-ada-jadwal-jumat");

//     if (formColumns.length > 0) {
//         belumAdaJadwalText.hide();
//     } else {
//         belumAdaJadwalText.show();
//     }
// }

// $("#form-jumat").submit(function (event) {
//     var isValid = true;

//     $(".form-repeater-item-jumat").each(function (index) {
//         var mulaiInput = $(this).find("input[name='mulai[]']");
//         var mulaiValue = mulaiInput.val();

//         if (!mulaiValue.trim()) {
//             isValid = false;
//             $(`#invalid-mulai-${index + 1}`).text(
//                 "Inputan waktu mulai harus diisi."
//             );
//         } else {
//             $(`#invalid-mulai-${index + 1}`).text("");
//         }

//         var akhirInput = $(this).find("input[name='akhir[]']");
//         var akhirValue = akhirInput.val();

//         if (!akhirValue.trim()) {
//             isValid = false;
//             $(`#invalid-akhir-${index + 1}`).text(
//                 "Inputan waktu akhir harus diisi."
//             );
//         } else {
//             $(`#invalid-akhir-${index + 1}`).text("");
//         }
//     });

//     if (isValid) {
//     } else {
//         event.preventDefault();
//         Swal.fire({
//             title: "Gagal!",
//             text: "Inputan waktu harus diisi.",
//             icon: "error",
//         });
//     }
// });

// function handleFormSubmission(formId, repeaterId, tabId) {
//     var form = $("#" + formId);
//     var repeater = $("#" + repeaterId);

//     form.submit(function (event) {
//         if (repeater.find(".form-column").length === 0) {
//             event.preventDefault();

//             Swal.fire({
//                 title: "Gagal!",
//                 text: "Anda harus menambahkan form terlebih dahulu.",
//                 icon: "error",
//             });
//         } else {
//             localStorage.setItem("lastActiveTab", tabId);
//         }
//     });
// }

// $("#form-senin").submit(function (event) {
//     if ($("#form-repeater .form-column").length === 0) {
//         event.preventDefault();

//         Swal.fire({
//             title: "Gagal!",
//             text: "Anda harus menambahkan form terlebih dahulu.",
//             icon: "error",
//         });
//     } else {
//     }
// });

// $("#form-selasa").submit(function (event) {
//     if ($("#form-repeater-selasa .form-column").length === 0) {
//         event.preventDefault();

//         Swal.fire({
//             title: "Gagal!",
//             text: "Anda harus menambahkan form terlebih dahulu.",
//             icon: "error",
//         });
//     } else {
//     }
// });

// $("#form-rabu").submit(function (event) {
//     if ($("#form-repeater-rabu .form-column").length === 0) {
//         event.preventDefault();

//         Swal.fire({
//             title: "Gagal!",
//             text: "Anda harus menambahkan form terlebih dahulu.",
//             icon: "error",
//         });
//     } else {
//     }
// });

// $("#form-kamis").submit(function (event) {
//     if ($("#form-repeater-kamis .form-column").length === 0) {
//         event.preventDefault();

//         Swal.fire({
//             title: "Gagal!",
//             text: "Anda harus menambahkan form terlebih dahulu.",
//             icon: "error",
//         });
//     } else {
//     }
// });

// $("#form-jumat").submit(function (event) {
//     if ($("#form-repeater-jumat .form-column").length === 0) {
//         event.preventDefault();

//         Swal.fire({
//             title: "Gagal!",
//             text: "Anda harus menambahkan form terlebih dahulu.",
//             icon: "error",
//         });
//     } else {
//     }
// });
