<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'consultation_fee',
        'medicine_fee',
        'total_amount',
        'payment_method',
        'paid_at',
        'cashier_id',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // RELASI: Pembayaran ini milik satu Booking
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    // RELASI: Pembayaran ini diproses oleh satu User (Kasir)
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}