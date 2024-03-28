<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illminate\Validation\ValidationException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class AuthController extends Controller
{
    public function index()
    {
        if ($user = Auth::user()) {
            if ($user->role == 'admin') {
                return redirect()->intended('/dashboard');
            } elseif ($user->role == 'bp') {
                return redirect()->intended('/dashboard');
            } elseif ($user->role == 'bpp') {
                return redirect()->intended('/bpp');
            } elseif ($user->role == 'kpa') {
                return redirect()->intended('/kpa');
            } elseif ($user->role == 'pa') {
                return redirect()->intended('/pa');
            } elseif ($user->role == 'ppk') {
                return redirect()->intended('/ppk');
            }
        }
        return view('pages.auth.index', [
            'title' => 'Login',
        ]);
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $email = $credentials['email'];
        $password = $credentials['password'];

        $user = User::where('email', $email)->first();

        if ($user) {
            if ($user->status == 1) {
                if (Auth::attempt($credentials)) {
                    $request->session()->remove('failed_attempts');
                    $request->session()->remove('last_failed_attempt');

                    $user = Auth::user();

                    if ($user->role) {
                        return redirect()->intended('/dashboard')->with('succe', 'Login berhasil. Selamat datang!');
                    }

                    return redirect()->intended('/');
                } else {
                    $failedAttempts = $request->session()->get('failed_attempts', 0);
                    $failedAttempts++;
                    $request->session()->put('failed_attempts', $failedAttempts);
                    $request->session()->put('last_failed_attempt', now());

                    if ($failedAttempts >= 3) {
                        $user->update(['status' => 2]);
                        return redirect()->back()->withErrors(['error' => 'Akun Anda telah diblokir. Harap hubungi administrator.']);
                    }

                    return redirect()->back()->withErrors(['loginError' => 'Login Gagal!'])->withInput();
                }
            } else {
                return redirect()->back()->withErrors(['error' => 'Akun Anda belum diaktifkan.']);
            }
        } else {
            return redirect()->back()->withErrors(['error' => 'Email tidak terdaftar.']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/');
    }
}
