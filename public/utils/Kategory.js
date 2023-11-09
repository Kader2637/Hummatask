const handleKategory = (kategory) =>{
    if(kategory === "solo"){
        return "Solo Project"
    }
    if(kategory === "pre_mini"){
        return "Pre Mini Project"
    }
    if(kategory === "mini"){
        return "Mini Project"
    }
    if(kategory === "big"){
        return "Big Project"
    }
}


module.exports = handleKategory;
