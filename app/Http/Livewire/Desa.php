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
    public $nama_desa, $kecamatans_id, $luas_wilayah, $desa_id;

    protected $desas, $kecamatans;

    // ✅ Custom validation messages
    protected $messages = [
        'nama_desa.required'    => 'Barangay name is required.',
        'kecamatans_id.required' => 'Please select a district.',
        'luas_wilayah.required'  => 'Number of farmers is required.',
        'luas_wilayah.numeric'   => 'Number of farmers must be a number.',
    ];

    public function render()
    {
        // ✅ Use Eloquent relationships with eager loading
        $this->desas = ModelsDesa::with(['kecamatan', 'pemiliklahans'])
            ->where(function($query) {
                $query->where('nama_desa', 'like', '%' . $this->search . '%')
                      ->orWhereHas('kecamatan', function($q) {
                          $q->where('nama_kecamatan', 'like', '%' . $this->search . '%');
                      });
            })
            ->paginate($this->perPage);

        $this->kecamatans = Kecamatan::all();

        return view('livewire.desa', [
            'desas' => $this->desas,
            'kecamatans' => $this->kecamatans,
        ])->extends('layouts.app')->section('content');
    }

    public function resetFields()
    {
        $this->nama_desa = '';
        $this->kecamatans_id = '';
        $this->luas_wilayah = '';
        $this->desa_id = '';
    }

    public function desaId($id)
    {
        $desa = ModelsDesa::find($id);
        $this->desa_id = $id;
        $this->nama_desa = $desa->nama_desa;
        $this->kecamatans_id = $desa->kecamatans_id;
        $this->luas_wilayah = $desa->luas_wilayah;
    }

    public function store()
    {
        $this->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatans_id' => 'required|exists:kecamatans,id',
            'luas_wilayah' => 'required|numeric|min:1',
        ]);

        ModelsDesa::create([
            'nama_desa' => $this->nama_desa,
            'kecamatans_id' => $this->kecamatans_id,
            'luas_wilayah' => $this->luas_wilayah,
        ]);

        session()->flash('message', 'Barangay added successfully!');
        $this->resetFields();
    }

    public function update()
    {
        $this->validate([
            'nama_desa' => 'required|string|max:255',
            'kecamatans_id' => 'required|exists:kecamatans,id',
            'luas_wilayah' => 'required|numeric|min:1',
        ]);

        if ($this->desa_id) {
            $desa = ModelsDesa::find($this->desa_id);
            $desa->update([
                'nama_desa' => $this->nama_desa,
                'kecamatans_id' => $this->kecamatans_id,
                'luas_wilayah' => $this->luas_wilayah,
            ]);

            session()->flash('message', 'Barangay updated successfully!');
            $this->resetFields();
        }
    }

    public function destroy()
    {
        if ($this->desa_id) {
            $desa = ModelsDesa::find($this->desa_id);
            $desa->delete();
            session()->flash('message', 'Barangay deleted successfully!');
            $this->resetFields();
        }
    }
}
