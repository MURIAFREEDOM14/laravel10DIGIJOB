@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b>Permohonan Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama Jabatan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="form-control" disabled value="{{$lowongan->jabatan}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama Kandidat</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="form-control" disabled value="{{$kandidat->nama}}" id="">
                        </div>
                    </div>
                    <a href="/kandidat" class="btn btn-danger float-left">Kembali</a>
                    <button type="submit" class="btn btn-primary float-right">Kirim</button>
                </form>
            </div>
        </div>
    </div>
@endsection