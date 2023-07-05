@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Edit Pekerjaan</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nama Pekerjaan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nama_pekerjaan" value="{{$pekerjaan->nama_pekerjaan}}" required class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Syarat Umur</label>
                        </div>
                        <div class="col-2">
                            <input type="number" name="syarat_umur" value="{{$pekerjaan->syarat_umur}}" required class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Syarat Kelamin</label>
                        </div>
                        <div class="col-8">
                            <select name="syarat_kelamin" required class="form-control" id="">
                                <option value="">-- Pilih Syarat Kelamin --</option>
                                <option value="M" @if ($pekerjaan->syarat_kelamin == "M")
                                    selected
                                @endif>Laki-laki</option>
                                <option value="F" @if ($pekerjaan->syarat_kelamin == "F")
                                    selected
                                @endif>Perempuan</option>
                                <option value="MF" @if ($pekerjaan->syarat_kelamin == "MF")
                                    selected
                                @endif>Laki-laki & Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/perusahaan/pekerjaan/{{$kerjaid}}/{{$id}}">Kembali</a>
                    <button class="btn btn-warning" type="submit">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection