@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b>Kirim pesan</b>
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
                        <textarea name="pesan" id="" class="form-control"></textarea>
                    </div>
                    <a href="/semua_pesan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-success">Kirim</button>
                </div>
            </form>
        </div>
    </div>
@endsection