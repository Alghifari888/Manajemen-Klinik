<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'schedule_id',
        'booking_date',
        'queue_number',
        'status',
        'notes',
    ];

    // RELASI: Booking ini milik satu Pasien
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // RELASI: Booking ini untuk satu Dokter
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    // RELASI: Booking ini berdasarkan satu Jadwal
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    // RELASI: Satu Booking punya satu Rekam Medis
    public function medicalRecord()
    {
        return $this->hasOne(MedicalRecord::class);
    }

    // RELASI: Satu Booking punya satu Pembayaran
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}