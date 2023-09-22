<?php

namespace App\Http\Livewire\Akademi;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\Kandidat;
use illuminate\Support\Facades\Auth;
use App\Models\Akademi;

class LocationPermission extends Component
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
        $user = Auth::user();
        $akademi = Akademi::where('referral_code',$user->referral_code)->first();
        $kandidat = Kandidat::where('id_akademi',$akademi->id_akademi)->first();
        return view('livewire.akademi.location-permission')->extends('layouts.input');
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
