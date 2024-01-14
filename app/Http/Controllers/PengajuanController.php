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
            // 'nd_kpa_id'             => 'required',
            'nd_nama_kegiatan'      => 'required',
            'nd_sub_kegiatan'       => 'required',
            'nd_perihal'            => 'required',
            'nd_nomor_nota'         => 'required',
            'nd_uraian_kegiatan'    => 'required',
            'nd_tanggal'            => 'required|date',
            'nd_jumlah_biaya'       => 'required',
            // 'p_pa_id'               => 'required',
            // 'p_bpp_id'              => 'required',
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

            $idBiodata = null;
            $biodatas = BiodataModel::all();

            foreach ($biodatas as $item) {
                if ($item->jabatan->kode == 'KPA') {
                    $idBiodata = $item->id_biodata;
                    break;
                }elseif ($item->jabatan->kode == 'PA') {
                    $idBiodata = $item->id_biodata;
                    break;
                }elseif ($item->jabatan->kode == 'BPP') {
                    $idBiodata = $item->id_biodata;
                    break;
                }
            }

            // Tambahkan id_biodata ke $validatedData
            $validatedData['nd_kpa_id'] = $idBiodata;
            $validatedData['p_pa_id'] = $idBiodata;
            $validatedData['p_bpp_id'] = $idBiodata;

            // Simpan 'p_pa_id' dan 'p_bpp_id' dalam variabel terpisah
            $pPaId = $validatedData['p_pa_id'];
            $pBppId = $validatedData['p_bpp_id'];

            // Hilangkan 'p_pa_id' dan 'p_bpp_id' dari $validatedData
            unset($validatedData['p_pa_id']);
            unset($validatedData['p_bpp_id']);

            NotaDinasModel::create($validatedData);

            PengajuanModel::create([
                'p_kpa_id' => $validatedData['nd_kpa_id'],
                'p_pa_id'  => $pPaId,
                'p_bpp_id' => $pBppId,
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