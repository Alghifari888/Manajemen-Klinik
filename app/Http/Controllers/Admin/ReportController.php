<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Menampilkan laporan pendapatan.
     */
    public function revenueReport(Request $request)
    {
        // Ambil filter bulan dan tahun dari request, jika tidak ada, gunakan bulan & tahun saat ini
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        // Ambil data pembayaran berdasarkan filter bulan dan tahun
        $payments = Payment::whereYear('paid_at', $year)
                           ->whereMonth('paid_at', $month)
                           ->with(['booking.patient.user', 'booking.doctor.user'])
                           ->latest()
                           ->get();

        // Hitung total pendapatan dari data yang sudah difilter
        $totalRevenue = $payments->sum('total_amount');

        // Kirim data ke view
        return view('admin.reports.revenue', compact('payments', 'totalRevenue', 'month', 'year'));
    }

    /**
     * Menampilkan laporan kunjungan pasien.
     */
    public function patientReport(Request $request)
    {
        // Ambil filter bulan dan tahun
        $month = $request->input('month', now()->month);
        $year = $request->input('year', now()->year);

        // Ambil data booking yang sudah selesai (completed) berdasarkan filter
        // Status 'completed' menandakan kunjungan yang valid
        $bookings = Booking::where('status', 'completed')
                           ->whereYear('booking_date', $year)
                           ->whereMonth('booking_date', $month)
                           ->with(['patient.user', 'doctor.user'])
                           ->latest()
                           ->get();

        // Hitung jumlah kunjungan
        $totalVisits = $bookings->count();

        // Kirim data ke view
        return view('admin.reports.patients', compact('bookings', 'totalVisits', 'month', 'year'));
    }
}