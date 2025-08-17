<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Potensi as ModelsPotensi;
use App\Models\Desa as ModelsDesa;
use App\Models\Pemiliklahan as ModelsPemiliklahan;
use App\Models\Infotanah as ModelsInfotanah;

class Potensi extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $perPage = 5;

    public $desa_id, $pemiliklahan_id, $infotanah_id, $luas_lahan, $potensi_id;
    public $nama_desa, $nama_pemiliklahan, $jenis_tanah;
    public $batas_lahan = [];

    public $isTambah = false;
    public $isUpdate = false;

    protected $updatesQueryString = ['search', 'perPage'];

    public function render()
    {
        $potensi = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select(
                'potensis.*',
                'desas.nama_desa',
                'pemiliklahans.nama_pemiliklahan',
                'infotanahs.jenis_tanah'
            )
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('desas.nama_desa', 'like', '%' . $this->search . '%')
                      ->orWhere('pemiliklahans.nama_pemiliklahan', 'like', '%' . $this->search . '%')
                      ->orWhere('infotanahs.jenis_tanah', 'like', '%' . $this->search . '%')
                      ->orWhere('potensis.luas_lahan', 'like', '%' . $this->search . '%')
                      ->orWhere('potensis.batas_lahan', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->perPage);

        $desa = ModelsDesa::all();
        $pemiliklahan = ModelsPemiliklahan::all();
        $infotanah = ModelsInfotanah::all();

        $lahan = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
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
            ->get();

        return view('livewire.potensi', [
            'potensi' => $potensi,
            'desa' => $desa,
            'pemiliklahan' => $pemiliklahan,
            'infotanah' => $infotanah,
            'lahan' => $lahan,
        ])->extends('layouts.app')->section('content');
    }

    // Reset input fields
    public function resetInputFields()
    {
        $this->desa_id = '';
        $this->pemiliklahan_id = '';
        $this->infotanah_id = '';
        $this->luas_lahan = '';
        $this->batas_lahan = '';
        $this->potensi_id = '';
        $this->isTambah = false;
        $this->isUpdate = false;
    }

    // Show add form
    public function tambah()
    {
        $this->resetInputFields();
        $this->isTambah = true;
        $this->dispatchBrowserEvent('livewire:load');
    }

    // Load record for edit
    public function potensiId($id)
    {
        $this->resetInputFields();
        $this->potensi_id = $id;

        $potensi = ModelsPotensi::find($id);
        $this->desa_id = $potensi->desa_id;
        $this->pemiliklahan_id = $potensi->pemiliklahan_id;
        $this->infotanah_id = $potensi->infotanah_id;
        $this->luas_lahan = $potensi->luas_lahan;
        $this->batas_lahan = $potensi->batas_lahan;

        $this->isTambah = true;
        $this->isUpdate = true;
        $this->dispatchBrowserEvent('livewire:load');
    }

    // Store new record
    public function store()
    {
        $validatedData = $this->validate([
            'desa_id' => 'required',
            'pemiliklahan_id' => 'required',
            'infotanah_id' => 'required',
            'luas_lahan' => 'required',
            'batas_lahan' => 'required',
        ]);

        ModelsPotensi::create($validatedData);

        session()->flash('message', 'Data Successfully Added');
        $this->resetInputFields();
    }

    // Update existing record
    public function update()
    {
        $validatedData = $this->validate([
            'desa_id' => 'required',
            'pemiliklahan_id' => 'required',
            'infotanah_id' => 'required',
            'luas_lahan' => 'required',
            'batas_lahan' => 'required',
        ]);

        if ($this->potensi_id) {
            $potensi = ModelsPotensi::find($this->potensi_id);
            $potensi->update($validatedData);

            session()->flash('message', 'Data Successfully Updated');
            $this->resetInputFields();
        }
    }

    // Delete record
    public function delete($id)
    {
        ModelsPotensi::find($id)->delete();
        session()->flash('message', 'Data Successfully Deleted');
    }
}
