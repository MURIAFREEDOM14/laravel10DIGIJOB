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
                        <label for="" class="">Negara</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->negara)}}</b></div>
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
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Gambar</label>
                    </div>
                    <div class="col-md-8">
                        <div class="">
                            @if ($lowongan->gambar_lowongan !== null)
                                <img src="/gambar/Perusahaan/{{$perusahaan->nama}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" width="150" height="150" class="mb-2" alt="">                            
                            @else

                            @endif
                        </div>
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
                        <label for="" class="">Lokasi Pencarian Kandidat</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pencarian_tmp}}</b></div>
                    </div>
                </div>
                <hr>
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Tanggal Tutup Lowongan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->ttp_lowongan))}}</b></div>
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
                @if ($lowongan->jabatan == $jabatan)
                    <a href="/permohonan_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-primary float-right" onclick="return confirm('apakah anda ingin menganti lamaran sebelumnya?')">Melamar</a>                    
                @else
                    <a href="/permohonan_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-primary float-right">Melamar</a>
                @endif                
            </div>
        </div>
    </div>
@endsection