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

    protected $crops;
    public function mount()
    {
        $this->crops = Infotanah::paginate($this->perPage);
    }
    public $crop_type, $ketinggian_tanah, $kelembaban_tanah, $crop_id;

    public function resetInput()
    {
        $this->crop_type = '';
        $this->ketinggian_tanah = '';
        $this->kelembaban_tanah = '';
        $this->crop_id = '';
    }
    public function render()
    {
        $this->crops = Infotanah::where('crop_type', 'like', '%' . $this->search . '%')->paginate($this->perPage);

        return view('livewire.info-sawah',[
            'crops' => $this->crops,
        ])->extends('layouts.app')->section('content');
    }

    public function store(){
        $this->validate([
            'crop_type' => 'required',
            'ketinggian_tanah' => 'required',
            'kelembaban_tanah' => 'required',
        ]);

        Infotanah::create([
            'crop_type' => $this->crop_type,
            'ketinggian' => $this->ketinggian_tanah,
            'kelembaban' => $this->kelembaban_tanah,
        ]);

        $this->resetInput();
        $this->emit('infotanahStore');
    }

    public function tanahId($id){
        $tanah = Infotanah::find($id);
        $this->crop_id = $id;
        $this->crop_type = $tanah->crop_type;
        $this->ketinggian_tanah = $tanah->ketinggian;
        $this->kelembaban_tanah = $tanah->kelembaban;
    }

    public function update(){
        $this->validate([
            'crop_type' => 'required',
            'ketinggian_tanah' => 'required',
            'kelembaban_tanah' => 'required',
        ]);

        if($this->crop_id){
            $tanah = Infotanah::find($this->crop_id);
            $tanah->update([
                'crop_type' => $this->crop_type,
                'ketinggian' => $this->ketinggian_tanah,
                'kelembaban' => $this->kelembaban_tanah,
            ]);
            $this->resetInput();
            $this->emit('infotanahUpdate');
        }
    }

    public function delete(){
        if($this->crop_id){
            Infotanah::find($this->crop_id)->delete();
            $this->emit('infotanahDelete');
        }
    }

}
