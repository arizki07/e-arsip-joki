<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;

class BiodataController extends Controller
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

    public function add()
    {
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.crud.add', [
            'title' => 'Tambah Biodata Pegawai',
            'active' => 'BP',
            'jabatan' => $jabatan
        ]);
    }

    public function create(Request $request)
    {
        $modelBiodata = new BiodataModel();
        $modelUser = new User();

        $data = $request->all();

        $validator = \Validator::make($data, [
            'nama' => 'required|string|max:150',
            'jabatan_id' => 'required|string|max:150',
            'nip' => 'required|string|max:12|min:12|unique:biodatas',
            'email' => 'required|string|max:150|unique:biodatas|unique:users',
            'tgl_lahir' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $modelBiodata->nama = $data['nama'];
        $modelBiodata->jabatan_id = $data['jabatan_id'];
        $modelBiodata->nip = $data['nip'];
        $modelBiodata->email = $data['email'];
        $modelBiodata->tgl_lahir = $data['tgl_lahir'];
        $modelBiodata->alamat = $data['alamat'];

        $password = $data['nip'];
        $passwordHash = bcrypt($password);

        $userData = [
            'email' => $data['email'],
            'password' => $passwordHash,
            'name' => $data['nama'],
            'role' => 'bp',
        ];

        $user = $modelUser->create($userData);

        $modelBiodata->user_id = $user->id_users;
        $modelBiodata->save();

        return redirect()->back()->with('success', 'Data berhasil ditambahkan beserta dengan generate akun.');
    }
}
