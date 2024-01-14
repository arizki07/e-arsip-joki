<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class PPTKController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.pptk', [
            'title' => 'Biodata Pegawai PPTK',
            'active' => 'PPTK',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function profile()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.pptk.profile.index', [
            'title' => 'Profile',
            'active' => 'PPTK',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validation rules here

        $biodata = BiodataModel::findOrFail($id);

        $biodata->nama = $request->input('nama');
        $biodata->jabatan_id = $request->input('jabatan_id');
        $biodata->nip = $request->input('nip');
        $biodata->email = $request->input('email');
        $biodata->tgl_lahir = $request->input('tgl_lahir');
        $biodata->alamat = $request->input('alamat');

        // Save the updated data
        $biodata->save();

        return redirect('/profile-pptk')->with('success', 'Data berhasil diperbarui.');
    }
}
