<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Potensi as ModelsPotensi;
use App\Models\Desa as ModelsDesa;
use App\Models\Kecamatan as ModelsKecamatan;
use Barryvdh\DomPDF\Facade\Pdf;

class Laporan extends Component
{
    public $tahun, $kecamatan, $desa;
    public $barangays = [], $town = [];
    public $pdfUrl; // temporary PDF URL

    public function mount()
    {
        $this->town = ModelsKecamatan::all();
        $this->barangays = [];
    }

    public function updatedKecamatan($value)
    {
        $this->barangays = ModelsDesa::where('town_id', $value)->get();
        $this->desa = null;
    }

    public function render()
    {
        return view('livewire.laporan', [
            'town' => $this->town,
            'barangays' => $this->barangays,
        ])->extends('layouts.app')->section('content');
    }

public function cetakPdf()
{
    $petas = ModelsPotensi::join('barangays', 'barangays.id', '=', 'farmland.barangay_id')
        ->join('landowners', 'landowners.id', '=', 'farmland.farmer_id')
        ->join('crops', 'crops.id', '=', 'farmland.crop_id')
        ->select(
            'farmland.*',
            'barangays.barangay_name',
            'landowners.farmer_name',
            'crops.crop_type',
            'crops.ketinggian',
            'crops.kelembaban'
        )
        ->when($this->tahun, fn($q) => $q->whereYear('farmland.created_at', $this->tahun))
        ->when($this->kecamatan, fn($q) => $q->where('barangays.town_id', $this->kecamatan))
        ->when($this->desa, fn($q) => $q->where('farmland.barangay_id', $this->desa)) // ✅ fixed
        ->get();

    $pdf = Pdf::loadView('livewire.cetakpeta', [
        'petas' => $petas,
        'tahun' => $this->tahun,
        'kecamatan' => $this->kecamatan ? ModelsKecamatan::find($this->kecamatan)->town_name : null,
        'desa' => $this->desa ? ModelsDesa::find($this->desa)->barangay_name : null,
    ]);

    $filename = 'laporan_' . now()->format('Ymd_His') . '.pdf';
    $path = storage_path('app/public/' . $filename);
    $pdf->save($path);

    $this->pdfUrl = asset('storage/' . $filename);

    $this->dispatchBrowserEvent('open-pdf', ['url' => $this->pdfUrl]);
}
}