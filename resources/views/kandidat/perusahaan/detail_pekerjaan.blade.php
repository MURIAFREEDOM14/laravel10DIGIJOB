@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Informasi Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Nama Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: {{($pekerjaan->nama_pekerjaan)}}</b></div>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Syarat Umur</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: 
                                @if($pekerjaan->syarat_umur !== null)
                                    {{$pekerjaan->syarat_umur}}
                                @else
                                    Tidak ada batasan                            
                                @endif
                                </b>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div  class="row">
                        <div class="col-md-3">
                            <label for="" class="">Syarat Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            <div class=""><b class="bold">: 
                                @if($pekerjaan->syarat_kelamin == "M")
                                Laki-laki
                                @elseif($pekerjaan->syarat_kelamin == "F")
                                Perempuan
                                @else
                                Laki-laki & Perempuan
                                @endif
                                </b>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="/kandidat" class="btn btn-danger">Kembali</a>
                    @if ($kandidat->id_perusahaan == null)
                        <button type="submit" class="btn btn-primary float-right" onclick="return confirm('apakah anda ingin masuk pekerjaan ini?')">Melamar</button>                        
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection