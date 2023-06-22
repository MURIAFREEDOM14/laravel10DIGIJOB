@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: bold">Edit Lowongan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tema Lowongan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="nama_lowongan" class="form-control" id="" value="{{$lowongan->nama_lowongan}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Isi Lowongan</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="isi" required id="" class="form-control">{{$lowongan->isi}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jabatan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" required name="jabatan" class="form-control" id="" value="{{$lowongan->jabatan}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h5 style="font-weight:bold">Persyaratan</h5>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-4">
                            <select name="jenis_kelamin" required class="form-control" id="">
                                <option value="">-- Pilih jenis kelamin --</option>
                                <option value="M" @if ($lowongan->jenis_kelamin == "M")
                                    selected
                                @endif>Laki-laki</option>
                                <option value="F" @if ($lowongan->jenis_kelamin == "F")
                                    selected
                                @endif>Perempuan</option>
                                <option value="MF" @if ($lowongan->jenis_kelamin == "MF")
                                    selected
                                @endif>Laki-laki & Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pendidikan</label>
                        </div>
                        <div class="col-md-4">
                            <select name="pendidikan" required class="form-control" id="">
                                <option value="">-- Pilih Tingkatan Pendidikan --</option>
                                <option value="SD" @if ($lowongan->pendidikan == "SD")
                                    selected
                                @endif>SD</option>
                                <option value="SMP" @if ($lowongan->pendidikan == "SMP")
                                    selected                                    
                                @endif>SMP</option>
                                <option value="SMA" @if ($lowongan->pendidikan == "SMA")
                                    selected                                    
                                @endif>SMA</option>
                                <option value="Diploma" @if ($lowongan->pendidikan == "Diploma")
                                    selected                                    
                                @endif>Diploma</option>
                                <option value="Sarjana" @if ($lowongan->pendidikan == "Sarjana")
                                    selected                                    
                                @endif>Sarjana</option>
                                <option value="Tidak sekolah" @if ($lowongan->pendidikan == "Tidak sekolah")
                                    selected
                                @endif>Tidak Sekolah</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Usia</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="usia" class="form-control" id="" value="{{$lowongan->usia}}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pengalaman Bekerja</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="pengalaman_kerja" id="" class="form-control">{{$lowongan->pengalaman_kerja}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Berat / Tinggi Badan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="berat" placeholder="Masukkan Berat" class="form-control" id="" value="{{$lowongan->berat}}">
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="tinggi" placeholder="Masukkan Tinggi" class="form-control" id="" value="{{$lowongan->tinggi}}">
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
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="">
                                <span class="form-radio-sign">Se-Indonesia</span>
                            </label>
                        </div>
                    </div>
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
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection