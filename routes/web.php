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
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\ExportController;
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

        // Routes JABATAN
        Route::controller(JabatanController::class)->group(function () {
            Route::get('jabatan', 'index');
            Route::post('jabatan/add', 'add')->name('add-jabatan');
            Route::post('jabatan/edit/{id}', 'edit')->name('edit-jabatan');
            Route::get('jabatan/delete/{id}', 'delete')->name('delete-jabatan');
        });

        // Routes Biodata
        Route::controller(BiodataController::class)->group(function () {
            // Route::get('biodata', 'index')->name('biodata');
            Route::get('biodata/add', 'add')->name('add-biodata');
            Route::post('biodata/create', 'create')->name('create-biodata');
            Route::get('biodata/edit/{id}', 'edit')->name('edit-biodata');
            Route::post('biodata/update/{id}', 'update')->name('update-biodata');
            Route::delete('/delete-biodata/{id}', 'delete')->name('delete-biodata');
        });

        Route::controller(PenggunaController::class)->group(function () {
            Route::get('/pengguna', 'index');
            Route::post('/pengguna/store', 'store');
            Route::get('/pengguna/edit/{id}', 'edit');
            Route::post('/pengguna/edit/{id}', 'update');
            Route::delete('/pengguna/destroy/{id}', 'destroy');
        });

        Route::controller(BPController::class)->group(function () {
            Route::get('data-bp', 'index')->name('data-bp');
        });

        Route::controller(BPPController::class)->group(function () {
            Route::get('data-bpp', 'index')->name('data-bpp');
        });

        Route::controller(KPAController::class)->group(function () {
            Route::get('data-kpa', 'index')->name('data-kpa');
        });

        Route::controller(PAController::class)->group(function () {
            Route::get('data-pa', 'index')->name('data-pa');
        });

        Route::controller(PPTKController::class)->group(function () {
            Route::get('data-pptk', 'index')->name('data-pptk');
        });

        Route::controller(PPKController::class)->group(function () {
            Route::get('data-ppk', 'index')->name('data-ppk');
        });


        Route::controller(PengajuanController::class)->group(function () {
            Route::get('/pengajuan', 'index')->name('pengajuan');
            Route::get('/pengajuan/create', 'create')->name('pengajuan.create');
            Route::post('/pengajuan/store', 'store')->name('pengajuan.store');
        });
        Route::controller(ExportController::class)->group(function () {
            Route::get('/export/pengajuan', 'exportPengajuan')->name('export.pengajuan');
            Route::get('/export/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan');
            Route::get('/export/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan');

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