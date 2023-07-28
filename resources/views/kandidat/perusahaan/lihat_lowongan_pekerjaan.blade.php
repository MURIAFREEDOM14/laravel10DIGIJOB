@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Informasi Lowongan</b></h4>
            </div>
            <div class="card-body">
                @if ($lowongan->lvl_pekerjaan !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Tingkatan Pekerja</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($lowongan->lvl_pekerjaan)}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Spesifikasi Pekerjaan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->jabatan)}}</b></div>
                    </div>
                </div>
                <hr>
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
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Penempatan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{($lowongan->negara)}}</b></div>
                    </div>
                </div>
                @if ($lowongan->gambar_lowongan !== null)
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Gambar</label>
                        </div>
                        <div class="col-md-4">
                            <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" width="250" height="250" alt="" class="img">                            
                        </div>
                    </div>    
                @endif
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
                <a href="/kandidat" class="btn btn-danger">Kembali</a>
                @if(!$interview)
                    @if ($lowongan->jabatan == $jabatan)
                        <a href="/permohonan_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-primary float-right" onclick="return confirm('apakah anda ingin menganti lamaran sebelumnya?')">Melamar</a>                    
                    @else
                        <a href="/permohonan_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-primary float-right">Melamar</a>
                    @endif
                @endif              
            </div>
        </div>
    </div>
@endsection