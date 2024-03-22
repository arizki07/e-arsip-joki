<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\UraianBkuModel;
use Carbon\Carbon;

class UraianBkuImportUpdate implements ToModel, WithStartRow
{
    /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */
    public function model(array $row)
    {
        $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]));
        $SESS_ID_BKU = Session::get('SESS_ID_BKU');
    
        $surat_pengantar = DB::table('spj_surat_pengantar')->where('id_surat_pengantar', $row[8])->first();
    
        if (!$surat_pengantar) {
            throw new \Exception("Nomor SPJ pada Sheet URAIAN BKU Tidak Ditemukan");
        }
    
        // UraianBkuModel::where('id_surat_pengantar', $row[8])->delete();
        UraianBkuModel::destroy($row[8]);

        return new UraianBkuModel([
            'id_bku' => $SESS_ID_BKU,
            'id_surat_pengantar' => $row[8],
            'no_urut' => $row[0],
            'tanggal' => $tgl->toDateString(),
            'uraian' => $row[2],
            'kode_rekening' => $row[3],
            'penerimaan' => $row[4],
            'pengeluaran' => $row[5],
            'saldo' => $row[6],
            'keterangan' => $row[7],
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