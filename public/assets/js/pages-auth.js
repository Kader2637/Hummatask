"use strict";
const formAuthentication = document.querySelector("#formAuthentication");
document.addEventListener("DOMContentLoaded", function (e) {
  !(function () {
    if (formAuthentication) {
      FormValidation.formValidation(formAuthentication, {
        fields: {
          username: {
            validators: {
              notEmpty: { message: "Silakan masukkan username" },
              stringLength: {
                min: 6,
                message: "Username harus lebih dari 6 karakter",
              },
            },
          },
          email: {
            validators: {
              notEmpty: { message: "Silakan masukkan alamat email Anda" },
              emailAddress: { message: "Silakan masukkan alamat email yang valid" },
            },
          },
          "email-username": {
            validators: {
              notEmpty: { message: "Silakan masukkan email / username" },
              stringLength: {
                min: 6,
                message: "Username harus lebih dari 6 karakter",
              },
            },
          },
          password: {
            validators: {
              notEmpty: { message: "Silakan masukkan kata sandi Anda" },
              stringLength: {
                min: 6,
                message: "Kata sandi harus lebih dari 6 karakter",
              },
            },
          },
          "confirm-password": {
            validators: {
              notEmpty: { message: "Silakan konfirmasi kata sandi" },
              identical: {
                compare: function () {
                  return formAuthentication.querySelector('[name="password"]').value;
                },
                message: "Kata sandi dan konfirmasinya tidak sama",
              },
              stringLength: {
                min: 6,
                message: "Kata sandi harus lebih dari 6 karakter",
              },
            },
          },
          terms: {
            validators: {
              notEmpty: { message: "Silakan setujui syarat dan ketentuan" },
            },
          },
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            eleValidClass: "",
            rowSelector: ".mb-3",
          }),
          submitButton: new FormValidation.plugins.SubmitButton(),
          defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
          autoFocus: new FormValidation.plugins.AutoFocus(),
        },
        init: (e) => {
          e.on("plugins.message.placed", function (e) {
            e.element.parentElement.classList.contains("input-group") &&
              e.element.parentElement.insertAdjacentElement(
                "afterend",
                e.messageElement
              );
          });
        },
      });
    }
    const e = document.querySelectorAll(".numeral-mask");
    e.length &&
      e.forEach((e) => {
        new Cleave(e, { numeral: true });
      });
  })();
});
