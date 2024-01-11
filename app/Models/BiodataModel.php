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
}
