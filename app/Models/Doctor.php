<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'poli_id',
        'specialization',
        'phone_number',
    ];

    // RELASI: Data Dokter ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI: Data Dokter ini milik satu Poli
    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }

    // RELASI: Satu Dokter punya banyak Jadwal
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    // RELASI: Satu Dokter punya banyak Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}