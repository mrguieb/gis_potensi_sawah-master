<?php

namespace App\Http\Livewire;

use App\Models\Potensi as ModelsPotensi;
use Livewire\Component;
use App\Models\Infotanah;
use App\Models\Pemiliklahan;
use App\Models\Desa as ModelsDesa;

class HalamanUser extends Component
{
    protected $infotanah, $barangays, $pemiliktanah, $sum_luas_tanah, $petas;
    public $land_boundaries = [];

    public function render()
    {
        $this->infotanah = Infotanah::all();
        $this->barangays = ModelsDesa::join('town', 'barangays.town_id', '=', 'town.id')
            ->select('barangays.*', 'town.town_name')
            ->get();
        $this->pemiliktanah = Pemiliklahan::all();
        // sum of luas tanah
        $this->sum_luas_tanah = ModelsPotensi::sum('land_area');
        $this->petas = ModelsPotensi::join('barangays', 'barangays.id', '=', 'farmland.barangay_id')
            ->join('landowners', 'landowners.id', '=', 'farmland.farmer_id')
            ->join('crops', 'crops.id', '=', 'farmland.crop_id')
            ->select('farmland.*', 'barangays.barangay_name', 'landowners.farmer_name', 'crops.crop_type',
            'crops.ketinggian', 'crops.kelembaban')
            ->get();
        return view('livewire.halaman-user',[
            'infotanah' => $this->infotanah,
            'barangays'     => $this->barangays,
            'pemiliktanah' => $this->pemiliktanah,
            'sum_luas_tanah' => $this->sum_luas_tanah,
            'petas' => $this->petas,
        ])->extends('welcome')->section('content');
    }
}
