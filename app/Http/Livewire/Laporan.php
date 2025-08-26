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
    public $desas = [], $kecamatans = [];
    public $pdfUrl; // temporary PDF URL

    public function mount()
    {
        $this->kecamatans = ModelsKecamatan::all();
        $this->desas = [];
    }

    public function updatedKecamatan($value)
    {
        $this->desas = ModelsDesa::where('kecamatans_id', $value)->get();
        $this->desa = null;
    }

    public function render()
    {
        return view('livewire.laporan', [
            'kecamatans' => $this->kecamatans,
            'desas' => $this->desas,
        ])->extends('layouts.app')->section('content');
    }

    public function cetakPdf()
    {
        $petas = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select(
                'potensis.*',
                'desas.nama_desa',
                'pemiliklahans.nama_pemiliklahan',
                'infotanahs.jenis_tanah',
                'infotanahs.ketinggian',
                'infotanahs.kelembaban'
            )
            ->when($this->tahun, fn($q) => $q->whereYear('potensis.created_at', $this->tahun))
            ->when($this->kecamatan, fn($q) => $q->where('desas.kecamatans_id', $this->kecamatan))
            ->when($this->desa, fn($q) => $q->where('desa_id', $this->desa))
            ->get();

        $pdf = Pdf::loadView('livewire.cetakpeta', [
            'petas' => $petas,
            'tahun' => $this->tahun,
            'kecamatan' => $this->kecamatan ? ModelsKecamatan::find($this->kecamatan)->nama_kecamatan : null,
            'desa' => $this->desa ? ModelsDesa::find($this->desa)->nama_desa : null,
        ]);

        $filename = 'laporan_' . now()->format('Ymd_His') . '.pdf';
        $path = storage_path('app/public/' . $filename);
        $pdf->save($path);

        $this->pdfUrl = asset('storage/' . $filename);

        $this->dispatchBrowserEvent('open-pdf', ['url' => $this->pdfUrl]);
    }
}
