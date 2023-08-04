@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        {{-- <div class="card">
            <div class="card-header">
                <h5 style="font-weight: bold">Lihat Lowongan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Negara Tujuan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->negara}}</b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Jabatan</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: {{$lowongan->jabatan}}</b></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="" class="">Gambar</label>
                    </div>
                    <div class="col-md-8">
                        @if ($lowongan->gambar_lowongan !== null)
                            <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" width="250" height="250" alt="" class="img">
                        @else
                            <img src="/gambar/default_user.png" width="250" height="250" alt="" class="img">
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <hr>
                        <h5 style="font-weight:bold">Persyaratan</h5>
                        <hr>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->jenis_kelamin == "M")
                                Laki-laki
                            @elseif($lowongan->jenis_kelamin == "F")
                                Perempuan
                            @else
                                Laki-laki & Perempuan
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Pendidikan</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: {{$lowongan->pendidikan}}</b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Usia</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->usia == null)
                                Tidak ada batasan
                            @else
                                {{$lowongan->usia}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Pengalaman Bekerja</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->pengalaman_kerja == null)
                                Tidak ada batasan
                            @else
                                {{$lowongan->pengalaman_kerja}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Berat Badan</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->berat == null)
                                Tidak ada batasan
                            @else
                                {{$lowongan->berat}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="" class="">Tinggi Badan</label>
                    </div>
                    <div class="col-md-4">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->tinggi == null)
                                Tidak ada batasan
                            @else
                                {{$lowongan->tinggi}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">   
                    <div class="col-4">
                        <label>Kriteria Lokasi</label>
                    </div>  
                    <div class="col-8">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->pencarian_tmp == null)
                                Se-Indonesia
                            @else
                                {{$lowongan->pencarian_tmp}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="" class="">Tanggal Tutup Lowongan</label>
                    </div>
                    <div class="col-8">
                        <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->ttp_lowongan))}}</b></div>
                    </div>
                </div>
                <hr>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="" class="">Kode Undangan</label>
                    </div>
                    <div class="col-8">
                        <div class=""><b class="bold">: {{$perusahaan->referral_code}}</b></div>
                    </div>
                </div>
                <hr>
                <a class="btn btn-danger" href="/perusahaan/list/lowongan">Kembali</a>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Informasi Lowongan</b></h4>
            </div>
            <div class="card-body">
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Penempatan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->negara)}}</b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Judul Pekerjaan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->jabatan)}}</b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->lvl_pekerjaan !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Jenis Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($lowongan->lvl_pekerjaan)}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                @if ($lowongan->isi !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Deskripsi Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($lowongan->isi)}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                @if ($lowongan->gambar_lowongan !== null)
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Gambar</label>
                        </div>
                        <div class="col-md-4">
                            <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" width="250" height="250" alt="" class="img">                            
                        </div>
                    </div>    
                    <hr>
                @endif
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <h5><b class="bold">Persyaratan</b></h5>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->jenis_kelamin == "M")
                                Laki-laki    
                            @elseif($lowongan->jenis_kelamin == "F")
                                Perempuan
                            @else
                                Laki-laki & Perempuan
                            @endif
                        </b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Pendidikan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pendidikan}}</b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->usia !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Usia</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$lowongan->usia}} Sampai {{$lowongan->usia}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Pengalaman Kerja</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->pengalaman_kerja == null)
                                Tidak ada batasan
                            @else    
                                {{$lowongan->pengalaman_kerja}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->tinggi !== null)
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Syarat Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-3">
                            <b class="bold">: {{$lowongan->tinggi}}</b>
                        </div>
                    </div>
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Syarat Berat Badan minimal</label>
                    </div>
                    <div class="col-md-3">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->berat == null)
                                Tidak ada batasan
                            @else
                                {{$lowongan->berat}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->mata_uang !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Mata Uang</label>
                        </div>
                        <div class="col-md-4">
                            <div class=""><b class="bold">: {{($lowongan->mata_uang)}}</b></div>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Informasi Gaji</label>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">Gaji Minimum: {{($lowongan->gaji_minimum)}}</b></div>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">Gaji Maksimum: {{($lowongan->gaji_maksimum)}}</b></div>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($lowongan->benefit !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Benefit Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($lowongan->benefit)}}
                            </b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                
                
                <hr>
                @if ($lowongan->ttp_lowongan !== null)
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->ttp_lowongan))}}</b></div>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($lowongan->tgl_interview !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Tanggal Interview</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->tgl_interview))}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Kode Undangan Perusahaan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$perusahaan->referral_code}}</b></div>
                    </div>
                </div>
                
                
                
                
                
                
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Lokasi Pencarian Kandidat</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pencarian_tmp}}</b></div>
                    </div>
                </div>
                <hr>
                <a href="/kandidat" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
@endsection