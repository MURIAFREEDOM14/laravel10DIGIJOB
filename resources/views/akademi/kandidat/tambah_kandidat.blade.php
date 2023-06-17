@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-4">
                    </h6>
                    <form action="" method="POST">
                        @csrf
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="name" class="">{{ __('Nama') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="nik" class="">{{ __('No. NIK') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="tgl" class="">{{ __('Tanggal Lahir') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="tgl" type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl') }}" required autocomplete="tgl" autofocus>
                                    @error('tgl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="no_telp" class="">{{ __('No Telp') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>
                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="nama_panggilan" class="">{{ __('Username') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="nama_panggilan" type="text" class="form-control @error('username') is-invalid @enderror" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required autocomplete="nama_panggilan">
                                    @error('nama_panggilan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Username sudah digunakan</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="">{{ __('Email Address') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Email sudah digunakan</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="email" class="">{{ __('Password') }}</label>
                                </div>
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>password harus berisi min 6 digit dan max 20 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <a href="/akademi/list_kandidat" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary my-3 float-end" type="submit">Tambah</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection