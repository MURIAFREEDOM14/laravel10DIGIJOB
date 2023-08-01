@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: bold">Edit Lowongan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
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
                            <label for="" class="col-form-label">Pendidikan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <select name="pendidikan" required class="form-control" id="">
                                <option value="">-- Pilih Tingkatan Pendidikan --</option>
                                <option value="Tidak sekolah" @if ($lowongan->pendidikan == "Tidak sekolah")
                                    selected
                                @endif>Tanpa Ijazah</option>
                                <option value="SD" @if ($lowongan->pendidikan == "SD")
                                    selected
                                @endif>SD Sederajat / Kejar Paket A</option>
                                <option value="SMP" @if ($lowongan->pendidikan == "SMP")
                                    selected
                                @endif>SMP Sederajat / Kejar Paket B</option>
                                <option value="SMA" @if ($lowongan->pendidikan == "SMA")
                                    selected
                                @endif>SMA Sederajat / Kejar Paket C</option>
                                <option value="Diploma" @if ($lowongan->pendidikan == "Diploma")
                                    selected
                                @endif>Diploma</option>
                                <option value="Sarjana" @if ($lowongan->pendidikan == "Sarjana")
                                    selected
                                @endif>Sarjana</option>
                                <option value="Master" @if ($lowongan->pendidikan == "Master")
                                    selected
                                @endif>Master, phD</option>
                                <option value="Doctoral" @if ($lowongan->pendidikan == "Doctoral")
                                    selected
                                @endif>Doctoral</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Usia Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="usia" value="{{$lowongan->usia}}" class="form-control" id="">
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
                            <label for="" class="col-form-label">Berat Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="berat" value="{{$lowongan->berat}}" placeholder="Masukkan Berat" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" name="tinggi" value="{{$lowongan->tinggi}}" placeholder="Masukkan Tinggi" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Spesifikasi Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="jabatan" value="{{$lowongan->jabatan}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Level Pekerja</label>
                        </div>
                        <div class="col-md-6">
                            <select name="lvl_pekerjaan" required class="form-control" id="">
                                <option value="">-- Tentukan Level Pekerja --</option>
                                <option value="magang" @if ($lowongan->lvl_pekerjaan == "magang")
                                    selected
                                @endif>Magang</option>
                                <option value="karyawan" @if ($lowongan->lvl_pekerjaan == "karyawan")
                                    selected
                                @endif>Karyawan / Staff</option>
                                <option value="manager" @if ($lowongan->lvl_pekerjaan == "manager")
                                    selected
                                @endif>Manager</option>
                                <option value="direktur" @if ($lowongan->lvl_pekerjaan == "direktur")
                                    selected
                                @endif>Direktur</option>
                                <option value="seo" @if ($lowongan->lvl_pekerjaan == "seo")
                                    selected
                                @endif>SEO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Job Deskripsi</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="deskripsi" id="" class="form-control">{{$lowongan->isi}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Flyer (jika ada)</label>
                        </div>
                        <div class="col-md-8">
                            @if ($lowongan->gambar_lowongan !== null)
                                <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/" class="img" alt="">
                                <input type="file" name="gambar" class="form-control" id="" accept="image/*">                                
                            @else
                                <input type="file" name="gambar" class="form-control" id="" accept="image/*">                                                                
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label">Benefit Pekerjaan</label>
                            </div>
                            <div class="col-md-8">
                                <div class="selectgroup selectgroup-pills">
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="benefit[]" value="cuti tahunan" class="selectgroup-input">
                                        <span class="selectgroup-button">Cuti Tahunan</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="benefit[]" value="gaji lembur" class="selectgroup-input">
                                        <span class="selectgroup-button">Gaji Lembur</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="benefit[]" value="asuransi" class="selectgroup-input">
                                        <span class="selectgroup-button">Asuransi</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="benefit[]" value="transportasi" class="selectgroup-input">
                                        <span class="selectgroup-button">Transportasi</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="row mb-3">   
                            <div class="col-4">
                                <label>Area Rekrut Pekerja</label>
                            </div>  
                            <label class="form-radio-label">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->kota}}" checked="">
                                <span class="form-radio-sign">Se-Kabupaten /  Kota</span>
                            </label>
                            <label class="form-radio-label ml-3">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->provinsi}}">
                                <span class="form-radio-sign">Se-Provinsi</span>
                            </label>
                            <label class="form-radio-label ml-3">
                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="Se-indonesia">
                                <span class="form-radio-sign">Se-Indonesia</span>
                            </label>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-8">
                            <select name="penempatan" class="form-control" id="negara_tujuan">
                                <option value="">-- Pilih Negara Penempatan --</option>
                                @foreach ($negara as $item)                                    
                                    <option value="{{$item->negara_id}}" @if ($item->negara == $lowongan->negara)
                                        selected
                                    @endif>{{$item->negara}}</option>                                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Informasi Gaji</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend" id="">
                                  <span class="input-group-text" id="mata_uang1">{{$lowongan->mata_uang}}</span>
                                </div>
                                <input type="text" name="gaji_minimum" value="{{$lowongan->gaji_minimum}}" id="" placeholder="Gaji Minimum" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="mata_uang2">{{$lowongan->mata_uang}}</span>
                                </div>
                                <input type="text" name="gaji_maksimum" value="{{$lowongan->gaji_maksimum}}" id="" placeholder="Gaji Maksimum" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-4">
                            <input type="date" name="ttp_lowongan" value="{{$lowongan->ttp_lowongan}}" class="form-control" id="">
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
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection