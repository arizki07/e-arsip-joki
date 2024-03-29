<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BiodataModel;
use App\Models\BuktiPengeluaranModel;
use App\Models\JabatanModel;
use App\Models\PengajuanModel;
use App\Models\SpjFungsionalModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::count();
        $jabatan = JabatanModel::count();
        $pengajuan = PengajuanModel::count();
        $bukti = BuktiPengeluaranModel::count();
        $spj = SpjFungsionalModel::count();
        $user = User::count();

        $approvedCount = PengajuanModel::where('status', 4)->count();
        $rejectedCount = PengajuanModel::where('status', 5)->count();

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'biodata' => $biodata,
            'jabatan' => $jabatan,
            'pengajuan' => $pengajuan,
            'user'      => $user,
            'bukti'      => $bukti,
            'spj'      => $spj,
            'approvedCount' => $approvedCount,
            'rejectedCount' => $rejectedCount,
        ]);
    }
}
