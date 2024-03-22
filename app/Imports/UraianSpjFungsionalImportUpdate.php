<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianSpjFungsionalModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UraianSpjFungsionalImportUpdate implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]));
        $SESS_ID_BKU = Session::get('SESS_ID_BKU');
        $SESS_ID_FUNGSIONAL = Session::get('SESS_ID_FUNGSIONAL');

        $surat_pengantar = DB::table('spj_surat_pengantar')->where('id_surat_pengantar', $row[9])->first();

        if (!$surat_pengantar) {
            throw new \Exception("Nomor SPJ pada Sheet URAIAN FUNGSIONAL Tidak Ditemukan");
        }
        // $SESS_ID_SURAT_PENGANTAR = Session::get('SESS_ID_SURAT_PENGANTAR');
        // $model = UraianSpjFungsionalModel::where('id_surat_pengantar', $row[9])->first();
        UraianSpjFungsionalModel::destroy($row[9]);

        return new UraianSpjFungsionalModel ([
            'id_bku' => $SESS_ID_BKU,
            'id_fungsional' => $SESS_ID_FUNGSIONAL,
            'id_surat_pengantar' => $row[9],
            'kode_rekening' => $row[0],
            'tipe' => $row[1],
            'uraian' => $row[2],
            'jumlah_anggaran' => $row[3],
            'sd_bulan_lalu' => $row[4],
            'bulan_ini' => $row[5],
            'sd_bulan_ini' => $row[6],
            'jumlah_spj' => $row[7],
            'sisa_pagu_anggaran' => $row[8],
        ]);

        // if ($model) {
        //     $model->update([
        //         'id_bku' => $SESS_ID_BKU,
        //         'id_fungsional' => $SESS_ID_FUNGSIONAL,
        //         'id_surat_pengantar' => $row[9],
        //         'kode_rekening' => $row[0],
        //         'tipe' => $row[1],
        //         'uraian' => $row[2],
        //         'jumlah_anggaran' => $row[3],
        //         'sd_bulan_lalu' => $row[4],
        //         'bulan_ini' => $row[5],
        //         'sd_bulan_ini' => $row[6],
        //         'jumlah_spj' => $row[7],
        //         'sisa_pagu_anggaran' => $row[8],
        //     ]);
        // } else {
        //     throw new \Exception("Nomor SPJ pada Sheet URAIAN SPJ FUNGSIONAL Tidak Ditemukan");
        // }
        // return $model;
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}