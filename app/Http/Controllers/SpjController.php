<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpjModel;
use App\Models\SuratPengantarModel;

class SpjController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.admin.spj.index', [
            'title' => 'Spj',
            'active' => 'SPJ',
            'spj' => $spj,
            'title' => 'Spj', 'active' => 'spj'
        ]);
    }

    public function create()
    {
        $hel = [
            'active' => 'spj',
            'title' => 'Tambah Surat Pertanggung Jawaban'
        ];
        return view('pages.admin.spj.create', $hel);
    }
}
