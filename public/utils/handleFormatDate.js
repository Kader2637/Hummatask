// Fungsi untuk mengubah format tanggal
function formatDate(dateString) {
    // Membuat objek Date dari string tanggal
    var date = new Date(dateString);

    // Array untuk menyimpan nama bulan
    var monthNames = [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    // Mendapatkan tanggal, bulan, dan tahun dari objek Date
    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    // Menggabungkan tanggal, nama bulan, dan tahun menjadi format yang diinginkan
    var formattedDate = day + " " + monthNames[monthIndex] + " " + year;

    // Mengembalikan tanggal yang diformat
    return formattedDate;
  }


module.exports = formatDate;
