@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-header">
                        Tambah Data Pekerjaan
                    </div>
                    <div class="card-body">
                        <form action="/manager/tambah_pekerjaan" method="POST">
                            @csrf
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Nama Pekerjaan</label>
                                <div class="col-md-9 p-0">
                                    <input type="text" name="nama_pekerjaan" required class="form-control input-full" id="inlineinput" placeholder="Masukkan Nama Pekerjaan">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Syarat Umur</label>
                                <div class="col-md-9 p-0">
                                    <input type="number" name="syarat_umur" required class="form-control input-full" id="inlineinput" placeholder="Masukkan Syarat Umur">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Syarat Kelamin</label>
                                <div class="col-md-9 p-0">
                                    <select name="syarat_kelamin" required class="form-control" id="">
                                        <option value="">-- Pilih Syarat Kelamin --</option>
                                        <option value="M">Hanya Laki-laki</option>
                                        <option value="F">Hanya Perempuan</option>
                                        <option value="MF">Laki-laki & Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Nama Negara</label>
                                <div class="col-md-9 p-0">
                                    <select name="negara_id" class="form-control" required id="">
                                        <option value="">-- Pilih Nama Negara --</option>
                                        @foreach ($negara as $item)
                                            <option value="{{$item->negara_id}}">{{$item->negara}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-success mt-3">Tambah</button>
                                <a href="/manager/pekerjaan" class="btn btn-danger mt-3">Batal</a>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection