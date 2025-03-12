<?php

use App\Http\Controllers\ApbdController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



//Admin - SKPD
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['hak_akses:Superadmin,Operator'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::prefix('apbd')->group(function () {
        Route::get('/', [ApbdController::class, 'index']);
        Route::post('/update-apbd', [ApbdController::class, 'updateApbd']);
        Route::get('/get-apbd/{unit}/{bln}', [ApbdController::class, 'getApbd']);
        Route::get('/get-pagu/{unit}', [ApbdController::class, 'getPagu']);
    });
});


//APBD