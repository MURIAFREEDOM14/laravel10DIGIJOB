@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
@php
    $alamat = $perusahaan->tmp_perusahaan;
    $telp = $perusahaan->no_telp_perusahaan;
    $operator = $perusahaan->email_operator;
@endphp
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 style="text-transform:uppercase;">{{$perusahaan->nama_perusahaan}}</h3>
                    </div>
                </div>
            </div>
        </div>
        @if ($alamat == null && $telp == null && $operator == null)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 style="font-weight: 600">Harap Lengkapi Profil Perusahaan Terlebih dahulu</h5>
                            <a href="/perusahaan/isi_perusahaan_data" class="btn btn-outline-primary">Lengkapi Profil</a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center" style="background-color:#31ce36; border-radius: 0% 15% 0% 15%; width:100% height:auto;">
                                <div class="avatar avatar-xxl my-3">
                                    @if ($perusahaan->logo_perusahaan == null)
                                        <img src="/gambar/default_user.png" class="avatar-img rounded-circle" alt="">
                                    @else
                                        <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Logo Perusahaan/{{$perusahaan->logo_perusahaan}}" alt="..." class="avatar-img rounded-circle">                                        
                                    @endif
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
                <div class="col-9">
                    <div class="card">
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
                        </div>
                    </div>
                    {{-- <div class="card">
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
                                                    <div class="btn">{{$item->negara}}</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>    
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <div style="text-transform:uppercase; font-weight:bold" class="text-center">Lowongan Pekerjaan</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col" style="">Judul Lowongan</th>
                                            <th scope="col" style="">Negara</th>
                                            <th scope="col" style="">Pencarian Kandidat</th>
                                            <th scope="col" style="">Lihat Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lowongan as $item)
                                            <tr class="text-center">
                                                <td>{{$item->jabatan}}</td>
                                                <td>{{$item->negara}}</td>
                                                <td>{{$item->pencarian_tmp}}</td>
                                                <td>
                                                    <a class="btn btn-outline-primary" href="/perusahaan/lihat_lowongan/{{$item->id_lowongan}}">Lihat Lowongan</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div> 
            {{-- <div class="row">
                <div class="col-12" style="background-color: white;">
                    <div class=" mb-3">
                        <hr>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="dropdown">
                                    <div class="btn-group dropright">
                                        <button type="button" class="btn btn-link btn-sm" data-toggle="dropdown" aria-expanded="false">
                                            Buat Lowongan Baru
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/perusahaan/list/lowongan/{{"dalam"}}">Dalam negeri</a>
                                            <a class="dropdown-item" href="/perusahaan/list/lowongan/{{"luar"}}">Luar negeri</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="dropdown">
                                    <div class="btn-group dropright">
                                        <button class="btn btn-link btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                            Daftar Lowongan
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="/perusahaan/list_permohonan_lowongan">Daftar Lowongan</a>
                                        </div>    
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="dropdown">
                                    <button class="btn btn-link btn-sm" type="button" data-toggle="dropdown" aria-expanded="false">
                                      Histori Pembayaran
                                    </button>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="/perusahaan/list/pembayaran">Data Pembayaran</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>
            </div> --}}
            <div class="my-5"></div>
        @endif
    </div>
@endsection