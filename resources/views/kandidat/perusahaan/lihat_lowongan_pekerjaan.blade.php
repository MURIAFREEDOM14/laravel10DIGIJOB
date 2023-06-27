@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Informasi Lowongan</b></h4>
            </div>
            <div class="card-body">
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Tema Lowongan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->nama_lowongan)}}</b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Isi Lowongan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->isi)}}</b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Jabatan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->jabatan)}}</b></div>
                    </div>
                </div>
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
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Usia</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: 
                            @if ($lowongan->usia == null)
                                Tidak ada batasan
                            @else    
                                {{$lowongan->usia}}
                            @endif
                        </b></div>
                    </div>
                </div>
                <hr>
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
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Berat</label>
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
                    <div class="col-md-3">
                        <label for="">Tinggi</label>
                    </div>
                    <div class="col-md-3"><b class="bold">: 
                        @if ($lowongan->tinggi == null)
                            Tidak ada batasan
                        @else
                            {{$lowongan->tinggi}}
                        @endif
                    </b></div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Kriteria Lokasi</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pencarian_tmp}}</b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Kode Undangan Perusahaan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$perusahaan->referral_code}}</b></div>
                    </div>
                </div>
                <hr>
                <a href="/kandidat" class="btn btn-danger">Kembali</a>
                <a href="/permohonan_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-primary float-right">Terima Lowongan</a>
            </div>
        </div>
    </div>
@endsection