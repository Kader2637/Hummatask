<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\catatanController;
use App\Http\Controllers\KetuaMagangController;
use App\Http\Controllers\mentorController;
use App\Http\Controllers\PengajuanProjekController;
use App\Http\Controllers\PengajuanTimController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\ProfileMentor;
use App\Http\Controllers\ProfileSiswaController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\tambahUsersController;
use App\Http\Controllers\timController;
use App\Http\Controllers\TugasController;
use App\Models\Presentasi;
use App\Models\StatusTim;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->controller(authController::class)->group(function () {
    Route::get('/', 'welcomePage');
    Route::get('login', 'loginPage');
    Route::get('register', 'registerPage')->name('register');
    Route::get('forgot', 'lupaPasswordPage')->name('lupa-password');
    Route::get('reset', 'resetPasswordPage');
    Route::get('profile/{code}', 'profilePage')->name('profile');
    Route::get('/auth/google', 'redirectToGoogle')->name('google.register');
    Route::get('/auth/google/callback', 'handleGoogleCallback')->name('google.callback');
    Route::get('/auth/facebook', 'redirectToFacebook')->name('facebook.register');
    Route::get('/auth/facebook/callback', 'handleFacebookCallback')->name('facebook.callback');

    // Process
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register.store');
});

Route::get('logout', [authController::class, 'logout'])->name('logout');

Route::prefix('siswa')->middleware(['auth', 'siswa'])->group(function () {
    Route::get('dashboard', [siswaController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('profile', [siswaController::class, 'profilePage'])->name('profile.siswa');
    Route::post('buat-tim-solo', [PengajuanTimController::class, 'pengajuanSoloProject'])->name('buat_tim_solo');
});

Route::prefix('tim')->controller(timController::class)->group(function () {
    // Halaman Tim
    Route::middleware(['auth', 'siswa'])->group(function () {
        Route::get('board/{code}', 'boardPage')->name('tim.board');
        Route::get('kalender/{code}', 'kalenderPage')->name('tim.kalender');
        Route::get('catatan/{code}', 'catatanPage')->name('tim.catatan');
        Route::get('history/{code}', 'historyPage')->name('tim.history');
        Route::get('history-presentasi/{code}', 'historyPresentasiPage')->name('tim.historyPresentasi');
        Route::get('history-catatan/{code}', 'historyCatatanPage')->name('tim.historyCatatan');
        Route::get('project/{code}', 'projectPage')->name('tim.project');

        Route::post('catatan', [catatanController::class, 'store'])->name('catatan.store');

        // Process
        Route::post('project/ajukan-project/{code}', [PengajuanProjekController::class, 'ajukanProject'])->name('tim.ajukanProject');

        // proses di halaman tim
        Route::post('board/tambah-tugas', [TugasController::class, 'buatTugas']);
        Route::post('ajukan-presentasi/{code}', [PresentasiController::class, 'ajukanPresentasi'])->name('ajukan-presentasi');
        Route::patch('edit-project/{code}', [PengajuanProjekController::class, 'editProject'])->name('tim.editProject');
    });
});

// Halaman Ketua Magang
Route::prefix('ketuaMagang')->middleware(['auth', 'siswa', 'can:kelola siswa'])->controller(KetuaMagangController::class)->group(function () {
    Route::get('dashboard', 'dashboardPage')->name('ketua.dashboard');
    Route::get('presentasi', 'presentasiPage')->name('ketua.presentasi');
    Route::get('project', 'projectPage')->name('ketua.project');
    Route::get('projek', 'projek')->name('tampilprojek');
    Route::get('detail_project/{code}', 'detailProject')->name('ketua.detail_project');
    Route::get('history', 'historyPage')->name('ketua.history');
    Route::post('pembuatantim', [PengajuanTimController::class, 'pembuatanTimProjectKetua'])->name('pembuatantim.ketua');

    // proses
    Route::post('ketua/tampil-detail-presentasi/{code}', [PresentasiController::class, 'tampilkanDetailPresentasi']);
    Route::put('ketua/persetujuan-presentasi/{code}', [PresentasiController::class, 'persetujuanPresentasi']);
    Route::put('ketua/penolakan-presentasi/{code}', [PresentasiController::class, 'penolakanPresentasi']);
    Route::put('ketua/atur-jadwal-presentasi/{code}', [PresentasiController::class, 'aturJadwal']);
    Route::put('ketua/konfirmasi-presentasi/{code}', [PresentasiController::class, 'konfirmasiPresentasi']);
    Route::patch('ketua/persetujuan-project/{code}', [PengajuanProjekController::class, 'persetujuanProject'])->name('ketua.persetujuan-project');
    Route::put('ketua/atur-urutan/{code}',[PresentasiController::class,'gantiUrutan']);
    Route::get('ketua/ambil-urutan/{codeHistory}',[PresentasiController::class,'ambilUrutan']);
});

// Halaman Mentor
Route::prefix('mentor')->middleware(['auth', 'mentor'])->group(function () {
    Route::get('dashboard', [mentorController::class, 'dashboard'])->name('dashboard.mentor');
    Route::get('pengajuan-projek', [mentorController::class, 'pengajuanProjekPage'])->name('pengajuan-projek');
    Route::get('detail-pengajuan-projek/{code}', [mentorController::class, 'detailPengajuan'])->name('detail-pengajuan-projek');
    Route::get('projek', [mentorController::class, 'projekPage'])->name('projek');
    Route::get('detail-projek/{code}', [mentorController::class, 'detailProjekPage'])->name('detail-projek');
    Route::get('profile-mentor', [mentorController::class, 'profilePage'])->name('profile-mentor');
    Route::get('pengguna', [mentorController::class, 'pengguna'])->name('pengguna.mentor');
    Route::get('history', [mentorController::class, 'history'])->name('history.mentor');
    Route::get('presentasi', [mentorController::class, 'presentasi'])->name('presentasi.mentor');
    Route::get('project', [mentorController::class, 'Project'])->name('Project');

    // Process`
    Route::post('tampil-detail-presentasi/{code}', [PresentasiController::class, 'tampilkanDetailPresentasi']);
    Route::put('persetujuan-presentasi/{code}', [PresentasiController::class, 'persetujuanPresentasi']);
    Route::put('penolakan-presentasi/{code}', [PresentasiController::class, 'penolakanPresentasi']);
    Route::put('atur-jadwal-presentasi/{code}', [PresentasiController::class, 'aturJadwal']);
    Route::put('konfirmasi-presentasi/{code}', [PresentasiController::class, 'konfirmasiPresentasi']);
    Route::patch('persetujuan-project/{code}', [PengajuanProjekController::class, 'persetujuanProject'])->name('persetujuan-project');
    Route::put('atur-urutan/{code}',[PresentasiController::class,'gantiUrutan']);
    Route::get('ambil-urutan/{codeHistory}',[PresentasiController::class,'ambilUrutan']);
    Route::post('pembuatantim', [PengajuanTimController::class, 'pembuatanTimProject'])->name('pembuatan.tim');

    Route::get('delete-user/{code}', [tambahUsersController::class, 'delete'])->name('delete.user.pengguna');
    Route::get('delete-mentor/{code}', [tambahUsersController::class, 'delete_mentor'])->name('delete.mentor');
    Route::get('delete-user-permisions/{code}', [tambahUsersController::class, 'delete_permisions'])->name('delete.user');

    Route::post('tambah-user-user', [tambahUsersController::class, 'storeCsv'])->name('tambah.users.csv');
    Route::post('tambah-user', [tambahUsersController::class, 'store'])->name('tambah.users');
    Route::post('tambah-mentor', [tambahUsersController::class, 'store_mentor'])->name('tambah.mentor');
    Route::post('tambah-pengelola', [tambahUsersController::class, 'tambah_pengelola'])->name('tambah.pengelola');
    Route::post('tambah-role', [tambahUsersController::class, 'tambah_role'])->name('tambah.roles');
});
