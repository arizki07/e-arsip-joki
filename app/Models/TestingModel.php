<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'testing_import';
    protected $primaryKey = 'id_testing';
    protected $fillable = [
        'kpa_id',
        'pa_id',
        'bpp_id',
        'nama_kegiatan',
        'sub_kegiatan',
        'tgl',
        'total_biaya',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_testing = '510000' . random_int(10000, 99999);
            while (TestingModel::where('id_testing', $model->id_testing)->exists()) {
                $model->id_testing = '510000' . random_int(10000, 99999);
            }
        });
    }
}
