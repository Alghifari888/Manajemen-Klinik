<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua data booking untuk hari ini
        $bookings = Booking::whereDate('booking_date', today())
                            ->with(['patient.user', 'doctor.user', 'payment']) 
                            ->orderBy('queue_number', 'asc')
                            ->get();

        // PENTING: Hitung jumlah pasien yang menunggu konfirmasi ('pending')
        $pendingConfirmation = $bookings->where('status', 'pending')->count();
        
        // PENTING: Hitung jumlah pasien yang menunggu pembayaran ('completed' dan belum ada data payment)
        $waitingForPayment = $bookings->where('status', 'completed')->where('payment', null)->count();

        // Kirim semua data (termasuk data statistik) ke view
        return view('kasir.dashboard', compact(
            'bookings', 
            'pendingConfirmation', 
            'waitingForPayment'
        ));
    }
}