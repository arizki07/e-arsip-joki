<?php

namespace App\Http\Controllers\Kpa;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantarModel;
use Illuminate\Http\Request;

class SpjKpaController extends Controller
{
    public function spj()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.kpa.spj.index', [
            'spj' => $spj,
            'active' => 'SPJ',
            'title' => 'SPJ BPP'
        ]);
    }
}
