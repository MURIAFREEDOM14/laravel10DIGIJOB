@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Tambah Negara
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Nama Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="negara" value="{{$negara->negara}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Kode Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="kode_negara" value="{{$negara->kode_negara}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Syarat Umur Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="number" name="syarat_umur" value="{{$negara->syarat_umur}}" class="form-control" id="">
                        </div>
                    </div>
                    <a href="/manager/negara_tujuan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection