<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkuModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_bku';
    protected $primaryKey = 'id_bku';
    protected $fillable = [
        'id_td_bukti',
        'id_kpa',
        'id_pptk',
        'id_bpp',
        'tanggal',
        'kas',
        'tunai',
        'saldo_bank',
        'sp2d',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_bku = '510000' . random_int(10000, 99999);
            while (BkuModel::where('id_bku', $model->id_bku)->exists()) {
                $model->id_bku = '510000' . random_int(10000, 99999);
            }
        });
    }
}
