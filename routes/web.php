<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BPController;
use App\Http\Controllers\PAController;
use App\Http\Controllers\BPPController;
use App\Http\Controllers\KPAController;
use App\Http\Controllers\PPKController;
use App\Http\Controllers\SpjController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PPTKController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\Admin\DocumentKPA;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\JabatanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImportSpjController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\Bpp\SpjBppController;
use App\Http\Controllers\Kpa\ProfileKpaController;
use App\Http\Controllers\Admin\DocumentBpController;
use App\Http\Controllers\Admin\DocumentPaController;
use App\Http\Controllers\Admin\VerifikasiController;
use App\Http\Controllers\BuktiPengeluaranController;
use App\Http\Controllers\Kpa\PengajuanKpaController;
use App\Http\Controllers\Admin\DocumentBppController;
use App\Http\Controllers\Admin\DocumentPPTKController;
use App\Http\Controllers\Bpp\BuktiPengeluaranBppController;
use App\Http\Controllers\Pptk\PengajuanPPTKController;

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
            Route::post('/reject-kpa/{id}', 'reject')->name('reject.kpa');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentBpController::class)->group(function () {
            Route::get('/doc-bp', 'index')->name('doc.bp.index');
            Route::get('/detail/pengajuan/pdf/{id}', 'detailPengajuanPdf')->name('detail.pdf.pengajuan');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentPaController::class)->group(function () {
            Route::get('/acc-pa', 'index')->name('acc.pa.index');
            Route::post('/acc-pa/{id}', 'verifikasi')->name('acc.pa');
            Route::post('/reject-pa/{id}', 'reject')->name('reject.pa.document');
        });

        Route::controller(App\Http\Controllers\Admin\DocumentPPTKController::class)->group(function () {
            Route::get('/acc-pptk', 'index')->name('acc.pptk.index');
            Route::post('/acc-pptk/{id}', 'verifikasi')->name('acc.pptk');
            Route::post('/reject-pptk/{id}', 'reject')->name('reject.pptk');
        });


        Route::controller(ExportController::class)->group(function () {
            Route::get('/export/pengajuan', 'exportPengajuan')->name('export.pengajuan');
            Route::get('/export/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan');
            Route::get('/export/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan');
            Route::get('/export/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng');
            Route::get('/export/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng');
            Route::get('/export/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng');
            // SPJ
            Route::get('/spj/export/document/{id}', 'export_spj');
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
            Route::get('/data-spj', 'index');
            Route::get('/spj/create', 'create');
            Route::get('/spj/view/{id}', 'view');
            Route::get('/spj/delete/{id}', 'delete');
        });

        Route::post('/import', [ImportSpjController::class, 'import'])->name('import');
    });

    Route::group(['middleware' => ['CekLogin:bp']], function () {

        // Route::get('/test/bp', function () {
        //     echo 'bp';
        // });

        // Route::get('/profile', [BPController::class, 'profile'])->name('profile');

        Route::controller(ExportController::class)->group(function () {
            Route::get('/spj/export/document/{id}', 'export_spj');
        });

        Route::controller(SpjController::class)->group(function () {
            // Route::get('/data-spj', 'index');
            // Route::get('/spj/create', 'create');
            Route::get('/spj/view/{id}', 'view')->name('bp.view.spj');
            // Route::get('/spj/delete/{id}', 'delete');
        });

        Route::post('/import', [ImportSpjController::class, 'import'])->name('import');

        Route::controller(BPController::class)->group(function () {
            Route::get('/profile-bp', 'profile'); // cek
            Route::post('biodata/update/{id}', 'update')->name('biodata-update');
            Route::get('/doc-bp', 'document')->name('doc.bp.index');
            Route::get('/detail/pengajuan/pdf/{id}', 'detailPengajuanPdf')->name('detail.pdf.pengajuan');
            Route::get('/spj', 'spj');
        });
    });

    Route::group(['middleware' => ['CekLogin:bpp']], function () {

        Route::controller(App\Http\Controllers\Bpp\BPPController::class)->group(function () {
            Route::get('/profile-bpp', 'profilee'); //cek
            Route::post('/update-profile-bpp/{id}', 'updatee')->name('bpp.update');
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
            Route::post('/bukti-bpp/store', 'store')->name('bukti-bpp.store');
            Route::get('/bukti-bpp-pengeluaran/edit/{id}', 'edit')->name('bukti-bpp-pengeluaran.edit');
            Route::put('/bukti-bpp-pengeluaran/{id}', 'update')->name('bukti-bpp-pengeluaran.update');
            Route::get('/bukti-bpp-pengeluaran/getDataPengajuan/{id}', 'getDataPengajuan')->name('getDataPengajuan');
        });

        Route::controller(App\Http\Controllers\Bpp\SpjBppController::class)->group(function () {
            Route::get('/spj-bpp', 'index');
            Route::get('/spj-create', 'create');
            Route::post('/impor-spj', 'import')->name('impor.spj');
            Route::get('/spj-bpp-view/{id}', 'view');
            Route::get('/spj-delete/{id}', 'delete');
        });
        Route::controller(ExportController::class)->group(function () {
            Route::get('/export-bpp/pengajuan', 'exportPengajuan')->name('export.pengajuan.bpp');
            Route::get('/export-bpp/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan.bpp');
            Route::get('/export-bpp/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan.bpp');
            Route::get('/export-bpp/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng.bpp');
            Route::get('/export-bpp/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng.bpp');
            Route::get('/export-bpp/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng.bpp');
            Route::get('/spj/bpp/export/document/{id}', 'export_spj');
            Route::get('/bioSpj', 'bioSpj');
        });

        // Route::controller(ExportController::class)->group(function () {
        // });
        // Route::get('/bioSpj', [ExportController::class, 'bioSpj']);
    });

    Route::group(['middleware' => ['CekLogin:kpa']], function () {
        Route::controller(App\Http\Controllers\Kpa\ProfileKpaController::class)->group(function () {
            Route::get('/profile-kpa', 'profile');
            Route::post('/update-kpa', 'update')->name('kpa.update');
        });

        Route::controller(App\Http\Controllers\Kpa\PengajuanKpaController::class)->group(function () {
            Route::get('/pengajuan-kpa', 'pengajuan');
            Route::post('/kpa-acc/{id}', 'verifikasi')->name('kpa-acc');
            Route::post('/reject/{id}', 'reject')->name('reject');
        });

        Route::controller(App\Http\Controllers\Kpa\BuktiKpaController::class)->group(function () {
            Route::get('/bukti-kpa', 'bukti');
        });

        Route::controller(App\Http\Controllers\Kpa\SpjKpaController::class)->group(function () {
            Route::get('/kpa-spj', 'spj');
            Route::get('/kpa-data-spj', 'index');
            Route::get('/kpa-spj/create', 'create');
            Route::get('/kpa-spj/view/{id}', 'view');
            Route::get('/kpa-spj/delete/{id}', 'delete');

            Route::get('/kpa-spj/export/surat_pengantar', 'export_surat_pengantar');

            // AREA CETAK SPJ
            Route::get('/kpa-spj/pdf/surat_pengantar', 'pdf_surat_pengantar');
            Route::get('/kpa-spj/pdf/bku', 'pdf_bku');
            Route::get('/kpa-spj/pdf/fungsional', 'pdf_fungsional');
            Route::get('/kpa-spj/pdf/register_kas', 'pdf_register_kas');
            Route::get('/kpa-spj/pdf/all_spj', 'pdf_all_spj');
        });

        Route::controller(ExportController::class)->group(function () {
            Route::get('/export-kpa/pengajuan', 'exportPengajuan')->name('export.pengajuan.kpa');
            Route::get('/export-kpa/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan.kpa');
            Route::get('/export-kpa/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan.kpa');
            Route::get('/export-kpa/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng.kpa');
            Route::get('/export-kpa/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng.kpa');
            Route::get('/export-kpa/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng.kpa');
            Route::get('/spj/bpp/export/document/{id}', 'export_spj');
        });
    });

    Route::group(['middleware' => ['CekLogin:pa']], function () {
        Route::controller(App\Http\Controllers\Pa\ProfilePaController::class)->group(function () {
            Route::get('/profile-pa', 'index');
            Route::post('/update-pa', 'update')->name('update.pa');
        });

        Route::controller(App\Http\Controllers\Pa\PengajuanPaController::class)->group(function () {
            Route::get('/pengajuan-pa', 'index');
            Route::post('/kpa-acc-pa/{id}', 'verifikasi')->name('kpa-acc-pa');
            Route::post('/reject-pa/{id}', 'reject')->name('reject.pa');
        });

        Route::controller(App\Http\Controllers\Pa\SpjPaController::class)->group(function () {
            Route::get('/spj-pa', 'index');
        });

        Route::controller(ExportController::class)->group(function () {
            Route::get('/export-pa/pengajuan', 'exportPengajuan')->name('export.pengajuan.pa');
            Route::get('/export-pa/pengajuan/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan.pa');
            Route::get('/export-pa/pengajuan/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan.pa');
            Route::get('/export-pa/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng.pa');
            Route::get('/export-pa/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng.pa');
            Route::get('/export-pa/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng.pa');
            Route::get('/spj/bpp/export/document/{id}', 'export_spj');
        });
    });

    Route::group(['middleware' => ['CekLogin:pptk']], function () {
        Route::controller(App\Http\Controllers\Pptk\ProfilePptkController::class)->group(function () {
            Route::get('/profile-pptk', 'index');
            Route::post('/update-pptk', 'update')->name('update.pptk');
        });
        Route::controller(App\Http\Controllers\Pptk\PengajuanPPTKController::class)->group(function () {
            Route::get('/pengajuan-pptk', 'index');
            Route::post('/acc-pptk-role/{id}', 'verifikasi')->name('acc.pptk.role');
            Route::post('/reject-pptk-role/{id}', 'reject')->name('reject.pptk.role');
        });
        Route::controller(ExportController::class)->group(function () {
            // Route::get('/export/pengajuan', 'exportPengajuan')->name('export.pengajuan');
            Route::get('/export/pengajuan-pptk/word/{id}', 'exportPengajuanWord')->name('export.word.pengajuan.pptk');
            Route::get('/export/pengajuan-pptk/pdf/{id}', 'exportPengajuanPdf')->name('export.pdf.pengajuan.pptk');
            // Route::get('/export/buktiPeng', 'exportbuktiPeng')->name('export.buktiPeng');
            // Route::get('/export/buktiPeng/word/{id}', 'exportbuktiPengWord')->name('export.word.buktiPeng');
            // Route::get('/export/buktiPeng/pdf/{id}', 'exportBuktiPengPdf')->name('export.pdf.buktiPeng');
        });
        Route::controller(App\Http\Controllers\Ppk\SpjPpkController::class)->group(function () {
            Route::get('/spj-pptk', 'index');
        });
    });

    Route::group(['middleware' => ['CekLogin:ppk']], function () {
        Route::controller(App\Http\Controllers\Ppk\ProfilePpkController::class)->group(function () {
            Route::get('/profile-ppk', 'index');
            Route::post('/update-ppk', 'update')->name('update.ppk');
        });

        Route::controller(App\Http\Controllers\Ppk\SpjPpkController::class)->group(function () {
            Route::get('/spj-ppk', 'index');
        });
    });
    Route::controller(BPController::class)->group(function () {
        Route::get('/doc-bp', 'document')->name('doc.bp.index');
    });
});