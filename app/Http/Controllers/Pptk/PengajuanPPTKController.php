<?php

namespace App\Http\Controllers\Pptk;

use Illuminate\Http\Request;
use App\Models\PengajuanModel;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PengajuanPPTKController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        // dd($pengajuans);
        return view('pages.pptk.pengajuan.index', [
            'title' => 'Pengajuan',
            'active' => 'acc_pptk',
            'pengajuan' => $pengajuans,
        ]);
    }

    public function verifikasi($id)
    {
        try {
            $pengajuan = PengajuanModel::findOrFail($id);
            $pengajuan->status = '3';
            $pengajuan->save();

            return redirect()->back()->with('success', 'Pengajuan telah disetujui!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan!');
        }
    }

    public function reject($id)
    {
        try {
            $pengajuan = PengajuanModel::findOrFail($id);
            $pengajuan->status = '5'; // Mengubah status menjadi reject
            $pengajuan->save();

            return redirect()->back()->with('success', 'Pengajuan telah ditolak!');
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Pengajuan tidak ditemukan!');
        }
    }
}
