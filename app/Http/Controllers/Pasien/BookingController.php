<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Doctor;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Langkah 1: Menampilkan Pilihan Poli
    public function stepOne()
    {
        $polis = Poli::all();
        return view('pasien.booking.step-one', compact('polis'));
    }

    // Langkah 2: Menampilkan Pilihan Dokter berdasarkan Poli
    public function stepTwo(Poli $poli)
    {
        // Ambil dokter yang ada di poli yang dipilih & punya jadwal aktif
        $doctors = $poli->doctors()->whereHas('schedules', function ($query) {
            $query->where('is_active', true);
        })->get();

        return view('pasien.booking.step-two', compact('poli', 'doctors'));
    }

    // Langkah 3: Menampilkan Pilihan Jadwal Dokter
    public function stepThree(Doctor $doctor)
    {
        // Ambil jadwal aktif dokter
        $schedules = $doctor->schedules()->where('is_active', true)->get();

        // Buat daftar tanggal yang tersedia (misal: 7 hari ke depan)
        $available_dates = [];
        $start_date = Carbon::today();
        $day_name_map = [
            'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        for ($i = 0; $i < 7; $i++) {
            $date = $start_date->copy()->addDays($i);
            $dayName = $day_name_map[$date->format('l')];

            // Cek apakah ada jadwal dokter di hari tersebut
            foreach ($schedules as $schedule) {
                if ($schedule->day_of_week === $dayName) {
                    $available_dates[] = [
                        'date' => $date->format('Y-m-d'),
                        'dayName' => $dayName,
                        'schedule_id' => $schedule->id,
                        'time' => date('H:i', strtotime($schedule->start_time)) . ' - ' . date('H:i', strtotime($schedule->end_time)),
                    ];
                }
            }
        }
        
        return view('pasien.booking.step-three', compact('doctor', 'available_dates'));
    }

    // Langkah 4: Menyimpan Booking
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'schedule_id' => 'required|exists:schedules,id',
            'booking_date' => 'required|date',
        ]);

        $patient = Auth::user()->patient;

        // Cek apakah pasien sudah booking di tanggal yang sama
        $existingBooking = Booking::where('patient_id', $patient->id)
                                  ->where('booking_date', $request->booking_date)
                                  ->exists();

        if ($existingBooking) {
            return back()->with('error', 'Anda sudah memiliki booking pada tanggal tersebut.');
        }

        // Generate Nomor Antrian
        // Cari nomor antrian terakhir di tanggal dan dokter yang sama
        $lastQueueNumber = Booking::where('doctor_id', $request->doctor_id)
                                  ->where('booking_date', $request->booking_date)
                                  ->max('queue_number');

        $newQueueNumber = $lastQueueNumber ? $lastQueueNumber + 1 : 1;

        // Simpan booking
        Booking::create([
            'patient_id' => $patient->id,
            'doctor_id' => $request->doctor_id,
            'schedule_id' => $request->schedule_id,
            'booking_date' => $request->booking_date,
            'queue_number' => $newQueueNumber,
            'status' => 'pending', // Status awal adalah pending
        ]);

        return redirect()->route('pasien.dashboard')
                         ->with('success', 'Booking berhasil! Nomor antrian Anda adalah ' . $newQueueNumber . ' untuk tanggal ' . $request->booking_date);
    }
}