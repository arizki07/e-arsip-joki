<?php

namespace App\Http\Controllers\Ppk;

use App\Http\Controllers\Controller;
use App\Models\BiodataModel;
use App\Models\BuktiPengeluaranModel;
use App\Models\PengajuanModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class BuktiPengeluaranPPKContnroller extends Controller
{
    public function index()
    {
        $buktiPengeluarans = BuktiPengeluaranModel::all();
        $pengajuans = PengajuanModel::joinBiodata()->with('buktiPengeluaran')->get();

        return view('pages.ppk.tanda-bukti.index', [
            'title' => 'Bukti Pengeluaran PPK',
            'active' => 'Tanda Bukti',
            'pengajuans' => $pengajuans,
            'buktiPengeluarans' => $buktiPengeluarans
        ]);
    }

    public function verifikasi($id)
    {
        try {
            $buktiPeng = BuktiPengeluaranModel::findOrFail($id);
            $buktiPeng->status = '2';
            $buktiPeng->save();

            return redirect()->back()->with('success', 'Bukti Pengeluaran telah disetujui!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Bukti Pengeluaran tidak ditemukan!');
        }
    }

    public function reject($id)
    {
        try {
            $buktiPeng = BuktiPengeluaranModel::findOrFail($id);
            $buktiPeng->status = '4'; // Mengubah status menjadi reject
            $buktiPeng->save();

            return redirect()->back()->with('success', 'Bukti Pengeluaran telah ditolak!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Bukti Pengeluaran tidak ditemukan!');
        }
    }
}