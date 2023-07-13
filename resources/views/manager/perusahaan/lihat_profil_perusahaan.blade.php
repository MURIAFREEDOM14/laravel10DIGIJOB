@extends('layouts.manager')
@section('content')
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
                    <div class="card-header" style="background-color: #31ce36">
                        <div class="text-white text-center"><b class="" style="text-transform: uppercase;">Foto Perusahaan</b></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 text-center" style="background-color:#31ce36">
                                <div class="avatar avatar-xxl my-3">
                                    @if ($perusahaan->logo_perusahaan == null)
                                        <img src="/gambar/default_user.png" class="avatar-img rounded-circle" alt="">
                                    @else
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="..." class="avatar-img rounded-circle">                                        
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr>
                        <b class="bold">Email Perusahaan</b>
                        <p><b class="bold">{{$perusahaan->email_perusahaan}}</b></p>
                        <hr>
                        <b class="bold">No. Telp Perusahaan</b>
                        <p><b class="bold">{{$perusahaan->no_telp_perusahaan}}</b></p>
                        <hr>
                        <b class="bold">Alamat Perusahaan</b>
                        <p><b class="bold">{{$perusahaan->kota}}</b></p>
                        <hr>
                        <b class="bold">Nama Operator</b>
                        <p><b class="bold">{{$perusahaan->nama_operator}}</b></p>
                        <hr>
                        <b class="bold">No. Telp Operator</b>
                        <p><b class="bold">{{$perusahaan->no_telp_operator}}</b></p>
                        <hr>
                        <b class="bold">Email Operator</b>
                        <p><b class="bold">{{$perusahaan->email_operator}}</b></p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header" style="background-color: #31ce36">
                        <div class="text-center text-white" style="text-transform:uppercase;"><b>Bio Data Perusahaan</b></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <b class="bold">Penempatan Negara</b>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th scope="col" style="">Negara Tujuan</th>
                                                        <th scope="col" style="">Jabatan</th>
                                                        <th scope="col" style="">Lokasi Perusahaan</th>
                                                        <th scope="col" style="width: 0px;">Lihat Detail</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($lowongan as $item)
                                                        <tr class="text-center">
                                                            <td>{{$item->negara}}</td>
                                                            <td>{{$item->jabatan}}</td>
                                                            <td>{{$item->pencarian_tmp}}</td>
                                                            <td>
                                                                <a class="btn btn-outline-primary" href="/manager/perusahaan/lihat_lowongan/{{$item->id_lowongan}}">Lihat Lowongan</a>
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
    <div class="card">
        <div class="card-header">
            <b class="bold">Kandidat Dalam Perusahaan</b>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <b class="bold">Kandidat sudah diterima</b>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <b class="bold">Menunggu Konfirmasi Perusahaan</b>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kandidat</th>
                                    <th>No. Telp</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidat as $item)
                                    @if ($item->stat_pemilik == "diambil")
                                        <tr>
                                            <td>{{$loop->iteration}}</td>                                    
                                            <td>{{$item->nama}}</td>                                    
                                            <td>{{$item->no_telp}}</td>                                    
                                            <td>
                                                <a class="btn btn-primary" href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}"><i class="fas fa-eye"></i></a>
                                            </td>                                    
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-6">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Kandidat</th>
                                    <th>No. Telp</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kandidat as $item)
                                    @if ($item->stat_pemilik !== "diambil")
                                        <tr>
                                            <td>{{$loop->iteration}}</td>                                    
                                            <td>{{$item->nama}}</td>                                    
                                            <td>{{$item->no_telp}}</td>                                    
                                            <td>
                                                <a class="btn btn-primary" href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}"><i class="fas fa-eye"></i></a>
                                            </td>                                    
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection