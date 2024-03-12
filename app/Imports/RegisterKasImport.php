<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\SpjRegisterModel;
use Carbon\Carbon;

class RegisterKasImport implements ToModel, WithStartRow
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
        $SESS_ID_FUNGSIONAL = Session::get('SESS_ID_FUNGSIONAL');
        $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        $model = new SpjRegisterModel([
            'id_bku' => $SESS_ID_BKU,
            'id_fungsional' => $SESS_ID_FUNGSIONAL,
            'id_surat_pengantar' => $SESS_ID_SURAT_PENGANTAR,
            'tgl_penutupan_lalu' => $row[0],
            'id_biodata' => $row[1],
            'saldo_buku' => $row[2],
            'saldo_kas' => $row[3],
            'positif_negatif' => $row[4],
            'kertas_berharga' => $row[5],
            'perbedaan' => $row[6],
        ]);
        // dd ($model); die;
        $model->save();

        Session::put('SESS_ID_REGISTER_KAS', $model->id_register_kas);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}