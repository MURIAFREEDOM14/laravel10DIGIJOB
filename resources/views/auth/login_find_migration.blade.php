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
                    <form action="/login/migration/confirm" method="POST">
                        @csrf
                        <div class="row my-3">
                            <div class="col-12 text-center">
                                <b class="bold">Apakah Nama Anda </b>
                                    <p><b class="" style="text-transform: uppercase;">{{$kandidat->nama}}</b></p>                                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">No. NIK Anda</label>
                                    <input name="" disabled type="number" class="form-control" value="{{$kandidat->nik}}" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Email Anda</label>
                                    <input name="email" type="email" class="form-control" value="{{$kandidat->email}}" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Password</label>
                                    <input name="password" placeholder="Buat Password Aplikasi" type="text" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <a class="btn btn-danger" href="/laman">Kembali</a>
                            <button class="btn btn-primary float-end" type="submit">Simpan & Masuk</button>
                        </div>
                    </form>                        
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="" style="height: 55px;"></div>
</div>
@endsection
