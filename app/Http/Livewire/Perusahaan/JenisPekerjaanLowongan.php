<?php

namespace App\Http\Livewire\Perusahaan;

use Livewire\Component;
use App\Models\JenisPekerjaan;

class JenisPekerjaanLowongan extends Component
{
    public $jenis_pekerjaan;

    public function mount()
    {
        $this->jenis_pekerjaan = JenisPekerjaan::all();
    }

    public function render()
    {
        return view('livewire.perusahaan.jenis-pekerjaan-lowongan')->extends('layouts.perusahaan');
    }
}
