@extends('layouts.laman')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ __('Register Kandidat') }}</h4>
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
                                    <label for="nama_panggilan" class="">{{ __('Username / Nama Panggilan') }}</label>
                                    <input id="nama_panggilan" type="text" placeholder="Maks 20 kata" class="form-control @error('nama_panggilan') is-invalid @enderror" name="nama_panggilan" value="{{ old('nama_panggilan') }}" required autocomplete="nama_panggilan">
                                    @error('nama_panggilan')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
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
                                    <label for="email" class="">{{ __('Buat Password') }}</label>
                                    <input id="password" type="text" placeholder="min 8 kata" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>password harus berisi min 8 digit dan max 20 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password" type="text" placeholder="Masukkan ulang password anda dengan benar" class="form-control" name="passwordConfirm" required autocomplete="password">
                                </div>
                                <div class="mb-3">
                                    <div class="slidercaptcha card">
                                      <div class="card-header">
                                          <span>Kode Captcha</span>
                                      </div>
                                      <div class="card-body">
                                        <div class="@error('captcha') is-invalid @enderror" id="captcha"></div>
                                        <div class="text-center mt-5" id="confirm">
                                        </div>
                                      </div>
                                    </div>
                                    <input type="text" hidden name="captcha" value="" id="confirmCaptcha" required>
                                    @error('captcha')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>Harap isi captcha anda</strong>
                                      </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" onclick="enable()" id="check">
                            <span class="form-check-label" for="flexCheckDefault" style="font-size: 13px">
                                Dengan ini, anda menyetujui <a href="/syarat_ketentuan/kandidat">syarat & ketentuan</a> kami.
                            </span>
                        </div>
                        <div class="mt-3">Sudah punya akun?<a href="/login" class="ms-1 btn btn-link">Login</a></div>
                        <div class="">Bingung cara untuk daftar?<button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-link">Yuk lihat video ini</button></div>
                        <button type="submit" id="btn" disabled="true" class="btn btn-primary mt-3">
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
