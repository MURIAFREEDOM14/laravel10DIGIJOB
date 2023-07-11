@extends('layouts.manager')
@section('content')
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
                            <b class="bold">Nama Perusahaan</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nama_perusahaan" class="form-control" value="{{$pembayaran->nama_perusahaan}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">No. NIB</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="no_nib" class="form-control" value="{{$pembayaran->nib}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nominal Pembayaran</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nominal_pembayaran" class="form-control" value="{{$pembayaran->nominal_pembayaran}}" id="">
                        </div>
                    </div>
                    @if ($pembayaran->foto_pembayaran !== null)
                        <div class="row mb-3">
                            <div class="col-4">
                                <b class="bold">Foto Pembayaran</b>
                            </div>
                            <div class="col-8">
                                @if ($pembayaran->foto_pembayaran !== null)
                                    <img src="/gambar/perusahaan/{{$pembayaran->nama_pembayaran}}/pembayaran/{{$pembayaran->foto_pembayaran}}" width="300" height="300" alt="">                                
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <b class="bold">Status Pembayaran</b>
                            </div>
                            <div class="col-4">
                                @if ($pembayaran->foto_pembayaran !== null)
                                    <select name="stats_pembayaran" class="form-control" id="">
                                        <option value="belum dibayar">Belum dibayar</option>
                                        <option value="sudah dibayar">Sudah dibayar</option>
                                    </select>                                
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-success" type="submit">Konfirmasi</button>
                    @else
                        <p>Maaf Perusahaan Ini belum Mengirimkan foto bukti pembayaran</p>
                    @endif                    
                    <a class="btn btn-danger" href="/manager/pembayaran/perusahaan">Batal</a>
                    <div class="" hidden>
                        @foreach ($interview as $item)
                            <input type="text" name="id_kandidat[]" id="" value="{{$item->id_kandidat}}">
                            <input type="text" name="id_perusahaan" id="" value="{{$item->id_perusahaan}}">
                            <input type="text" name="id_interview[]" id="" value="{{$item->id_interview}}">
                            <input type="text" name="nama[]" id="" value="{{$item->nama}}">
                        @endforeach
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
@endsection