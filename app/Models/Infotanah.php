<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Infotanah extends Model
{
    use HasFactory;
    protected $table = 'crops';
    protected $fillable = [
        'crop_type',
        'ketinggian',
        'kelembaban',
    ];
}
