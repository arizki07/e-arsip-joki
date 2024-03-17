<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanModel;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class DocumentPPTKController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        // dd($pengajuans);
        return view('pages.admin.document.pptk.index', [
            'title' => 'Terima Pengajuan',
            'active' => 'acc_kpa',
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