<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemiliklahan extends Model
{
    use HasFactory;

    protected $table = 'pemiliklahans';

    protected $fillable = [
        'nama_pemiliklahan',
        'alamat_pemiliklahan',
        'no_hp_pemiliklahan',
        'email_pemiliklahan',
        'desa_id', // ✅ Make sure we can assign barangay when saving
    ];

    // ✅ Each farmer belongs to one barangay
    public function desa()
    {
        return $this->belongsTo(Desa::class, 'desa_id', 'id');
    }
}
