@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 style="font-weight: 600">Idenfikasi Diri</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group mb-2">
                                <label for="" class="">Password Baru</label>
                                <input type="text" class="form-control" placeholder="Masukkan Password baru anda" name="password" required id="">
                            </div>
                            <div class="form-group mb-2">
                                <label for="" class="">Konfirmasi Password</label>
                                <input type="text" class="form-control" placeholder="Masukkan Password baru anda" name="password" required id="">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Konfirmasi</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection