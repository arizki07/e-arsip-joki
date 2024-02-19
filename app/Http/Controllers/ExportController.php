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

            // $p_biaya_formatted = 'Rp ' . number_format($pengajuan->p_biaya, 0, ',', '.');
            $template->setValue('p_biaya', $pengajuan->p_biaya);

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

            // $nd_jumlah_biaya_formatted = 'Rp ' . number_format($notaDinas->nd_jumlah_biaya, 0, ',', '.');
            $template->setValue('nd_jumlah_biaya', $notaDinas->nd_jumlah_biaya);

            // Simpan template ke arsip
            $template->saveAs($outputPath);

            return response()->download($outputPath);
        } else {
            return response()->json(['error' => 'Template file not found.']);
        }
    }


    public function exportPengajuanPdf($id)
    {
        $model = new PengajuanModel();

        $pengajuanData = $model->find($id);

        if ($pengajuanData) {
            $pengajuanID = $pengajuanData['id_pengajuan'];

            $laporanPengajuan = $model->select('pengajuans.*', 'pa.nama as nama_pa', 'pa.nip as nip_pa', 'kpa.nama as nama_kpa', 'kpa.nip as nip_kpa', 'bpp.nama as nama_bpp', 'bpp.nip as nip_bpp')
                ->leftJoin('biodatas as pa', 'pa.id_biodata', '=', 'pengajuans.p_pa_id')
                ->leftJoin('biodatas as kpa', 'kpa.id_biodata', '=', 'pengajuans.p_kpa_id')
                ->leftJoin('biodatas as bpp', 'bpp.id_biodata', '=', 'pengajuans.p_bpp_id')
                ->where('pengajuans.id_pengajuan', $pengajuanID)
                ->first();

            $view = view('doc/nota-dinas', ['laporanPengajuan' => $laporanPengajuan]);

            $dompdf = new Dompdf();
            $options = new \Dompdf\Options();
            $options->set('isPhpEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);
            setlocale(LC_TIME, 'id_ID');

            $dompdf->loadHtml($view);

            $dompdf->setPaper('F4', 'portrait');

            $dompdf->render();

            $pdfContent = $dompdf->output();

            $pdfName = str_replace(' ', '_', $pengajuanData['p_nama_kegiatan']);
            $filename = $pdfName . date('d-m-Y_H-i-s') . '.pdf';

            $filePath = public_path('arsip/pdf/' . $filename);
            file_put_contents($filePath, $pdfContent);

            $response = response($pdfContent);
            $response->header('Content-Type', 'application/pdf');
            $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

            $response->setContent($pdfContent);

            return $response;
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
}
