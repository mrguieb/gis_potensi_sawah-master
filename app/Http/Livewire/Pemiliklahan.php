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
    public $nama_pemiliklahan, $alamat_pemiliklahan, $no_hp_pemiliklahan, $email_pemiliklahan, $pemiliklahan_id;
    protected $pemiliklahans;

    protected $rules = [
        'nama_pemiliklahan'   => 'required|string|max:255',
        'alamat_pemiliklahan' => 'required|string|max:255',
        'no_hp_pemiliklahan'  => 'required|digits_between:10,15',
        'email_pemiliklahan'  => 'nullable|email',
    ];

    protected $messages = [
        'nama_pemiliklahan.required'   => 'Owner name is required.',
        'nama_pemiliklahan.string'     => 'Owner name must be text.',
        'nama_pemiliklahan.max'        => 'Owner name cannot exceed 255 characters.',

        'alamat_pemiliklahan.required' => 'Address is required.',
        'alamat_pemiliklahan.string'   => 'Address must be text.',
        'alamat_pemiliklahan.max'      => 'Address cannot exceed 255 characters.',

        'no_hp_pemiliklahan.required'  => 'Phone number is required.',
        'no_hp_pemiliklahan.digits_between' => 'Phone number must be between 10 and 15 digits.',

        'email_pemiliklahan.email'     => 'Please enter a valid email address.',
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
        $this->pemiliklahans = ModelsPemiliklahan::where('nama_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('alamat_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('no_hp_pemiliklahan', 'like', '%' . $this->search . '%')
            ->orWhere('email_pemiliklahan', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.pemiliklahan', [
            'pemiliklahans' => $this->pemiliklahans,
        ])->extends('layouts.app')->section('content');
    }

    public function resetInputFields()
    {
        $this->nama_pemiliklahan   = '';
        $this->alamat_pemiliklahan = '';
        $this->no_hp_pemiliklahan  = '';
        $this->email_pemiliklahan  = '';
        $this->pemiliklahan_id     = '';
    }

    public function pemiliklahanId($id)
    {
        $this->pemiliklahan_id = $id;

        $pemiliklahan = ModelsPemiliklahan::find($id);
        $this->nama_pemiliklahan   = $pemiliklahan->nama_pemiliklahan;
        $this->alamat_pemiliklahan = $pemiliklahan->alamat_pemiliklahan;
        $this->no_hp_pemiliklahan  = $pemiliklahan->no_hp_pemiliklahan;
        $this->email_pemiliklahan  = $pemiliklahan->email_pemiliklahan;
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

        if ($this->pemiliklahan_id) {
            $pemiliklahan = ModelsPemiliklahan::find($this->pemiliklahan_id);
            $pemiliklahan->update($validatedData);

            $this->resetInputFields();
            $this->emit('pemiliklahanUpdate');
            session()->flash('message', 'Land owner successfully updated.');
        }
    }

    public function delete()
    {
        if ($this->pemiliklahan_id) {
            ModelsPemiliklahan::where('id', $this->pemiliklahan_id)->delete();
            session()->flash('message', 'Land owner successfully deleted.');
        }
    }
}
