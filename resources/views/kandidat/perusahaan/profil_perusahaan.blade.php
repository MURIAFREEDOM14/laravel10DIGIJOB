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
                        @if (auth()->user()->verify_confirmed !== null)
                            <span class="badge badge-pill badge-info">Verified</span>
                        @endif
                        @if ($perusahaan->email_operator !== null)
                            <span class="badge badge-pill badge-success">Profile</span>
                        @endif
                    </div>
                </div>
                @if ($kandidat->id_perusahaan == $perusahaan->id_perusahaan && $kandidat->stat_pemilik !== "diambil")
                    <div class="card">
                        <div class="card-body">
                            <div class="">Permohonan Lowongan sudah dikirimkan</div>
                            <hr>
                            <a href="/keluar_perusahaan/{{$perusahaan->id_perusahaan}}" class="btn btn-outline-danger mx-auto" onclick="cancelLowongan(event)">Batalkan Lowongan</a>
                        </div>
                    </div>
                @elseif($kandidat->id_perusahaan == $perusahaan->id_perusahaan && $kandidat->stat_pemilik == "diambil")
                    <div class="card">
                        <div class="card-body">
                            <div class="">Keluar Perusahaan</div>
                            <hr>
                            <a href="/keluar_perusahaan/{{$perusahaan->id_perusahaan}}" class="btn btn-outline-danger mx-auto" onclick="outPerusahaan(event)">Permohonan Keluar</a>
                        </div>
                    </div>
                @else    
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
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <b class="bold">Nama Perusahaan : {{$perusahaan->nama_perusahaan}}</b>
                                        <hr>
                                        <b class="bold">Alamat Perusahaan : {{$perusahaan->kota}}</b>
                                        <p><b class="bold"></b></p>
                                        <hr>
                                        <b class="bold">Nama Pemimpin : {{$perusahaan->nama_pemimpin}}</b>
                                        <hr>
                                        <b class="bold">Company Profile : {{$perusahaan->company_profile}}</b>
                                        <p><b class="bold"></b></p>
                                        <hr>
                                        <b class="bold">Penempatan Kerja : {{$perusahaan->penempatan_kerja}}</b>
                                        <p><b class="bold"></b></p>
                                        <hr>
                                    </div>
                                </div>
                                {{-- <div class="row">
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
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color:#31ce36">
                        <div class="text-center text-white" style="text-transform:uppercase;"><b>Negara Tujuan</b></div>
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #31ce36">
                        <div class="text-center text-white" style="text-transform:uppercase;"><b>List Lowongan Pekerjaan Perusahaan</b></div>
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
@endsection