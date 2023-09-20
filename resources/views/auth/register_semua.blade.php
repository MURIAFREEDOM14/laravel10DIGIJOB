@extends('layouts.laman')
@section('content')
    <div class="container">
        <!-- Route(view) LamanController => '/register' -->
        <div class="row mb-3">
            <div class="col-md-5 mx-auto">
                <div class="card" style="background-image: linear-gradient(to top, white, white, rgb(190, 210, 255), rgb(0, 100, 255)); border-radius:25px; padding:20px; width:100%; height:auto;">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Pencari Kerja / Kandidat</p>
                        <a class="btn btn-outline-primary" style="text-transform: uppercase;" href="/register/kandidat">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5 mx-auto">
                <div class="card" style="background-image: linear-gradient(to top, white, white, rgb(255, 254, 196), rgb(241, 201, 59)); border-radius:25px; padding:20px; width:100%; height:auto;">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Akademi</p>
                        <a class="btn btn-outline-primary" style="text-transform: uppercase;" href="/register/akademi">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5 mx-auto">
                <div class="card" style="background-image: linear-gradient(to top, white, white, rgb(208, 231, 210), rgb(23, 163, 10)); border-radius:25px; padding:20px; width:100%; height:auto;">
                    <div class="card-body text-center">
                        <p style="text-transform:uppercase">Perusahaan</p>
                        <a class="btn btn-outline-primary" style="text-transform:uppercase;" href="/register/perusahaan">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection