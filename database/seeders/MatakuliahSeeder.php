<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Matakuliah::create([
            'kode_matakuliah' => 'PWL24',
            'nama_matakuliah' => 'Pemograman Web II',
            'sks' => 3,
        ]);
    }
}
