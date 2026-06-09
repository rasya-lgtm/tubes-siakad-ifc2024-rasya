<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Dosen::create([
            'nidn' => '5520204088',
            'nama' => 'Budi Santoso ST',
        ]);

        Dosen::create([
            'nidn' => '5520204089',
            'nama' => 'Santoso ST',
        ]);

        Dosen::create([
            'nidn' => '5520204090',
            'nama' => 'Ahmad Fauzi ST',
        ]);
    }
}
