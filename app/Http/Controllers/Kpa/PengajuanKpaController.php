<?php

namespace App\Http\Controllers\Kpa;

use App\Http\Controllers\Controller;
use App\Models\PengajuanModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PengajuanKpaController extends Controller
{
    public function pengajuan()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.kpa.pengajuan.index', [
            'pengajuan' => $pengajuans,
            'title' => 'Pengajuan',
            'active' => 'Pengajuan'
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