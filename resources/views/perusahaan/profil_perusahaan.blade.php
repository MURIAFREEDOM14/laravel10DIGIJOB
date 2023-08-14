@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
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
                        <div class="card-body">
                            <div class="">
                                <div class="text-center" style="background-color:#31ce36;">
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
                </div>
            </div>
        </div>
    </div>
@endsection