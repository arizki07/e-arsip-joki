<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpjModel;

class SpjController extends Controller
{
    public function index()
    {
        return view('pages.admin.spj.index', [
<<<<<<< Updated upstream
            'title' => 'Spj',
            'active' => 'SPJ',
=======
            'title' => 'Spj', 'active' => 'spj'
>>>>>>> Stashed changes
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
