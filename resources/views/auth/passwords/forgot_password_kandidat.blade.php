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
                    <form action="" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Nama Lengkap</label>
                                    <input name="name" type="text" class="form-control" value="{{old('nama')}}" required id="nama">
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputPassword1">Masukkan Email</label>
                                    <input name="email" type="email" class="form-control" value="{{old('email')}}" required id="email">
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a class="btn btn-danger" href="/login">Kembali</a>
                            <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Lanjut</button>    
                            <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    <div class="mt-2" style="height: 3rem"></div>
</div>
<script>
    function processing() {
        var name = document.getElementById('nama').value;
        var email = document.getElementById('email').value;
        if (name !== '' &&
            email !== '') {
            var submit = document.getElementById('btn').style.display = 'none';
            var btnLoad = document.getElementById('btnload').style.display = 'block';
        }
    }
</script>    
@endsection