<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpjRegisterModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_register_kas';
    protected $primaryKey = 'id_register_kas';
    protected $fillable = [
        'id_bku',
        'id_fungsional',
        'id_biodata',
        'id_surat_pengantar',
        'tgl_penutupan_lalu',
        'saldo_buku',
        'saldo_kas',
        'positif_negatif',
        'kertas_berharga',
        'perbedaan',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_register_kas = '530000' . random_int(10000, 99999);
            while (SpjRegisterModel::where('id_register_kas', $model->id_register_kas)->exists()) {
                $model->id_register_kas = '530000' . random_int(10000, 99999);
            }
        });
    }
}
