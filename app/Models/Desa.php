<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'barangays';
    protected $fillable = ['barangay_name', 'town_id', 'number_of_farmers'];

    // Relationship to Kecamatan (Municipality)
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'town_id', 'id');
    }

    // Relationship to Pemiliklahan (Farmers/Land Owners)
    public function landowners()
    {
        return $this->hasMany(Pemiliklahan::class, 'barangay_id', 'id');
    }
}
