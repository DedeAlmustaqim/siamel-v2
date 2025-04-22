<?php

use App\Http\Controllers\ApbdController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DakController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PpbjController;
use App\Http\Controllers\PresentasiController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\Service\GrafikController;
use App\Http\Controllers\Service\JadwalServiceContoller;
use App\Http\Controllers\Service\SinkronServiceController;
use App\Http\Controllers\Setting\JadwalController;
use App\Http\Controllers\Setting\SkpdController;
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
    Route::get('/kunci-input/{bln}', [JadwalServiceContoller::class, 'kunciInput']);

    Route::prefix('apbd')->group(function () {
        Route::get('/', [ApbdController::class, 'index']);
        Route::post('/update-apbd', [ApbdController::class, 'updateApbd']);
        Route::get('/get-apbd/{unit}/{bln}', [ApbdController::class, 'getApbd']);
        Route::get('/get-pagu/{unit}', [ApbdController::class, 'getPagu']);
        Route::get('/report-form-i/{bulan}/{unit}', [ApbdController::class, 'reportApbdFormI']);
        Route::get('/report-form-ii/{bulan}/{unit}', [ApbdController::class, 'reportApbdFormII']);
    });

    Route::prefix('service')->group(function () {
        Route::prefix('grafik')->group(function () {
            Route::get('/apbd-skpd/{unit}', [GrafikController::class, 'getGrafikApbdSkpd']);
            Route::get('/pendapatan-skpd/{unit}', [GrafikController::class, 'getGrafikPendapatanSkpd']);
        });
        Route::get('/sinkron', [SinkronServiceController::class, 'btnSinkron']);
        Route::post('/sinkron', [SinkronServiceController::class, 'sinkron']);
    });

    Route::prefix('ppbj')->group(function () {
        Route::get('/', [PpbjController::class, 'index']);
        Route::get('/get-ppbj/{id_bln}/{unit}', [PpbjController::class, 'getPpbj']);
        Route::post('update-ppbj50', [PpbjController::class, 'updatePpbj50']);
        Route::post('update-ppbj200', [PpbjController::class, 'updatePpbj200']);
        Route::post('update-ppbj25', [PpbjController::class, 'updatePpbj25']);
        Route::get('/report-ppbj-50/{bln}/{unit}', [PpbjController::class, 'reportPpbj50']);
        Route::get('/report-ppbj-200/{bln}/{unit}', [PpbjController::class, 'reportPpbj200']);
        Route::get('/report-ppbj-25/{bln}/{unit}', [PpbjController::class, 'reportPpbj25']);
    });

    Route::prefix('dak')->group(function () {
        Route::get('/', [DakController::class, 'index']);
        Route::get('/get-dak-fisik/{bln}/{unit}', [DakController::class, 'getDataDakFisik']);
        Route::get('/get-dak-non-fisik/{bln}/{unit}', [DakController::class, 'getDataDakNonFisik']);

        Route::post('/update-dak-fisik', [DakController::class, 'updateDakFisik']);
        Route::post('/update-dak-non-fisik', [DakController::class, 'updateDakNonFisik']);

        Route::get('/report-dak-fisik/{id_bln}/{id_unit}', [DakController::class, 'reportDakFisik']);
        Route::get('/report-dak-non-fisik/{id_bln}/{id_unit}', [DakController::class, 'reportDakNonFisik']);

        Route::get('/get-dak-fisik-by-id/{id}', [DakController::class, 'getDataDakFisikbyId']);
        Route::get('/get-dak-non-fisik-by-id/{id}', [DakController::class, 'getDataDakNonFisikbyId']);
    });

    Route::prefix('pendapatan')->group(function () {
        Route::get('/', [PendapatanController::class, 'index']);
        Route::get('/get-pendapatan/{bln}/{unit}', [PendapatanController::class, 'getDatapendapatan']);
        Route::post('/update', [PendapatanController::class, 'update']);
        Route::get('/report-pendapatan/{bln}/{unit}', [PendapatanController::class, 'reportPendapatan']);
    });
});

Route::middleware(['hak_akses:Superadmin'])->group(function () {
    Route::get('/presentasi', [PresentasiController::class, 'index']);

    Route::prefix('rekapitulasi')->group(function () {
        Route::get('', [RekapitulasiController::class, 'index']);
        Route::get('/apbd/{bln}', [RekapitulasiController::class, 'apbd']);
        Route::get('/pendapatan/{bln}', [RekapitulasiController::class, 'pendapatan']);
        Route::get('/ppbj/{bln}', [RekapitulasiController::class, 'getPpbj']);
        Route::get('/dak/{bln}', [RekapitulasiController::class, 'getDak']);
        Route::get('/report-apbd/{bln}', [RekapitulasiController::class, 'reportApbd']);
        Route::get('/report-pendapatan/{bln}', [RekapitulasiController::class, 'reportPd']);
        Route::get('/report-ppbj-50/{bln}', [RekapitulasiController::class, 'reportPpbj50']);
        Route::get('/report-ppbj-200/{bln}', [RekapitulasiController::class, 'reportPpbj200']);
        Route::get('/report-ppbj-25/{bln}', [RekapitulasiController::class, 'reportPpbj25']);
        Route::get('/report-dak-fisik/{bln}', [RekapitulasiController::class, 'reportDakFisik']);
        Route::get('/report-dak-non-fisik/{bln}', [RekapitulasiController::class, 'reportDakNonFisik']);
        Route::get('/grafik-apbd', [RekapitulasiController::class, 'grafikapbd']);
        Route::get('/grafik-pd', [RekapitulasiController::class, 'grafikPd']);
    });

    Route::prefix('setting')->group(function () {

        Route::prefix('user')->group(function () {
            Route::get('/get-user/{id}', [SkpdController::class, 'getUser']);
            Route::post('/reset-pass/{id}', [SkpdController::class, 'reset_pass']);
        });

        Route::prefix('skpd')->group(function () {
            Route::get('/', [SkpdController::class, 'index']);
            Route::get('/get-skpd', [SkpdController::class, 'getDatatablesSkpd']);
            Route::get('/get-skpd-by-id/{id}', [SkpdController::class, 'getSkpdById']);
            Route::get('/get-pagu/{id}', [SkpdController::class, 'getPagu']);
            Route::post('/update-pagu/', [SkpdController::class, 'updatePagu']);
        });

        Route::prefix('jadwal')->group(function () {
            Route::get('/', [JadwalController::class, 'index']);
            Route::post('/update', [JadwalController::class, 'update']);
            Route::get('/get-bln', [JadwalController::class, 'getDatatablesBln']);
            Route::get('/get-bln-by-id/{id}', [JadwalController::class, 'getDataBlnbyId']);
            Route::post('/aktivasi/{id}', [JadwalController::class, 'updateAktif']);
        });
    });
});

//APBD