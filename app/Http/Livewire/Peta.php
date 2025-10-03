<?php

namespace App\Http\Livewire;

use App\Models\Potensi as ModelsPotensi;
use Livewire\Component;

class Peta extends Component
{
    public $barangay_id, $farmer_id, $crop_id, $land_area, $potensi_id;
    public $barangay_name, $farmer_name, $crop_type, $tahun;

    protected $petas;
    public $land_boundaries = [];

    public function render()
    {
        $this->petas = ModelsPotensi::join('barangays', 'barangays.id', '=', 'farmland.barangay_id')
            ->join('landowners', 'landowners.id', '=', 'farmland.farmer_id')
            ->join('crops', 'crops.id', '=', 'farmland.crop_id')
            ->select('farmland.*', 'barangays.barangay_name', 'landowners.farmer_name', 'crops.crop_type')
            ->whereNotNull('farmland.land_boundaries') // Only records with boundary data
            ->where('farmland.land_boundaries', '!=', '') // Exclude empty boundary data
            ->get();
        return view('livewire.peta', [
            'petas' => $this->petas,
        ])->extends('layouts.app')->section('content');
    }
}
