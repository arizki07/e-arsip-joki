<?php

namespace App\Http\Controllers\Pptk;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantarModel;
use Illuminate\Http\Request;

class SpjPptkController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.pptk.spj.index', [
            'spj' => $spj,
            'active' => 'SPJ',
            'title' => 'SPJ PPTK'
        ]);
    }
}
