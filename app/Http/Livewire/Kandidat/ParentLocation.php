<?php

namespace App\Http\Livewire\Kandidat;

use App\Models\Kandidat;
use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Auth;

class ParentLocation extends Component
{
    public $provinsis;
    public $kotas;
    public $kecamatans;
    public $kelurahans;
    public $kota = NULL;
    public $kecamatan = NULL;
    public $kelurahan = NULL;

    public function mount()
    {
        $this->provinsis = Provinsi::all();
        $this->kotas = collect();
        $this->kecamatans = collect();
        $this->kelurahans = collect();
    }
    public function render()
    {
        $id = Auth::user();
        $kandidat = Kandidat::where('referral_code',$id->referral_code)->first();
        $prov = Provinsi::where('provinsi',$kandidat->provinsi)->first('id');
        $kab = Kota::where('kota',$kandidat->kabupaten)->first('id');
        $kel = Kelurahan::where('kelurahan',$kandidat->kelurahan)->first('id');
        $kec = Kecamatan::where('kecamatan',$kandidat->kecamatan)->first('id');
        return view('livewire.kandidat.parent-location',compact('kandidat','prov','kab','kel','kec'))->extends('layouts.input');
    }

    public function updatedkota($state)
    {
        if (!is_null($state)) {
            $this->kotas = Kota::where('provinsi_id', $state)->get();
        }
    }
    public function updatedkecamatan($kota_id)
    {
        if (!is_null($kota_id)) {
            $this->kecamatans = Kecamatan::where('kota_id', $kota_id)->get();
        }
    }
    public function updatedkelurahan($kecamatan_id)
    {
        if (!is_null($kecamatan_id)) {
            $this->kelurahans = Kelurahan::where('kecamatan_id', $kecamatan_id)->get();
        }
    }
}
