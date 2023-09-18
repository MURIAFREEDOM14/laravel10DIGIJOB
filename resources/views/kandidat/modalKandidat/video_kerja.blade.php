@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        @if ($code == "tambah")
            <div class="card mb-5">
                <div class="card-header">
                    <h5 class="" style="">Tambah Portofolio</h5>
                </div>
                <div class="card-body">
                    <!-- form(post) KandidatController => simpanPortofolio -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Video Baru</label>
                            </div>
                            <div class="col-md-8">
                                <input type="file" required name="video" class="form-control" id="video" accept="video/*">
                            </div>
                        </div>
                        <span>Pastikan ukuran video yang anda upload tidak lebih dari 5 mb</span>
                        <hr>
                        <div class="">
                            <a class="btn btn-danger" href="/lihat_kandidat_pengalaman_kerja/{{$id}}">Kembali</a>
                            <button type="submit" class="btn btn-primary float-end" onclick="processing()" id="btn">Tambah</button>
                            <button type="button" class="btn btn-primary float-end" id="btnload"><div class="spinner-border text-light" role="status"></div></button>    
                        </div>
                    </form>
                </div>
            </div>    
        @elseif($code == "edit")
            <div class="card mb-5">
                <div class="card-header">
                    <h5>Edit Portofolio</h5>
                </div>
                <div class="card-body">
                    <!-- form(post) KandidatController => ubahPortofolio -->
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
                                <input type="file" name="video" id="video" class="form-control" accept="video/*">
                            </div>
                        </div>
                        <span>Pastikan ukuran video yang anda upload tidak lebih dari 5 mb</span>
                        <hr>
                        <div class="">
                            <a class="btn btn-danger mt-3 float-start" href="/lihat_kandidat_pengalaman_kerja/{{$video->pengalaman_kerja_id}}">Kembali</a>
                            <button type="submit" class="btn btn-warning mt-3" onclick="processing()" id="btn">Ubah</button>
                            <button type="button" class="btn btn-primary float-end" id="btnload"><div class="spinner-border text-light" role="status"></div></button>    
                        </div>
                    </form>
                </div>    
            </div>            
        @endif
    </div>
    <script>
        function processing() {
            var video = document.getElementById('video').value;
            if (video !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';                
            }
        }
    </script>
@endsection