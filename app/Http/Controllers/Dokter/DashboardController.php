<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data dokter yang sedang login
        $doctor = Auth::user()->doctor;

        // Ambil data booking untuk dokter ini, pada hari ini,
        // yang statusnya sudah dikonfirmasi (menunggu diperiksa) atau sudah selesai
        $bookings = Booking::where('doctor_id', $doctor->id)
                            ->whereDate('booking_date', today())
                            ->whereIn('status', ['confirmed', 'completed'])
                            ->with('patient.user')
                            ->orderBy('queue_number', 'asc')
                            ->get();
        
        return view('dokter.dashboard', compact('bookings'));
    }
}