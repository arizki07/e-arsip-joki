<?php

namespace App\Imports;

use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\SuratPengantarModel;
use App\Models\BuktiPengeluaranModel;
use Carbon\Carbon;

class SuratPengantarImportUpdate implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $tgl = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[4]));
        $cekNota = BuktiPengeluaranModel::where('id_td_bukti', $row[7])->exists();
        
        if(!$cekNota) {
            throw new \Exception("Nomor Bukti Pengeluaran tidak ditemukan");
        }

        $model = SuratPengantarModel::where('id_surat_pengantar', $row[8])->first();

        if ($model) {
            $model->update([
                'nomor_surat' => $row[0],
                'sifat' => $row[1],
                'lampiran' => $row[2],
                'perihal' => $row[3],
                'tanggal' => $tgl->toDateString(),
                'kegiatan' => $row[5],
                'biaya' => $row[6],
                'id_td_bukti' => $row[7],
                'id_surat_pengantar' => $row[8],
            ]);
            Session::put('SESS_ID_SURAT_PENGANTAR', $model->id_surat_pengantar);
        } else {
            throw new \Exception("Nomor SPJ pada Sheet SURAT PENGANTAR Tidak Ditemukan");
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
