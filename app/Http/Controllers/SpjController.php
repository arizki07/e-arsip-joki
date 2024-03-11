<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpjModel;
use App\Models\SuratPengantarModel;
use App\Models\BkuModel;
use App\Models\BuktiPengeluaranModel;
use App\Models\SpjFungsionalModel;
use App\Models\SpjRegisterModel;
use App\Models\UraianBkuModel;
use App\Models\UraianSpjFungsionalModel;
use App\Models\UraianSpjRegisterModel;
use App\Models\BiodataModel;

class SpjController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.admin.spj.index', [
            'title' => 'Spj',
            'active' => 'SPJ',
            'spj' => $spj
        ]);
    }

    public function view($id)
    {
        $suratPengantar = SuratPengantarModel::findOrFail($id);
        $bku = BkuModel::all();
        $buktiPengeluaran = BuktiPengeluaranModel::all();
        $fungsional = SpjFungsionalModel::all();
        $register = SpjRegisterModel::all();
        $uraianBku = UraianBkuModel::all();
        $uraianFungsional = UraianSpjFungsionalModel::all();
        $uraianRegister = UraianSpjRegisterModel::all();
        $biodata = BiodataModel::all();

            $totalPenerimaan = 0;
            $totalPengeluaran = 0;
            $totalSaldo = 0;
            foreach ($uraianBku as $urBKU) {
                if ($urBKU->id_surat_pengantar == $id){
                    
                    if (is_numeric($urBKU->penerimaan)) {
                        $totalPenerimaan += $urBKU->penerimaan;
                    }
                    if (is_numeric($urBKU->pengeluaran)) {
                        $totalPengeluaran += $urBKU->pengeluaran;
                    }
                    if (is_numeric($urBKU->saldo)) {
                        $totalSaldo += $urBKU->saldo;
                    }
                }
            }

        return view('pages.admin.spj.view', [
            'title' => 'Detail SPJ',
            'suratPengantar' => $suratPengantar,
            'bku' => $bku,
            'buktiPengeluaran' => $buktiPengeluaran,
            'fungsional' => $fungsional,
            'register' => $register,
            'uraianBku' => $uraianBku,
            'uraianFungsional' => $uraianFungsional,
            'uraianRegister' => $uraianRegister,
            'biodata' => $biodata,
            'totalPenerimaan' => $totalPenerimaan,
            'totalPengeluaran' => $totalPengeluaran,
            'totalSaldo' => $totalSaldo,
            'active' => 'SPJ'
        ]);
    }
}
