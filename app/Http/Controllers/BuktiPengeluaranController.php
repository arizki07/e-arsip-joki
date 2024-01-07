<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuktiPengeluaranController extends Controller
{
    public function index()
    {
        return view('pages.admin.bukti-pengeluaran.index', [
            'title' => 'Bukti-pengeluaran',
        ]);
    }
}
