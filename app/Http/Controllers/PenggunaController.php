<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = User::all();
        return view('pages.admin.pengguna.index', [
            'title' => 'Pengguna',
            'active' => 'Pengguna',
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
            $validatedData['password'] = bcrypt($validatedData['password']);

            user::create($validatedData);

            return redirect('/pengguna')->with('success', 'Data Pengguna Berhasil Disimpan!');
        } catch (\Exception $e) {
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
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required|max:12',
        ]);

        // Temukan pengguna yang ingin diperbarui berdasarkan ID
        $pengguna = User::findOrFail($id);

        // Perbarui informasi pengguna sesuai dengan data yang diterima dari formulir
        $pengguna->name = $request->input('name');
        $pengguna->email = $request->input('email');
        $pengguna->role = $request->input('role');
        $pengguna->password = Hash::make($request->password);
        $pengguna->save();

        return redirect('/pengguna')->with('success', 'User updated successfully.');
    }


    public function destroy($id)
    {
        try {
            $pengguna = User::findOrFail($id);

            if (!$pengguna) {
                return redirect('/pengguna')->with('error', 'Data pengguna tidak ditemukan.');
            }
            $pengguna->delete();

            return redirect('/pengguna')->with('success', 'Data pengguna berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect('/pengguna')->with('error', 'Gagal menghapus data pengguna. Error: ' . $e->getMessage());
        }
    }
}
