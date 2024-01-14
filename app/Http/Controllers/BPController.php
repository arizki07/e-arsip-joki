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

    public function profile()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.bp.profile.index', [
            'title' => 'Profile',
            'active' => 'BP',
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

        return redirect('/profile')->with('success', 'Data berhasil diperbarui.');
    }
}
