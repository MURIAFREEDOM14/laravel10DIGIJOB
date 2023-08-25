<?php

namespace App\Http\Livewire\Manager;

use App\Models\Provinsi;
use Livewire\Component;
use App\Models\Kota;

class DisnakerLocate extends Component
{
    public $provinsis;
    public $kotas;
    public $kota = null;
    
    public function mount() {
        $this->provinsis = Provinsi::all();
        $this->kotas = collect();
    }
    public function render()
    {
        return view('livewire.manager.disnaker-locate')->extends('layouts.manager');
    }

    public function updatedKota($state)
    {
        if(!is_null($state)) {
            $this->kotas = Kota::where('provinsi_id',$state)->get();
        }
    }
}
