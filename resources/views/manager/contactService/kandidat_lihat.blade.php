@extends('layouts.contact_service')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h4><b class="bold">Kepada {{$kandidat->dari}}</b></h4>
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
                            Isi Pesan
                        </div>
                        <div class="col-8">
                            <textarea disabled id="" class="form-control">{{$kandidat->isi}}</textarea>
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