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
    public $searchFarmer = ''; // Search text for farmer
    public $perPage = 5;
    public $desa_id, $pemiliklahan_id, $infotanah_id, $luas_lahan, $potensi_id;
    public $batas_lahan = '';
    public $isTambah = false;
    public $isUpdate = false;

    public $pemiliklahan = []; // List of farmers for suggestions

    protected $updatesQueryString = ['search', 'perPage'];

    protected $rules = [
        'desa_id'         => 'required',
        'pemiliklahan_id' => 'required',
        'infotanah_id'    => 'required',
        'luas_lahan'      => 'required|numeric|min:1',
        'batas_lahan'     => 'required',
    ];

    protected $messages = [
        'desa_id.required'         => 'Please select a Barangay.',
        'pemiliklahan_id.required' => 'Please select a Farmer/Land Owner.',
        'infotanah_id.required'    => 'Please select a crop type.',
        'luas_lahan.required'      => 'Land area is required.',
        'luas_lahan.numeric'       => 'Land area must be a number.',
        'luas_lahan.min'           => 'Land area must be greater than 0.',
        'batas_lahan.required'     => 'You must draw or upload the land boundaries.',
    ];

    public function updatedSearchFarmer()
    {
        // Only search if at least 1 character entered
        if (strlen($this->searchFarmer) > 0) {
            $this->pemiliklahan = ModelsPemiliklahan::where('nama_pemiliklahan', 'like', '%' . $this->searchFarmer . '%')->get();
        } else {
            $this->pemiliklahan = [];
        }
    }

    public function selectFarmer($id, $name)
    {
        $this->pemiliklahan_id = $id;
        $this->searchFarmer = $name;
        $this->pemiliklahan = []; // Clear dropdown after selection
    }

    public function render()
    {
        $potensi = ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('desas.nama_desa', 'like', '%' . $this->search . '%')
                        ->orWhere('pemiliklahans.nama_pemiliklahan', 'like', '%' . $this->search . '%')
                        ->orWhere('infotanahs.jenis_tanah', 'like', '%' . $this->search . '%')
                        ->orWhere('potensis.luas_lahan', 'like', '%' . $this->search . '%');
                });
            })
            ->paginate($this->perPage);

        $desa = ModelsDesa::all();
        $infotanah = ModelsInfotanah::all();
        $lahan = $this->getLahanData();

        return view('livewire.potensi', compact('potensi', 'desa', 'infotanah', 'lahan'))
            ->extends('layouts.app')->section('content');
    }

    private function getLahanData()
    {
        return ModelsPotensi::join('desas', 'desas.id', '=', 'potensis.desa_id')
            ->join('pemiliklahans', 'pemiliklahans.id', '=', 'potensis.pemiliklahan_id')
            ->join('infotanahs', 'infotanahs.id', '=', 'potensis.infotanah_id')
            ->select('potensis.*', 'desas.nama_desa', 'pemiliklahans.nama_pemiliklahan', 'infotanahs.jenis_tanah')
            ->get();
    }

    public function resetInputFields()
    {
        $this->desa_id = '';
        $this->pemiliklahan_id = '';
        $this->infotanah_id = '';
        $this->luas_lahan = '';
        $this->batas_lahan = '';
        $this->potensi_id = '';
        $this->searchFarmer = '';
        $this->pemiliklahan = [];
        $this->isTambah = false;
        $this->isUpdate = false;
    }

    public function tambah()
    {
        $this->resetInputFields();
        $this->isTambah = true;
        $this->dispatchBrowserEvent('open-potensi-modal');
    }

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

        // Pre-fill the farmer name for editing
        $farmer = ModelsPemiliklahan::find($potensi->pemiliklahan_id);
        $this->searchFarmer = $farmer ? $farmer->nama_pemiliklahan : '';

        $this->isTambah = $this->isUpdate = true;
        $this->dispatchBrowserEvent('open-potensi-modal');
    }

    public function store()
    {
        $this->validate();

        ModelsPotensi::create([
            'desa_id'         => $this->desa_id,
            'pemiliklahan_id' => $this->pemiliklahan_id,
            'infotanah_id'    => $this->infotanah_id,
            'luas_lahan'      => $this->luas_lahan,
            'batas_lahan'     => $this->batas_lahan,
        ]);

        $this->afterCrud('Data Successfully Added');
    }

    public function update()
    {
        $this->validate();

        if ($this->potensi_id) {
            ModelsPotensi::find($this->potensi_id)->update([
                'desa_id'         => $this->desa_id,
                'pemiliklahan_id' => $this->pemiliklahan_id,
                'infotanah_id'    => $this->infotanah_id,
                'luas_lahan'      => $this->luas_lahan,
                'batas_lahan'     => $this->batas_lahan,
            ]);

            $this->afterCrud('Data Successfully Updated');
        }
    }

    public function delete($id)
    {
        ModelsPotensi::find($id)->delete();
        $this->afterCrud('Data Successfully Deleted');
    }

    private function afterCrud($message)
    {
        session()->flash('message', $message);
        $this->resetInputFields();
        $this->dispatchBrowserEvent('close-potensi-modal');
        $this->dispatchBrowserEvent('refreshMap', ['lahan' => $this->getLahanData()]);
    }
}
