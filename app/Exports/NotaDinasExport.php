<?php

namespace App\Exports;

use App\Models\NotaDinasModel;
use Maatwebsite\Excel\Concerns\FromCollection;

class NotaDinasExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return NotaDinasModel::all();
    }

    public function headings(): array
    {
        return [
            'ID',
            'KPA ID',
            'Nama Kegiatan',
            'Sub Kegiatan',
            'Perihal',
            'Nomor Nota',
            'Uraian Kegiatan',
            'Tanggal',
            'Jumlah Biaya',
        ];
    }
}