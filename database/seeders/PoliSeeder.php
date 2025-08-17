<?php

namespace Database\Seeders;

use App\Models\Poli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Poli::create(['name' => 'Poli Umum', 'description' => 'Untuk keluhan kesehatan umum.']);
        Poli::create(['name' => 'Poli Gigi', 'description' => 'Masalah kesehatan gigi dan mulut.']);
        Poli::create(['name' => 'Poli Anak', 'description' => 'Kesehatan anak dan tumbuh kembang.']);
        Poli::create(['name' => 'Poli Kandungan', 'description' => 'Kesehatan reproduksi dan kehamilan.']);
        Poli::create(['name' => 'Poli THT', 'description' => 'Telinga, Hidung, Tenggorokan.']);
    }
}