<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianSpjRegisterModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_register_uraian';
    protected $primaryKey = 'id_register_uraian';
    protected $fillable = [
        'id_register_kas',
        'kertas_100',
        'kertas_50',
        'kertas_20',
        'kertas_10',
        'kertas_5',
        'kertas_1',
        'logam_1000',
        'logam_500',
        'logam_100',
        'logam_50',
        'logam_25',
        'logam_10',
        'logam_5',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_register_uraian = '533000' . random_int(10000, 99999);
            while (UraianSpjRegisterModel::where('id_register_uraian', $model->id_register_uraian)->exists()) {
                $model->id_register_uraian = '533000' . random_int(10000, 99999);
            }
        });
    }
}
