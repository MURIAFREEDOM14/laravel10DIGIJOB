@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="text-transform: uppercase"></h5>
            </div>
            <div class="card-body">
                <p class="text-justify" style="border: 2px solid #1572e8; border-radius:5%; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px;">{{$pengirim->pesan}}</p>
                <a class="btn btn-danger float-right" href="/hapus_pesan/{{$id}}" onclick="hapusData(event)"><i class="fas fa-trash"></i></a>
                <a href="/semua_pesan" class="btn btn-danger float-left"><- Kembali</a>
            </div>
        </div>
    </div>
@endsection