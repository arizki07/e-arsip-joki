<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportUpdate implements WithMultipleSheets
{

    public function sheets(): array
    {
        return [
            'SURAT PENGANTAR' => new SuratPengantarImportUpdate(),
            'BKU' => new BkuImportUpdate(),
            // 'URAIAN BKU' => new UraianBkuImportUpdate(),
            'SPJ FUNGSIONAL' => new SpjFungsionalImportUpdate(),
            // 'URAIAN SPJ FUNGSIONAL' => new UraianSpjFungsionalImportUpdate(),
            'REGISTER KAS' => new RegisterKasImportUpdate(),
            // 'URAIAN REGISTER KAS' => new UraianRegisterKasImportUpdate(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}