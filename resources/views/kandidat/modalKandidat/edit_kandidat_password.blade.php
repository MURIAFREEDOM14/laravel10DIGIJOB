@extends('layouts.input')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="row">
            <h4 class="text-center">Profil Biodata</h4>
            @if ($password == null)
                <!-- form(post) KandidatController => edit_password_confirm -->    
                <form action="/edit_password_confirm" method="POST">
                    @csrf
                    <div id="password">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <h6 class="ms-5">Ubah Password</h6>
                            </div>
                        </div>
                        <!-- input email -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Masukkan Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" required class="form-control" name="email" id="">
                            </div>
                        </div>
                        <!-- input password -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Masukkan Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required class="form-control" name="password" id="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            @elseif ($password !== null)
                <!-- form(post) KandidatController => ubah_kandidat_password -->
                <form action="/ubah_kandidat_password" method="POST">
                    @csrf
                    <!-- input email -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Email Anda</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" disabled class="form-control" value="{{$password->email}}" id="">
                        </div>
                    </div>
                    <!-- input password -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Masukkan Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" name="password_new" id="">
                        </div>
                    </div>
                    <!-- input konfirmasi password -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Konfirmasi Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required class="form-control" name="password_confirm" id="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Ubah Password</button>
                </form>
            @endif            
        </div>
    </div>
@endsection