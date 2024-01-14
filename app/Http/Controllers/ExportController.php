<?php

namespace App\Http\Controllers;

use App\Models\PengajuanModel;
use App\Models\NotaDinasModel;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;

class ExportController extends Controller
{
    public function exportPengajuanWord($id)
    {
        $pengajuan = PengajuanModel::findOrFail($id);
        $notaDinas = NotaDinasModel::findOrFail($id);

        $templatePath = public_path('dokumen/word/pengajuan/pengajuan.docx');
        $outputPath = public_path('arsip/' . $pengajuan->p_sub_kegiatan . '_' . strtoupper($pengajuan->p_tanggal) . '.docx');

        // Membuat direktori 'public/arsip/' jika belum ada
        if (!is_dir(public_path('arsip'))) {
                mkdir(public_path('arsip'));
        }

        // Memeriksa eksistensi template file
        if (file_exists($templatePath)) {
            $template = new TemplateProcessor($templatePath);
            // Isi data dari PengajuanModel
            $template->setValue('p_nama_kegiatan', ucwords(strtolower($pengajuan->p_nama_kegiatan)));
            $template->setValue('p_sub_kegiatan', ucwords(strtolower($pengajuan->p_sub_kegiatan)));

            $p_tanggal_formatted = date('d F Y', strtotime($pengajuan->p_tanggal));
            $template->setValue('p_tanggal', $p_tanggal_formatted);

            $p_biaya_formatted = 'Rp ' . number_format($pengajuan->p_biaya, 0, ',', '.');
            $template->setValue('p_biaya', $p_biaya_formatted);

            $created_at_formatted = date('d F Y', strtotime($pengajuan->created_at));
            $template->setValue('created_at', $created_at_formatted);
            $template->setValue('bpp_nama', ucwords(strtolower($pengajuan->bpp->nama)));
            $template->setValue('bpp_nip', $pengajuan->bpp->nip);
            $template->setValue('pa_nama', ucwords(strtolower($pengajuan->pa->nama)));
            $template->setValue('pa_nip', $pengajuan->pa->nip);
            $template->setValue('kpa_nama', ucwords(strtolower($pengajuan->kpa->nama)));
            $template->setValue('kpa_nip', $pengajuan->kpa->nip);

            $template->setValue('nd_nama_kegiatan', $notaDinas->nd_nama_kegiatan);
            $template->setValue('nd_sub_kegiatan', $notaDinas->nd_sub_kegiatan);
            $template->setValue('nd_perihal', $notaDinas->nd_perihal);
            $template->setValue('nd_nomor_nota', $notaDinas->nd_nomor_nota);
            $template->setValue('nd_uraian_kegiatan', $notaDinas->nd_uraian_kegiatan);

            $nd_tanggal_formatted = date('d F Y', strtotime($notaDinas->nd_tanggal));
            $template->setValue('nd_tanggal', $nd_tanggal_formatted);

            $nd_jumlah_biaya_formatted = 'Rp ' . number_format($notaDinas->nd_jumlah_biaya, 0, ',', '.');
            $template->setValue('nd_jumlah_biaya', $nd_jumlah_biaya_formatted);

            // Simpan template ke arsip
            $template->saveAs($outputPath);

            return response()->download($outputPath);

        } else {
            return response()->json(['error' => 'Template file not found.']);
        }
    }

}