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

        $failedAttempts = $request->session()->get('failed_attempts', 0);

        if ($failedAttempts >= 3) {
            $lastfailedAttempt = $request->session()->get('last_failed_attempt', 0);
            $currentTime = time();

            if ($currentTime - $lastfailedAttempt < 300) {
                $remainingTime = 300 - ($currentTime - $lastfailedAttempt);
                return redirect('/login')->with('remainingTime', $remainingTime);
            }
        }

        try {
            if (Auth::attempt($credentials)) {
                $request->session()->remove('failed_attempts');
                $request->session()->remove('last_failed_attempt');

                $user = Auth::user();

                //sesuaikan dengan role
                // if ($user->role == 'admin') {
                //     return redirect()->intended('/dashboard')->with('succes', 'Login berhasil. Selamat datang!');
                // } elseif ($user->role == 'bp') {
                //     return redirect()->intended('/dashboard')->with('succes', 'Login berhasil. Selamat datang!');
                // } elseif ($user->role == 'bpp') {
                //     return redirect()->intended('/bpp')->with('succes', 'Login berhasil. Selamat datang!');
                // } elseif ($user->role == 'kpa') {
                //     return redirect()->intended('/kpa')->with('succes', 'Login berhasil. Selamat datang!');
                // } elseif ($user->role == 'pa') {
                //     return redirect()->intended('/pa')->with('succes', 'Login berhasil. Selamat datang!');
                // } elseif ($user->role == 'ppk') {
                //     return redirect()->intended('/ppk')->with('succes', 'Login berhasil. Selamat Datang!');
                // }
                // return redirect()->intended('/');
                if ($user->role) {
                    return redirect()->intended('/dashboard')->with('succes', 'Login berhasil. Selamat datang!');
                }
                return redirect()->intended('/');
            }
        } catch (ValidationValidationException $e) {
            return redirect()->back()->withErrors(['loginError' => 'Login Gagal!'])->withInput();
        }

        $failedAttempts++;
        $request->session()->put('failed_attempts', $failedAttempts);
        $request->session()->put('last_failed_attempt', time());

        if ($failedAttempts === 1 || $failedAttempts === 2) {
            return redirect()->back()->withErrors(['Login Error', 'Email atau Password Salah'])->withInput();
        } elseif ($failedAttempts >= 3) {
            $remainingTime = 300;
            return redirect()->back()->withErrors(['error' => 'Anda telah mencapai batas percobaan login. Silahkan coba lagi dalam' . $remainingTime . ' detik.'])->withInput();
        }

        return redirect()->back()->withErrors(['error' => 'Email atau Password tidak Valid'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect('/');
    }
}
