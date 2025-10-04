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
        'farmer_number',
        'barangay_id',
    ];

    public function barangay()
    {
        return $this->belongsTo(\App\Models\Barangay::class, 'barangay_id', 'id');
    }
}
