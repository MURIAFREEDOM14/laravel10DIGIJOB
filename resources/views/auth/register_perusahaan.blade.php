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
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                    </div>
                                    <div class="col-md-8">
                                        
                                    </div>
                                </div> --}}
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
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="passwordConfirm" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="mb-3">
                                    <label for="">Kode Captcha</label>
                                    <div class="ms-5">{!! htmlFormSnippet() !!}</div>
                                </div> --}}
                            </div>
                        </div>
                        {{-- <a href="/login/perusahaan" class="btn btn-secondary">Kembali</a> --}}
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
