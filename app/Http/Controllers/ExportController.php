<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuktiPengeluaranModel;
use App\Models\PengajuanModel;
use App\Models\NotaDinasModel;
use App\Models\SuratPengantarModel;
use App\Models\UraianBkuModel;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\View;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Response;
use App\Exports\ExportBioSpj;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use setasign\Fpdi\Fpdi;

class ExportController extends Controller
{
    public function exportPengajuanWord($id)
    {
        $pengajuan = PengajuanModel::findOrFail($id);
        $notaDinas = NotaDinasModel::where('id_pengajuan', $id)->first();

        // var_dump($pengajuan);
            // dd($notaDinas);
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
        // $pengajuan = PengajuanModel::findOrFail($id);
        // $notaDinas = NotaDinasModel::where('id_pengajuan', $id)->first();
        $model = new PengajuanModel();
        $modelNota = new NotaDinasModel();

        $pengajuanData = $model->find($id);
        $notaData = $modelNota->where('id_pengajuan', $id)->first();

        // dd($notaData);
        if ($pengajuanData) {
            $pengajuanID = $pengajuanData['id_pengajuan'];

            $laporanPengajuan = $model->select('pengajuans.*', 'pa.nama as nama_pa', 'pa.nip as nip_pa', 'kpa.nama as nama_kpa', 'kpa.nip as nip_kpa', 'bpp.nama as nama_bpp', 'bpp.nip as nip_bpp')
                ->leftJoin('biodatas as pa', 'pa.id_biodata', '=', 'pengajuans.p_pa_id')
                ->leftJoin('biodatas as kpa', 'kpa.id_biodata', '=', 'pengajuans.p_kpa_id')
                ->leftJoin('biodatas as bpp', 'bpp.id_biodata', '=', 'pengajuans.p_bpp_id')
                ->where('pengajuans.id_pengajuan', $pengajuanID)
                ->first();

            $view = view('doc/nota-dinas', [
                'laporanPengajuan' => $laporanPengajuan,
                'notaData' => $notaData,
            ]);

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

    public function exportBuktiPengPdf($id)
    {
        $model = new BuktiPengeluaranModel();

        $buktiPengeluaran = $model->find($id);
        if ($buktiPengeluaran) {
            $buktiPengID = $buktiPengeluaran['id_td_bukti'];

            $data = $model->select(
                'td_bukti_pengeluarans.*',
                'pa.nama as nama_pa',
                'pa.nip as nip_pa',
                'kpa.nama as nama_kpa',
                'kpa.nip as nip_kpa',
                'bpp.nama as nama_bpp',
                'bpp.nip as nip_bpp',
                'bp.nama as nama_bp',
                'bp.nip as nip_bp',
                'peng.p_nama_kegiatan',
                'peng.p_sub_kegiatan',
                'peng.p_tanggal',
            )
                ->leftJoin('biodatas as pa', 'pa.id_biodata', '=', 'td_bukti_pengeluarans.td_pa_id')
                ->leftJoin('biodatas as kpa', 'kpa.id_biodata', '=', 'td_bukti_pengeluarans.td_kpa_id')
                ->leftJoin('biodatas as bpp', 'bpp.id_biodata', '=', 'td_bukti_pengeluarans.td_bpp_id')
                ->leftJoin('biodatas as bp', 'bp.id_biodata', '=', 'td_bukti_pengeluarans.td_bp_id')
                ->join('pengajuans as peng', 'peng.id_pengajuan', '=', 'td_bukti_pengeluarans.td_id_pengajuan')
                ->where('td_bukti_pengeluarans.id_td_bukti', $buktiPengID)
                ->first();
            $amountString = preg_replace("/[^0-9]/", "", $data->td_biaya);

            $terbilang = $this->terbilangRupiah($amountString);
            $pdf = PDF::setOptions([
                'isPhpEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isHtml5PhpEnabled' => true,
                'isPhp7' => true,
                'isHtml5' => true,
                'isPaperSizeEnabled' => true,
                'isFontSubsettingEnabled' => true,
                'defaultFont' => 'times'
            ])->loadview('doc.bukti-pengeluaran', [
                'data' => $data,
                'terbilangRupiah' => $terbilang,
            ])->setPaper('a4', 'potrait');

            // Return the PDF content without triggering download
            return response($pdf->output())
                ->header('Content-Type', 'application/pdf');
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    function terbilangRupiah($angka)
    {
        // dd($angka);
        $bilangan = abs((int)$angka);
        $huruf = array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan');
        $tingkat = array('', 'Ribu', 'Juta', 'Miliar', 'Triliun');

        $hasil_terbilang = '';
        $jumlah_kata = 0;

        while ($bilangan > 0) {
            $bagian = $bilangan % 1000;

            if ($bagian > 0) {
                $str = '';
                $ratusan = floor($bagian / 100);
                $puluhan = floor(($bagian % 100) / 10);
                $satuan = $bagian % 10;

                if ($ratusan > 0) {
                    $str .= $huruf[$ratusan] . ' Ratus ';
                }

                if ($puluhan > 0) {
                    if ($puluhan == 1) {
                        $str .= 'Sebelas ';
                    } elseif ($puluhan == 0) {
                        $str .= $huruf[$satuan] . ' ';
                    } else {
                        $str .= $huruf[$puluhan] . ' Puluh ';
                    }
                }

                if ($satuan > 0 && $puluhan != 1) {
                    $str .= $huruf[$satuan] . ' ';
                }

                $str .= $tingkat[$jumlah_kata];
                $hasil_terbilang = $str . $hasil_terbilang;
            }

            $bilangan = floor($bilangan / 1000);
            $jumlah_kata++;
        }

        return ($hasil_terbilang == '') ? 'Nol' : $hasil_terbilang;
    }

    public function bioSpj()
    {
        // return Excel::download(new ExportBioSpj, 'Daftar-Biodata.xlsx', true, ['X-Vapor-Base64-Encode' => 'True']);
        return Excel::download(new ExportBioSpj, 'Daftar-Biodata.xlsx');
    }


    public function export_spj(Request $request, $id)
    {
        $model = new SuratPengantarModel();
        $spjData = $model->find($id);
        $act = $request->get('typeSPJ');
        // dd($act);
        // die;

        if ($spjData) {
            $suratPengantarID = $spjData['id_surat_pengantar'];

            $querySPJ = (new SuratPengantarModel())->querySpjAll($suratPengantarID);
            $queryUraianBku = (new SuratPengantarModel())->queryUraianBku($suratPengantarID);
            $queryUraianFungsional = (new SuratPengantarModel())->queryUraianFungsional($suratPengantarID);
            $queryFungsional = (new SuratPengantarModel())->queryFungsi($suratPengantarID);
            // dd($querySPJ);
            // dd($queryUraianBku);
            // dd($queryUraianFungsional);
            // die;
            $uraianJson = $querySPJ->td_uraian;
            $uraianArray = json_decode($uraianJson, true);
            $uraianData = [];
            foreach ($uraianArray as $uraianItem) {
                $uraianData[] = [
                    'jumlah' => $uraianItem['jumlah'],
                    'uraian' => $uraianItem['uraian']
                ];
            }

            $total = 0;
            foreach ($uraianData as $item) {
                $jumlah = str_replace(['Rp ', '.'], '', $item['jumlah']);
                $total += (int)$jumlah;
            }

            // URAIAN FUNGSIONAL (TIPE == URAIAN FUNGSIONAL)
            $jumlahSpjTerbesar = 0;
            $jmlBulanIni = 0;
            $jmlsdBulanIni = 0;
            $jmlAnggaran = 0;
            $jmlBulanLalu = 0;
            foreach ($queryUraianFungsional as $urFUNG) {
                if ($urFUNG->id_surat_pengantar == $id && $urFUNG->tipe == 'Uraian Fungsional') {
                    if (is_numeric($urFUNG->jumlah_spj) && $urFUNG->jumlah_spj > $jumlahSpjTerbesar) {
                        $jumlahSpjTerbesar = $urFUNG->jumlah_spj;
                    }
                    if (is_numeric($urFUNG->bulan_ini) && $urFUNG->bulan_ini > $jmlBulanIni) {
                        $jmlBulanIni = $urFUNG->bulan_ini;
                    }
                    if (is_numeric($urFUNG->sd_bulan_ini) && $urFUNG->sd_bulan_ini > $jmlsdBulanIni) {
                        $jmlsdBulanIni = $urFUNG->sd_bulan_ini;
                    }
                    if (is_numeric($urFUNG->jumlah_anggaran) && $urFUNG->jumlah_anggaran > $jmlAnggaran) {
                        $jmlAnggaran = $urFUNG->jumlah_anggaran;
                    }
                    if (is_numeric($urFUNG->sd_bulan_lalu) && $urFUNG->sd_bulan_lalu > $jmlBulanLalu) {
                        $jmlBulanLalu = $urFUNG->sd_bulan_lalu;
                    }
                }
            }

            // START Group Syntax Penerimaan
            $penerimaanSP2D = 0;
            $penerimaanPajak = 0;
            $penerimaanSP2Dsd = 0;
            $penerimaanPajaksd = 0;
            foreach ($queryUraianFungsional as $urFUNG) {
                if ($urFUNG->id_surat_pengantar == $id && $urFUNG->tipe == 'Penerimaan' && $urFUNG->uraian == 'SP2D / Panjar') {

                    if (is_numeric($urFUNG->bulan_ini) && $urFUNG->bulan_ini > $penerimaanSP2D) {
                        $penerimaanSP2D = $urFUNG->bulan_ini;
                    }
                    if (is_numeric($urFUNG->sd_bulan_ini) && $urFUNG->sd_bulan_ini > $penerimaanSP2Dsd) {
                        $penerimaanSP2Dsd = $urFUNG->sd_bulan_ini;
                    }
                } else if ($urFUNG->id_surat_pengantar == $id && $urFUNG->tipe == 'Penerimaan' && $urFUNG->uraian == 'Potongan Pajak') {

                    if (is_numeric($urFUNG->bulan_ini) && $urFUNG->bulan_ini > $penerimaanPajak) {
                        $penerimaanPajak = $urFUNG->bulan_ini;
                    }
                    if (is_numeric($urFUNG->sd_bulan_ini) && $urFUNG->sd_bulan_ini > $penerimaanPajaksd) {
                        $penerimaanPajaksd = $urFUNG->sd_bulan_ini;
                    }
                }
            }
            $totalPenerimaan = $penerimaanSP2D + $penerimaanPajak;
            $totalPenerimaansd = $penerimaanSP2Dsd + $penerimaanPajaksd;

            // START Group Syntax Pengeluaran
            $pengeluaranSP2D = 0;
            $pengeluaranPajak = 0;
            $pengeluaranSP2Dsd = 0;
            $pengeluaranPajaksd = 0;
            foreach ($queryUraianFungsional as $urFUNG) {
                if ($urFUNG->id_surat_pengantar == $id && $urFUNG->tipe == 'Pengeluaran' && $urFUNG->uraian == 'SP2D / Panjar') {

                    if (is_numeric($urFUNG->bulan_ini) && $urFUNG->bulan_ini > $pengeluaranSP2D) {
                        $pengeluaranSP2D = $urFUNG->bulan_ini;
                    }
                    if (is_numeric($urFUNG->sd_bulan_ini) && $urFUNG->sd_bulan_ini > $pengeluaranSP2Dsd) {
                        $pengeluaranSP2Dsd = $urFUNG->sd_bulan_ini;
                    }
                } else if ($urFUNG->id_surat_pengantar == $id && $urFUNG->tipe == 'Pengeluaran' && $urFUNG->uraian == 'Potongan Pajak') {

                    if (is_numeric($urFUNG->bulan_ini) && $urFUNG->bulan_ini > $pengeluaranPajak) {
                        $pengeluaranPajak = $urFUNG->bulan_ini;
                    }
                    if (is_numeric($urFUNG->sd_bulan_ini) && $urFUNG->sd_bulan_ini > $pengeluaranPajaksd) {
                        $pengeluaranPajaksd = $urFUNG->sd_bulan_ini;
                    }
                }
            }
            $totalPengeluaran = $pengeluaranSP2D + $pengeluaranPajak;
            $totalPengeluaransd = $pengeluaranSP2Dsd + $pengeluaranPajaksd;

            if ($act == 'spj_surat_pengantar') {
                $view = view('doc/spj/surat-pengantar', ['surPeng' => $querySPJ, 'uraianData' => $uraianData, 'total' => $total]);
            } else if ($act == 'spj_bku') {
                $totalPenerimaanBku = 0;
                $totalPengeluaranBku = 0;
                $totalSaldo = 0;
                foreach ($queryUraianBku as $urBKU) {
                    if ($urBKU->id_surat_pengantar == $id) {

                        if (is_numeric($urBKU->penerimaan)) {
                            $totalPenerimaanBku += $urBKU->penerimaan;
                        }
                        if (is_numeric($urBKU->pengeluaran)) {
                            $totalPengeluaranBku += $urBKU->pengeluaran;
                        }
                        if (is_numeric($urBKU->saldo)) {
                            $totalSaldo += $urBKU->saldo;
                        }
                    }
                }
                $view = view('doc/spj/bku', ['bku' => $querySPJ, 'queryUraianBku' => $queryUraianBku, 'uraianData' => $uraianData, 'total' => $total, 'totalPenerimaanBku' => $totalPenerimaanBku, 'totalPengeluaranBku' => $totalPengeluaranBku, 'totalSaldo' => $totalSaldo]);
            } else if ($act == 'spj_fungsional') {
                $view = view('doc/spj/fungsional', ['bku' => $querySPJ, 'urFungsional' => $queryUraianFungsional, 'fungsi' => $queryFungsional, 'uraianData' => $uraianData, 'jumlahSpjTerbesar' => $jumlahSpjTerbesar, 'jmlBulanIni' => $jmlBulanIni, 'jmlsdBulanIni' => $jmlsdBulanIni, 'jmlAnggaran' => $jmlAnggaran, 'jmlBulanLalu' => $jmlBulanLalu, 'totalPenerimaan' => $totalPenerimaan, 'totalPenerimaansd' => $totalPenerimaansd, 'totalPengeluaran' => $totalPengeluaran, 'totalPengeluaransd' => $totalPengeluaransd]);
            } else if ($act == 'spj_register_kas') {
                $view = view('doc/spj/register', [
                    'bku' => $querySPJ,
                    'totalPenerimaan' => $totalPenerimaan,
                    'totalPengeluaran' => $totalPengeluaran,
                    'uraianData' => $uraianData
                ]);
            } else if ($act == 'spj_all') {
                // $mergedContent = '';
                $tempFiles = [];
                $acts = ['spj_surat_pengantar', 'spj_bku', 'spj_fungsional', 'spj_register_kas'];
                foreach ($acts as $actType) {
                    if ($actType == 'spj_surat_pengantar') {
                        $view = view('doc/spj/surat-pengantar', ['surPeng' => $querySPJ, 'uraianData' => $uraianData, 'total' => $total]);
                        $pdfContent = $this->generatePdfFromView($view);
                        $tempFile = tempnam(sys_get_temp_dir(), 'spj_surat_pengantar');
                        file_put_contents($tempFile, $pdfContent);
                        $tempFiles[] = $tempFile;
                    } else if ($actType == 'spj_bku') {
                        $totalPenerimaanBku = 0;
                        $totalPengeluaranBku = 0;
                        $totalSaldo = 0;
                        foreach ($queryUraianBku as $urBKU) {
                            if ($urBKU->id_surat_pengantar == $id) {

                                if (is_numeric($urBKU->penerimaan)) {
                                    $totalPenerimaanBku += $urBKU->penerimaan;
                                }
                                if (is_numeric($urBKU->pengeluaran)) {
                                    $totalPengeluaranBku += $urBKU->pengeluaran;
                                }
                                if (is_numeric($urBKU->saldo)) {
                                    $totalSaldo += $urBKU->saldo;
                                }
                            }
                        }
                        $view = view('doc/spj/bku', ['bku' => $querySPJ, 'queryUraianBku' => $queryUraianBku, 'uraianData' => $uraianData, 'total' => $total, 'totalPenerimaanBku' => $totalPenerimaanBku, 'totalPengeluaranBku' => $totalPengeluaranBku, 'totalSaldo' => $totalSaldo]);
                        $pdfContent = $this->generatePdfFromView($view);
                        $tempFile = tempnam(sys_get_temp_dir(), 'spj_bku');
                        file_put_contents($tempFile, $pdfContent);
                        $tempFiles[] = $tempFile;
                    } else if ($actType == 'spj_fungsional') {
                        $view = view('doc/spj/fungsional', ['bku' => $querySPJ, 'urFungsional' => $queryUraianFungsional, 'fungsi' => $queryFungsional, 'uraianData' => $uraianData, 'jumlahSpjTerbesar' => $jumlahSpjTerbesar, 'jmlBulanIni' => $jmlBulanIni, 'jmlsdBulanIni' => $jmlsdBulanIni, 'jmlAnggaran' => $jmlAnggaran, 'jmlBulanLalu' => $jmlBulanLalu, 'totalPenerimaan' => $totalPenerimaan, 'totalPenerimaansd' => $totalPenerimaansd, 'totalPengeluaran' => $totalPengeluaran, 'totalPengeluaransd' => $totalPengeluaransd]);
                        $pdfContent = $this->generatePdfFromView($view);
                        $tempFile = tempnam(sys_get_temp_dir(), 'spj_fungsional');
                        file_put_contents($tempFile, $pdfContent);
                        $tempFiles[] = $tempFile;
                    } else if ($actType == 'spj_register_kas') {
                        $view = view('doc/spj/register', ['bku' => $querySPJ, 'totalPenerimaan' => $totalPenerimaan, 'totalPengeluaran' => $totalPengeluaran, 'uraianData' => $uraianData]);
                        $pdfContent = $this->generatePdfFromView($view);
                        $tempFile = tempnam(sys_get_temp_dir(), 'spj_register_kas');
                        file_put_contents($tempFile, $pdfContent);
                        $tempFiles[] = $tempFile;
                    }
                }

                $pdf = new \setasign\Fpdi\Fpdi();
                foreach ($tempFiles as $tempFile) {
                    $pageCount = $pdf->setSourceFile($tempFile);
                    for ($pageNumber = 1; $pageNumber <= $pageCount; $pageNumber++) {
                        $template = $pdf->importPage($pageNumber);
                        $pdf->AddPage();
                        $pdf->useTemplate($template);
                    }
                    unlink($tempFile);
                }

                $pdfName = str_replace(' ', '_', $spjData['id_surat_pengantar']);
                $mergedFilename = 'SPJ_ALL-NO-' . $pdfName . date('d-m-Y_H-i-s') . '.pdf';
                $mergedFilePath = public_path('arsip/pdf/' . $mergedFilename);
                $pdf->Output($mergedFilePath, 'F');

                $response = response()->download($mergedFilePath, $mergedFilename);
                return $response;
            }

            $dompdf = new Dompdf();
            $options = new \Dompdf\Options();
            $options->set('isPhpEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);
            setlocale(LC_TIME, 'id_ID');
            date_default_timezone_set('Asia/Jakarta');

            $dompdf->loadHtml($view);

            $dompdf->setPaper('F4', 'portrait');

            $dompdf->render();

            $pdfContent = $dompdf->output();

            if ($act == 'spj_surat_pengantar') {
                $pdfName = str_replace(' ', '_', $spjData['id_surat_pengantar']);
                $filename = 'SPJ_SURAT PENGANTAR_No-' . $pdfName . date('d-m-Y_H-i-s') . '.pdf';
            } else if ($act == 'spj_bku') {
                $pdfName = str_replace(' ', '_', $spjData['id_surat_pengantar']);
                $filename = 'SPJ_BKU_No-' . $pdfName . date('d-m-Y_H-i-s') . '.pdf';
            } else if ($act == 'spj_fungsional') {
                $pdfName = str_replace(' ', '_', $spjData['id_surat_pengantar']);
                $filename = 'SPJ_FUNGSIONAL_No-' . $pdfName . date('d-m-Y_H-i-s') . '.pdf';
            } else if ($act == 'spj_register_kas') {
                $pdfName = str_replace(' ', '_', $spjData['id_surat_pengantar']);
                $filename = 'SPJ_REGISTER KAS_No-' . $pdfName . date('d-m-Y_H-i-s') . '.pdf';
            }

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

    private function generatePdfFromView($view)
    {
        $dompdf = new Dompdf();
        $options = new \Dompdf\Options();
        $options->set('isPhpEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
        setlocale(LC_TIME, 'id_ID');
        date_default_timezone_set('Asia/Jakarta');

        $dompdf->loadHtml($view);

        $dompdf->setPaper('F4', 'portrait');

        $dompdf->render();

        return $dompdf->output();
    }
}

// JANGAN DIHAPUS (CEK QUERY SQL SPJ ALL)
// SELECT
//     sp.*,
//     pj.*,
// 		ju.*,
// 		bku.*,
// 		urbku.*,
// 		fung.*,
// 		urfung.*,
// 		reg.*,
// 		urreg.*,
// 		bku.*,
//     bd_kpa.nama AS nama_kpa,
//     bd_pa.nama AS nama_pa,
//     bd_bpp.nama AS nama_bpp
// FROM
//     spj_surat_pengantar AS sp
// JOIN
//     td_bukti_pengeluarans AS pj ON sp.id_td_bukti = pj.id_td_bukti
// LEFT JOIN
// 		pengajuans AS ju ON pj.td_id_pengajuan = ju.id_pengajuan
// LEFT JOIN
//     biodatas AS bd_kpa ON pj.td_kpa_id = bd_kpa.id_biodata
// LEFT JOIN
//     biodatas AS bd_pa ON pj.td_pa_id = bd_pa.id_biodata
// LEFT JOIN
//     biodatas AS bd_bpp ON pj.td_bpp_id = bd_bpp.id_biodata
// LEFT JOIN
// 		spj_bku AS bku ON bku.id_surat_pengantar = sp.id_surat_pengantar
// LEFT JOIN
// 		spj_bku_uraian AS urbku ON urbku.id_surat_pengantar = sp.id_surat_pengantar
// LEFT JOIN
// 		spj_fungsional AS fung ON fung.id_surat_pengantar = sp.id_surat_pengantar
// LEFT JOIN
// 		spj_fungsional_uraian AS urfung ON urfung.id_surat_pengantar = sp.id_surat_pengantar
// LEFT JOIN
// 		spj_register_kas AS reg ON reg.id_surat_pengantar = sp.id_surat_pengantar
// LEFT JOIN
// 		spj_register_uraian AS urreg ON urreg.id_surat_pengantar = sp.id_surat_pengantar
// WHERE
//     sp.id_surat_pengantar = 'ISI PAKE ID SURAT PENGANTAR';