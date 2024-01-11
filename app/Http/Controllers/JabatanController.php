<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\JabatanModel;

class JabatanController extends Controller
{
    public function index()
    {
        $jabatan = JabatanModel::all();

        return view('pages.admin.jabatan.index', [
            'title' => 'Data Jabatan',
            'active' => 'Jabatan',
            'jabatan' => $jabatan
        ]);
    }

    public function add(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'kode' => 'required|string|max:150|unique:jabatans',
            'nama_jabatan' => 'required|string|max:150|unique:jabatans',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jabatan = new JabatanModel();
        $jabatan->kode = $data['kode'];
        $jabatan->nama_jabatan = $data['nama_jabatan'];
        $jabatan->save();

        return redirect()->back()->with('success', 'Jabatan berhasil ditambahkan.');
    }

    public function edit(Request $request, int $id)
    {
        $jabatan = JabatanModel::find($id);

        if (!$jabatan) {
            return redirect()->back()->with('error', 'Jabatan tidak ditemukan.');
        }

        $data = $request->all();

        $validator = \Validator::make($data, [
            'kode' => [
                'required',
                'string',
                'max:150',
                Rule::unique('jabatans')->ignore($id, 'id_jabatan'),
            ],
            'nama_jabatan' => [
                'required',
                'string',
                'max:150',
                Rule::unique('jabatans')->ignore($id, 'id_jabatan'),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $jabatan->kode = $data['kode'];
        $jabatan->nama_jabatan = $data['nama_jabatan'];
        $jabatan->save();

        return redirect()->back()->with('success', 'Jabatan berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $jabatan = JabatanModel::find($id);

        if (!$jabatan) {
            return redirect()->back()->with('error', 'Jabatan tidak ditemukan.');
        }

        $jabatan->delete();

        return redirect()->back()->with('success', 'Jabatan berhasil dihapus.');
    }
}
