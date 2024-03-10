<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\TestingModel;

class HeaderImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new TestingModel([
            'kpa_id' => $row[0],
            'pa_id' => $row[1],
            'bpp_id' => $row[2],
            'nama_kegiatan' => $row[3],
            'sub_kegiatan' => $row[4],
            'tgl' => '0',
            'total_biaya' => '0',
            'status' => '0',
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; // Sesuaikan dengan baris awal data pada sheet HEADER
    }
}
