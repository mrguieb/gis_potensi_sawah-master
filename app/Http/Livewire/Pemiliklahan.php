<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pemiliklahan as ModelsPemiliklahan;
use App\Models\Barangay;

class Pemiliklahan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 5;
    public $farmer_name, $barangay_id, $farmer_number, $farmer_id;
    public $barangays = [];
    protected $landowners;

    protected $rules = [
        'farmer_name'   => 'required|string|max:255',
        'barangay_id'   => 'required|exists:barangays,id',
        'farmer_number' => 'required|digits_between:10,15',
    ];

    protected $messages = [
        'farmer_name.required'   => 'Owner name is required.',
        'farmer_name.string'     => 'Owner name must be text.',
        'farmer_name.max'        => 'Owner name cannot exceed 255 characters.',

        'barangay_id.required'   => 'Please select a barangay.',
        'barangay_id.exists'     => 'Invalid barangay selected.',

        'farmer_number.required' => 'Phone number is required.',
        'farmer_number.digits_between' => 'Phone number must be between 10 and 15 digits.',
    ];

    public function mount()
    {
        $this->barangays = Barangay::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingPerPage()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->landowners = ModelsPemiliklahan::with('barangay')
            ->where('farmer_name', 'like', '%' . $this->search . '%')
            ->orWhereHas('barangay', function ($q) {
                $q->where('barangay_name', 'like', '%' . $this->search . '%');
            })
            ->orWhere('farmer_number', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.pemiliklahan', [
            'landowners' => $this->landowners,
            'barangays'  => $this->barangays,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInputFields()
    {
        $this->farmer_name   = '';
        $this->barangay_id   = '';
        $this->farmer_number = '';
        $this->farmer_id     = '';
    }

    public function pemiliklahanId($id)
    {
        $this->farmer_id = $id;

        $pemiliklahan = ModelsPemiliklahan::find($id);
        $this->farmer_name   = $pemiliklahan->farmer_name;
        $this->barangay_id   = $pemiliklahan->barangay_id;
        $this->farmer_number = $pemiliklahan->farmer_number;
    }

    public function store()
    {
        $validatedData = $this->validate();
        ModelsPemiliklahan::create($validatedData);

        session()->flash('message', 'Land owner successfully added.');
        $this->resetInputFields();
        $this->emit('pemiliklahanStore');
    }

    public function update()
    {
        $validatedData = $this->validate();

        if ($this->farmer_id) {
            $pemiliklahan = ModelsPemiliklahan::find($this->farmer_id);
            $pemiliklahan->update($validatedData);

            $this->resetInputFields();
            $this->emit('pemiliklahanUpdate');
            session()->flash('message', 'Land owner successfully updated.');
        }
    }

    public function delete()
    {
        if ($this->farmer_id) {
            ModelsPemiliklahan::where('id', $this->farmer_id)->delete();
            session()->flash('message', 'Land owner successfully deleted.');
        }
    }
}
