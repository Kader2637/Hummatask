const prioritas = (status) =>{
    let element = ''
    if(status === "mendesak") return element =  `<div class="badge rounded-pill bg-label-danger">Mendesak</div>`
    if(status === "penting") return element =  `<div class="badge rounded-pill bg-label-warning">Penting</div>`
    if(status === "biasa") return element =  `<div class="badge rounded-pill bg-label-info">Biasa</div>`
    if(status === "tambahan") return element =  `<div class="badge rounded-pill bg-label-primary">Tambahan</div>`
    if(status === "opsional") return element =  `<div class="badge rounded-pill bg-label-secondary">Opsional</div>`
}

module.exports = prioritas;
