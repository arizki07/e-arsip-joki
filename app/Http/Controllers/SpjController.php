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
            'active' => 'Spj'
        ]);
    }
}
