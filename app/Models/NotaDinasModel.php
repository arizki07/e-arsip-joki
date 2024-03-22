<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinasModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'nota_dinas';
       protected $primaryKey = 'id_nota_dinas';
       protected $fillable = [
        'nd_kpa_id',
        'nd_nama_kegiatan',
        'nd_sub_kegiatan',
        'nd_perihal',
        'nd_nomor_nota',
        'nd_uraian_kegiatan',
        'nd_tanggal',
        'nd_jumlah_biaya',
        'id_pengajuan'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_nota_dinas = '300000' . random_int(10000, 99999);
            while (NotaDinasModel::where('id_nota_dinas', $model->id_nota_dinas)->exists()) {
                $model->id_nota_dinas = '300000' . random_int(10000, 99999);
            }
        });
    }

    public function kpa()
    {
        return $this->hasOne(NotaDinasModel::class);
    }

     public function pengajuan()
    {
        return $this->belongsTo(PengajuanModel::class, 'nd_nama_kegiatan', 'p_nama_kegiatan');
    }
}