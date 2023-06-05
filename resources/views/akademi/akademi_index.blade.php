@extends('layouts.akademi')
@section('content')
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ProyekPortal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h3 style="font-family: poppins; text-transform:uppercase;">{{$akademi->nama}}</h3>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header" style="background-color:#FF9E27">
                            <div class="text-white text-center"><b class="" style="text-transform: uppercase;">Foto Akademi/Sekolah</b></div>
                        </div>
                        <div class="card-body text-center">
                            @if ($akademi->foto_akademi !== null)
                                <img src="/gambar/Akademi/Foto/{{$akademi->foto_akademi}}" class="img" width="180" height="200" alt="">
                            @else
                                <img src="/gambar/default_user.png" class="img" width="180" height="200" alt="">
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
                            <a href="/isi_akademi_data" class="btn text-white" style="background-color: #FF9E27">Edit Data Akademi</a>
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>
@endsection