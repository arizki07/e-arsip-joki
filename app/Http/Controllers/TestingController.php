<?php

namespace App\Http\Controllers;

use App\Imports\Import;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TestingController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new Import, $request->file('file'));

        return redirect()->back()->with('success', 'Data Berhasil Diimport');
    }
}
