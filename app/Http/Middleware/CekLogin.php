<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $rules)
    {
        // if (!Auth::check()) {
        //     return redirect('login');
        // }

        // $user = Auth::user();
        // if ($user->role == $rules) {
        //     return $next($request);
        // }
        // return redirect()->back()->with('error', 'Anda Tidak Memiliki Akses ');
        if (!Auth::check()) {
            Log::info('Pengguna tidak terautentikasi. URL: ' . $request->fullUrl());
            return redirect('login');
        }

        $user = Auth::user();
        if (in_array($user->role, explode('|', $rules))) {
            Log::info('Pengguna ' . $user->name . ' berhasil masuk. Role: ' . $user->role);
            return $next($request);
        }

        Log::info('Pengguna ' . $user->name . ' tidak memiliki akses yang diperlukan. Role: ' . $user->role);
        return redirect('login')->withErrors(['error' => 'Anda Tidak Memiliki Akses']);

    }
}