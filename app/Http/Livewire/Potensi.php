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
    public $barangay_id, $farmer_id, $crop_id, $land_area, $potensi_id;
    public $land_boundaries = '';
    public $isTambah = false;
    public $isUpdate = false;

    public $pemiliklahan = []; // List of farmers for suggestions

    protected $updatesQueryString = ['search', 'perPage'];

    protected $rules = [
        'barangay_id'         => 'required',
        'farmer_id' => 'required',
        'crop_id'         => 'required',
        'land_area'       => 'required|numeric|min:0.01', // allow decimals, no 0 values
        'land_boundaries' => 'required',
    ];

    protected $messages = [
        'barangay_id.required'         => 'Please select a Barangay.',
        'farmer_id.required' => 'Please select a Farmer/Land Owner.',
        'crop_id.required'         => 'Please select a crop type.',
        'land_area.required'       => 'Land area is required.',
        'land_area.numeric'        => 'Land area must be a number.',
        'land_area.min'            => 'Land area must be greater than 0.',
        'land_boundaries.required' => 'You must draw or upload the land boundaries.',
    ];

    public function updatedSearchFarmer()
    {
        // Only search if at least 1 character entered
        if (strlen($this->searchFarmer) > 0) {
            $this->pemiliklahan = ModelsPemiliklahan::where('farmer_name', 'like', '%' . $this->searchFarmer . '%')->get();
        } else {
            $this->pemiliklahan = [];
        }
    }

    public function selectFarmer($id, $name)
    {
        $this->farmer_id = $id;
        $this->searchFarmer = $name;
        $this->pemiliklahan = []; // Clear dropdown after selection
    }

    public function render()
    {
        $potensi = ModelsPotensi::join('barangays', 'barangays.id', '=', 'farmland.barangay_id')
            ->join('landowners', 'landowners.id', '=', 'farmland.farmer_id')
            ->join('crops', 'crops.id', '=', 'farmland.crop_id')
            ->select('farmland.*', 'barangays.barangay_name', 'landowners.farmer_name', 'crops.crop_type')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('barangays.barangay_name', 'like', '%' . $this->search . '%')
                      ->orWhere('landowners.farmer_name', 'like', '%' . $this->search . '%')
                      ->orWhere('crops.crop_type', 'like', '%' . $this->search . '%')
                      ->orWhereRaw("CAST(farmland.land_area AS CHAR) LIKE ?", ['%' . $this->search . '%']); // fix search for decimals
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
        return ModelsPotensi::join('barangays', 'barangays.id', '=', 'farmland.barangay_id')
            ->join('landowners', 'landowners.id', '=', 'farmland.farmer_id')
            ->join('crops', 'crops.id', '=', 'farmland.crop_id')
            ->select('farmland.*', 'barangays.barangay_name', 'landowners.farmer_name', 'crops.crop_type')
            ->get();
    }

    public function resetInputFields()
    {
        $this->barangay_id = '';
        $this->farmer_id = '';
        $this->crop_id = '';
        $this->land_area = '';
        $this->land_boundaries = '';
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
        $this->barangay_id = $potensi->barangay_id;
        $this->farmer_id = $potensi->farmer_id;
        $this->crop_id = $potensi->crop_id;
        $this->land_area = $potensi->land_area;
        $this->land_boundaries = $potensi->land_boundaries;

        // Pre-fill the farmer name for editing
        $farmer = ModelsPemiliklahan::find($potensi->farmer_id);
        $this->searchFarmer = $farmer ? $farmer->farmer_name : '';

        $this->isTambah = $this->isUpdate = true;
        $this->dispatchBrowserEvent('open-potensi-modal');
    }

    public function store()
    {
        $this->validate();

        ModelsPotensi::create([
            'barangay_id'         => $this->barangay_id,
            'farmer_id' => $this->farmer_id,
            'crop_id'         => $this->crop_id,
            'land_area'       => $this->land_area,
            'land_boundaries' => $this->land_boundaries,
        ]);

        $this->afterCrud('Data Successfully Added');
    }

    public function update()
    {
        $this->validate();

        if ($this->potensi_id) {
            ModelsPotensi::find($this->potensi_id)->update([
                'barangay_id'         => $this->barangay_id,
                'farmer_id' => $this->farmer_id,
                'crop_id'         => $this->crop_id,
                'land_area'       => $this->land_area,
                'land_boundaries' => $this->land_boundaries,
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
