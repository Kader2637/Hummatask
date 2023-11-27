function successRes(message){
    Swal.fire({
        icon: 'success',
        title : "Sukses",
        text : message,
        timer : 1000,
        showConfirmButton: false
    })
}

module.exports = successRes;
