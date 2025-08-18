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
                            // TAMBAHKAN 'payment' DI SINI untuk mengecek status pembayaran
                            ->with(['patient.user', 'doctor.user', 'payment']) 
                            ->orderBy('queue_number', 'asc')
                            ->get();

        return view('kasir.dashboard', compact('bookings'));
    }
}