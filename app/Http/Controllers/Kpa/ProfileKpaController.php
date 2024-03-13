<?php

namespace App\Http\Controllers\Kpa;

use App\Http\Controllers\Controller;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileKpaController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        $biodata = BiodataModel::where('user_id', $user->id_users)->get();
        $jabatan = JabatanModel::all();

        return view('pages.kpa.profile.index', [
            'biodata' => $biodata,
            'jabatan' => $jabatan,
            'title' => 'Profile',
            'active' => 'Profile'
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

        return redirect('/profile-kpa')->with('success', 'Data berhasil diperbarui.');
    }
}
