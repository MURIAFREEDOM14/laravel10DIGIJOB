@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: bold">Tambah Lowongan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    {{-- <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tema Lowongan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="nama_lowongan" class="form-control" id="">
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Negara Tujuan</label>
                        </div>
                        <div class="col-md-8">
                            <select name="negara_id" class="form-control" id="">
                                <option value="">-- Pilih Negara --</option>
                                @foreach ($negara as $item)
                                    <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Isi Lowongan</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="isi" required id="" class="form-control"></textarea>
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jabatan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" required name="jabatan" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 style="font-weight:bold">Persyaratan</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-4">
                            <select name="jenis_kelamin" required class="form-control" id="">
                                <option value="">-- Pilih jenis kelamin --</option>
                                <option value="M">Laki-laki</option>
                                <option value="F">Perempuan</option>
                                <option value="MF">Laki-laki & Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pendidikan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <select name="pendidikan" required class="form-control" id="">
                                <option value="">-- Pilih Tingkatan Pendidikan --</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA">SMA</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Sarjana">Sarjana</option>
                                <option value="Tidak sekolah">Tidak Sekolah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Usia Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="usia" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pengalaman Bekerja</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="pengalaman_kerja" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Berat Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="berat" placeholder="Masukkan Berat" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="tinggi" placeholder="Masukkan Tinggi" class="form-control" id="">
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="row mb-3">   
                            <div class="col-4">
                                <label>Kriteria Lokasi</label>
                            </div>  
                            <label class="form-radio-label">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->kota}}"  checked="">
                                <span class="form-radio-sign">Kabupaten</span>
                            </label>
                            <label class="form-radio-label ml-3">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->provinsi}}">
                                <span class="form-radio-sign">Provinsi</span>
                            </label>
                            <label class="form-radio-label ml-3">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="Se-indonesia">
                                <span class="form-radio-sign">Se-Indonesia</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-4">
                            <input type="date" name="ttp_lowongan" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Kode Undangan</label>
                        </div>
                        <div class="col-8">
                            <input type="text" name="" disabled class="form-control" value="{{$perusahaan->referral_code}}" id="">
                        </div>
                    </div>
                    <hr>
                    <a href="/perusahaan/list/lowongan" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection