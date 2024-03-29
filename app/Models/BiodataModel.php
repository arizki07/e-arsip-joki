<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Import the Str class

class BiodataModel extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $table = 'biodatas';
    protected $primaryKey = 'id_biodata';
    protected $fillable = [
        'user_id',
        'qr_code',
        'jabatan_id',
        'nama',
        'email',
        'nip',
        'tgl_lahir',
        'alamat',
        'foto_ttd',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_biodata = '100000' . random_int(10000, 99999);
            while (BiodataModel::where('id_biodata', $model->id_biodata)->exists()) {
                $model->id_biodata = '100000' . random_int(10000, 99999);
            }
        });
    }

    protected $keyType = 'int';
    protected $increment = 10;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_users');
    }

    public function ByUserId($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }

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
