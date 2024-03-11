<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\SpjFungsionalModel;
// use Carbon\Carbon;

class SpjFungsionalImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd ($row); die;
        // $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]));
        $SESS_ID_BKU = Session::get('SESS_ID_BKU');
        $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        $model = new SpjFungsionalModel ([
            'id_bku' => $SESS_ID_BKU,
            'id_surat_pengantar' => $SESS_ID_SURAT_PENGANTAR,
            'urusan' => $row[0],
            'organisasi' => $row[1],
            'program' => $row[2],
            'kegiatan' => $row[3],
            'bulan' => $row[4],
        ]);
        // dd ($model); die;
        $model->save();

        Session::put('SESS_ID_FUNGSIONAL', $model->id_fungsional);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}