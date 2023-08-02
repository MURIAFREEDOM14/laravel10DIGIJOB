@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                galeri
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <video id="video" class="img">
                            <source class="" src="/gambar/Kandidat/{{$kandidat->nama_kandidat}}/Pengalaman Kerja/{{$video->video}}">
                        </video>
                        <button class="btn btn-success mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                    </div>
                    <div class="col-md-6">
                        <b class="bold">Nama Pengalaman Kerja : {{$kandidat->nama_perusahaan}}</b>
                        <hr>
                        <b class="bold">Alamat Pengalaman Kerja : {{$kandidat->alamat_perusahaan}}</b>
                        <hr>
                        <b class="bold">Jabatan : {{$kandidat->jabatan}}</b>
                        <hr>
                        <b class="bold">Periode : {{date('d-M-Y',strtotime($kandidat->periode_awal))}} Sampai {{date('d-M-Y',strtotime($kandidat->periode_akhir))}}</b>
                        <hr>
                        <b class="bold">Alasan Berhenti : {{$kandidat->alasan_berhenti}}</b>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    .col-
                </div>
            </div>
        </div>
    </div>
@endsection