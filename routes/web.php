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

    Route::post('login', 'login')->name('login');
    Route::post('register', 'register')->name('register.store');
});

Route::get('logout', [authController::class, 'logout'])->name('logout');

Route::prefix('siswa')->middleware(['auth', 'siswa'])->group(function () {
    Route::get('dashboard', [siswaController::class, 'dashboard'])->name('dashboard.siswa');
    Route::get('profile', [siswaController::class, 'profilePage'])->name('profile.siswa');
    Route::post('buat-tim-solo',[PengajuanTimController::class,'pengajuanSoloProject'])->name('buat_tim_solo');
});

Route::prefix('tim')->middleware(['auth', 'siswa'])->controller(timController::class)->group(function () {
    // Halaman Tim
    Route::get('board/{uuid}', 'boardPage')->name('tim.board');
    Route::get('kalender/{uuid}', 'kalenderPage')->name('tim.kalender');
    Route::get('catatan/{uuid}','catatanPage')->name('tim.catatan');
    Route::get('project/{uuid}', 'projectPage')->name('tim.project');
    Route::get('history/{uuid}', 'historyPage')->name('tim.history');
    Route::get('history-presentasi/{uuid}', 'historyPresentasiPage')->name('tim.historyPresentasi');
    Route::get('history-catatan/{uuid}', 'historyCatatanPage')->name('tim.historyCatatan');




    // proses di halaman tim
    Route::get('board/dataTugas/{uuid}',[TugasController::class,'getData'])->name('dataTugas');
    Route::post('board/tambah-tugas',[TugasController::class,'buatTugas']);
});

// Halaman Ketua Magang
Route::prefix('ketuaMagang')->middleware(['auth', 'siswa','can:kelola siswa'])->controller(KetuaMagangController::class)->group(function () {
    Route::get('dashboard','dashboardPage')->name('ketua.dashboard');
    Route::get('presentasi','presentasiPage')->name('ketua.presentasi');
    Route::get('project','projectPage')->name('ketua.project');
    Route::get('detail_project','detailProject')->name('ketua.detail_project');
    Route::get('history','historyPage')->name('ketua.history');
});

// Halaman Mentor
Route::prefix('mentor')->middleware(['auth', 'mentor'])->group(function () {
    Route::get('dashboard', [mentorController::class, 'dashboard'])->name('dashboard.mentor');
    Route::get('pengajuan-projek', [mentorController::class, 'pengajuanProjekPage'])->name('pengajuan-projek');
    Route::get('detail-pengajuan-projek', [mentorController::class, 'detailPengajuanPage'])->name('detail-pengajuan-projek');
    Route::get('projek', [mentorController::class, 'projekPage'])->name('projek');
    Route::get('detail-projek', [mentorController::class, 'detailProjekPage'])->name('detail-projek');
    Route::get('profile-mentor', [mentorController::class, 'profilePage'])->name('profile-mentor');
    Route::get('pengguna', [mentorController::class, 'pengguna'])->name('pengguna.mentor');
    Route::get('history', [mentorController::class, 'history'])->name('history.mentor');
    Route::get('presentasi', [mentorController::class, 'presentasi'])->name('presentasi.mentor');
});
