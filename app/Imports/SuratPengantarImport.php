<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\TestingModel;
use Carbon\Carbon;

class SuratPengantarImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]));
        $model = new TestingModel([
            'kpa_id' => $row[0],
            'pa_id' => $row[1],
            'bpp_id' => $row[2],
            'nama_kegiatan' => $row[3],
            'sub_kegiatan' => $row[4],
            'tgl' => $tgl->toDateString(),
            'total_biaya' => $row[6],
            'status' => $row[7],
        ]);
        $model->save();

        Session::put('ses_id', $model->id_testing);

        return $model;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
