@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: 600">Lihat {{$type}}</h5>
            </div>
            <div class="card-body">
                @if ($type == "video")
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <video id="video">
                            <source class="" src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$video->video}}">
                        </video>
                    </div>
                    <div class="col-3"></div>
                </div>
                <div class="text-center">
                    <button class="btn btn-success mb-2" id="play" type="button" onclick="play()">Mulai</button>
                    <button class="btn btn-warning mb-2" id="jeda" type="button" onclick="pause()">Jeda</button>
                </div>
                @elseif($type == "foto")
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <img src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$foto->foto}}" class="img mb-2" alt="">
                    </div>
                    <div class="col-3"></div>
                </div>
                @endif                
                <a class="float-right btn btn-danger" href="/galeri_pengalaman_kerja/{{$pengalaman->pengalaman_kerja_id}}">Kembali</a>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($foto_pengalaman as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/manager/kandidat/lihat_galeri_kandidat/{{$item->foto_kerja_id}}/{{"foto"}}">
                                    <div class="card-body">
                                        <img src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->foto}}" class="img2" alt="">
                                    </div>    
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($video_pengalaman as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/manager/kandidat/lihat_galeri_kandidat/{{$item->video_kerja_id}}/{{"video"}}">
                                    <div class="card-body">
                                        <video id="video">
                                            <source class="" src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->video}}">
                                        </video>
                                    </div>
                                </a>
                            </div>                            
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection