@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Lihat Negara
            </div>
            <div class="card-body">
                <h4 class="text-center">Gambar Icon Negara</h4>
                <div class="row mb-3">
                    <div class="col-4"></div>
                    <div class="col-4 text-center">
                        @if ($negara->gambar == null)
                            <img src="/gambar/default_user.png" width="150" height="150" alt="" class="img">
                        @else
                            <img src="/gambar/manager/Foto/Icon/{{$negara->gambar}}" width="150" height="150" class="img" alt="">                            
                        @endif
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="">Nama Negara</label>
                    </div>
                    <div class="col-8">
                        <input type="text" value="{{$negara->negara}}" disabled name="negara" class="form-control" id="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="">Kode Negara</label>
                    </div>
                    <div class="col-8">
                        <input type="text" value="{{$negara->kode_negara}}" disabled name="kode_negara" class="form-control" id="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="">Syarat Umur Negara</label>
                    </div>
                    <div class="col-8">
                        <input type="number" value="{{$negara->syarat_umur}}" disabled name="syarat_umur" class="form-control" id="">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-4">
                        <label for="" class="col-form-label">Deskripsi Negara</label>
                    </div>
                    <div class="col-8">
                        <textarea name="deskripsi" rows="10" class="form-control" id="">{{$negara->deskripsi}}</textarea>
                    </div>                    
                </div>
                <a href="/manager/negara_tujuan" class="btn btn-danger">Kembali</a>
            </div>
        </div>
    </div>
@endsection