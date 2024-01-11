<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class KPAController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.kpa', [
            'title' => 'Biodata Pegawai KPA',
            'active' => 'KPA',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function kpa()
    {
        return view('pages.admin.pengguna.kpa', [
            'title' => 'Data Kpa',
        ]);
    }
}
