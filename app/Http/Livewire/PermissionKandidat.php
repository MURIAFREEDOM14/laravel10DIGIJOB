<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PermissionKandidat extends Component
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
        $auth = Auth::user();
        $manager = User::where('referral_code',$auth->referral_code)->first();
        $prov = Provinsi::where('provinsi',$manager->provinsi)->first('id');
        $kab = Kota::where('kota',$manager->kabupaten)->first('id');
        $kel = Kelurahan::where('kelurahan',$manager->kelurahan)->first('id');
        $kec = Kecamatan::where('kecamatan',$manager->kecamatan)->first('id');
        return view('livewire.permission-kandidat',compact('manager','prov','kab','kel','kec'))->extends('layouts.manager');
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
