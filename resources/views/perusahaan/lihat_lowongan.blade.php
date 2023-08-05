@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
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
                        <label for="" class="">Pendidikan Minimal</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pendidikan}}</b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->usia !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Syarat Usia</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$lowongan->usia}} tahun Sampai {{$lowongan->usia}} tahun</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Pengalaman Kerja</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$lowongan->pengalaman_kerja}}</b></div>
                    </div>
                </div>
                <hr>
                @if ($lowongan->tinggi !== null)
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-3">
                            <b class="bold">: {{$lowongan->tinggi}}</b>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($lowongan->usia !== null && $lowongan->usia !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Berat Badan Minimal</label>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">: {{$lowongan->berat}}</b></div>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Berat Badan Maksimal</label>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">: {{$lowongan->berat}}</b></div>                            
                        </div>
                    </div>
                    <hr>                
                @endif
                @if ($lowongan->pencarian_tmp !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Area Rekrut Pekerja</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$lowongan->pencarian_tmp}}</b></div>
                        </div>
                    </div>
                    <hr>    
                @endif
                <div  class="row">
                    <div class="col-md-3">
                        <h5><b class="bold">Fasilitas</b></h5>
                    </div>
                </div>
                <hr>
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
                <div  class="row">
                    <div class="col-md-3">
                        <label for="" class="">Kode Undangan Perusahaan</label>
                    </div>
                    <div class="col-md-8">
                        <div class=""><b class="bold">: {{$perusahaan->referral_code}}</b></div>
                    </div>
                </div>
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
                <a class="btn btn-danger float-right" href="/perusahaan/hapus_lowongan/{{$lowongan->id_lowongan}}" onclick="hapusData(event)">Hapus</a>
                <a class="btn btn-warning float-right mx-2" href="/perusahaan/edit_lowongan/{{$lowongan->id_lowongan}}">Edit</a>
                <a href="/perusahaan/list/lowongan" class="btn btn-danger"><- Kembali</a>
            </div>
        </div>
    </div>
@endsection