@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="text-transform: uppercase">Isi Pesan</h5>
            </div>
            <div class="card-body">
                <p class="text-justify" style="border: 2px solid #1572e8; border-radius:5%; padding-left:10px; padding-right:10px; padding-top:10px; padding-bottom:10px;">{{$pengirim->pesan}}</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <b>Jawab pesan</b>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            Nama Pengirim
                        </div>
                        <div class="col-8">
                            <input type="text" disabled class="form-control" value="{{$kandidat->nama}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            Kepada
                        </div>
                        <div class="col-8">
                            <input type="text" disabled class="form-control" value="{{$pengirim->pengirim}}" id="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Kirim Pesanmu disini</label>
                        <textarea name="pesan" required id="" class="form-control"></textarea>
                    </div>
                    <a href="/semua_pesan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection