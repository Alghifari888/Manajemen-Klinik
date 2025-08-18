<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // PENTING: Menghitung Pendapatan Hari Ini
        // Menjumlahkan kolom 'total_amount' dari tabel 'payments'
        // yang dibuat pada hari ini.
        $todaysRevenue = Payment::whereDate('paid_at', today())->sum('total_amount');

        // PENTING: Menghitung Jumlah Pasien Hari Ini
        // Menghitung jumlah booking untuk hari ini yang statusnya sudah dikonfirmasi atau selesai.
        // Ini merepresentasikan pasien yang benar-benar datang.
        $todaysPatients = Booking::whereDate('booking_date', today())
                                ->whereIn('status', ['confirmed', 'completed'])
                                ->count();
        
        // PENTING: Menghitung Total Booking Pending
        // Menghitung semua booking yang statusnya masih 'pending' dari semua tanggal.
        $pendingBookings = Booking::where('status', 'pending')->count();
        
        // PENTING: Mengambil beberapa booking terbaru untuk ditampilkan
        $recentBookings = Booking::with(['patient.user', 'doctor.user'])
                                ->latest() // Mengurutkan dari yang paling baru
                                ->take(5) // Mengambil 5 data teratas
                                ->get();

        // Mengirim semua data statistik ke view
        return view('admin.dashboard', compact(
            'todaysRevenue',
            'todaysPatients',
            'pendingBookings',
            'recentBookings'
            
        ));
        
    }
    // Dashboard Dokter
    public function doctorDashboard()
    {
        $bookings = Booking::whereDate('booking_date', today())
                          ->with(['patient.user'])
                          ->get();

        $waitingPatients = $bookings->where('status', 'confirmed')->count();

        return view('dokter.dashboard', compact('bookings', 'waitingPatients'));
    }
}