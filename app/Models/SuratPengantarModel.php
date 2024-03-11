<?php

namespace App\Models;

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
}
