@extends('layouts.laman')
@section('content')
    <div class="container">
        <!-- Route(view) LamanController => '/register' -->
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #19A7CE">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Pencari Kerja / Kandidat</p>
                        <a class="btn btn-outline-primary" href="/register/kandidat">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #FFD966">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Akademi</p>
                        <a class="btn btn-outline-primary" href="/register/akademi">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #2bb930">
                    <div class="card-body text-center">
                        <p style="text-transform:uppercase">Perusahaan</p>
                        <a class="btn btn-outline-primary" href="/register/perusahaan">Registrasi</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #45CFDD">
                    <div class="card-body text-center">
                        <a class="btn btn-outline-primary" href="/login">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection