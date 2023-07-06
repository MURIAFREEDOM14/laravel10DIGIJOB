@extends('layouts.laman')
@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ __('Register') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register/kandidat">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="">{{ __('Nama') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="">{{ __('No. NIK') }}</label>
                                    <input id="nik" type="number" class="form-control @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}" required autocomplete="nik" autofocus>
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="tgl" class="">{{ __('Masukkan Tanggal Lahir') }}</label>
                                    <input id="tgl" type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl" value="{{ old('tgl') }}" required autocomplete="tgl" autofocus>
                                    @error('tgl')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="no_telp" class="">{{ __('No Telp') }}</label>
                                    <input id="no_telp" type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}" required autocomplete="no_telp" autofocus>
                                    @error('no_telp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="nama_panggilan" class="">{{ __('Username') }}</label>
                                    <input id="nama_panggilan" type="text" class="form-control @error('username') is-invalid @enderror" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required autocomplete="nama_panggilan">
                                    @error('nama_panggilan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Username sudah digunakan</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Email sudah digunakan</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Masukkan Password') }}</label>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>password harus berisi min 6 digit dan max 20 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password" type="password" class="form-control" name="passwordConfirm" required autocomplete="password">
                                </div>
                            </div>
                        </div>
                        {{-- <a href="/login/kandidat" class="btn btn-secondary">Kembali</a> --}}
                        <div class="">Sudah punya akun?<a href="/login" class="ms-1">Login</a></div>
                        <button type="submit" class="btn btn-primary mt-3">
                            {{ __('Register') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
