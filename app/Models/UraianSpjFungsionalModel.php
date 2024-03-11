<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianSpjFungsionalModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_fungsional_uraian';
    protected $primaryKey = 'id_fungsional_uraian';
    protected $fillable = [
        'id_fungsional',
        'kode_rekening',
        'tipe',
        'uraian',
        'jumlah_anggaran',
        'sd_bulan_lalu',
        'bulan_ini',
        'sd_bulan_ini',
        'jumlah_spj',
        'sisa_pagu_anggaran',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_fungsional_uraian = '522000' . random_int(10000, 99999);
            while (UraianSpjFungsionalModel::where('id_fungsional_uraian', $model->id_fungsional_uraian)->exists()) {
                $model->id_fungsional_uraian = '522000' . random_int(10000, 99999);
            }
        });
    }
}
