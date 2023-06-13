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
                        <div class="my-4">Belum punya akun? <a href="/laman">Daftar yuk!!</a></div>
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
@endsection
