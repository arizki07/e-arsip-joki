<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestingTempatUraianModel extends Model
{
    use HasFactory;
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

    public function header()
    {
        return $this->belongsTo(TestingModel::class, 'testing_id');
    }
}
