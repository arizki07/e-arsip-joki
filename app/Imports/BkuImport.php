<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\BkuModel;
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
        // dd ($row); die;
        $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]));
        $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        $model = new BkuModel([
            'id_surat_pengantar' => $SESS_ID_SURAT_PENGANTAR,
            'id_td_bukti' => $row[0],
            'id_kpa' => $row[1],
            'id_pptk' => $row[2],
            'id_bpp' => $row[3],
            'tanggal' => $tgl->toDateString(),
            'kas' => $row[5],
            'tunai' => $row[6],
            'saldo_bank' => $row[7],
            'sp2d' => $row[8],
        ]);
        // dd ($model); die;
        $model->save();

        Session::put('SESS_ID_BKU', $model->id_bku);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}