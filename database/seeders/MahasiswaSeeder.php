<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            Mahasiswa::create([
            'npm' => '5520124090',
            'nidn' => '5520204088',
            'nama' => 'Rasya Arkana',
        ]);
    }
}
