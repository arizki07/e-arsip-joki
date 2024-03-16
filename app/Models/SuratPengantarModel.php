<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratPengantarModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_surat_pengantar';
    protected $primaryKey = 'id_surat_pengantar';
    protected $fillable = [
        'id_td_bukti',
        'id_surat_pengantar',
        'nomor_surat',
        'sifat',
        'lampiran',
        'perihal',
        'tanggal',
        'biaya',
        'kegiatan',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_surat_pengantar = '540000' . random_int(10000, 99999);
            while (SuratPengantarModel::where('id_surat_pengantar', $model->id_surat_pengantar)->exists()) {
                $model->id_surat_pengantar = '540000' . random_int(10000, 99999);
            }
        });
    }

    // public function querySpjSuratPengantar($id)
    // {
    //     $surPeng = DB::table('spj_surat_pengantar as sp')
    //         ->select('sp.*', 'pj.*', 'ju.*', 'bd_kpa.nama as nama_kpa', 'bd_bpp.nama as nama_bpp', 'bd_bpp.nip as nip_bpp', 'bd_kpa.nip as nip_kpa')
    //         ->join('td_bukti_pengeluarans as pj', 'sp.id_td_bukti', '=', 'pj.id_td_bukti')
    //         ->leftJoin('pengajuans as ju', 'pj.td_id_pengajuan', '=', 'ju.id_pengajuan')
    //         ->leftJoin('biodatas as bd_kpa', 'pj.td_kpa_id', '=', 'bd_kpa.id_biodata')
    //         ->leftJoin('biodatas as bd_pa', 'pj.td_pa_id', '=', 'bd_pa.id_biodata')
    //         ->leftJoin('biodatas as bd_bpp', 'pj.td_bpp_id', '=', 'bd_bpp.id_biodata')
    //         ->where('sp.id_surat_pengantar', '=', $id)
    //         ->limit(1)
    //         ->first();

    //     return $surPeng;
    // }

    public function querySpjAll($id)
    {
        $result = DB::table('spj_surat_pengantar AS sp')
            ->select(
                'sp.*',
                'pj.*',
                'ju.*',
                'bku.*',
                'urbku.*',
                'fung.*',
                'urfung.*',
                'reg.*',
                'urreg.*',
                'bku.*',
                'bd_kpa.nama AS nama_kpa',
                'bd_pa.nama AS nama_pa',
                'bd_pa.nama AS nama_pa',
                'bd_bpp.nama AS nama_bpp',
                'bd_bpp.nip as nip_bpp',
                'bd_kpa.nip as nip_kpa',
                'bd_pa.nip as nip_pa',
                'bd_pptk.nama AS nama_pptk',
                'bd_pptk.nip AS nip_pptk'
            )
            ->join('td_bukti_pengeluarans AS pj', 'sp.id_td_bukti', '=', 'pj.id_td_bukti')
            ->leftJoin('pengajuans AS ju', 'pj.td_id_pengajuan', '=', 'ju.id_pengajuan')
            ->leftJoin('biodatas AS bd_kpa', 'pj.td_kpa_id', '=', 'bd_kpa.id_biodata')
            ->leftJoin('biodatas AS bd_pa', 'pj.td_pa_id', '=', 'bd_pa.id_biodata')
            ->leftJoin('biodatas AS bd_bpp', 'pj.td_bpp_id', '=', 'bd_bpp.id_biodata')
            ->leftJoin('spj_bku AS bku', 'bku.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('spj_bku_uraian AS urbku', 'urbku.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('spj_fungsional AS fung', 'fung.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('spj_fungsional_uraian AS urfung', 'urfung.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('spj_register_kas AS reg', 'reg.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('spj_register_uraian AS urreg', 'urreg.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->leftJoin('biodatas AS bd_pptk', 'bd_pptk.id_biodata', '=', 'bku.id_pptk')
            ->where('sp.id_surat_pengantar', $id)
            ->first();

        return $result;
    }

    public function queryUraianBku($id)
    {
        $result = DB::table('spj_surat_pengantar AS sp')
            ->select(
                'sp.*',
                'urbku.*'
            )
            ->join('spj_bku_uraian AS urbku', 'urbku.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->where('sp.id_surat_pengantar', $id)
            ->orderBy('urbku.no_urut')
            ->get();

        return $result;
    }

    public function queryUraianFungsional($id)
    {
        $result = DB::table('spj_surat_pengantar AS sp')
            ->select(
                'sp.*',
                'urfung.*'
            )
            ->join('spj_fungsional_uraian AS urfung', 'urfung.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->where('sp.id_surat_pengantar', $id)
            ->get();

        return $result;
    }

    public function queryFungsi($id)
    {
        $result = DB::table('spj_surat_pengantar AS sp')
            ->select(
                'sp.*',
                'fungsi.*'
            )
            ->join('spj_fungsional AS fungsi', 'fungsi.id_surat_pengantar', '=', 'sp.id_surat_pengantar')
            ->where('sp.id_surat_pengantar', $id)
            ->first();

        return $result;
    }
}
