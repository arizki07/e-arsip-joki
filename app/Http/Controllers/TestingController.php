<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
// use App\Imports\UraianImport;

class TestingController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new Import(), $request->file('file'));

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }
}
