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
use App\Models\JabatanModel;

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
            'nd_nama_kegiatan'      => 'required',
            'nd_sub_kegiatan'       => 'required',
            'nd_perihal'            => 'required',
            'nd_nomor_nota'         => 'required',
            'nd_uraian_kegiatan'    => 'required',
            'nd_tanggal'            => 'required|date',
            'nd_jumlah_biaya'       => 'required',
        ], [
                'required' => 'Kolom :attribute harus diisi.',
                'max' => [
                'string' => 'Kolom :attribute tidak boleh lebih dari :max karakter.',
            ],
            'image' => 'Kolom :attribute harus berupa file gambar.',
            'mimes' => 'Kolom :attribute harus memiliki format: :values.',
            'integer' => 'Kolom :attribute harus berupa angka.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'unique' => 'Nama pengajuan sudah ada. Harap pilih nama pengajuan yang lain.',
        ]);


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
            ]);

            return redirect('/pengajuan')->with('success', 'Data pengajuan Berhasil Disimpan!');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json(['errors' => $e->errors()], 422);
            }
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Gagal menyimpan data. Silakan coba lagi.'], 500);
            }

            return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }
}