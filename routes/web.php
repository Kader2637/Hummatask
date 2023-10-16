<?php

use App\Http\Controllers\authController;
use Illuminate\Support\Facades\Route;

Route::controller(authController::class)->group(function () {
    Route::get('/', 'welcomePage');
    Route::get('login', 'loginPage')->name('login');
    Route::get('register', 'registerPage')->name('register');
    Route::get('forgot', 'lupaPasswordPage')->name('lupa-password');
    Route::get('reset', 'resetPasswordPage');
    Route::get('steps', 'stepsPage');
    Route::get('verify', 'verifyPage');
});

Route::get('/atur-jadwal',function(){
    return view('user.jadwal.aturJadwal');
});
