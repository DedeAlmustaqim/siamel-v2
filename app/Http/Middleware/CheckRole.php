<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  $roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Cek apakah sesi login tersedia
        if ($request->session()->has('login')) {
            // Ambil hak akses dari sesi
            $hakAkses = $request->session()->get('hak_akses');

            // Periksa apakah hak akses pengguna sesuai dengan salah satu yang diizinkan
            if (in_array($hakAkses, $roles)) {
                return $next($request);
            }
        }

        // Redirect ke halaman login jika tidak memiliki izin
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}