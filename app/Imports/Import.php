<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TestingModel;
use App\Models\TestingTempatUraianModel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Import implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'SURAT PENGANTAR' => new SuratPengantarImport(),
            'BKU' => new BkuImport(),
            'URAIAN BKU' => new UraianBkuImport(),
            'SPJ FUNGSIONAL' => new SpjFungsionalImport(),
            'URAIAN SPJ FUNGSIONAL' => new UraianSpjFungsionalImport(),
            'REGISTER KAS' => new RegisterKasImport(),
            'URAIAN REGISTER KAS' => new UraianRegisterKasImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}