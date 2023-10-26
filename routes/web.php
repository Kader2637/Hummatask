<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\KetuaMagangController;
use App\Http\Controllers\mentorController;
use App\Http\Controllers\PengajuanProjekController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\ProfileMentor;
use App\Http\Controllers\ProfileSiswaController;
use App\Http\Controllers\ProjekController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\timController;
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
    Route::get('profile', [ProfileSiswaController::class, 'profilePage'])->name('profile.siswa');
});

// halaman Tim
Route::prefix('tim')->middleware(['auth', 'siswa'])->controller(timController::class)->group(function () {
    Route::get('board', 'boardPage')->name('tim.board');
    Route::get('kalender', 'kalenderPage')->name('tim.kalender');
    Route::get('catatan','catatanPage')->name('tim.catatan');
    Route::get('project', 'projectPage')->name('tim.project');
    Route::get('history', 'historyPage')->name('tim.history');
    Route::get('history-presentasi', 'historyPresentasiPage')->name('tim.historyPresentasi');
    Route::get('history-catatan', 'historyCatatanPage')->name('tim.historyCatatan');
});

// halaman Ketua Magang

Route::prefix('ketuaMagang')->middleware(['auth', 'siswa'])->controller(KetuaMagangController::class)->group(function () {
    Route::get('dashboard','dashboardPage')->name('ketua.dashboard');
    Route::get('presentasi','presentasiPage')->name('ketua.presentasi');
    Route::get('project','projectPage')->name('ketua.project');
    Route::get('detail_project','detailProject')->name('ketua.detail_project');
    Route::get('history','ketua.history')->name('ketua.history');
});


Route::prefix('mentor')->middleware(['auth', 'mentor'])->group(function () {
    Route::get('dashboard', [mentorController::class, 'dashboard'])->name('dashboard.mentor');
    Route::get('pengajuan-projek', [PengajuanProjekController::class, 'pengajuanProjekPage'])->name('pengajuan-projek');
    Route::get('detail-pengajuan-projek', [PengajuanProjekController::class, 'detailPengajuanPage'])->name('detail-pengajuan-projek');
    Route::get('projek', [ProjekController::class, 'projekPage'])->name('projek');
    Route::get('detail-projek', [ProjekController::class, 'detailProjekPage'])->name('detail-projek');
    Route::get('profile-mentor', [ProfileMentor::class, 'profilePage'])->name('profile-mentor');
    Route::get('pengguna', [mentorController::class, 'pengguna'])->name('pengguna.mentor');
    Route::get('history', [mentorController::class, 'history'])->name('history.mentor');
    Route::get('presentasi', [PresentasiController::class, 'presentasi'])->name('presentasi.mentor');
});
