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
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-8">
                            <select name="penempatan" required class="form-control" id="negara_tujuan">
                                <option value="">-- Pilih Negara Penempatan --</option>
                                @foreach ($negara as $item)                                    
                                    <option value="{{$item->negara}}" @if ($lowongan->negara == $item->negara)
                                        selected
                                    @endif>{{$item->negara}}</option>                                                                        
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Judul Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="jabatan" value="{{$lowongan->jabatan}}" class="form-control" id="">
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
                                    <option value="ceo" @if ($lowongan->lvl_pekerjaan == "ceo")
                                        selected
                                    @endif>CEO</option>
                                </select>
                            @elseif($perusahaan->penempatan_kerja == "Luar negeri")
                                <select name="lvl_pekerjaan" required class="form-control" id="">
                                    <option value="">-- Tentukan Jenis Pekerja --</option>
                                    @foreach ($jenis_pekerjaan as $item)
                                        <option value="{{$item->nama}}" @if ($lowongan->jenis_pekerjaan == $item->jenis_pekerjaan)
                                            selected
                                        @endif>{{$item->nama}}</option>
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
                            <textarea name="deskripsi" required id="" class="form-control">{{$lowongan->isi}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Flyer (jika ada)</label>
                        </div>
                        <div class="col-md-8">
                            <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" style="width: 50%; height:auto;" class="mb-2" alt="">
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
                            <label for="" class="col-form-label">Syarat Usia</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" value="{{$lowongan->usia_min}}" required placeholder="Usia Minimal" name="usia_min" class="form-control" id="">
                        </div>
                        <div class="col-md-4">
                            <input type="number" value="{{$lowongan->usia_maks}}" required placeholder="Usia Maksimal" name="usia_maks" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pengalaman Bekerja</label>
                        </div>
                        <div class="col-md-8">
                            <div class="form-check">
                                <label class="form-radio-label">
                                    <input class="form-radio-input" type="radio" name="optionsRadios" value="non" checked="">
                                    <span class="form-radio-sign">Non</span>
                                </label>
                                <label class="form-radio-label ml-3">
                                    <input class="form-radio-input" type="radio" name="optionsRadios" value="EX">
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
                            <input type="number" value="{{$lowongan->tinggi}}" name="tinggi" placeholder="Masukkan Tinggi" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Syarat Berat Badan</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required value="{{$lowongan->berat_min}}" name="berat_min" placeholder="Berat Minimal" class="form-control" id="">
                        </div>
                        <div class="col-md-4">
                            <input type="number" required value="{{$lowongan->berat_maks}}" name="berat_maks" placeholder="Berat Maksimal" class="form-control" id="">
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
                                <input type="text" class="form-control mb-3" disabled {{$lowongan->benefit}} id="">
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
                            <input type="date" value="{{$lowongan->ttp_lowongan}}" name="ttp_lowongan" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <a href="/perusahaan/lihat_lowongan/{{$lowongan->id_lowongan}}" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-warning">Ubah</button>
                </form>
            </div>
        </div>
    </div>
@endsection