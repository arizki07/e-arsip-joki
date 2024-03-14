<?php

namespace App\Exports;

use App\Models\BiodataModel;
use App\Models\JabatanModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportBioSpj implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return BiodataModel::select('biodatas.id_biodata', 'biodatas.nama', 'jabatans.kode', 'jabatans.nama_jabatan', 'biodatas.email', 'biodatas.nip', 'biodatas.tgl_lahir', 'biodatas.alamat')
            ->join('jabatans', 'biodatas.jabatan_id', '=', 'jabatans.id_jabatan')
            ->get();
    }

    public function headings(): array
    {
        return [
            'NOMOR BIODATA',
            'NAMA',
            'KODE JABATAN',
            'JABATAN',
            'EMAIL TERDAFTAR',
            'NOMOR INDUK PEGAWAI',
            'TANGGAL LAHIR',
            'ALAMAT',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setWidth(25);
        $sheet->getColumnDimension('B')->setWidth(30);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);
        $sheet->getColumnDimension('F')->setWidth(40);
        $sheet->getColumnDimension('G')->setWidth(20);
        $sheet->getColumnDimension('H')->setWidth(50);
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
            'A1:C1' => ['alignment' => ['wrapText' => true]],
        ];
    }
}
