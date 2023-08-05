@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: bold">Tambah Lowongan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-8">
                            <select name="penempatan" required class="form-control" id="negara_tujuan">
                                <option value="">-- Pilih Negara Penempatan --</option>
                                @foreach ($negara as $item)                                    
                                    <option value="{{$item->negara}}">{{$item->negara}}</option>                                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Judul Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="jabatan" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jenis Pekerja</label>
                        </div>
                        <div class="col-md-6">
                            @if ($perusahaan->penempatan_kerja == "Dalam negeri")
                                <select name="lvl_pekerjaan" required class="form-control" id="">
                                    <option value="">-- Tentukan Jenis Pekerja --</option>
                                    <option value="magang">Magang</option>
                                    <option value="karyawan">Karyawan / Staff</option>
                                    <option value="manager">Manager</option>
                                    <option value="direktur">Direktur</option>
                                    <option value="ceo">CEO</option>
                                </select>
                            @elseif($perusahaan->penempatan_kerja == "Luar negeri")
                                <select name="lvl_pekerjaan" required class="form-control" id="">
                                    <option value="">-- Tentukan Jenis Pekerja --</option>
                                    @foreach ($jenis_pekerjaan as $item)
                                        <option value="{{$item->judul}}">{{$item->judul}}</option>
                                    @endforeach
                                </select>
                            @endif  
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Deskripsi Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="deskripsi" required id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Flyer (jika ada)</label>
                        </div>
                        <div class="col-md-8">
                            <input type="file" name="gambar" class="form-control" id="" accept="image/*">
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
                                <option value="Tidak sekolah">Tanpa Ijazah</option>
                                <option value="SD">SD Sederajat / Kejar Paket A</option>
                                <option value="SMP">SMP Sederajat / Kejar Paket B</option>
                                <option value="SMA">SMA Sederajat / Kejar Paket C</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Sarjana">Sarjana</option>
                                <option value="Master">Master, phD</option>
                                <option value="Doctoral">Doctoral</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Syarat Usia</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required placeholder="Usia Minimal" name="usia_min" class="form-control" id="">
                        </div>
                        <div class="col-md-4">
                            <input type="number" required placeholder="Usia Maksimal" name="usia_maks" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pengalaman Bekerja</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="pengalaman_kerja" value="non"  checked="">
                                    <span class="form-radio-sign">Non</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="pengalaman_kerja" value="ex">
                                    <span class="form-radio-sign">Ex / Berpengalaman</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required name="tinggi" placeholder="Masukkan Tinggi" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Syarat Berat Badan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required name="berat_min" placeholder="Berat Minimal" class="form-control" id="">
                        </div>
                        <div class="col-md-4">
                            <input type="number" required name="berat_maks" placeholder="Berat Maksimal" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="col-form-label">Area Rekrut Pekerja</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">                               
                                @if ($perusahaan->penempatan_kerja == "Dalam negeri")
                                    <label class="form-radio-label">
                                        <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->kota}}"  checked="">
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
                                @elseif($perusahaan->penempatan_kerja == "Luar negeri")
                                    <label class="form-radio-label ml-3">
                                        <input class="form-radio-input" type="radio" name="pencarian_tmp" value="Se-indonesia" checked="">
                                        <span class="form-radio-sign">Se-Indonesia</span>
                                    </label>    
                                @endif    
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 style="font-weight:bold">Fasilitas</h5>
                        </div>
                    </div>
                    <hr>
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
                                    <label class="selectgroup-item">
                                        <input type="checkbox" name="benefit[]" value="transportasi" class="selectgroup-input">
                                        <span class="selectgroup-button">Akomodasi</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Informasi Gaji</label>
                        </div>
                        <div class="col-4">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend" id="">
                                  <span class="input-group-text" id="mata_uang1"></span>
                                </div>
                                <input type="text" required name="gaji_minimum" id="" placeholder="Gaji Minimum" class="form-control">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="mata_uang2"></span>
                                </div>
                                <input type="text" required name="gaji_maksimum" id="" placeholder="Gaji Maksimum" class="form-control">
                            </div>
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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="ttp_lowongan" class="form-control" id="">
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