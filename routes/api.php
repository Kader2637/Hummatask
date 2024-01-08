<?php

use App\Http\Controllers\DivisiController;
use App\Http\Controllers\tambahUsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('division', [DivisiController::class, 'index']);
Route::post('divisionStore', [DivisiController::class, 'store']);
Route::put('division/{divisi}', [DivisiController::class, 'update']);
Route::delete('division/{divisi}', [DivisiController::class, 'destroy']);

// mentor
Route::get('mentor', [tambahUsersController::class, 'get_mentor']);
Route::post('tambah-mentor', [tambahUsersController::class, 'store_mentor']);
Route::put('edit-mentor/{uuid}', [tambahUsersController::class, 'edit_mentor']);
Route::delete('delete-mentor/{code}', [tambahUsersController::class, 'delete_mentor']);
