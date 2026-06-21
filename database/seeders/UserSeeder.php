<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Rasya Arkana',
            'email' => 'mahasiswa@gmail.com',
            'password' => bcrypt('mahasiswa'),
            'role' => 'mahasiswa',
            'npm' => '5520124090',
        ]);
    }
}
