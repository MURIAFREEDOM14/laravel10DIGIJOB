@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 style="font-family: poppins; text-transform:uppercase;">{{$perusahaan->nama_perusahaan}}</h3>
                </div>
            </div>    
        </div>
    </div>
    <div class="card">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header" style="background-color:#31ce36">
                        <div class="text-white text-center"><b class="" style="text-transform: uppercase;">Foto Perusahaan</b></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col text-center" style="background-color: #31ce36">
                                <div class="avatar avatar-xxl my-3">
                                    @if ($perusahaan->logo_perusahaan == null)
                                        <img src="/gambar/default_user.png" class="avatar-img rounded-circle img2" alt="">
                                    @else
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="..." class="avatar-img rounded-circle img2">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <b class="bold">Email Perusahaan</b>
                        <p><b class="">{{$perusahaan->email_perusahaan}}</b></p>
                        <hr>
                        <b class="bold">No. Telp Perusahaan</b>
                        <p><b class="bold">{{$perusahaan->no_telp_perusahaan}}</b></p>
                        <hr>
                        <b class="bold">Alamat Perusahaan</b>
                        <p><b class="bold">{{$perusahaan->alamat_perusahaan}}</b></p>
                        <hr>
                        <b class="bold">Nama Operator</b>
                        <p><b class="bold">{{$perusahaan->nama_operator}}</b></p>
                        <hr>
                        <b class="bold">No. Telp Operator</b>
                        <p><b class="bold">{{$perusahaan->no_telp_operator}}</b></p>
                        <hr>
                        <b class="bold">Email Operator</b>
                        <p><b class="">{{$perusahaan->email_operator}}</b></p>
                        <hr>
                    </div>
                </div>
                @if ($kandidat->id_perusahaan == $perusahaan->id_perusahaan)
                    <div class="card">
                        <div class="card-body">
                            <div class="">Anda sekarang Tergabung dalam Perusahaan Ini</div>
                            <hr>
                            <a href="/keluar_perusahaan/{{$perusahaan->id_perusahaan}}" class="btn btn-outline-danger mx-auto" onclick="return confirm('apakah anda yakin ingin keluar perusahaan ini?')">Keluar Perusahaan</a>
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header" style="background-color: #31ce36">
                                <div class="text-center text-white" style="text-transform:uppercase;"><b>Bio Data Perusahaan</b></div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="col-12">
                                        <b class="bold">Nama Perusahaan : {{$perusahaan->nama_perusahaan}}</b>
                                        <hr>
                                        <b class="bold">No. NIB : {{$perusahaan->no_nib}}</b>
                                        <hr>
                                        <b class="bold">Nama Pemimpin : {{$perusahaan->nama_pemimpin}}</b>
                                        <hr>
                                        <b class="bold">Company Profile :</b>
                                        <p><b class="bold">{{$perusahaan->company_profile}}</b></p>
                                        <hr>
                                        <b class="bold">Penempatan Kerja :</b>
                                        <p><b class="bold">{{$perusahaan->penempatan_kerja}}</b></p>
                                        <hr>
                                        <b class="bold">Negara Tujuan :</b>
                                        <div class="row">
                                        @foreach ($penempatan as $item)
                                        <div class="col-4 text-center">
                                            <a class="" href="/lihat/perusahaan/pekerjaan/{{$item->negara_id}}/{{$perusahaan->nama_perusahaan}}">
                                                <div class="card">
                                                    <div class="card-body btn btn-outline-success">
                                                        <div class="btn">{{$item->nama_negara}}</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>    
                                        @endforeach
                                        </div>
                                        <hr>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <b class="bold">List Lowongan Pekerjaan Perusahaan</b>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th scope="col" style="">Nama Jabatan</th>
                                                                <th scope="col">Negara</th>
                                                                <th scope="col" style="">Pencarian Kandidat</th>
                                                                <th scope="col" style="width: 0px;">Lihat Detail</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($lowongan as $item)
                                                                <tr class="text-center">
                                                                    <td>{{$item->jabatan}}</td>
                                                                    <td>{{$item->negara}}</td>
                                                                    <td>{{$item->pencarian_tmp}}</td>
                                                                    <td>
                                                                        <a class="btn btn-outline-primary" href="/lihat_lowongan_pekerjaan/{{$item->id_lowongan}}">Lihat Lowongan</a>
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
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection