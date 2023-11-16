function alertError(error){
    if (error.response && error.response.status === 422) {
        const errors = error.response.data.errors;
        console.log(errors);

        let errorMessage = '';
        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
            errorMessage += `${errors[key]}\n`;
            }
        }
        $("#formTambahTugas").trigger("reset");
        Swal.fire({
            icon : 'error',
            title : "Error!",
            text  : errorMessage,
            showConfirmButton : false,
            timer : 1000,
        });
    } else {

    console.log(error);

    }

}

module.exports = alertError;
