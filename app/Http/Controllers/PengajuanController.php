<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\NotaDinasModel;
use App\Models\PengajuanModel;
use App\Models\BiodataModel;
use Illuminate\Support\Facades\DB;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.admin.pengajuan.index', [
            'title' => 'Pengajuan',
            'active' => 'Pengajuan',
            'pengajuan' => $pengajuans,
        ]);
    }

    public function create(){

        return view('pages.admin.pengajuan.create', [
            'title' => 'Tambah Data Pengajuan',
            'active' => 'Pengajuan',
        ]);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'nd_nama_kegiatan' => 'required|string|max:200|unique:nota_dinas',
            'nd_sub_kegiatan' => 'required|string|max:200|unique:nota_dinas',
            'nd_perihal' => 'required|string|max:50|unique:nota_dinas',
            'nd_nomor_nota' => 'required|string|max:50|unique:nota_dinas',
            'nd_uraian_kegiatan' => 'required|string',
            'nd_tanggal' => 'required|string',
            'nd_jumlah_biaya' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            if ($validator->fails()) {
                throw new ValidationException($validator);
            }
            $validatedData = $validator->validated();

            $idBiodataKPA = BiodataModel::getBiodataByJabatanKode('KPA')->first()->id_biodata;
            $idBiodataPA = BiodataModel::getBiodataByJabatanKode('PA')->first()->id_biodata;
            $idBiodataBPP = BiodataModel::getBiodataByJabatanKode('BPP')->first()->id_biodata;

            // Set the values for nd_kpa_id, p_pa_id, and p_bpp_id
            $validatedData['nd_kpa_id'] = $idBiodataKPA;
            $validatedData['p_pa_id'] = $idBiodataPA;
            $validatedData['p_bpp_id'] = $idBiodataBPP;

            // Hilangkan 'p_pa_id' dan 'p_bpp_id' dari $validatedData
            unset($validatedData['p_pa_id']);
            unset($validatedData['p_bpp_id']);

            NotaDinasModel::create($validatedData);

            PengajuanModel::create([
                'p_kpa_id' => $validatedData['nd_kpa_id'],
                'p_pa_id'  => $idBiodataPA,
                'p_bpp_id' => $idBiodataBPP,
                'p_nama_kegiatan' => $validatedData['nd_nama_kegiatan'],
                'p_sub_kegiatan' => $validatedData['nd_sub_kegiatan'],
                'p_tanggal' => $validatedData['nd_tanggal'],
                'p_biaya' => $validatedData['nd_jumlah_biaya'],
                'status' => 1, // status Pending verivikasi
            ]);

            return redirect('/pengajuan')->with('success', 'Data pengajuan Berhasil Disimpan!');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Pastikan data KPA, PA, BP, dan BPP sudah ada.'], 500);
            }
            return redirect()->back()->with('error', 'Gagal menyimpan data. Pastikan data KPA, PA, BP, dan BPP sudah ada.');
        }
    }

    public function edit($id){
        $pengajuan = PengajuanModel::findOrFail($id);

        // Ganti 'created_at' dengan kolom yang sesuai di dalam model NotaDinasModel
        $notaDinas = NotaDinasModel::where('created_at', $pengajuan->created_at)->firstOrFail();

        return view('pages.admin.pengajuan.edit', [
            'title' => 'Edit Data Pengajuan',
            'active' => 'Pengajuan',
            'pengajuan' => $pengajuan,
            'notaDinas' => $notaDinas,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nd_nama_kegiatan' => 'required|string|max:200',
            'nd_sub_kegiatan' => 'required|string|max:200',
            'nd_perihal' => 'required|string|max:50',
            'nd_nomor_nota' => 'required|string|max:50',
            'nd_uraian_kegiatan' => 'required|string',
            'nd_tanggal' => 'required|string',
            'nd_jumlah_biaya' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $validatedData = $validator->validated();

            // Dapatkan data pengajuan
            $pengajuan = PengajuanModel::findOrFail($id);

            // Update data pengajuan
            $pengajuan->update([
                'p_nama_kegiatan' => $validatedData['nd_nama_kegiatan'],
                'p_sub_kegiatan' => $validatedData['nd_sub_kegiatan'],
                'p_tanggal' => $validatedData['nd_tanggal'],
                'p_biaya' => $validatedData['nd_jumlah_biaya'],
            ]);

            // Dapatkan dan update data nota dinas yang terkait
            $notaDinas = NotaDinasModel::where('created_at', $pengajuan->created_at)
                                        ->firstOrFail();

            $notaDinas->update($validatedData);

            return redirect('/pengajuan')->with('success', 'Data pengajuan berhasil diperbarui!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data pengajuan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal memperbarui data pengajuan.');
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $pengajuan = PengajuanModel::findOrFail($id);

            $notaDinas = NotaDinasModel::where('created_at', $pengajuan->created_at)->firstOrFail();

            $pengajuan->delete();

            $notaDinas->delete();

            DB::commit();

            return redirect('/pengajuan')->with('success', 'Data pengajuan berhasil dihapus!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data pengajuan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pengajuan.');
        }
    }
}