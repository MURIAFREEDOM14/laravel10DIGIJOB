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
                            <label for="" class="col-form-label">Nama Perusahaan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled name="nama" class="form-control" value="{{$pembayaran->nama_pembayaran}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">No. NIB</label>
                        </div>
                        <div class="col-8">
                            <input type="text" disabled name="nib" class="form-control" value="{{$pembayaran->nib}}" id="">
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
                                <img src="/gambar/Perusahaan/{{$pembayaran->nama_pembayaran}}/Pembayaran/{{$pembayaran->foto_pembayaran}}" width="300" height="300" alt="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="" class="col-form-label">Status Pembayaran</label>
                            </div>
                            <div class="col-4">
                                <select name="stats_pembayaran" required class="form-control" id="">
                                    <option value="">-- Konfirmasi / Kirim ulang --</option>
                                    <option value="belum dibayar" >Kirim Ulang Bukti</option>
                                    <option value="sudah dibayar" >Konfirmasi Pembayaran</option>
                                </select>
                            </div>
                        </div>
                        @if ($pembayaran->stats_pembayaran !== "sudah dibayar")
                            <button class="btn btn-success" type="submit">Konfirmasi</button>                            
                        @endif 
                    @endif                    
                    <a class="btn btn-danger" href="/manager/payment/perusahaan">Batal</a>
                </form>
            </div>
        </div>
    </div>
@endsection