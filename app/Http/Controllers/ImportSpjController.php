<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\Import;
use DateTime;
// use App\Imports\UraianImport;

class ImportSpjController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        date_default_timezone_set('Asia/Jakarta');
        $now = new DateTime();
        $formatted_datetime = $now->format('dmYHis');
        $file_name = 'SPJ_' . $formatted_datetime . '.xlsx';
        $destination_folder = 'arsip/spj';
        // dd($destination_folder, $file_name); die;
        $this->create_folder($destination_folder);
        try {
            Excel::import(new Import(), $request->file('file'), $destination_folder . '/' . $file_name);
        } catch (\Exception $e) {
            return redirect()->to('/data-spj')->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Data berhasil diimpor');
    }

    private function create_folder($folder_path)
    {
        if (!file_exists($folder_path)) {
            mkdir($folder_path, 0777, true);
        }
    }
}
