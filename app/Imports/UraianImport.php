<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\TestingTempatUraianModel;
use App\Models\TestingModel;

class UraianImport implements ToModel, WithStartRow
{
    public function model(array $row)
    {
        return new TestingTempatUraianModel([
            'testing_id' => '1',
            'kode_rekening' => $row[0],
            'rekening' => $row[1],
            'tgl' => $row[2],
            'penerimaan' => $row[3],
            'pengeluaran' => $row[4],
        ]);
    }

    public function startRow(): int
    {
        return 2; // Sesuaikan dengan baris awal data pada sheet HEADER
    }
}