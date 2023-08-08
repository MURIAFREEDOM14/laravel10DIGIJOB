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
                                  <input name="password" type="password" class="form-control" value="{{old('password')}}" required id="exampleInputPassword1">
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
                        {{-- <div class="">Sudah Pernah Terdaftar?<a class="btn btn-link" href="/login/migration">Aktifkan Akun</a></div>                         --}}
                        <div class="">Belum punya akun?
                          {{-- <button type="button" class="btn btn-link mb-2" data-bs-toggle="modal" data-bs-target="#newUser">Daftar yuk!!</button> --}}
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

{{-- <main id="main"> --}}
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <!-- Modal New User -->
      <div class="modal fade" id="newUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:poppins">Anda ingin daftar sebagai siapa?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/kandidat" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset; background-color: #19A7CE">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase;color: white">Pencari Kerja</h4>  
                    </div>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/akademi" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset;background-color: #FFD966">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase; color: white">Akademi</h4>
                    </div>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <a href="/register/perusahaan" style="color: white">
                    <div class="icon-box text-center" style="border-style: outset;background-color: #2bb930">
                      <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                      <h4 style="text-transform: uppercase; color: white">Perusahaan</h4>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Modal New User -->

    <section id="services" class="services">
      <!-- Modal Forgot Password -->
      <div class="modal fade" id="forgotPassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:poppins">Lupa Password Sebagai...</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset; background-color: #19A7CE">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/forgot_password/kandidat" style="text-transform: uppercase;color: white">Pencari Kerja</a></h4>
                  </div>
                </div>
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset;background-color: #FFD966">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/forgot_password/akademi" style="text-transform: uppercase; color: white">Akademi</a></h4>
                  </div>
                </div>
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset;background-color: #2bb930">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/forgot_password/perusahaan" style="text-transform: uppercase; color: white">Perusahaan</a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Modal Forgot Password -->
  </main>
@endsection
