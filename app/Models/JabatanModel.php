<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanModel extends Model
{
    use HasFactory;

     protected $table = 'jabatans';
    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'kode',
        'nama_jabatan',

    ];
}
