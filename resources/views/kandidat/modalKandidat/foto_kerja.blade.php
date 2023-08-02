@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        @if ($code == "tambah")
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="" style="">Tambah Portofolio</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Foto Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input required type="file" name="foto" class="form-control" id="" accept="image/*">
                        </div>
                    </div>
                    <a class="btn btn-danger mt-3" href="/lihat_kandidat_pengalaman_kerja/{{$id}}">Kembali</a>
                    <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                </form>
            </div>
        </div>    
        @elseif($code == "edit")
        <div class="card mb-5">
            <div class="card-header">
                <h5>Edit Portofolio</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Ubah Foto</label>
                        </div>
                        <div class="col-md-8">
                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$foto->foto}}" class="img mb-1" alt="">
                            <input type="file" name="foto" id="" accept="image/*" class="form-control">            
                        </div>
                    </div>
                    <a class="btn btn-danger mt-3" href="/lihat_kandidat_pengalaman_kerja/{{$foto->pengalaman_kerja_id}}">Kembali</a>
                    <button type="submit" class="btn btn-warning mt-3">Ubah</button>
                </form>
            </div>    
        </div>            
        @else
        @endif
        
    </div>
@endsection