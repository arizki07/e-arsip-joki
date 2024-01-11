<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class BPController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.bp', [
            'title' => 'Biodata Pegawai BP',
            'active' => 'BP',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function bp()
    {
        return view('pages.admin.pengguna.bp', [
            'title' => 'Data Bp',
        ]);
    }
}
