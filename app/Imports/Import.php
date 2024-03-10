<?php

namespace App\Imports;

use App\Models\TestingModel;
use App\Models\TestingTempatUraianModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Import implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        dd($row);
        die;
        $headerData = [
            'id_testing' => '1',
            'kpa_id' => $row['kpa'],
            'pa_id' => $row['pa'],
            'bpp_id' => $row['bpp'],
            'nama_kegiatan' => $row['nama_kegiatan'],
            'sub_kegiatan' => $row['sub_kegiatan'],
            'tgl' => $row['tanggal'],
            'total_biaya' => $row['total_biaya'],
            'status' => $row['status'],
        ];

        dd($headerData);
        die;

        $header = TestingModel::create($headerData);

        $uraianData = [
            'testing_id' => $header->id,
            'kode_rekening' => $row['kode_rekening'] ?? '112',
            'rekening' => $row['rekening'] ?? '0040031213',
            'tgl' => '12-12-2024',
            'penerimaan' => $row['penerimaan'] ?? '7750000',
            'pengeluaran' => $row['pengeluaran'] ?? '7550000',
        ];

        TestingTempatUraianModel::create($uraianData);
        // dd($headerData, $uraianData);
        // die;

        return $header;
    }

    public function headingRow(): int
    {
        return 1; // Assuming your sheet has a header row on the first line
    }
}
