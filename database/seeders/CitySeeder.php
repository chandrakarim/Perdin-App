<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::insert([
            // --- Pulau Jawa ---
            ['name' => 'Jakarta', 'province' => 'DKI Jakarta', 'island' => 'Jawa', 'latitude' => -6.2088, 'longitude' => 106.8456, 'is_foreign' => 'Tidak'],
            ['name' => 'Bandung', 'province' => 'Jawa Barat', 'island' => 'Jawa', 'latitude' => -6.9175, 'longitude' => 107.6191, 'is_foreign' => 'Tidak'],
            ['name' => 'Bogor', 'province' => 'Jawa Barat', 'island' => 'Jawa', 'latitude' => -6.5950, 'longitude' => 106.8167, 'is_foreign' => 'Tidak'],
            ['name' => 'Bekasi', 'province' => 'Jawa Barat', 'island' => 'Jawa', 'latitude' => -6.2333, 'longitude' => 107.0000, 'is_foreign' => 'Tidak'],
            ['name' => 'Cirebon', 'province' => 'Jawa Barat', 'island' => 'Jawa', 'latitude' => -6.7063, 'longitude' => 108.5570, 'is_foreign' => 'Tidak'],
            ['name' => 'Semarang', 'province' => 'Jawa Tengah', 'island' => 'Jawa', 'latitude' => -6.9667, 'longitude' => 110.4167, 'is_foreign' => 'Tidak'],
            ['name' => 'Surakarta', 'province' => 'Jawa Tengah', 'island' => 'Jawa', 'latitude' => -7.5667, 'longitude' => 110.8167, 'is_foreign' => 'Tidak'],
            ['name' => 'Yogyakarta', 'province' => 'DI Yogyakarta', 'island' => 'Jawa', 'latitude' => -7.7972, 'longitude' => 110.3688, 'is_foreign' => 'Tidak'],
            ['name' => 'Malang', 'province' => 'Jawa Timur', 'island' => 'Jawa', 'latitude' => -7.9839, 'longitude' => 112.6214, 'is_foreign' => 'Tidak'],
            ['name' => 'Surabaya', 'province' => 'Jawa Timur', 'island' => 'Jawa', 'latitude' => -7.2575, 'longitude' => 112.7521, 'is_foreign' => 'Tidak'],
            ['name' => 'Tangerang', 'province' => 'Banten', 'island' => 'Jawa', 'latitude' => -6.1781, 'longitude' => 106.6319, 'is_foreign' => 'Tidak'],
            ['name' => 'Serang', 'province' => 'Banten', 'island' => 'Jawa', 'latitude' => -6.1200, 'longitude' => 106.1500, 'is_foreign' => 'Tidak'],

            // --- Pulau Bali ---
            ['name' => 'Denpasar', 'province' => 'Bali', 'island' => 'Bali', 'latitude' => -8.65, 'longitude' => 115.2167, 'is_foreign' => 'Tidak'],

            // --- Pulau Papua ---
            ['name' => 'Jayapura', 'province' => 'Papua', 'island' => 'Papua', 'latitude' => -2.5333, 'longitude' => 140.7, 'is_foreign' => 'Tidak'],

            // --- Luar Negeri ---
            ['name' => 'Singapore', 'province' => 'Luar Negeri', 'island' => 'Luar Negeri', 'latitude' => 1.3521, 'longitude' => 103.8198, 'is_foreign' => 'Ya'],
        ]);
    }
}
