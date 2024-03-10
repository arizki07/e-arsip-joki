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
            'HEADER' => new HeaderImport(),
            'URAIAN' => new UraianImport(),
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        info("Sheet {$sheetName} di skip :p");
    }
}