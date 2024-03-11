<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingTempatUraianModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'testing_tempat_uraian';
    protected $primaryKey = 'id_uraian';
    protected $fillable = [
        'testing_id',
        'kode_rekening',
        'rekening',
        'tgl',
        'penerimaan',
        'pengeluaran',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_uraian = '520000' . random_int(10000, 99999);
            while (TestingTempatUraianModel::where('id_uraian', $model->id_uraian)->exists()) {
                $model->id_uraian = '520000' . random_int(10000, 99999);
            }
        });
    }
    
}
