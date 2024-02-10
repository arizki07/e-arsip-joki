<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BiodataModel;
use App\Models\PengajuanModel;

class BuktiPengeluaranController extends Controller
{

    public function index()
    {

        return view('pages.admin.bukti-pengeluaran.index', [
            'title' => 'Bukti-pengeluaran',
            'active' => 'Bukti-pengeluaran'
        ]);
    }
}
