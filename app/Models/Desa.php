<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    use HasFactory;

    protected $table = 'desas';
    protected $fillable = ['nama_desa', 'kecamatans_id', 'luas_wilayah'];

    // Relationship to Kecamatan (District)
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'kecamatans_id', 'id');
    }

    // Relationship to Pemiliklahan (Farmers/Land Owners)
    public function pemiliklahans()
    {
        return $this->hasMany(Pemiliklahan::class, 'desa_id', 'id');
    }
}
