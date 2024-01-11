<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\tambahUsersController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\PresentasiDivisiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PengajuanPresentasiController;
use App\Http\Controllers\siswaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('login', [LoginController::class, 'login']);
Route::post('forgot', [LoginController::class, 'forgot']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [UserController::class, 'user']);
    Route::post('presentasi-divisi', [PresentasiDivisiController::class, 'store']);

    Route::get('siswa',[siswaController::class,'list']);
});

Route::get('division', [DivisiController::class, 'index']);
Route::post('divisionStore', [DivisiController::class, 'store']);
Route::put('division/{divisi}', [DivisiController::class, 'update']);
Route::delete('division/{divisi}', [DivisiController::class, 'destroy']);

Route::get('pengajuan-presentasi-hari-ini', [PengajuanPresentasiController::class, 'hariIni']);

// mentor
Route::get('mentor', [tambahUsersController::class, 'get_mentor']);
Route::post('tambah-mentor', [tambahUsersController::class, 'store_mentor']);
Route::put('edit-mentor/{uuid}', [tambahUsersController::class, 'edit_mentor']);
Route::delete('delete-mentor/{code}', [tambahUsersController::class, 'delete_mentor']);


Route::get('pengguna',[PenggunaController::class, 'index']);
Route::post('pengguna-api',[PenggunaController::class, 'store']);
Route::delete('deletePengguna/{user}',[PenggunaController::class,'destroy']);
Route::patch('editDivisi/{user}', [PenggunaController::class, 'UpdateDivisi']);
Route::post('storeCvs', [PenggunaController::class, 'storeCsv']);
