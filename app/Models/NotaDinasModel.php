<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaDinasModel extends Model
{
    use HasFactory;

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
        'nd_jumlah_biaya'
    ];

    public function kpa()
    {
        return $this->hasOne(NotaDinasModel::class);
    }
}