<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\PengajuanModel;
use App\Models\SuratPengantarModel;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Auth;

class BPController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.bp', [
            'title' => 'Biodata Pegawai BP',
            'active' => 'BP',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function bp()
    {
        return view('pages.admin.pengguna.bp', [
            'title' => 'Data Bp',
        ]);
    }

    public function profile()
    {
        $user = Auth::user();
        $biodata = BiodataModel::where('user_id', $user->id_users)->get();
        $jabatan = JabatanModel::all();

        return view('pages.bp.profile.index', [
            'title' => 'Profile',
            'active' => 'BP',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validation rules here

        $biodata = BiodataModel::findOrFail($id);

        $biodata->nama = $request->input('nama');
        $biodata->jabatan_id = $request->input('jabatan_id');
        $biodata->nip = $request->input('nip');
        $biodata->email = $request->input('email');
        $biodata->tgl_lahir = $request->input('tgl_lahir');
        $biodata->alamat = $request->input('alamat');

        // Save the updated data
        $biodata->save();

        return redirect('/profile-bp')->with('success', 'Data berhasil diperbarui.');
    }

    public function document()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.bp.document.index', [
            'title' => 'Document-Bp',
            'active' => 'doc',
            'pengajuan' => $pengajuans,
        ]);
    }

    public function detailPengajuanPdf($id)
    {
        $model = new PengajuanModel();

        $pengajuanData = $model->find($id);

        if ($pengajuanData) {
            $pengajuanID = $pengajuanData['id_pengajuan'];

            $laporanPengajuan = $model->select('pengajuans.*', 'pa.nama as nama_pa', 'pa.nip as nip_pa', 'kpa.nama as nama_kpa', 'kpa.nip as nip_kpa', 'bpp.nama as nama_bpp', 'bpp.nip as nip_bpp')
                ->leftJoin('biodatas as pa', 'pa.id_biodata', '=', 'pengajuans.p_pa_id')
                ->leftJoin('biodatas as kpa', 'kpa.id_biodata', '=', 'pengajuans.p_kpa_id')
                ->leftJoin('biodatas as bpp', 'bpp.id_biodata', '=', 'pengajuans.p_bpp_id')
                ->where('pengajuans.id_pengajuan', $pengajuanID)
                ->first();

            $view = view('doc/nota-dinas', ['laporanPengajuan' => $laporanPengajuan]);

            $dompdf = new Dompdf();
            $options = new \Dompdf\Options();
            $options->set('isPhpEnabled', true);
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isRemoteEnabled', true);
            $dompdf->setOptions($options);
            setlocale(LC_TIME, 'id_ID');

            $dompdf->loadHtml($view);

            $dompdf->setPaper('F4', 'portrait');

            $dompdf->render();

            $pdfContent = $dompdf->output();

            $pdfName = str_replace(' ', '_', $pengajuanData['p_nama_kegiatan']);
            $filename = $pdfName . date('d-m-Y_H-i-s') . '.pdf';

            $filePath = public_path('arsip/pdf/' . $filename);
            file_put_contents($filePath, $pdfContent);

            $response = response($pdfContent);
            $response->header('Content-Type', 'application/pdf');
            $response->header('Content-Disposition', 'attachment; filename="' . $filename . '"');

            $response->setContent($pdfContent);

            //Untuk View PDF
            $dompdf->stream($pdfContent, array("Attachment" => false));
            exit(0);

            return $response;
        } else {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }
    }

    public function spj()
    {
        $spj = SuratPengantarModel::all();
        return view('pages.bp.spj.index', [
            'active' => 'SPJ',
            'title' => 'SPJ',
            'spj' => $spj
        ]);
    }
}
