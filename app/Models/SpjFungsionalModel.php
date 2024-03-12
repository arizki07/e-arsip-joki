<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpjFungsionalModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_fungsional';
    protected $primaryKey = 'id_fungsional';
    protected $fillable = [
        'id_bku',
        'id_surat_pengantar',
        'urusan',
        'organisasi',
        'program',
        'kegiatan',
        'bulan',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_fungsional = '520000' . random_int(10000, 99999);
            while (SpjFungsionalModel::where('id_fungsional', $model->id_fungsional)->exists()) {
                $model->id_fungsional = '520000' . random_int(10000, 99999);
            }
        });
    }
}
