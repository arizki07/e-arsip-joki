<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class PAController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.pa', [
            'title' => 'Biodata Pegawai PA',
            'active' => 'PA',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function pa()
    {
        return view('pages.admin.pengguna.pa', [
            'title' => 'Data Pa',
        ]);
    }
}
