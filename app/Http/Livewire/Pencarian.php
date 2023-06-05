<?php

namespace App\Http\Livewire;

use App\Models\Perusahaan;
use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kota;
use Illuminate\Support\Facades\Auth;

class Pencarian extends Component
{
    public $provinsis;
    public $kotas;
    public $kota = NULL;

    public function mount()
    {
        $this->provinsis = Provinsi::all();
        $this->kotas = collect();
    }
    public function render()
    {
        $id = Auth::user();
        $kandidat = Perusahaan::where('referral_code',$id->referral_code)->first();
        $prov = Provinsi::where('provinsi',$kandidat->provinsi)->first('id');
        $kab = Kota::where('kota',$kandidat->kabupaten)->first('id');
        return view('livewire.pencarian',compact('kandidat','prov','kab'))->extends('layouts.perusahaan');
    }

    public function updatedkota($state)
    {
        if (!is_null($state)) {
            $this->kotas = Kota::where('provinsi_id', $state)->get();
        }
    }
}
