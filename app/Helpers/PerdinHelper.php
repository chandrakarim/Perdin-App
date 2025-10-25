<?php

namespace App\Helpers;

use App\Models\City;

class PerdinHelper
{
    public static function hitungJarak($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km
        $latFrom = deg2rad($lat1);
        $lonFrom = deg2rad($lon1);
        $latTo = deg2rad($lat2);
        $lonTo = deg2rad($lon2);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return $angle * $earthRadius;
    }

    public static function hitungUangSaku(City $asal, City $tujuan, $jarak)
    {
        $amount = 0; // default

        if ($tujuan->is_foreign && strtolower($tujuan->is_foreign) === 'ya') {
            $amount = 50; // USD
        } elseif ($jarak <= 60) {
            $amount = 0;
        } elseif ($asal->province === $tujuan->province) {
            $amount = 200000;
        } elseif ($asal->island === $tujuan->island) {
            $amount = 250000;
        } else {
            $amount = 300000;
        }

        // Pastikan tipe integer murni, tanpa titik/koma
        $amount = (int) $amount;

        return [
            'currency' => $tujuan->is_foreign && strtolower($tujuan->is_foreign) === 'ya' ? 'USD' : 'IDR',
            'amount' => $amount
        ];
    }
    public static function keteranganJarak($jarak)
    {
        if ($jarak > 60) {
            return 'jarak > 60 km';
        } else {
            return 'jarak < 60 km';
        }
    }
}
