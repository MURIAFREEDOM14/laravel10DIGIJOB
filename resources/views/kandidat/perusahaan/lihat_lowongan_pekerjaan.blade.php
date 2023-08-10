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
                            <label for="">Flyer</label>
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
                @if ($lowongan->usia_min !== null && $lowongan->usia_maks !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Syarat Usia</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{$lowongan->usia_min}} tahun Sampai {{$lowongan->usia_maks}} tahun</b></div>
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
                            <b class="bold">: {{$lowongan->tinggi}} Cm</b>
                        </div>
                    </div>
                    <hr>
                @endif
                @if ($lowongan->berat_min !== null && $lowongan->berat_maks !== null)
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Berat Badan Minimal</label>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">: {{$lowongan->berat_min}} Kg</b></div>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Berat Badan Maksimal</label>
                        </div>
                        <div class="col-md-3">
                            <div class=""><b class="bold">: {{$lowongan->berat_maks}} Kg</b></div>                            
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
                        <div class="col-md-12">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"></li>
                                <li class="list-group-item"></li>
                                <li class="list-group-item"></li>
                                <li class="list-group-item"></li>
                                <li class="list-group-item"></li>
                            </ul>
                        </div>
                    </div>
                    <hr>    
                @endif
                @if ($lowongan->mata_uang !== null && $lowongan->gaji_minimum !== null && $lowongan->gaji_maksimum !== null)
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
                @if ($lowongan->tgl_interview_awal !== null && $lowongan->tgl_interview_akhir !== null)
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="">Tanggal Interview Awal</label>
                        </div>
                        <div class="col-md-3">
                            <div class="">{{$lowongan->tgl_interview_awal}}</div>
                            <hr>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Tanggal Interview Akhir</label>
                        </div>
                        <div class="col-md-3">
                            <div class="">{{$lowongan->tgl_interview_akhir}}</div>
                            <hr>
                        </div>
                    </div>
                @endif
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