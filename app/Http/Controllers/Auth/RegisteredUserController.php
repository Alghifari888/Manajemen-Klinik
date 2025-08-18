<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // <-- PENTING: Import class DB
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // PENTING: Tambahkan validasi untuk kolom-kolom baru
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:patients,nik'], // unik di tabel patients
            'date_of_birth' => ['required', 'date'],
            'phone_number' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // PENTING: Gunakan DB Transaction untuk keamanan data
        // Ini memastikan bahwa jika salah satu proses (misal: create patient) gagal,
        // maka proses create user juga akan dibatalkan. Mencegah data "yatim".
        try {
            DB::beginTransaction();

            // Langkah 1: Buat data di tabel 'users'
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                // Role 'pasien' akan otomatis terisi karena sudah kita set default di migrasi
            ]);

            // Langkah 2: Buat data di tabel 'patients' yang terhubung dengan user baru
            $user->patient()->create([
                'nik' => $request->nik,
                'date_of_birth' => $request->date_of_birth,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
            ]);

            // Jika semua berhasil, konfirmasi transaksi
            DB::commit();

            event(new Registered($user));

            Auth::login($user);

            // Arahkan ke dashboard yang sesuai (akan dihandle oleh DashboardRedirectorController)
            return redirect(route('dashboard', absolute: false));

        } catch (\Throwable $th) {
            // Jika terjadi error, batalkan semua query yang sudah dijalankan
            DB::rollBack();
            
            // Tampilkan error (atau bisa juga redirect dengan pesan error)
            throw $th;
        }
    }
}