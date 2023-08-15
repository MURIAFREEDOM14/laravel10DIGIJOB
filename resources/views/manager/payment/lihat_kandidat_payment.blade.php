@extends('layouts.payment')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b style="text-transform: uppercase">Cek Pembayaran</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nama Kandidat</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled name="nama" class="form-control" value="{{$pembayaran->nama_pembayaran}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">No. NIK</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled name="nik" class="form-control" value="{{$pembayaran->nik}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nominal Pembayaran</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled name="nominal_pembayaran" class="form-control" value="{{$pembayaran->nominal_pembayaran}}" id="">
                        </div>
                    </div>
                    @if ($pembayaran->foto_pembayaran !== null)
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label">Foto Pembayaran</label>
                            </div>
                            <div class="col-8">
                                <img src="/gambar/Kandidat/{{$pembayaran->nama_pembayaran}}/pembayaran/{{$pembayaran->foto_pembayaran}}" width="300" height="300" alt="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label">Status Pembayaran</label>
                            </div>
                            <div class="col-4">
                                <select name="stats_pembayaran" class="form-control" id="">
                                    <option value="belum dibayar">Belum dibayar</option>
                                    <option value="sudah dibayar">Sudah dibayar</option>
                                </select>
                            </div>
                        </div> 
                        <button class="btn btn-success" type="submit">Konfirmasi</button>
                    @endif                    
                    <a class="btn btn-danger" href="/manager/payment/kandidat">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection