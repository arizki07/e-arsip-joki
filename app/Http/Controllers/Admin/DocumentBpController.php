<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanModel;
use Illuminate\Http\Request;

class DocumentBpController extends Controller
{
    // public function index()
    // {
    //     return view('pages.admin.document.bp.index', [
    //         'title' => 'Document-Bp',
    //         'active' => 'bp',
    //     ]);
    // }

    public function index()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        // dd($pengajuans);
        return view('pages.admin.document.bp.index', [
            'title' => 'Document-Bp',
            'active' => 'bp',
            'pengajuan' => $pengajuans,
        ]);
    }
}
