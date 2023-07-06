<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Perusahaan;

class CompanyLocation extends Component
{
    public $provinsis;
    public $kotas;
    public $kecamatans;
    public $kelurahans;
    public $kota = null;
    public $kecamatan = null;
    public $kelurahan = null;

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
        $perusahaan = Perusahaan::where('no_nib',$id->no_nib)->first();
        $prov = Provinsi::where('provinsi',$perusahaan->provinsi)->first('id');
        $kab = Kota::where('kota',$perusahaan->kabupaten)->first('id');
        $kel = Kelurahan::where('kelurahan',$perusahaan->kelurahan)->first('id');
        $kec = Kecamatan::where('kecamatan',$perusahaan->kecamatan)->first('id');
        return view('livewire.company-location',compact('perusahaan','prov','kab','kel','kec'))->extends('layouts.input');
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
