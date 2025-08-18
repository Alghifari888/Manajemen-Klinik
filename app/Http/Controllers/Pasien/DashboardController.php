<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dasbor utama pasien beserta riwayat booking.
     */
    public function index()
    {
        // Ambil ID patient yang terhubung dengan user yang sedang login
        $patientId = Auth::user()->patient->id;

        // Ambil semua data booking milik pasien tersebut
        // Eager load relasi dokter, user (untuk nama dokter), dan poli
        $bookings = Booking::where('patient_id', $patientId)
                            ->with(['doctor.user', 'doctor.poli', 'medicalRecord']) // Tambahkan medicalRecord
                            ->latest('booking_date') // Urutkan dari yang paling baru
                            ->paginate(10); // Bagi per 10 data

        return view('pasien.dashboard', compact('bookings'));
    }

    /**
     * FUNGSI YANG HILANG: Menampilkan detail rekam medis untuk satu booking.
     * Ini adalah fungsi yang dibutuhkan oleh rute Anda.
     */
    public function showMedicalRecord(Booking $booking)
    {
        // PENTING: Keamanan & Privasi
        // Pastikan pasien yang login hanya bisa melihat rekam medis miliknya sendiri.
        if ($booking->patient_id !== Auth::user()->patient->id) {
            abort(403, 'AKSES DITOLAK');
        }

        // Pastikan rekam medis untuk booking ini sudah ada
        if (!$booking->medicalRecord) {
            abort(404, 'REKAM MEDIS TIDAK DITEMUKAN');
        }

        // Tampilkan halaman detail rekam medis
        return view('pasien.medical-record', compact('booking'));
    }
}