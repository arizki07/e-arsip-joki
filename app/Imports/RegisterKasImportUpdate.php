<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\SpjRegisterModel;
use App\Models\BiodataModel;
use Carbon\Carbon;

class RegisterKasImportUpdate implements ToModel, WithStartRow
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
        $cek = BiodataModel::where('id_biodata', $row[1])->exists();
        
        if(!$cek) {
            throw new \Exception("Nomor Biodata Penutup Kas tidak ditemukan");
        } 

        $SESS_ID_BKU = Session::get('SESS_ID_BKU');
        $SESS_ID_FUNGSIONAL = Session::get('SESS_ID_FUNGSIONAL');
        // $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        $model = SpjRegisterModel::where('id_surat_pengantar', $row[7])->first();
        if ($model) {
            $model->update([
                'id_bku' => $SESS_ID_BKU,
                'id_fungsional' => $SESS_ID_FUNGSIONAL,
                'id_surat_pengantar' => $row[7],
                'tgl_penutupan_lalu' => $row[0],
                'id_biodata' => $row[1],
                'saldo_buku' => $row[2],
                'saldo_kas' => $row[3],
                'positif_negatif' => $row[4],
                'kertas_berharga' => $row[5],
                'perbedaan' => $row[6],
            ]);
            // dd ($model); die;
            // $model->save();

            Session::put('SESS_ID_REGISTER_KAS', $model->id_register_kas);
        } else {
            throw new \Exception("Nomor SPJ pada Sheet REGISTER KAS Tidak Ditemukan");
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