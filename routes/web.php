<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\mentorController;
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

Route::prefix('siswa')->middleware(['auth', 'siswa'])->controller(siswaController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard.siswa');
});

// halaman Tim
Route::prefix('tim')->middleware(['auth','siswa'])->controller(timController::class)->group(function(){

    Route::get('board','boardPage')->name('tim.board');
    Route::get('kalender','kalenderPage')->name('tim.kalender');
    Route::get('project','projectPage')->name('tim.project');
    Route::get('history','historyPage')->name('tim.history');
    Route::get('history-presentasi','historyPresentasiPage')->name('tim.historyPresentasi');
    Route::get('history-catatan','historyCatatanPage')->name('tim.historyCatatan');


});


Route::prefix('mentor')->middleware(['auth', 'mentor'])->controller(mentorController::class)->group(function () {
    Route::get('dashboard', 'dashboard')->name('dashboard.mentor');
    Route::get('pengguna', 'pengguna')->name('pengguna.mentor');
    Route::get('history', 'history')->name('history.mentor');
});
