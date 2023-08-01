@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Tambah Pekerjaan</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Nama Pekerjaan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nama_pekerjaan" required class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Syarat Umur</label>
                        </div>
                        <div class="col-8">
                            <input type="text" placeholder="( contoh 18 sampai 40 )" name="syarat_umur" required class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Syarat Kelamin</label>
                        </div>
                        <div class="col-8">
                            <select name="syarat_kelamin" required class="form-control" id="">
                                <option value="">-- Pilih Syarat Kelamin --</option>
                                <option value="M">Laki-laki</option>
                                <option value="F">Perempuan</option>
                                <option value="MF">Laki-laki & Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/perusahaan/pekerjaan/{{$id}}/{{$nama}}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
@endsection