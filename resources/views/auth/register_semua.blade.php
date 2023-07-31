@extends('layouts.laman')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #19A7CE">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Register Pencari Kerja</p>
                        <a class="btn btn-outline-primary" href="/register/kandidat">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #FFD966">
                    <div class="card-body text-center">
                        <p style="text-transform: uppercase">Register Akademi</p>
                        <a class="btn btn-outline-primary" href="/register/akademi">Register</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #2bb930">
                    <div class="card-body text-center">
                        <p style="text-transform:uppercase">Register Perusahaan</p>
                        <a class="btn btn-outline-primary" href="/register/perusahaan">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection