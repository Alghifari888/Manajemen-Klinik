<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'date_of_birth',
        'phone_number',
        'address',
    ];

    // RELASI: Data Pasien ini milik satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI: Satu Pasien bisa punya banyak Booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}