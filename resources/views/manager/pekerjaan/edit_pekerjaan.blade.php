@extends('layouts.manager')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-header">
                        Edit Data Pekerjaan
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Nama Pekerjaan</label>
                                <div class="col-md-9 p-0">
                                    <input type="text" value="{{$pekerjaan->nama_pekerjaan}}" name="nama_pekerjaan" required class="form-control input-full" id="inlineinput" placeholder="Masukkan Nama Pekerjaan">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Syarat Umur</label>
                                <div class="col-md-9 p-0">
                                    <input type="number" value="{{$pekerjaan->syarat_umur}}" name="syarat_umur" required class="form-control input-full" id="inlineinput" placeholder="Masukkan Syarat Umur">
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Syarat Kelamin</label>
                                <div class="col-md-9 p-0">
                                    <select name="syarat_kelamin" required class="form-control" id="">
                                        <option value="">-- Pilih Syarat Kelamin --</option>
                                        <option value="M" @if ($pekerjaan->syarat_kelamin == "M")
                                            selected
                                        @endif>Hanya Laki-laki</option>
                                        <option value="F" @if ($pekerjaan->syarat_kelamin == "F")
                                            selected
                                        @endif>Hanya Perempuan</option>
                                        <option value="MF" @if ($pekerjaan->syarat_kelamin == "MF")
                                            selected
                                        @endif>Laki-laki & Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group form-inline">
                                <label for="inlineinput" class="col-md-3 col-form-label">Masukkan Nama Negara</label>
                                <div class="col-md-9 p-0">
                                    <select name="negara_id" class="form-control" required id="">
                                        <option value="">-- Pilih Nama Negara --</option>
                                        @foreach ($negara as $item)
                                            <option value="{{$item->negara_id}}" @if ($pekerjaan->negara_id == $item->negara_id)
                                                selected
                                            @endif>{{$item->negara}}</option>                                            
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="float-right">
                                <button type="submit" class="btn btn-warning mt-3">Ubah</button>
                                <a class="btn btn-danger mt-3">Batal</a>    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection