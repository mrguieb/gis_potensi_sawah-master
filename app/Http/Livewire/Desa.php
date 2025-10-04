<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kecamatan;
use App\Models\Desa as ModelsDesa;

class Desa extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;
    public $barangay_name, $town_id, $barangay_id;

    protected $barangays, $town;

    // ✅ Custom validation messages
    protected $messages = [
        'barangay_name.required' => 'Barangay name is required.',
        'town_id.required'       => 'Please select a Municipality.',
    ];

    public function render()
    {
        // ✅ Get barangays with automatic farmer counts
        $this->barangays = ModelsDesa::with(['kecamatan'])
            ->withCount('landowners') // ✅ adds landowners_count column
            ->where(function ($query) {
                $query->where('barangay_name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('kecamatan', function ($q) {
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
        $this->barangay_id = '';
    }

    public function desaId($id)
    {
        $desa = ModelsDesa::find($id);
        $this->barangay_id = $id;
        $this->barangay_name = $desa->barangay_name;
        $this->town_id = $desa->town_id;
    }

    public function store()
    {
        $this->validate([
            'barangay_name' => 'required|string|max:255',
            'town_id'       => 'required|exists:town,id',
        ]);

        ModelsDesa::create([
            'barangay_name' => $this->barangay_name,
            'town_id'       => $this->town_id,
        ]);

        session()->flash('message', 'Barangay added successfully!');
        $this->resetFields();
    }

    public function update()
    {
        $this->validate([
            'barangay_name' => 'required|string|max:255',
            'town_id'       => 'required|exists:town,id',
        ]);

        if ($this->barangay_id) {
            $desa = ModelsDesa::find($this->barangay_id);
            $desa->update([
                'barangay_name' => $this->barangay_name,
                'town_id'       => $this->town_id,
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
