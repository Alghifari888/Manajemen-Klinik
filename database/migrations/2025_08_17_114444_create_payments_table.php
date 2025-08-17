<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->constrained('bookings')->onDelete('cascade');
            $table->decimal('consultation_fee', 10, 2);
            $table->decimal('medicine_fee', 10, 2);
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['cash', 'debit', 'credit_card', 'insurance'])->default('cash');
            $table->timestamp('paid_at');
            $table->foreignId('cashier_id')->constrained('users'); // ID user kasir yang memproses
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};