<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'nip' => 'required|string|max:18|min:18|unique:biodatas',
            'email' => 'required|string|max:150|unique:biodatas|unique:users',
            'tgl_lahir' => 'required|string|max:50',
            'alamat' => 'required|string|max:255',
            'foto_ttd' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

        ]);

        if ($request->hasFile('foto_ttd')) {
            $filename = Str::random(20) . '.' . $request->file('foto_ttd')->getClientOriginalExtension();

            // Create the directory if it doesn't exist
            Storage::disk('public')->makeDirectory('upload/ttd');

            $imagePath = $request->file('foto_ttd')->storeAs('upload/ttd', $filename, 'public');

            if (!$imagePath) {
                return redirect()->back()->with('error', 'Error uploading the photo');
            }
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $modelBiodata->nama = $data['nama'];
        $modelBiodata->jabatan_id = $data['jabatan_id'];
        $modelBiodata->nip = $data['nip'];
        $modelBiodata->email = $data['email'];
        $modelBiodata->tgl_lahir = $data['tgl_lahir'];
        $modelBiodata->alamat = $data['alamat'];
        $modelBiodata->foto_ttd = $imagePath ?? null;

        // Fetch jabatan based on jabatan_id
        $jabatan = JabatanModel::find($data['jabatan_id']);

        if ($jabatan) {
            // Use the role from the fetched jabatan
            $userData = [
                'email' => $data['email'],
                'password' => bcrypt($data['nip']),
                'name' => $data['nama'],
                'role' => $jabatan->kode, // Assuming 'kode' is the field in JabatanModel that holds the role
            ];

            $user = $modelUser->create($userData);

            $modelBiodata->user_id = $user->id_users;
            $modelBiodata->save();

            return redirect()->back()->with('success', 'Data berhasil ditambahkan beserta dengan generate akun.');
        } else {
            // Handle the case where jabatan is not found
            return redirect()->back()->with('error', 'Jabatan not found.');
        }
    }


    public function edit($id)
    {
        $jabatan = JabatanModel::all();
        $biodata = BiodataModel::findOrFail($id);

        return view('pages.admin.biodata.crud.edit', [
            'title' => 'Edit Pegawai BP',
            'active' => 'BP',
            'jabatan'    => $jabatan,
            'item'     => $biodata
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


        return redirect('/data-bp')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        BiodataModel::where('id_biodata', $id)->delete();

        return redirect('/data-bp')->with('success', 'Data berhasil diperbarui.');
    }
}
