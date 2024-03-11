<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\TestingTempatUraianModel;
use App\Models\TestingModel;
use Carbon\Carbon;

class BkuImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]));
        $id_testing = Session::get('ses_id');
        return new TestingTempatUraianModel([
            'testing_id' => $id_testing,
            'kode_rekening' => $row[0],
            'rekening' => $row[1],
            'tgl' => $tgl->toDateString(),
            'penerimaan' => $row[3],
            'pengeluaran' => $row[4],
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}