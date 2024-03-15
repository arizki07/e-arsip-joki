<?php

namespace App\Exports;

use App\Models\SuratPengantarModel;
// use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SPExport implements FromView
{
    public function view(): View
    {
        // return SuratPengantarModel::all();
        return view('test-cetak', [
            'spp' => SuratPengantarModel::all()
        ]);
    }
}