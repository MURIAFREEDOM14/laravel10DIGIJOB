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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Video Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" required name="video" class="form-control" id="" accept="video/*">
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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Ubah Video</label>
                        </div>
                        <div class="col-md-8">
                            <video id="video">
                                <source class="" src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$video->video}}">
                            </video>
                            <div class="text-center">
                                <button class="btn btn-success mb-2" id="play" type="button" onclick="play()">Mulai</button>
                                <button class="btn btn-warning mb-2" id="jeda" type="button" onclick="pause()">Jeda</button>
                            </div>
                            <input type="file" name="video" id="" class="form-control" accept="video/*">
                        </div>
                    </div>
                    <a class="btn btn-danger mt-3" href="/lihat_kandidat_pengalaman_kerja/{{$video->pengalaman_kerja_id}}">Kembali</a>
                    <button type="submit" class="btn btn-warning mt-3">Ubah</button>
                </form>
            </div>    
        </div>            
        @else
        @endif
        
    </div>
@endsection