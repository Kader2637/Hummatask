<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\KetuaMagangController;
use App\Http\Controllers\mentorController;
use App\Http\Controllers\PengajuanProjekController;
use App\Http\Controllers\PengajuanTimController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\ProfileMentor;
use App\Http\Controllers\ProfileSiswaController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\siswaController;
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
        Route::get('board/{uuid}', 'boardPage')->name('tim.board');
        Route::get('kalender/{uuid}', 'kalenderPage')->name('tim.kalender');
        Route::get('catatan/{uuid}', 'catatanPage')->name('tim.catatan');
        Route::get('history/{uuid}', 'historyPage')->name('tim.history');
        Route::get('history-presentasi/{uuid}', 'historyPresentasiPage')->name('tim.historyPresentasi');
        Route::get('history-catatan/{uuid}', 'historyCatatanPage')->name('tim.historyCatatan');
        Route::get('project/{uuid}', 'projectPage')->name('tim.project');

        // Process
        Route::post('project/ajukan-project/{code}', [PengajuanProjekController::class, 'ajukanProject'])->name('tim.ajukanProject');
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
    Route::get('detail_project/{code}', 'detailProject')->name('ketua.detail_project');
    Route::get('history', 'historyPage')->name('ketua.history');
    Route::post('pembuatantim',[PengajuanTimController::class,'pembuatanTimProjectKetua'])->name('pembuatantim.ketua');
});

// Halaman Mentor
Route::prefix('mentor')->middleware(['auth', 'mentor'])->group(function () {
    Route::get('dashboard', [mentorController::class, 'dashboard'])->name('dashboard.mentor');
    Route::get('pengajuan-projek', [mentorController::class, 'pengajuanProjekPage'])->name('pengajuan-projek');
    Route::get('detail-pengajuan-projek/{code}', [mentorController::class, 'detailPengajuanPage'])->name('detail-pengajuan-projek');
    Route::get('projek', [mentorController::class, 'projekPage'])->name('projek');
    Route::get('detail-projek/{code}', [mentorController::class, 'detailProjekPage'])->name('detail-projek');
    Route::get('profile-mentor', [mentorController::class, 'profilePage'])->name('profile-mentor');
    Route::get('pengguna', [mentorController::class, 'pengguna'])->name('pengguna.mentor');
    Route::get('history', [mentorController::class, 'history'])->name('history.mentor');
    Route::get('presentasi', [mentorController::class, 'presentasi'])->name('presentasi.mentor');

    // Process`
    Route::post('tampil-detail-presentasi/{code}',[PresentasiController::class,'tampilkanDetailPresentasi']);
    Route::put('persetujuan-presentasi/{code}',[PresentasiController::class,'persetujuanPresentasi']);
    Route::put('penolakan-presentasi/{code}',[PresentasiController::class,'penolakanPresentasi']);
    Route::put('atur-jadwal-presentasi/{code}',[PresentasiController::class,'aturJadwal']);
    Route::put('konfirmasi-presentasi/{code}',[PresentasiController::class,'konfirmasiPresentasi']);
    Route::post('pembuatantim', [PengajuanTimController::class, 'pembuatanTimProject'])->name('pembuatan.tim');
    Route::patch('persetujuan-project/{code}', [PengajuanProjekController::class, 'persetujuanProject'])->name('persetujuan-project');

});
