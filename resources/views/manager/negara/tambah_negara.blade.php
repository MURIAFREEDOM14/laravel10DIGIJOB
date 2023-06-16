@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Tambah Negara
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Nama Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" required name="negara" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Kode Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="text" required name="kode_negara" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Syarat Umur Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="number" name="syarat_umur" class="form-control" id="">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="" class="col-form-label">Deskripsi Negara</label>
                        <textarea name="deskripsi" class="form-control" rows="10" id=""></textarea>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Icon Negara</label>
                        </div>
                        <div class="col-8">
                            <input type="file" name="gambar" class="form-control" id="">
                        </div>
                    </div>
                    <a href="/manager/negara_tujuan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection