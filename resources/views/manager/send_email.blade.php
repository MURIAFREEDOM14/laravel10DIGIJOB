@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 style="text-transform: uppercase">Kirim Ulang Email</h3>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nama Pengguna</label>
                        </div>
                        <div class="col-8">
                            @if ($pengguna->type == 2)
                                <input type="text" name="nama" disabled class="form-control" value="{{$pengguna->name_perusahaan}}" id="">                            
                            @elseif($pengguna->type == 1)
                                <input type="text" name="nama" disabled class="form-control" value="{{$pengguna->name_akademi}}" id="">
                            @elseif($pengguna->type == 0)
                                <input type="text" name="nama" disabled class="form-control" value="{{$pengguna->name}}" id="">
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Email</label>
                        </div>
                        <div class="col-8">
                            <input type="email" name="email" hidden value="{{$pengguna->email}}" id="">
                            <input type="email" name="email" disabled class="form-control" value="{{$pengguna->email}}" id="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <label for="" class="col-form-label">Tipe Email</label>
                        </div>
                        <div class="col-8">
                            <select name="type" class="form-control" id="">
                                <option value="0">Email Verifikasi</option>
                                <option value="1">Email Pembayaran</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Email</button>
                </form>
            </div>
        </div>
    </div>
@endsection