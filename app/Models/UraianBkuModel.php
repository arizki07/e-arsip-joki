<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UraianBkuModel extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = 'spj_bku_uraian';
    protected $primaryKey = 'id_bku_uraian';
    protected $fillable = [
        'id_bku',
        'no_urut',
        'tanggal',
        'uraian',
        'kode_rekening',
        'penerimaan',
        'pengeluaran',
        'saldo',
        'keterangan',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_bku_uraian = '511000' . random_int(10000, 99999);
            while (UraianBkuModel::where('id_bku_uraian', $model->id_bku_uraian)->exists()) {
                $model->id_bku_uraian = '511000' . random_int(10000, 99999);
            }
        });
    }
}
