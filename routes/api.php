<?php

use App\Http\Controllers\Api\BoardController;
use App\Http\Controllers\Api\DetailPresentasiController;
use App\Http\Controllers\Api\HistoryPresentation;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\tambahUsersController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\PresentasiDivisiController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PresentasiController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TimController as ApiTimController;
use App\Http\Controllers\mentorController;
use App\Http\Controllers\PengajuanPresentasiController;
use App\Http\Controllers\ProjectAPI;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\timController;

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
    Route::get('profile', [UserController::class, 'user']);
    Route::get('notification', [NotificationController::class, 'index']);
    Route::get('siswa', [siswaController::class, 'list']);
    Route::get('tims', [ApiTimController::class, 'index']);
    Route::get('board/{code}', [BoardController::class, 'index']);

    Route::get('project/{code}', [ProjectController::class, 'show']);
    Route::get('history-presentation/{code}', [HistoryPresentation::class, 'history']);
    Route::get('anggota-project/{code}', [ProjectController::class, 'anggota']);
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

Route::get('detail-presentasi', [DetailPresentasiController::class, 'index']);

Route::get('pengguna', [PenggunaController::class, 'index']);
Route::post('pengguna-api', [PenggunaController::class, 'store']);
Route::delete('deletePengguna/{user}', [PenggunaController::class, 'destroy']);
Route::patch('editDivisi/{user}', [PenggunaController::class, 'UpdateDivisi']);
Route::post('storeCvs', [PenggunaController::class, 'storeCsv']);

//Route Menu Mentor PKL Hummatech
Route::controller(ProjectAPI::class)->group(function () {
    Route::get('get-team', 'getTeam');
    Route::get('get-mentors-team', 'getTeamBaseOnMentorStudent');
    Route::get('get-team-detail/{code}', 'getTeamDetail');
});
