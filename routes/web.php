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
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportSpjController;
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
    Route::get('/', 'index')->name('login');
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
            Route::get('data-document-bp', 'bpdoc')->name('data-document-bp');
        });

        Route::controller(App\Http\Controllers\Bpp\BPPController::class)->group(function () {
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
            Route::get('/pengajuan/edit/{id}', 'edit')->name('pengajuan.edit');
            Route::post('/pengajuan/update/{id}', 'update')->name('pengajuan.update');
            Route::delete('/pengajuan/delete/{id}', 'destroy')->name('pengajuan.delete');
        });

        Route::controller(App\Http\Controllers\Admin\VerifikasiController::class)->group(function () {
            Route::get('/verifikasi', 'index')->name('verifikasi.index');
            Route::post('/verifikasi/{id}', 'verifikasi')->name('verifikasi');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentBppController::class)->group(function () {
            Route::get('/acc-bpp', 'index')->name('acc.bpp.index');
            Route::post('/acc-bpp/{id}', 'verifikasi')->name('acc.bpp');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentKPA::class)->group(function () {
            Route::get('/acc-kpa', 'index')->name('acc.kpa.index');
            Route::post('/acc-kpa/{id}', 'verifikasi')->name('acc.kpa');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentBpController::class)->group(function () {
            Route::get('/doc-bp', 'index')->name('doc.bp.index');
            Route::get('/detail/pengajuan/pdf/{id}', 'detailPengajuanPdf')->name('detail.pdf.pengajuan');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentPaController::class)->group(function () {
            Route::get('/acc-pa', 'index')->name('acc.pa.index');
            Route::post('/acc-pa/{id}', 'verifikasi')->name('acc.pa');
        });

        Route::controller(ExportController::class)->group(function () {
            Route::get('/export/pengajuan', 'exportPengajuan')->name('export.pengajuan');
            Route::get('/export/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan');
            Route::get('/export/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan');
            Route::get('/export/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng');
            Route::get('/export/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng');
            Route::get('/export/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng');
        });

        Route::controller(App\Http\Controllers\Admin\BuktiPengeluaranController::class)->group(function () {
            Route::get('/bukti-pengeluaran', 'index')->name('bukti.pengeluaran');
            Route::get('/bukti-pengeluaran/create', 'create')->name('bukti.create');
            Route::post('/bukti-pengeluaran/store', 'store')->name('bukti.store');
            Route::get('/bukti-pengeluaran/getDataPengajuan/{id}', 'getDataPengajuan')->name('getDataPengajuan');
            Route::get('/bukti-pengeluaran/edit/{id}', 'edit')->name('bukti-pengeluaran.edit');
            Route::put('/bukti-pengeluaran/{id}', 'update')->name('bukti-pengeluaran.update');
        });


        Route::controller(SpjController::class)->group(function () {
            Route::get('/spj', 'index');
            Route::get('/spj/create', 'create');
        });

        Route::post('/import', [ImportSpjController::class, 'import'])->name('import');
        Route::get('/spj/view/{id}', [SpjController::class, 'view']);
        Route::get('/spj/delete/{id}', [SpjController::class, 'delete']);
    });

    Route::group(['middleware' => ['CekLogin:bp']], function () {

        // Route::get('/test/bp', function () {
        //     echo 'bp';
        // });

        // Route::get('/profile', [BPController::class, 'profile'])->name('profile');

        Route::controller(BPController::class)->group(function () {
            Route::get('/profile-bp', 'profile'); // cek
            Route::post('biodata/update/{id}', 'update')->name('biodata-update');
            Route::get('/doc-bp', 'document')->name('doc.bp.index');
            Route::get('/detail/pengajuan/pdf/{id}', 'detailPengajuanPdf')->name('detail.pdf.pengajuan');
        });
    });

    Route::group(['middleware' => ['CekLogin:bpp']], function () {

        Route::controller(App\Http\Controllers\Bpp\BPPController::class)->group(function () {
            Route::get('/profile-bpp', 'profilee'); //cek
            Route::get('/pengajuan-index', 'pengajuan');
            Route::get('/pengajuans/create', 'create')->name('pengajuans.create');
            Route::post('/pengajuans/store', 'store')->name('store.pengajuans');
            Route::get('/pengajuans/edit/{id}', 'edit')->name('pengajuans.edit');
            Route::post('/pengajuans/update/{id}', 'update')->name('pengajuans.update');
            Route::delete('/pengajuans/delete/{id}', 'destroy')->name('pengajuans.delete');
        });

        Route::controller(App\Http\Controllers\Bpp\BuktiPengeluaranBppController::class)->group(function () {
            Route::get('/bukti-bpp', 'index');
            Route::get('/bukti-bpp/tambah', 'tambah')->name('bukti-bpp.tambah');
        });
    });

    Route::group(['middleware' => ['CekLogin:kpa']], function () {
    });
    Route::group(['middleware' => ['CekLogin:pa']], function () {
    });
    Route::group(['middleware' => ['CekLogin:pptk']], function () {
        Route::controller(PPTKController::class)->group(function () {
            Route::get('/profile-pptk', 'profile');
            Route::post('biodata/update/{id}', 'update')->name('update-biodata');
        });
    });
});