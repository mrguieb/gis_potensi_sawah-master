<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potensi extends Model
{
    use HasFactory;

    protected $table = 'farmland';

    protected $fillable = [
        'barangay_id',
        'farmer_id',
        'crop_id',
        'land_area',
        'land_boundaries',
    ];

    protected $casts = [
        'land_area' => 'float', // ensures decimals always return as float
    ];
}
