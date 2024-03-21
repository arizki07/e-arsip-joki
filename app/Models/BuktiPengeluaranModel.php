<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuktiPengeluaranModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'td_bukti_pengeluarans';
    protected $primaryKey = 'id_td_bukti';
    protected $fillable = [
        'td_id_pengajuan',
        'td_bp_id',
        'td_bpp_id',
        'td_pa_id',
        'td_kpa_id',
        'td_biaya',
        'td_jumlah_biaya',
        'td_uraian',
        'no_bukti',
        'total_uraian',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_td_bukti = '200000' . random_int(10000, 99999);
            while (BuktiPengeluaranModel::where('id_td_bukti', $model->id_td_bukti)->exists()) {
                $model->id_td_bukti = '200000' . random_int(10000, 99999);
            }
        });
    }

    public function bukti()
    {
        return $this->belongsTo(PengajuanModel::class, 'td_id_pengajuan', 'id_pengajuan');
    }

    public function biodata()
    {
        return $this->belongsTo(BiodataModel::class, 'td_bp_id', 'id_biodata');
    }

    public function kpa()
    {
        return $this->belongsTo(BiodataModel::class, 'td_kpa_id', 'id_biodata');
    }

    public function pa()
    {
        return $this->belongsTo(BiodataModel::class, 'td_pa_id', 'id_biodata');
    }
    public function bpp()
    {
        return $this->belongsTo(BiodataModel::class, 'td_bpp_id', 'id_biodata');
    }
    public function bp()
    {
        return $this->belongsTo(BiodataModel::class, 'td_bp_id', 'id_biodata');
    }

    public function getStatusBadge()
    {
        $status = $this->status;

        switch ($status) {
            case 1:
                return 'Pending PPK';
            case 2:
                return 'Pending PA';
            case 3:
                return 'Selesai';
            case 4:
                return 'Reject';
            default:
                return '';
        }

    }
}