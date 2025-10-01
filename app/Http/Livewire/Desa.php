<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Kecamatan;
use Livewire\WithPagination;
use App\Models\Desa as ModelsDesa;

class Desa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;
    public $barangay_name, $town_id, $number_of_farmers, $barangay_id;

    protected $barangays, $town;

    // ✅ Custom validation messages
    protected $messages = [
        'barangay_name.required'    => 'Barangay name is required.',
        'town_id.required' => 'Please select a Municipality.',
        'number_of_farmers.required'  => 'Number of farmers is required.',
        'number_of_farmers.numeric'   => 'Number of farmers must be a number.',
    ];

    public function render()
    {
        // ✅ Use Eloquent relationships with eager loading
        $this->barangays = ModelsDesa::with(['kecamatan', 'landowners'])
            ->where(function($query) {
                $query->where('barangay_name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('kecamatan', function($q) {
                          $q->where('town_name', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate($this->perPage);

        $this->town = Kecamatan::all();

        return view('livewire.desa', [
            'barangays' => $this->barangays,
            'town' => $this->town,
        ])->extends('layouts.app')->section('content');
    }

    public function resetFields()
    {
        $this->barangay_name = '';
        $this->town_id = '';
        $this->number_of_farmers = '';
        $this->barangay_id = '';
    }

    public function desaId($id)
    {
        $desa = ModelsDesa::find($id);
        $this->barangay_id = $id;
        $this->barangay_name = $desa->barangay_name;
        $this->town_id = $desa->town_id;
        $this->number_of_farmers = $desa->number_of_farmers;
    }

    public function store()
    {
        $this->validate([
            'barangay_name' => 'required|string|max:255',
            'town_id' => 'required|exists:town,id',
            'number_of_farmers' => 'required|numeric|min:1',
        ]);

        ModelsDesa::create([
            'barangay_name' => $this->barangay_name,
            'town_id' => $this->town_id,
            'number_of_farmers' => $this->number_of_farmers,
        ]);

        session()->flash('message', 'Barangay added successfully!');
        $this->resetFields();
    }

    public function update()
    {
        $this->validate([
            'barangay_name' => 'required|string|max:255',
            'town_id' => 'required|exists:town,id',
            'number_of_farmers' => 'required|numeric|min:1',
        ]);

        if ($this->barangay_id) {
            $desa = ModelsDesa::find($this->barangay_id);
            $desa->update([
                'barangay_name' => $this->barangay_name,
                'town_id' => $this->town_id,
                'number_of_farmers' => $this->number_of_farmers,
            ]);

            session()->flash('message', 'Barangay updated successfully!');
            $this->resetFields();
        }
    }

    public function destroy()
    {
        if ($this->barangay_id) {
            $desa = ModelsDesa::find($this->barangay_id);
            $desa->delete();
            session()->flash('message', 'Barangay deleted successfully!');
            $this->resetFields();
        }
    }
}
