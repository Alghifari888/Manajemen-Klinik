<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat Admin
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password'),
            'role' => UserRole::ADMIN,
        ]);

        // Membuat Kasir
        User::create([
            'name' => 'Kasir Klinik',
            'email' => 'kasir@klinik.com',
            'password' => Hash::make('password'),
            'role' => UserRole::KASIR,
        ]);

        // Membuat Dokter (contoh)
        User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'dr.budi@klinik.com',
            'password' => Hash::make('password'),
            'role' => UserRole::DOKTER,
        ]);

        // Membuat Pasien (contoh)
        User::create([
            'name' => 'Andi Wijaya',
            'email' => 'andi@pasien.com',
            'password' => Hash::make('password'),
            'role' => UserRole::PASIEN,
        ]);
    }
}