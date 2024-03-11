<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    public $incrementing = false;
    protected $table = 'jabatans';
    protected $primaryKey = 'id_jabatan';
    protected $fillable = [
        'kode',
        'nama_jabatan',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_jabatan = '430000' . random_int(10000, 99999);
            while (JabatanModel::where('id_jabatan', $model->id_jabatan)->exists()) {
                $model->id_jabatan = '430000' . random_int(10000, 99999);
            }
        });
    }
}
