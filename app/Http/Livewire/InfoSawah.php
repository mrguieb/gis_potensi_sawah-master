<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Infotanah;
use Livewire\WithPagination;

class InfoSawah extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search;
    public $perPage = 10;
    protected $queryString = ['search' => ['except' => ''], 'perPage'];

    public $crop_type, $crop_id;

    public function resetInput()
    {
        $this->crop_type = '';
        $this->crop_id = '';
    }

    public function render()
    {
        $crops = Infotanah::where('crop_type', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage);

        return view('livewire.info-sawah', [
            'crops' => $crops,
        ])->extends('layouts.app')->section('content');
    }

    public function store()
    {
        $this->validate([
            'crop_type' => 'required',
        ]);

        Infotanah::create([
            'crop_type' => $this->crop_type,
        ]);

        $this->resetInput();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function tanahId($id)
    {
        $tanah = Infotanah::find($id);
        $this->crop_id = $id;
        $this->crop_type = $tanah->crop_type;
    }

    public function update()
    {
        $this->validate([
            'crop_type' => 'required',
        ]);

        if ($this->crop_id) {
            $tanah = Infotanah::find($this->crop_id);
            $tanah->update([
                'crop_type' => $this->crop_type,
            ]);
            $this->resetInput();
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function delete()
    {
        if ($this->crop_id) {
            Infotanah::find($this->crop_id)->delete();
            $this->dispatchBrowserEvent('close-modal');
        }
    }
}
