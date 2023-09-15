@extends('layouts.input')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Lupa Password</h4>
                </div>
                <div class="card-body">
                    <!-- form(post) VerifikasiController => confirmPassword -->
                    <form action="/new_password" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <!-- input email -->
                                <div class="mb-3">
                                    <label for="">Masukkan Email</label>
                                    <input name="email" disabled type="email" class="form-control" value="{{$user->email}}" required id="exampleInputPassword1">
                                </div>
                                <!-- input password baru -->
                                <div class="mb-3">
                                    <label for="">Masukkan Password Baru</label>
                                    <input name="password" type="text" placeholder="Harap ingat password anda" class="form-control" value="{{old('email')}}" required id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-primary float-end" type="submit">Simpan</button>    
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="mt-2" style="height: 3rem"></div>
</div>
@endsection