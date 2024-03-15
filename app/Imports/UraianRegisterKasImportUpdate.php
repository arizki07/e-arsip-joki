<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianSpjRegisterModel;
use Carbon\Carbon;

class UraianRegisterKasImportUpdate implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]));
        $SESS_ID_REGISTER_KAS = Session::get('SESS_ID_REGISTER_KAS');
        // $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        $model = UraianSpjRegisterModel::where('id_surat_pengantar', $row[13])->first();
        if ($model) {
            $model->update([
                'id_register_kas' => $SESS_ID_REGISTER_KAS,
                'id_surat_pengantar' => $row[13],
                'kertas_100' => $row[0],
                'kertas_50' => $row[1],
                'kertas_20' => $row[2],
                'kertas_10' => $row[3],
                'kertas_5' => $row[4],
                'kertas_1' => $row[5],
                'logam_1000' => $row[6],
                'logam_500' => $row[7],
                'logam_100' => $row[8],
                'logam_50' => $row[9],
                'logam_25' => $row[10],
                'logam_10' => $row[11],
                'logam_5' => $row[12],
            ]);
        } else {
            throw new \Exception("Nomor SPJ pada Sheet URAIAN REGISTER KAS Tidak Ditemukan");
        }
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