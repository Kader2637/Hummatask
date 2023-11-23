function alertError(error){
    if (error.response && error.response.status === 422) {
        const errors = error.response.data.errors;
        console.log(error);

        let errorMessage = '';

        for (const key in errors) {
            if (errors.hasOwnProperty(key)) {
            errorMessage += `${errors[key]}\n`;
            }
        }


        Swal.fire({
            icon : 'error',
            title : "Error!",
            text  : errorMessage,
            showConfirmButton : false,
            timer : 1200,
        });
    } else {

        Swal.fire({
            icon : 'error',
            title : "Error!",
            text  : error,
            showConfirmButton : false,
            timer : 1000,
        });

    }

}

module.exports = alertError;
