<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingModel extends Model
{
    use HasFactory;
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
}
