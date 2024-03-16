<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class PengajuanPaController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.pa.pengajuan.index', [
            'pengajuan' => $pengajuans,
            'title' => 'Pengajuan-pa',
            'active' => 'Pengajuan-pa'
        ]);
    }

    public function verifikasi($id)
    {
        try {
            $pengajuan = PengajuanModel::findOrFail($id);
            $pengajuan->status = '4';
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
