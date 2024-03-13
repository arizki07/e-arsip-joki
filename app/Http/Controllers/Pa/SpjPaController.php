<?php

namespace App\Http\Controllers\Pa;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantarModel;
use Illuminate\Http\Request;

class SpjPaController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.pa.spj.index', [
            'spj' => $spj,
            'active' => 'SPJ',
            'title' => 'SPJ PA'
        ]);
    }
}
