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
                    <form action="/login/migration/confirm">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <b class="bold">Apakah Nama Anda {{$data->nama}}?</b>                                        
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">No. NIK Anda</label>
                                    <input name="email" type="email" class="form-control" value="{{$data->nik}}" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Email Anda</label>
                                    <input name="email" type="email" class="form-control" value="{{$data->email}}" id="exampleInputPassword1">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Password</label>
                                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                                </div>
                            </div>
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
