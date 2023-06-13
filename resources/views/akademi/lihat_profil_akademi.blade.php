@extends('layouts.akademi')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-family: poppins; text-transform:uppercase;">{{$akademi->nama_akademi}}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header" style="background-color:#FF9E27">
                        <div class="text-white text-center"><b class="" style="text-transform: uppercase;">Foto Akademi/Sekolah</b></div>
                    </div>
                    <div class="card-body text-center">
                        @if ($akademi->foto_akademi !== null)
                            <img src="/gambar/Akademi/{{$akademi->nama_akademi}}/Foto/{{$akademi->foto_akademi}}" class="img" width="180" height="180" alt="">
                        @else
                            <img src="/gambar/default_user.png" class="img" width="180" height="180" alt="">
                        @endif
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class=""><b class="bold">Email :</b></div>
                        <p><b class="bold">{{$akademi->email}}</b></p>
                        <hr>
                        <div class=""><b class="bold">No. Telp :</b></div>
                        <p><b class="bold">{{$akademi->no_telp_akademi}}</b></p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header" style="background-color: #FF9E27">
                        <div class="text-center text-white" style="text-transform:uppercase;"><b>Bio Data Sekolah</b></div>                            
                    </div>
                    <div class="card-body">
                        <div class=""><b class="bold">Nama Kepala Sekolah : {{$akademi->nama_kepala_akademi}}</b></div><hr>
                        <div class=""><b class="bold">No. NIS : {{$akademi->no_nis}}</b></div><hr>
                        <div class=""><b class="bold">No. Surat Izin : {{$akademi->no_surat_izin}}</b></div><hr>
                        <div class=""><b class="bold">Nama Operator : {{$akademi->nama_operator}}</b></div><hr>
                        <div class=""><b class="bold">Email Operator : {{$akademi->email_operator}}</b></div><hr>
                        <div class=""><b class="bold">Alamat : {{$akademi->alamat_akademi}}</b></div><hr>
                        <div class=""><b class="bold">Peta :</b></div>
                        <iframe src="" frameborder="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection