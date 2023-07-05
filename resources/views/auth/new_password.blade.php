@extends('layouts.laman')
@section('content')
@include('sweetalert::alert')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Lupa Password</h4>
                </div>
                <div class="card-body">
                    <form action="/new_password" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Email</label>
                                    <input name="email" disabled type="email" class="form-control" value="{{$user->email}}" required id="exampleInputPassword1">
                                    <input name="email" hidden type="email" class="form-control" value="{{$user->email}}" required id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Password Baru</label>
                                    <input name="password" type="text" placeholder="Harap ingat password anda" class="form-control" value="{{old('email')}}" required id="exampleInputPassword1">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-danger" href="/login">Kembali</a>
                            <button class="btn btn-primary float-end" type="submit">Lanjut</button>    
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