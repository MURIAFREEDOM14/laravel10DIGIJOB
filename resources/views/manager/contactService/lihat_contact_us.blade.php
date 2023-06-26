@extends('layouts.contact_service')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Balas Pesan
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            Nama Pengirim
                        </div>
                        <div class="col-8">
                            <input type="text" disabled class="form-control" value="{{$kandidat->dari}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            Alamat Email
                        </div>
                        <div class="col-8">
                            <input type="text" disabled class="form-control" value="{{$contact_us->email}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            No. Telp
                        </div>
                        <div class="col-8">
                            <input type="text" disabled class="form-control" value="{{$contact_us->no_telp}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            Isi Pesan
                        </div>
                        <div class="col-8">
                            <textarea disabled id="" class="form-control">{{$contact_us->isi}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            Balas Pesan
                        </div>
                        <div class="col-8">
                            <textarea name="balas" required id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/manager/contact_us">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim</button>    
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                Riwayat Pesan
            </div>
            <div class="card-body">

            </div>
        </div>
    </div>
@endsection