<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class BPPController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.bpp', [
            'title' => 'Biodata Pegawai BPP',
            'active' => 'BPP',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function bpp()
    {
        return view('pages.admin.pengguna.bpp', [
            'title' => 'Data Bpp',
        ]);
    }
}
