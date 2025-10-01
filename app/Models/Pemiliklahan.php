<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemiliklahan extends Model
{
    use HasFactory;

    protected $table = 'landowners';

    protected $fillable = [
        'farmer_name',
        'farmer_barangay',
        'farmer_number',
        'barangay_id', // ✅ Make sure we can assign barangay when saving
    ];

    // ✅ Each farmer belongs to one barangay
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'barangay_id', 'id');
    }
}
