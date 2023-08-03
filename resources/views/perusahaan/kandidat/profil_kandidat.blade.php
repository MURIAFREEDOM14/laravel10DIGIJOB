@extends('layouts.perusahaan')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header rounded-top bg-primary">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center text-light"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">Profil Kandidat</b></div>
                    {{-- <h6 class="text-center text-light" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row ml-5 mt-3 mb-3"><b class="bold">PERSONAL BIO DATA</b></div>
            <div class ="row" style="line-height:20px">
                <div class="col-sm-9">
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">NAMA LENGKAP</b>
                        </div>
                        <div class="col-sm-6">
                            <b class="bold">: {{$kandidat->nama}}</b>
                        </div>        
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">JENIS KELAMIN</b>
                        </div>
                        <div class="col-sm-5">: 
                            @if ($kandidat->jenis_kelamin == "M")
                                <b class="bold">Laki-Laki</b>
                            @else
                                <b class="bold">Perempuan</b>
                            @endif
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                        </div>
                        <div class="col-sm-5">
                            <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">Usia</b>
                        </div>
                        <div class="col-sm-5">
                            <b class="bold">: {{$usia}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">Tinggi / Berat Badan</b>
                        </div>
                        <div class="col-sm-6">
                            <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">Pendidikan</b>
                        </div>
                        <div class="col-sm-5">
                            <b class="bold">: {{$kandidat->pendidikan}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-sm-4">
                            <b class="bold">Asal</b>
                        </div>
                        <div class="col-sm-6">
                            <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                        </div>
                    </div>                                
                </div>
                <div class="col-md-3">
                    <div class="float-right mt--5">
                        @if ($kandidat->foto_set_badan !== null)
                            <img class="avatar-img rounded-circle" style="border:2px solid black" src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="130px" height="150px" alt="">
                        @else
                            <img class="avatar-img rounded-circle" style="border:2px solid black" src="/gambar/default_user.png" width="120px" height="150px" alt="">
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt-5" style="line-height:15px">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <b class="bold">Pengalaman Kerja</b>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-head-bg-info table-bordered-bd-info text-center">
                                            <thead>
                                            <tr class="" style="font-size:10px;">
                                                <th style="width: 1px;"><b class="bold">No</b></th>
                                                <th style="width: 1px;"><b class="bold">Nama Perusahaan</b></th>
                                                <th style="width: 1px;"><b class="bold">Alamat Perusahaan</b></th>
                                                <th style="width: 1px;"><b class="bold">Jabatan</b></th>
                                                <th><b class="bold">Periode</b></th>
                                                <th style="width: 1px"><b class="bold">Alasan Berhenti</b></th>
                                                <th><b class="bold">Pratinjau Video</b></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengalaman_kerja_kandidat as $item)
                                                    <tr>
                                                        <th><b class="bold">{{$loop->iteration}}</b></th>
                                                        <td><b class="bold">{{$item->nama_perusahaan}}</b></td>
                                                        <td><b class="bold">{{$item->alamat_perusahaan}}</b></td>
                                                        <td><b class="bold">{{$item->jabatan}}</b></td>
                                                        <td><b class="bold">{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</b></td>
                                                        <td><b class="bold">{{$item->alasan_berhenti}}</b></td>
                                                        <td>
                                                            <a href="/perusahaan/galeri_kandidat/{{$item->pengalaman_kerja_id}}" class="btn btn-primary">Lihat Galeri</a>
                                                        </td>                                                    
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-primary">Kembali</a>
        </div>        
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Rekomendasi untuk anda
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($semua_kandidat as $item)
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="float-left">{{$item->nama}}</div>
                                        <div class="float-right">{{$item->usia}}thn</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="avatar-sm float-left">
                                            @if ($item->foto_4x6 == null)
                                                <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">
                                            @else
                                                <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                                
                                            @endif
                                        </div>
                                        <a href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}" class="btn btn-primary float-right">Lihat Profil</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>        
@endsection