@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Video Pelatihan
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <video width="250" height="250" class="" id="video">
                            <source src="/gambar/Manager/Pelatihan/{{$video->judul}}/Video/{{$video->video}}" type="video/mp4">
                        </video>
                        <div class="text-center">
                            <button class="btn btn-success mb-2" id="play" type="button" onclick="play()">Mulai</button>
                            <button class="btn btn-warning mb-2" id="jeda" type="button" onclick="pause()">Jeda</button>
                        </div>
                        <button type="button" class="" onclick="fullsize()">Ukuran Penuh</button>
                    </div>
                    <div class="col-md-6">
                        <hr>
                        <b class="bold">Judul Video : {{$video->judul}}</b>
                        <hr>
                        <b class="bold">Deskripsi : {{$video->deskripsi}}</b>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 style="font-weight: 700">Video Pelatihan Lainnya</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($pelatihan as $item)
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <b>{{$item->judul}}</b>
                                    <a class="float-right btn btn-primary" href="/lihat_video_pelatihan/{{$item->id}}">Lihat Video</a>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <video width="300" height="300" class="img"
                                                @if ($item->thumbnail !== null)
                                                    poster="/gambar/Manager/Pelatihan/{{$item->judul}}/Thumbnail/{{$item->thumbnail}}"
                                                @endif
                                                >
                                                <source src="/gambar/Manager/Pelatihan/{{$item->judul}}/Video/{{$item->video}}" type="video/mp4">
                                            </video>
                                        </div>
                                        <div class="col-6">
                                            <label>{{$item->deskripsi}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>                
            </div>
        </div>
    </div>
    <script>
        var video = document.getElementById("video");
        function playPause() {
            if (video.paused) {
                video.play();
            } else {
                video.pause();
            };
        }   
    </script>
@endsection