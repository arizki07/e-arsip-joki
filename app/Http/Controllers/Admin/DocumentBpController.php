<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PengajuanModel;
use App\Models\NotaDinasModel;
use Dompdf\Dompdf;
// use Illuminate\Database\Eloquent\ModelNotFoundException;


class DocumentBpController extends Controller
{

    public function index()
    {
        die;
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.admin.document.bp.index', [
            'title' => 'Document-Bp',
            'active' => 'bp',
            'pengajuan' => $pengajuans,
        ]);
    }

    public function detailPengajuanPdf($id)
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

            //Untuk View PDF
            $dompdf->stream($pdfContent, array("Attachment" => false));
            exit(0);

            return $response;
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }
}
