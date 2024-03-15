<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpjModel;
use App\Models\SuratPengantarModel;
use App\Models\BkuModel;
use App\Models\BuktiPengeluaranModel;
use App\Models\SpjFungsionalModel;
use App\Models\SpjRegisterModel;
use App\Models\UraianBkuModel;
use App\Models\UraianSpjFungsionalModel;
use App\Models\UraianSpjRegisterModel;
use App\Models\BiodataModel;
use App\Exports\SPExport;
use Maatwebsite\Excel\Facades\Excel;

class SpjController extends Controller
{
    public function index()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.admin.spj.index', [
            'title' => 'Spj',
            'active' => 'SPJ',
            'spj' => $spj
        ]);
    }

    public function view($id)
    {
        // $hel = [
        //     'active' => 'spj',
        //     'title' => 'Tambah Surat Pertanggung Jawaban'
        // ];
        // return view('pages.admin.spj.create', $hel);
        $suratPengantar = SuratPengantarModel::findOrFail($id);
        $bku = BkuModel::all();
        $buktiPengeluaran = BuktiPengeluaranModel::all();
        $fungsional = SpjFungsionalModel::all();
        $register = SpjRegisterModel::all();
        $uraianBku = UraianBkuModel::all();
        $uraianFungsional = UraianSpjFungsionalModel::all();
        $uraianRegister = UraianSpjRegisterModel::all();
        $biodata = BiodataModel::all();

        $totalPenerimaan = 0;
        $totalPengeluaran = 0;
        $totalSaldo = 0;
        foreach ($uraianBku as $urBKU) {
            if ($urBKU->id_surat_pengantar == $id){
                
                if (is_numeric($urBKU->penerimaan)) {
                    $totalPenerimaan += $urBKU->penerimaan;
                }
                if (is_numeric($urBKU->pengeluaran)) {
                    $totalPengeluaran += $urBKU->pengeluaran;
                }
                if (is_numeric($urBKU->saldo)) {
                    $totalSaldo += $urBKU->saldo;
                }
            }
        }

        // URAIAN FUNGSIONAL (TIPE == URAIAN FUNGSIONAL)
        $jumlahSpjTerbesar = 0;
        $jmlBulanIni = 0;
        $jmlsdBulanIni = 0;
        $jmlAnggaran = 0;
        $jmlBulanLalu = 0;
        foreach ($uraianFungsional as $urFUNG) {
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
        foreach ($uraianFungsional as $urFUNG) {
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
        // END Group Syntax Penerimaan

        // START Group Syntax Pengeluaran
        $pengeluaranSP2D = 0;
        $pengeluaranPajak = 0;
        $pengeluaranSP2Dsd = 0;
        $pengeluaranPajaksd = 0;
        foreach ($uraianFungsional as $urFUNG) {
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
        $urBKUs = UraianBkuModel::orderBy('no_urut', 'asc')->get();
        // END Group Syntax Pengeluaran

        return view('pages.admin.spj.view', [
            'title' => 'Spj',
            'title2' => 'Detail SPJ',
            'suratPengantar' => $suratPengantar,
            'bku' => $bku,
            'buktiPengeluaran' => $buktiPengeluaran,
            'fungsional' => $fungsional,
            'register' => $register,
            'uraianBku' => $uraianBku,
            'uraianFungsional' => $uraianFungsional,
            'uraianRegister' => $uraianRegister,
            'biodata' => $biodata,
            'totalPenerimaan' => $totalPenerimaan,
            'totalPengeluaran' => $totalPengeluaran,
            'totalSaldo' => $totalSaldo,
            'jumlahSpjTerbesar' => $jumlahSpjTerbesar,
            'jmlBulanIni' => $jmlBulanIni,
            'jmlsdBulanIni' => $jmlsdBulanIni,
            'jmlAnggaran' => $jmlAnggaran,
            'jmlBulanLalu' => $jmlBulanLalu,    
            'totalPenerimaan' => $totalPenerimaan,    
            'totalPenerimaansd' => $totalPenerimaansd,    
            'totalPengeluaran' => $totalPengeluaran,    
            'totalPengeluaransd' => $totalPengeluaransd, 
            'urBKUs' => $urBKUs, 
            'active' => 'SPJ'
        ]);
    }

    public function delete($id)
    {
        SuratPengantarModel::where('id_surat_pengantar', $id)->delete();
        return redirect('/data-spj')->with('success', 'Data berhasil dihapus.');
        return redirect('/spj')->with('success', 'Data berhasil dihapus.');
    }

    public function export_surat_pengantar() 
    {
        return Excel::download(new SPExport, 'spj.xlsx');
    }
}
