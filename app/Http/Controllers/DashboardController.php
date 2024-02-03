<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\PengajuanModel;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::count();
        $jabatan = JabatanModel::count();
        $pengajuan = PengajuanModel::count();
        $user = User::count();

        return view('pages.dashboard', [
            'title' => 'Dashboard',
            'active' => 'Dashboard',
            'biodata' => $biodata,
            'jabatan' => $jabatan,
            'pengajuan' => $pengajuan,
            'user'      => $user,
        ]);
    }
}
