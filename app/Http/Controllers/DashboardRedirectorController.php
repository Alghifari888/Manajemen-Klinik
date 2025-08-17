<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectorController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();

        if ($user->role === UserRole::ADMIN) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->role === UserRole::DOKTER) {
            return redirect()->route('dokter.dashboard');
        }

        if ($user->role === UserRole::KASIR) {
            return redirect()->route('kasir.dashboard');
        }

        if ($user->role === UserRole::PASIEN) {
            return redirect()->route('pasien.dashboard');
        }

        // Default fallback
        return redirect('/profile');
    }
}