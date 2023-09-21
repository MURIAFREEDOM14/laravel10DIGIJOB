<?php

namespace App\Http\Livewire\Perusahaan;

use Livewire\Component;
use App\Models\JenisPekerjaan;

class JenisPekerjaanLowongan extends Component
{
    public function render()
    {
        $jenis_pekerja = JenisPekerjaan::all();
        return view('livewire.perusahaan.jenis-pekerjaan-lowongan',compact('jenis_pekerjaan'))->extends('layouts.perusahaan');
    }
}
