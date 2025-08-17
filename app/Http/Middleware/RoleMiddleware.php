<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        // Ambil data user yang sedang login
        $user = Auth::user();

        // Lakukan perulangan untuk setiap role yang diizinkan di rute
        foreach ($roles as $role) {
            // Jika role user cocok dengan salah satu role yang diizinkan
            if ($user->role->value == $role) {
                // Lanjutkan request ke controller/halaman tujuan
                return $next($request);
            }
        }

        // Jika tidak ada role yang cocok, lempar ke halaman error 403 (Forbidden)
        abort(403, 'ANDA TIDAK MEMILIKI HAK AKSES.');
    }
}