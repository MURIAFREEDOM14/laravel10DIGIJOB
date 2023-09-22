@extends('layouts.akademi')
@section('content')
    <div class="mx-3 mt-5 my-5">
        <div class="card">
            <div class="card-header">
                <h5 style="text-transform: uppercase"></h5>
            </div>
            <div class="card-body">
                <p class="text-justify" style="border: 0.1px solid black; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px;">{{$pengirim->pesan}}</p>
                <a class="btn btn-danger float-right" href="/akademi/hapus_pesan/{{$id}}" onclick="hapusData(event)"><i class="fas fa-trash"></i></a>
                <a href="/akademi/semua_pesan" class="btn btn-danger float-left"><- Kembali</a>
            </div>
        </div>
    </div>
@endsection