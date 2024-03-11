<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanModel extends Model
{
    use HasFactory;
    public $incrementing = false;
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

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id_pengajuan = '400000' . random_int(10000, 99999);
            while (PengajuanModel::where('id_pengajuan', $model->id_pengajuan)->exists()) {
                $model->id_pengajuan = '400000' . random_int(10000, 99999);
            }
        });
    }

    // @if ($item->status == 1)
    //     <span class="badge bg-warning">Pending Verifikasi</span>
    // @elseif ($item->status == 2)
    //     <span class="badge bg-warning">Pending KPA</span>
    // @elseif ($item->status == 3)
    //     <span class="badge bg-warning">Pending PA</span>
    // @elseif ($item->status == 4)
    //     <span class="badge bg-primary">Selesai</span>
    // @endif

    public function getStatusBadge()
    {
        $status = $this->status;

        switch ($status) {
            case 1:
                return 'Pending Verifikasi';
            case 2:
                return 'Pending KPA';
            case 3:
                return 'Pending PA';
            case 4:
                return 'Selesai';
            default:
                return '';
        }
        // switch ($status) {
        //     case 1:
        //         return '<span class="badge bg-warning">Pending Verifikasi</span>';
        //     case 2:
        //         return '<span class="badge bg-warning">Pending KPA</span>';
        //     case 3:
        //         return '<span class="badge bg-warning">Pending PA</span>';
        //     case 4:
        //         return '<span class="badge bg-primary">Selesai</span>';
        //     default:
        //         return '';
        // }
    }

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
        return $this->hasOne(NotaDinasModel::class, 'nd_nama_kegiatan', 'p_nama_kegiatan');
    }

    public function buktiPengeluaran()
    {
        return $this->hasMany(BuktiPengeluaranModel::class, 'td_id_pengajuan', 'id_pengajuan');
    }
}
