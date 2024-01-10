<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BPController;
use App\Http\Controllers\BPPController;
use App\Http\Controllers\BuktiPengeluaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KPAController;
use App\Http\Controllers\PAController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PPKController;
use App\Http\Controllers\PPTKController;
use App\Http\Controllers\SpjController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index');
    });

    Route::group(['middleware' => ['CekLogin:admin']], function () {

        Route::controller(PenggunaController::class)->group(function () {
            Route::get('/pengguna', 'index');
        });

        Route::controller(BPController::class)->group(function () {
            Route::get('/bp', 'index');
            Route::get('/data-bp', 'bp');
        });

        Route::controller(BPPController::class)->group(function () {
            Route::get('/bpp', 'index');
            Route::get('/data-bpp', 'bpp');
        });

        Route::controller(KPAController::class)->group(function () {
            Route::get('/kpa', 'index');
            Route::get('/data-kpa', 'kpa');
        });

        Route::controller(PAController::class)->group(function () {
            Route::get('/pa', 'index');
            Route::get('/data-pa', 'pa');
        });

        Route::controller(PPTKController::class)->group(function () {
            Route::get('/data-pptk', 'index');
        });

        Route::controller(PPKController::class)->group(function () {
            Route::get('/ppk', 'index');
        });


        Route::controller(PengajuanController::class)->group(function () {
            Route::get('/pengajuan', 'index');
        });

        Route::controller(BuktiPengeluaranController::class)->group(function () {
            Route::get('/bukti-pengeluaran', 'index');
        });

        Route::controller(SpjController::class)->group(function () {
            Route::get('/spj', 'index');
        });
    });
    Route::group(['middleware' => ['CekLogin:bp']], function () {
        // Route::controller(PengajuanController::class)->group(function () {
        //     Route::get('/pengajuan', 'index');
        // });

            // cek
    });
});
