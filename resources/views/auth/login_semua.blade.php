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
                    <form action="/login" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                              <div class="mb-3">
                                  <label for="exampleInputPassword1">Masukkan Email</label>
                                  <input name="email" type="email" class="form-control" value="{{old('email')}}" required id="exampleInputPassword1">
                              </div>
                              <div class="mb-3">
                                  <label for="exampleInputPassword1">Masukkan Password</label>
                                  {{-- <div class="input-group"> --}}
                                    <input name="password" type="password" class="form-control" value="{{old('password')}}" required id="password_input">
                                    {{-- <button type="button" class="btn btn-primary" onclick="seePassword()"><img src="/gambar/seeing.png" style="width: 15px; height:auto; color:white;" alt=""></button> --}}
                                  {{-- </div> --}}
                                  <div class="my-2">
                                    <input type="checkbox" class="me-1" name="" onclick="seePassword()" id=""><span>Tampilkan Password</span>
                                  </div>
                              </div>
                              <div class="row mb-3">
                                <div class="col-md-12">
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
                                </div>
                                @error('captcha')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>Harap isi captcha anda</strong>
                                  </span>
                                @enderror
                              </div>
                            </div>
                        </div>
                        <div class=""><button type="button" class="btn btn-link mb-2" data-bs-toggle="modal" data-bs-target="#forgotPassword">Lupa Password</button></div>
                        <div class="">Belum punya akun?
                        <a href="/register" class="btn btn-link mb-2" >Daftar yuk!!</a>
                        </div>
                        <button type="submit" class="btn btn-primary float-right mr-2">Masuk</button>
                    </form> 
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="mt-2" style="height: 3rem"></div>
</div>

@endsection
