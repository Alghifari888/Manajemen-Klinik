<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Menampilkan daftar semua dokter.
     */
    public function index()
    {
        // Ambil data dokter beserta relasi user dan poli untuk efisiensi query
        $doctors = Doctor::with(['user', 'poli'])->latest()->paginate(10);
        return view('admin.doctors.index', compact('doctors'));
    }

    /**
     * Menampilkan form untuk membuat dokter baru.
     */
    public function create()
    {
        // Ambil data user yang memiliki role 'dokter' TAPI belum terdaftar di tabel doctors
        $users = User::where('role', UserRole::DOKTER)
                     ->whereDoesntHave('doctor')
                     ->get();

        // Ambil semua data poli untuk pilihan dropdown
        $polis = Poli::all();

        return view('admin.doctors.create', compact('users', 'polis'));
    }

    /**
     * Menyimpan dokter baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:doctors,user_id',
            'poli_id' => 'required|exists:polis,id',
            'specialization' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        Doctor::create($request->all());

        return redirect()->route('admin.doctors.index')
                         ->with('success', 'Data Dokter berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit data dokter.
     */
    public function edit(Doctor $doctor)
    {
        // Ambil semua data poli untuk pilihan dropdown
        $polis = Poli::all();
        return view('admin.doctors.edit', compact('doctor', 'polis'));
    }

    /**
     * Memperbarui data dokter di database.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $request->validate([
            'poli_id' => 'required|exists:polis,id',
            'specialization' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
        ]);

        $doctor->update($request->all());

        return redirect()->route('admin.doctors.index')
                         ->with('success', 'Data Dokter berhasil diperbarui.');
    }

    /**
     * Menghapus data dokter dari database.
     */
    public function destroy(Doctor $doctor)
    {
        $doctor->delete();
        
        return redirect()->route('admin.doctors.index')
                         ->with('success', 'Data Dokter berhasil dihapus.');
    }
}