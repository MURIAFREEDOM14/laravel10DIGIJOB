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
        <div class="row mb-3">
            <div class="col-md-10 mx-auto">
                <div class="card" style="border-top: 10px solid #45CFDD">
                    <div class="card-body text-center">
                        <p style="text-transform:uppercase">Masuk Aplikasi</p>
                        <a class="btn btn-outline-primary" href="/login">Masuk</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tutorial_kandidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tutorial Daftar Pencari Kerja / Kandidat</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class="modal-body text-center">
                            <video id="video" style="width: 50%;">
                                <source class="" src="/gambar/Manager/Tutorial/Registrasi DIGIJOB UGIPORT.mp4">
                            </video>
                            <div class="text-center">
                                <button class="btn btn-success mb-2" id="play" type="button" onclick="play()">Mulai</button>
                                <button class="btn btn-warning mb-2" id="jeda" type="button" onclick="pause()">Jeda</button>
                            </div>
                        </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection