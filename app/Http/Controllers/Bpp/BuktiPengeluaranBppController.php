<?php

namespace App\Http\Controllers\Bpp;

use App\Http\Controllers\Controller;
use App\Models\BiodataModel;
use App\Models\BuktiPengeluaranModel;
use App\Models\PengajuanModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BuktiPengeluaranBppController extends Controller
{
    public function index()
    {
        $buktiPengeluarans = BuktiPengeluaranModel::all();
        $pengajuans = PengajuanModel::joinBiodata()->with('buktiPengeluaran')->get();

        return view('pages.bpp.tanda-bukti.index', [
            'title' => 'Bukti Pengeluaran BPP',
            'active' => 'Tanda Bukti',
            'pengajuans' => $pengajuans,
            'buktiPengeluarans' => $buktiPengeluarans
        ]);
    }

    public function tambah()
    {
        $pengajuans = PengajuanModel::joinBiodata()->where('status', '=', 4)->get();

        return view('pages.bpp.tanda-bukti.tambah', [
            'title' => 'Tambah Bukti Pengeluaran',
            'active' => 'Bukti-pengeluaran',
            'pengajuans' => $pengajuans,
        ]);
    }

    public function getDataPengajuan($id)
    {
        $pengajuanModel = PengajuanModel::findOrFail($id);
        $notaDinasModel = $pengajuanModel->notaDinas()->first();

        return response()->json(['dataPengajuan' => ['pengajuan' => $pengajuanModel, 'notaDinas' => $notaDinasModel]]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'td_id_pengajuan' => 'required|numeric',
                'td_biaya' => 'required',
                // 'td_jumlah_biaya' => 'required',
                'uraian_kegiatan.*' => 'nullable|string',
                'uraian_kegiatan_jumlah.*' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validatedData = $validator->validated();

            // Combine uraian_kegiatan and uraian_kegiatan_jumlah into td_uraian
            $uraianData = [];
            foreach ($validatedData['uraian_kegiatan'] as $key => $uraian) {
                $jumlah = isset($validatedData['uraian_kegiatan_jumlah'][$key]) ? $validatedData['uraian_kegiatan_jumlah'][$key] : null;
                $uraianData[] = ['uraian' => $uraian, 'jumlah' => $jumlah];
            }

            $validatedData['td_uraian'] = json_encode($uraianData);

            // Fetching Biodata IDs
            $idBiodataKPA = BiodataModel::getBiodataByJabatanKode('KPA')->first()->id_biodata;
            $idBiodataPA = BiodataModel::getBiodataByJabatanKode('PA')->first()->id_biodata;
            $idBiodataBPP = BiodataModel::getBiodataByJabatanKode('BPP')->first()->id_biodata;
            $idBiodataBP = BiodataModel::getBiodataByJabatanKode('BP')->first()->id_biodata;

            // Set the values for td_kpa_id, td_pa_id, td_bpp_id, and td_bp_id
            $validatedData['td_kpa_id'] = $idBiodataKPA;
            $validatedData['td_pa_id'] = $idBiodataPA;
            $validatedData['td_bpp_id'] = $idBiodataBPP;
            $validatedData['td_bp_id'] = $idBiodataBP;

            // Remove unnecessary fields
            unset($validatedData['uraian_kegiatan']);
            unset($validatedData['uraian_kegiatan_jumlah']);
            unset($validatedData['nd_nama_kegiatan']);
            unset($validatedData['nd_sub_kegiatan']);
            unset($validatedData['nd_tanggal']);

            // Create BuktiPengeluaranModel
            BuktiPengeluaranModel::create([
                'td_id_pengajuan' => $validatedData['td_id_pengajuan'],
                'td_uraian' => $validatedData['td_uraian'],
                'td_kpa_id' => $validatedData['td_kpa_id'],
                'td_pa_id' => $validatedData['td_pa_id'],
                'td_bpp_id' => $validatedData['td_bpp_id'],
                'td_bp_id' => $validatedData['td_bp_id'],
                'td_biaya' => $validatedData['td_biaya'],
                'td_jumlah_biaya' => $validatedData['td_biaya'],
            ]);

            return redirect('/bukti-bpp')->with('success', 'Data pengajuan berhasil disimpan!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->Errors())->withInput();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Gagal menyimpan data. Pastikan data KPA, PA, BP, dan BPP sudah ada.');
        }
    }

    public function edit($id)
    {
        $buktiPengeluaran = BuktiPengeluaranModel::findOrFail($id);
        $pengajuans = PengajuanModel::all(); // or however you retrieve $pengajuans in your context

        $namaKegiatan = '';
        $subKegiatan = '';
        foreach ($pengajuans as $peng) {
            if ($peng->id_pengajuan == $buktiPengeluaran->td_id_pengajuan) {
                $namaKegiatan = $peng->p_nama_kegiatan;
                $subKegiatan = $peng->p_sub_kegiatan;
                $tglKegiatan = $peng->p_tanggal;
            }
        }

        // $data = []; // Kanggo nampung array json
        // foreach ($pengajuans as $peng) {
        //     if ($peng->id_pengajuan == $buktiPengeluaran->td_id_pengajuan) {
        //         $data = json_decode($buktiPengeluaran->td_uraian, true);
        //         break;
        //     }
        // }

        $data = json_decode($buktiPengeluaran->td_uraian, true);
        $total = 0;

        foreach ($data as $item) {
            $jumlah = str_replace(['Rp ', '.'], '', $item['jumlah']);
            $total += (int)$jumlah;
        }


        return view('pages.bpp.tanda-bukti.edit', [
            'title' => 'Edit Bukti Pengeluaran',
            'active' => 'Bukti-pengeluaran',
            'buktiPengeluaran' => $buktiPengeluaran,
            'pengajuans' => $pengajuans,
            'namaKegiatan' => $namaKegiatan,
            'subKegiatan' => $subKegiatan,
            'tglKegiatan' => $tglKegiatan,
            'data' => $data,
            'total' => $total,
        ]);
    }

    public function update(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'td_id_pengajuan' => 'required|numeric',
                'td_biaya' => 'required',
                'uraian_kegiatan.*' => 'nullable|string',
                'uraian_kegiatan_jumlah.*' => 'nullable',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $validatedData = $validator->validated();

            // Temukan instansi BuktiPengeluaranModel berdasarkan id
            $buktiPengeluaran = BuktiPengeluaranModel::findOrFail($id);

            // Combine uraian_kegiatan and uraian_kegiatan_jumlah into td_uraian
            $uraianData = [];
            foreach ($validatedData['uraian_kegiatan'] as $key => $uraian) {
                $jumlah = isset($validatedData['uraian_kegiatan_jumlah'][$key]) ? $validatedData['uraian_kegiatan_jumlah'][$key] : null;
                $uraianData[] = ['uraian' => $uraian, 'jumlah' => $jumlah];
            }
            $validatedData['td_uraian'] = json_encode($uraianData);

            // Fetching Biodata IDs
            $idBiodataKPA = BiodataModel::getBiodataByJabatanKode('KPA')->first()->id_biodata;
            $idBiodataPA = BiodataModel::getBiodataByJabatanKode('PA')->first()->id_biodata;
            $idBiodataBPP = BiodataModel::getBiodataByJabatanKode('BPP')->first()->id_biodata;
            $idBiodataBP = BiodataModel::getBiodataByJabatanKode('BP')->first()->id_biodata;

            // Set the values for td_kpa_id, td_pa_id, td_bpp_id, and td_bp_id
            $validatedData['td_kpa_id'] = $idBiodataKPA;
            $validatedData['td_pa_id'] = $idBiodataPA;
            $validatedData['td_bpp_id'] = $idBiodataBPP;
            $validatedData['td_bp_id'] = $idBiodataBP;

            // Update kolom-kolom yang sesuai
            $buktiPengeluaran->update([
                'td_id_pengajuan' => $validatedData['td_id_pengajuan'],
                'td_uraian' => $validatedData['td_uraian'],
                'td_kpa_id' => $validatedData['td_kpa_id'],
                'td_pa_id' => $validatedData['td_pa_id'],
                'td_bpp_id' => $validatedData['td_bpp_id'],
                'td_bp_id' => $validatedData['td_bp_id'],
                'td_biaya' => $validatedData['td_biaya'],
                'td_jumlah_biaya' => $validatedData['td_biaya'],
            ]);

            return redirect('/bukti-bpp-pengeluaran')->with('success', 'Data bukti pengeluaran berhasil diperbarui!');
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data bukti pengeluaran.');
        }
    }
}
