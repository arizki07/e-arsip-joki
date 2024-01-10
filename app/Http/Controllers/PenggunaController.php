<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();


        return view('pages.admin.pengguna.index', [
            'title' => 'Pengguna',
            'pengguna' => $pengguna,

        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|max:30',
            'email' => 'required|email',
            'password' => 'required|max:60',
            'role' => 'required|max:20',
        ]);

        try {
            // Enkripsi password sebelum menyimpan
            $validatedData['password'] = bcrypt($validatedData['password']);

            // Buat entitas Pengguna baru dengan data yang valid
            user::create($validatedData);

            return redirect('/pengguna')->with('success', 'Data Pengguna Berhasil Disimpan!');
        } catch (\Exception $e) {
            // Tangkap dan tangani kesalahan, contoh: redirect kembali dengan pesan kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan. ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pengguna = User::findOrFail($id);

        return view('pages.admin.pengguna.show', [
            'title' => 'User Details',
            'pengguna' => $pengguna
        ]);
    }

    public function edit($id)
    {
        $pengguna = User::findOrFail($id);

        return view('pages.admin.pengguna.edit', [
            'title' => 'Edit User',
            'pengguna' => $pengguna
        ]);
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            // Add validation rules for other fields as needed
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the user by ID
        $pengguna = User::findOrFail($id);

        // Update user data
        $pengguna->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
            // Update other fields as needed
        ]);

        // Redirect back with a success message
        return redirect('/pengguna')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        try {

            user::where('id_users', $id)->delete();

            return response()->json(['message' => 'Data berhasil dihapus.']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['message' => 'Data tidak ditemukan.'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan saat menghapus data.'], 500);
        }
    }
}
