<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\DepartemenController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware([])->group(function () {
    Route::prefix('departemen')->group(function () {
        Route::get('/', [DepartemenController::class, 'index']);
        Route::post('/', [DepartemenController::class, 'store']);
        Route::get('/{id}', [DepartemenController::class, 'show']);
        Route::put('/{id}', [DepartemenController::class, 'update']);
        Route::delete('/{id}', [DepartemenController::class, 'destroy']);
    });
});

Route::prefix('karyawan')->group(function () {
    Route::get('/', [KaryawanController::class, 'index']); // GET /api/karyawan
    Route::post('/', [KaryawanController::class, 'store']); // POST /api/karyawan
    Route::get('/{id}', [KaryawanController::class, 'show']); // GET /api/karyawan/{id}
    Route::put('/{id}', [KaryawanController::class, 'update']); // PUT /api/karyawan/{id}
    Route::delete('/{id}', [KaryawanController::class, 'destroy']); // DELETE /api/karyawan/{id}
});