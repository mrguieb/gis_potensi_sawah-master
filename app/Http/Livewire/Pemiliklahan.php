<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pemiliklahan as ModelsPemiliklahan;

class Pemiliklahan extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 5;
    public $farmer_name, $farmer_barangay, $farmer_number, $farmer_id;
    protected $landowners;

    protected $rules = [
        'farmer_name'   => 'required|string|max:255',
        'farmer_barangay' => 'required|string|max:255',
        'farmer_number'  => 'required|digits_between:10,15',
        // 'farmer_email'  => 'nullable|email',
    ];

    protected $messages = [
        'farmer_name.required'   => 'Owner name is required.',
        'farmer_name.string'     => 'Owner name must be text.',
        'farmer_name.max'        => 'Owner name cannot exceed 255 characters.',

        'farmer_barangay.required' => 'Address is required.',
        'farmer_barangay.string'   => 'Address must be text.',
        'farmer_barangay.max'      => 'Address cannot exceed 255 characters.',

        'farmer_number.required'  => 'Phone number is required.',
        'farmer_number.digits_between' => 'Phone number must be between 10 and 15 digits.',

        // 'farmer_email.email'     => 'Please enter a valid email address.',
    ];

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
        $this->landowners = ModelsPemiliklahan::where('farmer_name', 'like', '%' . $this->search . '%')
            ->orWhere('farmer_barangay', 'like', '%' . $this->search . '%')
            ->orWhere('farmer_number', 'like', '%' . $this->search . '%')
            // ->orWhere('farmer_email', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.pemiliklahan', [
            'landowners' => $this->landowners,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInputFields()
    {
        $this->farmer_name   = '';
        $this->farmer_barangay = '';
        $this->farmer_number  = '';
        // $this->farmer_email  = '';
        $this->farmer_id     = '';
    }

    public function pemiliklahanId($id)
    {
        $this->farmer_id = $id;

        $pemiliklahan = ModelsPemiliklahan::find($id);
        $this->farmer_name   = $pemiliklahan->farmer_name;
        $this->farmer_barangay = $pemiliklahan->farmer_barangay;
        $this->farmer_number  = $pemiliklahan->farmer_number;
        // $this->farmer_email  = $pemiliklahan->farmer_email;
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
