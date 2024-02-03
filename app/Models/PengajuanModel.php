<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanModel extends Model
{
    use HasFactory;
    protected $table = 'pengajuans';
       protected $primaryKey = 'id_pengajuan';
       protected $fillable = [
        'p_kpa_id',
        'p_pa_id',
        'p_bpp_id',
        'p_nama_kegiatan',
        'p_sub_kegiatan',
        'p_tanggal',
        'p_biaya',
        'status'
    ];

    // @if ($item->status == 1)
    //     <span class="badge bg-warning">Pending Verifikasi</span>
    // @elseif ($item->status == 2)
    //     <span class="badge bg-warning">Pending KPA</span>
    // @elseif ($item->status == 3)
    //     <span class="badge bg-warning">Pending PA</span>
    // @elseif ($item->status == 4)
    //     <span class="badge bg-primary">Selesai</span>
    // @endif

    public function kpa()
    {
        return $this->belongsTo(BiodataModel::class, 'p_kpa_id', 'id_biodata');
    }

    public function pa()
    {
        return $this->belongsTo(BiodataModel::class, 'p_pa_id', 'id_biodata');
    }
    public function bpp()
    {
        return $this->belongsTo(BiodataModel::class, 'p_bpp_id', 'id_biodata');
    }

    public function scopeJoinBiodata($query)
    {
        return $query->join('biodatas', 'pengajuans.p_bpp_id', '=', 'biodatas.id_biodata');
    }

    public function notaDinas()
    {
        return $this->hasOne(NotaDinasModel::class, 'id_pengajuan', 'id_pengajuan');
    }
}