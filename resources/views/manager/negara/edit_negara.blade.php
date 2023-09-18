@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Tambah Negara
            </div>
            <div class="card-body">
                <!-- form(post) NegaraController => ubahNegara -->
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- input nama negara -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Nama Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="negara" value="{{$negara->negara}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input kode negara -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Kode Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="kode_negara" value="{{$negara->kode_negara}}" class="form-control" id="">
                        </div>
                    </div>   
                    <!-- input deskripsi negara -->                 
                    <div class="mb-3">
                        <label for="" class="col-form-label">Deskripsi Negara</label>
                        <textarea name="deskripsi" id="" rows="10" class="form-control">{{$negara->deskripsi}}</textarea>
                    </div>
                    <!-- input icon negara -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Icon Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="file" name="gambar" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input kode mata uang negara -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Kode Mata Uang Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="mata_uang" class="form-control" id="">
                        </div>
                    </div>
                    <a href="/manager/negara_tujuan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection