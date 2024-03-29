<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class PPKController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.ppk', [
            'title' => 'Biodata Pegawai PPK',
            'active' => 'PPK',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }
}
