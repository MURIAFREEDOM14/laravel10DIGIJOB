@extends('layouts.laman')
@section('content')
<div class="container">
    @php
        $c1 = 1;
        $date = date('D');
        if (date('D') == 'Sun') {
            if ($c1 == 0) {
                $c1 = $c1 + 1;
            } elseif ($c1 == 1) {
                $c1 = $c1 - 1;
            }
        }
    @endphp
    <style>
        .slidercaptcha {
            display: none;
        }
        #btn {
            display: none;
        }
    </style>
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">{{ __('Register Perusahaan') }}</h4>
                </div>
                <div class="card-body">
                    <!-- form(post) RegisterController => perusahaan -->
                    <form method="POST" action="/register/perusahaan">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="">{{ __('Nama Perusahaan') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ "Nama harus berisi kurang dari 255 kata" }}</strong>
                                        </span>
                                    @enderror    
                                </div>
                                <div class="mb-3">
                                    <label for="nib" class="">{{ __('No. NIB') }}</label>
                                    <input id="nib" type="text" class="form-control @error('no_nib') is-invalid @enderror" name="no_nib" value="{{ old('no_nib') }}" required autocomplete="nib" autofocus>
                                    @error('no_nib')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ "No. NIB tidak boleh kosong" }}</strong>
                                        </span>
                                    @enderror    
                                </div>
                                <div class="mb-3">
                                    <label for="inputPassword6" class="col-form-label">{{ __('Perusahaan Anda menempatkan pekerja di:') }}</label>
                                    <select name="penempatan_kerja" class="form-select" required id="penempatan">
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
                                            <strong>{{ "Email Sudah digunakan" }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="">{{ __('Buat Password') }}</label>
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ "Password harus berisi min:8 kata" }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password_confirm" type="text" class="form-control @error('password') is-invalid @enderror" name="passwordConfirm" value="{{ old('password') }}" required autocomplete="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ "Password konfirmasi harus sama dengan buat password" }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    {{-- @if ($c1 == 0)
                                        <!-- input kode captcha -->
                                        <div class="captcha_img">
                                            <span>{!!captcha_img('flat')!!}</span>
                                            <button type="button" class="btn btn-danger reload" id="reload">
                                                &#x21bb;
                                            </button>
                                        </div>
                                        <input type="text" placeholder="Masukkan kode captcha" required class="form-control mt-2" name="captcha" id="confirmCaptcha">
                                    @elseif($c1 == 1) --}}
                                        <!-- input kode captcha -->
                                        <div class="slidercaptcha card" id="sliderCaptcha">
                                            <div class="card-header">
                                                <span>Kode Captcha</span>
                                            </div>
                                            <div class="card-body">
                                                <div class="@error('captcha') is-invalid @enderror" id="captcha"></div>
                                                <div class="text-center mt-5" id="confirm"></div>
                                            </div>
                                        </div>
                                        <div id="confirm_captcha"></div>
                                        <input type="text" hidden name="captcha" value="" id="captcha">
                                        @error('captcha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ "Harap isi captcha anda" }}</strong>
                                            </span>
                                        @enderror    
                                    {{-- @endif --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" onclick="enable()" id="check">
                            <span class="form-check-label" for="flexCheckDefault" style="font-size: 13px">
                                Dengan ini, anda menyetujui <a href="/syarat_ketentuan/kandidat">syarat & ketentuan</a> kami.
                            </span>
                        </div>
                        <div class="mt-3">Sudah punya akun?<a href="/login" class="ms-1">Login</a></div>
                        <div class="">Bingung cara untuk daftar?<button type="button" data-bs-toggle="modal" data-bs-target="#tutorial_kandidat" class="btn btn-link">Yuk lihat video ini</button></div>
                        <button id="inputMailPass" class="btn btn-primary float-right mr-2" onclick="btnInputMailPass()">Lanjut</button>
                        <button type="submit" id="btn" disabled="true" class="btn btn-primary mt-3" onclick="processing()">
                            {{ __('Register') }}
                        </button>
                        <button type="button" class="btn btn-primary float-right mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
<div class="modal fade" id="tutorial_kandidat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content" style="background-color:transparent;border:none;">
            <div class="text-center">
                <video id="video" style="width: 90%;" controls>
                    <source class="" src="/gambar/Manager/Tutorial/Register Perusahaan/Registrasi DIGIJOB UGIPORT.mp4">
                </video>
                {{-- <button class="btn btn-success mx-auto mb-2" id="play" type="button" onclick="play()">Mulai</button>
                <button class="btn btn-warning mx-auto mb-2" id="jeda" type="button" onclick="pause()">Jeda</button> --}}
            </div>
        </div>
    </div>
</div>
<script>
    // fungsi confirmasi email & password
    function btnInputMailPass() {
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var captchaCode = document.getElementById('sliderCaptcha');
        var btn = document.getElementById('btn');
        var btnInputMailPass = document.getElementById('inputMailPass');
        if (email !== '' && password !== '') {
            btnInputMailPass.style.display = 'none';
            btn.style.display = 'block';
            captchaCode.style.display = 'block';
        }
    }

    // fungsi tombol loading
    function processing() {
        var name = document.getElementById('name').value;
        var nib = document.getElementById('nib').value;
        var penempatan = document.getElementById('penempatan').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var confirm = document.getElementById('password_confirm').value;
        var captcha = document.getElementById('confirmCaptcha').value;
        var confirm_captcha = document.getElementById('confirm_captcha');
        if (captcha == '') {
            confirm_captcha.innerHTML = "Harap selesaikan kode captcha terlebih dahulu"
            confirm_captcha.style.color = 'red';
        }
        if (name !== '' &&
            nib !== '' &&
            penempatan !== '' &&
            email !== '' &&
            password !== '' &&
            confirm !== '' &&
            captcha !== '') {
            // var viewLoad = document.getElementById('viewLoad').style.display = 'block';
            var submit = document.getElementById('btn').style.display = 'none';
            var btnLoad = document.getElementById('btnload').style.display = 'block';
        }
    }
</script>
@endsection
