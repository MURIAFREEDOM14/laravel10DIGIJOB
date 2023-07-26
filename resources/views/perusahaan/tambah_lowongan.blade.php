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
                            <label for="" class="col-form-label">Level Pekerja</label>
                        </div>
                        <div class="col-md-6">
                            <select name="" class="form-control" id="">
                                <option value="">-- Tentukan Level Pekerja --</option>
                                <option value="">Magang</option>
                                <option value="">Karyawan / Staff</option>
                                <option value="">Manager</option>
                                <option value="">Direktur</option>
                                <option value="">SEO</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Spesifikasi Pekerjaan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="jabatan" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Job Deskripsi</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="" id="" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Mata Uang Gaji</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="" id="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Informasi Gaji</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="" id="" placeholder="Gaji Minimum" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="" id="" placeholder="Gaji Maksimum" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Benefit Pekerjaan</label>
                        <div class="row gutters-xs">
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="dark" class="colorinput-input">
                                    <span class="">Cuti Tahunan</span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="primary" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="secondary" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="info" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="success" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="danger" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="colorinput">
                                    <input name="color" type="checkbox" value="warning" class="colorinput-input">
                                    <span class=""></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="penempatan" class="form-control" id="" @if ($perusahaan->penempatan_kerja == "Dalam negeri")
                                value="Indonesia"
                            @else
                            @endif>
                        </div>
                    </div>
                    <div class="form-check">
                        <div class="row mb-3">   
                            <div class="col-4">
                                <label>Area Rekrut Pekerja</label>
                            </div>  
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
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-4">
                            <input type="date" name="ttp_lowongan" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Tanggal Interview</label>
                        </div>
                        <div class="col-4">
                            <input type="date" name="tgl_interview" class="form-control" id="">
                        </div>
                    </div>
                    <span class="">Disarankan untuk tanggal interview minimal 1-2 hari setelah berlakunya masa lamaran</span>
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