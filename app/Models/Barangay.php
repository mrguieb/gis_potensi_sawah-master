<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $table = 'barangays'; // your table name
    protected $fillable = ['barangay_name', 'town_id'];

    // Relation to Farmers (landowners)
    public function landowners()
    {
        return $this->hasMany(\App\Models\Pemiliklahan::class, 'barangay_id', 'id');
    }
}
