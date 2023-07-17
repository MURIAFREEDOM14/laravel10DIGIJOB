@extends('layouts.kandidat')
@section('content')
        <div class="container mt-5">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="avatar-xxl">
                                                @if ($kandidat->foto_4x6 !== null)
                                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                                
                                                @else
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                                                                                        
                                                @endif
                                            </div>
                                            <hr>
                                            <div class=""><b class="bold">{{$kandidat->nama}}</b></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="card bg-info2">
                                        <div class="card-header text-white">
                                            <b class="" style="text-transform: uppercase;">Video Pelatihan</b>
                                        </div>
                                        <div class="card-body text-white" style="font-size: 15px; text-transform:uppercase;">
                                            <b>Hai, kami punya video pelatihan nih buat kamu. Apakah kamu penasaran? Tonton yuk</b> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($video as $item)
                                    <div class="col-6">
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
            </div>
        </div>
@endsection