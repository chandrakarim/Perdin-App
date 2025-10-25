<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'jk' => 'Laki-laki',
            'no_tlp' => '081211108099',
        ]);

        User::create([
            'name' => 'chandra',
            'email' => 'chandra@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'pegawai',
            'jk' => 'Laki-laki',
            'no_tlp' => '081211103079',
        ]);

            User::create([
            'name' => 'Citra',
            'email' => 'citra@gmail.com',
            'password' => Hash::make('123456'),
            'role' => 'sdm',
            'jk' => 'Perempuan',
            'no_tlp' => '081211103079',
        ]);
    }
}
