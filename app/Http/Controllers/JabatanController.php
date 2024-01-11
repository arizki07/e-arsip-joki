<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\JabatanModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class JabatanController extends Controller
{
    public function index()
    {
        return view('pages.admin.jabatan.index', [
            'title' => 'Jabatan',
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_jabatan' => 'required',
            'kode'         => 'required'
        ]);

        JabatanModel::create($validateData);

        return redirect('/jabatan')->with('success', 'Data Berhasil Disimpan!');

    }

}