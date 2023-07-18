@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="float-left" style="font-weight: 700">Pelatihan</h3>
                <a class=" float-right btn btn-primary" href="/manager/kandidat/tambah_video_pelatihan/{{$pelatihan->tema_pelatihan}}/{{$pelatihan->tema_pelatihan_id}}">Tambah</a>
            </div>
            <div class="card-body">
                @foreach ($video as $item)
                    @if ($item->judul !== null)
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 style="font-weight: 500" class="float-left">{{$item->judul}}</h4>
                                        <a class="btn btn-danger mx-1 float-right" onclick="hapusNegara(event)" href="/manager/kandidat/hapus_video_pelatihan/{{$pelatihan->tema_pelatihan_id}}/{{$item->id}}">Hapus</a>
                                        <a class="btn btn-warning float-right" href="/manager/kandidat/edit_video_pelatihan/{{$item->tema}}/{{$item->id}}">Edit</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-8">
                                                <video
                                                @if ($item->thumbnail !== null)
                                                    poster="/gambar/Manager/Pelatihan/{{$item->judul}}/Thumbnail/{{$item->thumbnail}}" 
                                                @endif 
                                                    width="300" height="300" class="img" controls>
                                                    <source src="/gambar/Manager/Pelatihan/{{$item->judul}}/Video/{{$item->video}}" type="video/mp4">
                                                </video>
                                            </div>
                                            <div class="col-4 text-center">
                                                <div class="">Deskripsi</div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                                        
                    @endif
                @endforeach
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