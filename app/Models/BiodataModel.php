<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiodataModel extends Model
{
    protected $table = 'biodatas';
    protected $primaryKey = 'id_biodata';
    protected $fillable = [
        'user_id',
        'jabatan_id',
        'nama',
        'email',
        'nip',
        'tgl_lahir',
        'alamat',
    ];

    public function jabatan()
    {
        return $this->belongsTo(JabatanModel::class, 'jabatan_id', 'id_jabatan');
    }

    public static function getBiodataByJabatanKode($kode)
    {
        return static::whereHas('jabatan', function ($query) use ($kode) {
            $query->where('kode', $kode);
        })->get();
    }
}