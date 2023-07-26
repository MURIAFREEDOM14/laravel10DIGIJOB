@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="row">
            @if ($perusahaan->email_operator == null)
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 style="font-weight: 600">Harap Lengkapi Profil Perusahaan Terlebih dahulu</h5>
                            <a href="/isi_perusahaan_data" class="btn btn-outline-primary">Lengkapi Profil</a>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <b class="bold">Kandidat</b>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/perusahaan/list/kandidat">
                                        <div id="kandidat" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active" data-interval="30">
                                                    <img src="/gambar/default_user.png" class="d-block w-100" alt="">
                                                </div>
                                                <div class="carousel-item" data-interval="30">
                                                    <img src="/gambar/default_user.png" class="d-block w-100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <b class="bold">Akademi</b>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <div class="card-body">
                                    <a href="/perusahaan/list/akademi">
                                        <div id="akademi" class="carousel slide" data-ride="carousel">
                                            <div class="carousel-inner">
                                                <div class="carousel-item active" data-interval="2000">
                                                    <img src="/gambar/default_user.png" class="d-block w-100" alt="">
                                                </div>
                                                <div class="carousel-item" data-interval="2000">
                                                    <img src="/gambar/default_user.png" class="d-block w-100" alt="">
                                                </div>
                                                <div class="carousel-item">
                                                    <img src="/gambar/default_user.png" class="d-block w-100" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Data Kandidat
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Data Kandidat Interview
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Jadwal</th>
                                        <th>Lihat Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($interview as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->jadwal_interview}}</td>
                                        <td>
                                            <a href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">Lihat</a>
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
@endsection