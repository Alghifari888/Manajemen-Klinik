<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua booking untuk hari ini (today())
        $bookings = Booking::whereDate('booking_date', today())
                            ->with(['patient.user', 'doctor.user']) // Eager load relasi
                            ->orderBy('queue_number', 'asc') // Urutkan berdasarkan nomor antrian
                            ->get();

        return view('kasir.dashboard', compact('bookings'));
    }
}