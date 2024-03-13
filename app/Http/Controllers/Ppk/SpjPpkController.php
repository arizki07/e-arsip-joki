<?php

namespace App\Http\Controllers\Ppk;

use App\Http\Controllers\Controller;
use App\Models\SuratPengantarModel;
use Illuminate\Http\Request;

class SpjPpkController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.ppk.spj.index', [
            'spj' => $spj,
            'active' => 'SPJ',
            'title' => 'SPJ PPK'
        ]);
    }
}
