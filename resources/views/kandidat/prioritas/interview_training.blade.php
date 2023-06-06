@extends('layouts.prioritas')
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
                                            <b class="" style="text-transform: uppercase;">Pelatihan Interview</b>
                                        </div>
                                        <div class="card-body text-white" style="font-size: 15px; text-transform:uppercase;">
                                            <b>Mari Atasi sikap gugupmu dan tambahkan rasa percaya dirimu dengan Pelatihan Interview</b> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @foreach ($pelatihan as $item)
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <b>{{$item->judul}}</b>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <video width="200" poster="/gambar/Manager/Pelatihan/{{$item->judul}}/Thumbnail/{{$item->thumbnail}}" controls>
                                                            <source src="/gambar/Manager/Pelatihan/{{$item->judul}}/Video/{{$item->video}}" type="video/mp4">
                                                        </video>
                                                    </div>
                                                    <div class="col-6">
                                                        <b>{{$item->deskripsi}}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-primary" href="/list_video_interview">Lihat Lebih banyak</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection