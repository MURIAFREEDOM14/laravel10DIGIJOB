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
                                                    <img src="/gambar/Kandidat/4x6/{{$kandidat->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                                
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
                                            <b>Mari Atasi sikap gugupmu dan tambahkan rasa percaya dirimu dengan Pelatihan Interview Secara Gratis</b> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- @foreach ($interview as $item) --}}
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="/gambar/default_user.png" width="100" height="100" alt="">
                                                    </div>
                                                    <div class="col">
                                                        Video 1
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="/gambar/default_user.png" width="100" height="100" alt="">
                                                    </div>
                                                    <div class="col">
                                                        Video 2
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <img src="/gambar/default_user.png" width="100" height="100" alt="">                                                    
                                                    </div>
                                                    <div class="col">
                                                        Video 3
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection