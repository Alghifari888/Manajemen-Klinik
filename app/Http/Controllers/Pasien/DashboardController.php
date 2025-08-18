<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil ID patient yang terhubung dengan user yang sedang login
        $patientId = Auth::user()->patient->id;

        // Ambil semua data booking milik pasien tersebut
        // Eager load relasi dokter, user (untuk nama dokter), dan poli
        $bookings = Booking::where('patient_id', $patientId)
                            ->with(['doctor.user', 'doctor.poli'])
                            ->latest('booking_date') // Urutkan dari yang paling baru
                            ->paginate(10); // Bagi per 10 data

        return view('pasien.dashboard', compact('bookings'));
    }
}