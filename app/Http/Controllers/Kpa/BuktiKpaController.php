<?php

namespace App\Http\Controllers\Kpa;

use App\Http\Controllers\Controller;
use App\Models\BuktiPengeluaranModel;
use App\Models\PengajuanModel;
use Illuminate\Http\Request;

class BuktiKpaController extends Controller
{
    public function bukti()
    {
        $buktiPengeluarans = BuktiPengeluaranModel::all();
        $pengajuans = PengajuanModel::joinBiodata()->with('buktiPengeluaran')->get();

        return view('pages.kpa.bukti.index', [
            'title' => 'Tanda Bukti',
            'active' => 'Tanda Bukti',
            'pengajuans' => $pengajuans,
            'buktiPengeluarans' => $buktiPengeluarans
        ]);
    }
}
