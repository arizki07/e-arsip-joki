<?php

namespace App\Exports;

use App\Models\PengajuanModel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;

class PengajuanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $templatePath;

    public function __construct($templatePath)
    {
        $this->templatePath = $templatePath;
    }
    public function collection()
    {
        // Ambil data dari database dan kembalikan sebagai koleksi
        return PengajuanModel::select(
            'id_pengajuan',
            'p_kpa_id',
            'p_pa_id',
            'p_bpp_id',
            'p_nama_kegiatan',
            'p_sub_kegiatan',
            'p_tanggal',
            'p_biaya'
        )->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'KPA ID',
            'PA ID',
            'BPP ID',
            'Nama Kegiatan',
            'Sub Kegiatan',
            'Tanggal',
            'Biaya',
        ];
    }

    public function map($pengajuan): array
    {
        return [
            $pengajuan->id_pengajuan,
            $pengajuan->p_kpa_id,
            $pengajuan->p_pa_id,
            $pengajuan->p_bpp_id,
            $pengajuan->p_nama_kegiatan,
            $pengajuan->p_sub_kegiatan,
            $pengajuan->p_tanggal,
            $pengajuan->p_biaya,
        ];
    }

     public function startCell(): string
    {
        return 'D12'; // Mulai menulis data dari sel A2
    }
}