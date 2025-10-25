<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perdin extends Model
{
    use HasFactory;
    protected $table = 'perdin';
    protected $fillable = [
        'user_id',
        'purpose',
        'from_city_id',
        'to_city_id',
        'start_date',
        'end_date',
        'duration_days',      // ✅ ubah dari total_days
        'distance_km',
        'daily_allowance',    // ✅ ubah dari allowance_per_day
        'total_allowance',
        'status',
        'approved_by',
        'approved_at',
        'notes',
    ];

    protected $casts = [
    'duration_days' => 'integer',
    'daily_allowance' => 'integer',
    'total_allowance' => 'integer',
    'distance_km' => 'double',
];

    public function user() { return $this->belongsTo(User::class); }
    public function fromCity() { return $this->belongsTo(City::class,'from_city_id'); }
    public function toCity() { return $this->belongsTo(City::class,'to_city_id'); }
    public function approver() { return $this->belongsTo(User::class,'approved_by'); }
}
