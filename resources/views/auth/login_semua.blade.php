@extends('layouts.laman')
@section('content')
    @include('sweetalert::alert')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">Login</h4>
                    </div>
                    <div class="card-body">
                        <!-- Form post menuju web php ('/login', 'authenticateLogin') -->
                        <form action="/login" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Mengambil data input email -->
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1">Masukkan Email</label>
                                        <input name="email" type="email" class="form-control"
                                            value="{{ old('email') }}" required id="email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputPassword1">Masukkan Password</label>
                                        <input name="password" type="password" class="form-control"
                                            value="{{ old('password') }}" required id="password_input">
                                        <div class="my-2">
                                            <input type="checkbox" class="me-1" name="" onclick="seePassword()"
                                                id=""><span>Tampilkan Password</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <div class="slidercaptcha card">
                                                <div class="card-header">
                                                    <span>Kode Captcha</span>
                                                </div>
                                                <div class="card-body">
                                                    <div class="@error('captcha') is-invalid @enderror" id="captcha">
                                                    </div>
                                                    <div class="text-center mt-5" id="confirm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="" id="confirm_captcha"></div>
                                            <input type="text" name="captcha" hidden required value=""
                                                id="confirmCaptcha">
                                        </div>
                                        @error('captcha')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>Harap isi captcha anda</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class=""><button type="button" class="btn btn-link mb-2" style="text-decoration: none;" data-bs-toggle="modal" data-bs-target="#forgotPassword">Lupa Password</button></div>
                            <div class="">Belum punya akun?
                                <a href="/register" style="text-decoration:none;" class="btn btn-link mb-2">Daftar yuk!!</a>
                            </div>
                            <button type="submit" class="btn btn-primary float-right mr-2" id="btn"
                                onclick="processing()">Masuk</button>
                            <button type="button" class="btn btn-primary float-right mr-2" id="btnload">
                                <div class="spinner-border text-light" role="status"></div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        <div class="mt-2" style="height: 3rem"></div>
    </div>
    <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:poppins">sebagai siapakah anda lupa password?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <a href="/forgot_password/kandidat" style="color: white;">
                                <div class="icon-box text-center" style="border-style: outset; background-color: #19A7CE; padding:20px">
                                    {{-- <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div> --}}
                                    <h4 style="text-transform: uppercase;color: white">Pencari Kerja /  Kandidat</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <a href="/forgot_password/akademi" style="color: white">
                                <div class="icon-box text-center" style="border-style: outset;background-color: #F0B86E; padding:20px;">
                                    {{-- <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div> --}}
                                    <h4 style="text-transform: uppercase; color: white">Akademi</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                            <a href="/forgot_password/perusahaan" style="color: white">
                                <div class="icon-box text-center" style="border-style: outset;background-color: #2bb930; padding:20px;">
                                    {{-- <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div> --}}
                                    <h4 style="text-transform: uppercase; color: white">Perusahaan</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // fungsi tampilan lihat password
        function seePassword() {
            var p = document.getElementById('password_input').type;
            if (p == "password") {
                document.getElementById('password_input').type = 'text';
            } else {
                document.getElementById('password_input').type = 'password';
            }
        }

        function processing() {
            var email = document.getElementById('email').value;
            var password = document.getElementById('password_input').value;
            var captcha = document.getElementById('confirmCaptcha').value;
            var confirm_captcha = document.getElementById('confirm_captcha');
            if (captcha == '') {
                confirm_captcha.innerHTML = "Harap selesaikan kode captcha terlebih dahulu";
                confirm_captcha.style.color = 'red';
            }
            if (email !== '' &&
                password !== '' &&
                captcha !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    </script>
@endsection
