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
                            </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            
                          </div>
                          <div class="">Sudah Pernah Terdaftar?<a class="btn btn-link" href="/login/migration">Aktifkan Akun</a></div>                        
                          <div class="mx-2">Belum punya akun?
                            <button type="button" class="btn btn-link mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Daftar yuk!!</button>
                          </div>  
                        </div>
                        {{-- <a href="/laman" class="btn btn-secondary float-left ml-2">Kembali</a> --}}
                        <button type="submit" class="btn btn-primary float-right mr-2">Masuk</button>
                    </form> 
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="mt-2" style="height: 3rem"></div>
</div>

<main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel" style="font-family:poppins">Anda ingin daftar sebagai siapa?</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset; background-color: #19A7CE">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/register/kandidat" style="text-transform: uppercase;color: white">Pencari Kerja</a></h4>
                  </div>
                </div>
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset;background-color: #FFD966">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/register/akademi" style="text-transform: uppercase; color: white">Akademi</a></h4>
                  </div>
                </div>
                <div class="col-md-4 mb-3 align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                  <div class="icon-box text-center" style="border-style: outset;background-color: #2bb930">
                    <div class="icon"><i class="bx bx-file" style="color: #0a3e52"></i></div>
                    <h4><a href="/register/perusahaan" style="text-transform: uppercase; color: white">Perusahaan</a></h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End Services Section -->

  </main>
@endsection
