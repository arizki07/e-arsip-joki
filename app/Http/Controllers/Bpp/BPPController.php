<?php

namespace App\Http\Controllers\Bpp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use App\Models\NotaDinasModel;
use App\Models\PengajuanModel;
use App\Models\BiodataModel;
use App\Models\JabatanModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class BPPController extends Controller
{
    public function index()
    {
        $biodata = BiodataModel::all();
        $jabatan = JabatanModel::all();

        return view('pages.admin.biodata.bpp', [
            'title' => 'Biodata Pegawai BPP',
            'active' => 'BPP',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    //View pengguna bpp
    public function bpp()
    {
        return view('pages.admin.pengguna.bpp', [
            'title' => 'Data Bpp',
        ]);
    }

    //view profile bpp
    public function profilee()
    {
        $user = Auth::user();
        $biodata = BiodataModel::where('user_id', $user->id_users)->get();
        $jabatan = JabatanModel::all();

        return view('pages.bpp.profile.index', [
            'title' => 'Profile',
            'active' => 'bpp',
            'biodata' => $biodata,
            'jabatan' => $jabatan
        ]);
    }

    public function updatee(Request $request, $id)
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

        return redirect('/profile-bpp')->with('success', 'Data berhasil diperbarui.');
    }

    //view pengajuan Bpp
    public function pengajuan()
    {
        $pengajuans = PengajuanModel::joinBiodata()->get();

        return view('pages.bpp.pengajuan.index', [
            'title' => 'Pengajuan',
            'active' => 'Pengajuan',
            'pengajuan' => $pengajuans,
        ]);
    }

    public function create()
    {

        return view('pages.bpp.pengajuan.create', [
            'title' => 'Tambah Data Pengajuan',
            'active' => 'Pengajuan',
        ]);
    }
    public function store(Request $request)
    {
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

            // // Hilangkan 'p_pa_id' dan 'p_bpp_id' dari $validatedData
            // unset($validatedData['p_pa_id']);
            // unset($validatedData['p_bpp_id']);

            // NotaDinasModel::create($validatedData);

            $pengajuan = PengajuanModel::create([
                'p_kpa_id' => $validatedData['nd_kpa_id'],
                'p_pa_id'  => $idBiodataPA,
                'p_bpp_id' => $idBiodataBPP,
                'p_nama_kegiatan' => $validatedData['nd_nama_kegiatan'],
                'p_sub_kegiatan' => $validatedData['nd_sub_kegiatan'],
                'p_tanggal' => $validatedData['nd_tanggal'],
                'p_biaya' => $validatedData['nd_jumlah_biaya'],
                'status' => 1, // status Pending verivikasi
            ]);

            $idPengajuan = $pengajuan->id_pengajuan;

            $validatedData['id_pengajuan'] = $idPengajuan;
            unset($validatedData['p_pa_id']);
            unset($validatedData['p_bpp_id']);
            // dd($validatedData);
            $notaDinas = NotaDinasModel::create($validatedData);

            return redirect('/pengajuan-index')->with('success', 'Data pengajuan Berhasil Disimpan!');
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
    public function edit($id)
    {
        $pengajuan = PengajuanModel::findOrFail($id);

        // Ganti 'created_at' dengan kolom yang sesuai di dalam model NotaDinasModel
        $notaDinas = NotaDinasModel::where('created_at', $pengajuan->created_at)->firstOrFail();

        return view('pages.bpp.pengajuan.edit', [
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

            return redirect('/pengajuan-index')->with('success', 'Data pengajuan berhasil diperbarui!');
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

            return redirect('/pengajuan-index')->with('success', 'Data pengajuan berhasil dihapus!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Data pengajuan tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus data pengajuan.');
        }
    }
}
