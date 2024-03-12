<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use DateTime;
// use App\Imports\UraianImport;

class ImportSpjController extends Controller
{
    // public function import(Request $request)
    // {
    //     $request->validate([
    //         'file' => 'required|mimes:xlsx,xls',
    //     ]);

    //     Excel::import(new Import(), $request->file('file'));

    //     return redirect()->back()->with('success', 'Data berhasil diimpor');
    // }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $now = new DateTime();
        $formatted_datetime = $now->format('Ymd_His');
        $file_name = 'spj_' . $formatted_datetime . '.xlsx';
        $destination_folder = 'arsip/spj';

        $this->create_folder($destination_folder);
        Excel::import(new Import(), $request->file('file'), $destination_folder . '/' . $file_name);

        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }

    private function create_folder($folder_path)
    {
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
    }
}
