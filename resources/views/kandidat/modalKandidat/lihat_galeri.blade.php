@extends('layouts.kandidat')
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
                            <source class="" src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$video->video}}">
                        </video>
                    </div>
                    <div class="col-3"></div>
                </div>
                <button class="btn btn-success float-left mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                @elseif($type == "foto")
                <div class="row">
                    <div class="col-3"></div>
                    <div class="col-6">
                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$foto->foto}}" class="img mb-2" alt="">
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
                                <a href="/lihat_galeri_pengalaman_kerja/{{$item->foto_kerja_id}}/{{"foto"}}">
                                    <div class="card-body">
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$item->foto}}" class="img2" alt="">
                                    </div>    
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($video_pengalaman as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/lihat_galeri_pengalaman_kerja/{{$item->video_kerja_id}}/{{"video"}}">
                                    <div class="card-body">
                                        <video id="video">
                                            <source class="" src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/{{$item->video}}">
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