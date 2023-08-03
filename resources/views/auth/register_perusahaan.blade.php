@extends('layouts.laman')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ __('Register Perusahaan') }}</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/register/perusahaan">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="">{{ __('Nama Perusahaan') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror    
                                </div>
                                <div class="mb-3">
                                    <label for="nib" class="">{{ __('No. NIB') }}</label>
                                    <input id="nib" type="text" class="form-control @error('no_nib') is-invalid @enderror" name="no_nib" value="{{ old('no_nib') }}" required autocomplete="nib" autofocus>
                                    @error('no_nib')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror    
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword6" class="col-form-label">{{ __('Perusahaan Anda menempatkan pekerja di:') }}</label>
                                    <select name="penempatan_kerja" class="form-select" required id="">
                                        <option value="">-- Pilih Penempatan Kerja --</option>
                                        <option value="Dalam negeri">Dalam Negeri</option>
                                        <option value="Luar Negeri">Luar Negeri</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="">{{ __('Email Address') }}</label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="">{{ __('Buat Password') }}</label>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="passwordConfirm" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
                                    <input type="text" hidden name="captcha" value="" id="confirmCaptcha">
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
                        {{-- <a href="/login/perusahaan" class="btn btn-secondary">Kembali</a> --}}
                        <div class="mt-3">Sudah punya akun?<a href="/login" class="ms-1">Login</a></div>
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
