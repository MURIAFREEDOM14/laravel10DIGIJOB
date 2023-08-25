@extends('layouts.perusahaan')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="font-weight: bold">Edit Lowongan</h4>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-9">
                            <select name="penempatan" required class="form-control" id="negara_tujuan">
                                <option value="">-- Pilih Negara Penempatan --</option>
                                @if ($type == "dalam")
                                    <option value="{{$negara->negara}}" @if ($lowongan->negara == $negara->negara)
                                        selected
                                    @endif>{{$negara->negara}}</option>
                                @else
                                    @foreach ($negara as $item)                                    
                                        <option value="{{$item->negara}}" @if ($lowongan->negara == $item->negara)
                                            selected
                                        @endif>{{$item->negara}}</option>                                                                        
                                    @endforeach    
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Judul Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" required name="jabatan" value="{{$lowongan->jabatan}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Jenis Pekerja</label>
                        </div>
                        <div class="col-md-6">
                            @if ($type == "dalam")
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
                                    @foreach ($negara as $item)                                    
                                        <option value="{{$item->negara}}" @if ($lowongan->negara == $item->negara)
                                            selected
                                        @endif>{{$item->negara}}</option>                                                                        
                                    @endforeach
                                </select>
                            @endif  
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Deskripsi Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="deskripsi" required id="" class="form-control">{{$lowongan->isi}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Flyer (jika ada)</label>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-8">
                                <img src="/gambar/Perusahaan/{{$perusahaan->nama_perusahaan}}/Lowongan Pekerjaan/{{$lowongan->gambar_lowongan}}" style="width: 50%; height:auto;" class="mb-2" alt="">
                                <input type="file" name="gambar" class="form-control" id="" accept="image/*">
                            </div>
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
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-5">
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
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Pendidikan Minimal</label>
                        </div>
                        <div class="col-md-5">
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
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Syarat Usia</label>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <input type="number" required placeholder="Usia Minimal" name="usia_min" value="{{$lowongan->usia_min}}" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <input type="number" required placeholder="Usia Maksimal" name="usia_maks" value="{{$lowongan->usia_maks}}" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($type == "luar")
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="" class="col-form-label">Pengalaman Bekerja</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="pengalaman_kerja[]" value="non" aria-label="Checkbox for following text input" checked>
                                    </div>
                                    </div>
                                    <span class="selectgroup-button">Non</span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="pengalaman_kerja[]" value="ex" aria-label="Checkbox for following text input">
                                    </div>
                                    </div>
                                    <span class="selectgroup-button">Ex</span>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" required name="tinggi" value="{{$lowongan->tinggi}}" placeholder="Masukkan Tinggi Badan" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Cm</span>
                                </div>
                            </div>
                        </div>
                    </div>  
                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Syarat Berat Badan</label>
                        </div>
                        <div class="col-md-4">
                            <select name="berat_badan" id="ideal" class="form-control">
                                <option value="ideal">Ideal</option>
                                <option value="kustom">Kustom</option>
                            </select>
                            <div class="mt-2" id="random">
                                <div class="mb-2">
                                    <div class="input-group">
                                        <input type="number" name="berat_min" value="{{$lowongan->berat_min}}" placeholder="Berat Badan Minimal" class="form-control" id="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="input-group">
                                        <input type="number" name="berat_maks" value="{{$lowongan->berat_maks}}" placeholder="Berat Badan Maksimal" class="form-control" id="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Area Rekrut Pekerja</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-check">                               
                                @if ($type == "dalam")
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
                                @elseif($type == "luar")
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
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Fasilitas Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="komunikasi" aria-label="Checkbox for following text input">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Komunikasi</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="makanan" aria-label="Checkbox for following text input">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Makanan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="tempat tinggal" aria-label="Checkbox for following text input">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Tempat Tinggal</span>
                            </div>
                            @foreach ($fasilitas as $item)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="fasilitas[]" value="{{$item->fasilitas}}" aria-label="Checkbox for following text input">
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">{{$item->fasilitas}}</span>
                                </div>    
                            @endforeach
                            <div class="">
                                <button class="btn btn-primary" type="button" onclick="btnTambahFasilitas()" id="tambahFasilitas">Tambah Fasilitas</button>
                                <div class="" id="fasilitasTambah">
                                    <input type="text" name="" class="form-control mb-2" id="inputFasilitas">
                                    <button class="btn btn-primary" type="button" onclick="opsiFasilitas()">Tambah</button>
                                    <button class="btn btn-danger" type="button" onclick="batalFasilitas()">Batal</button>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5 style="font-weight:bold">Benefits</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Informasi Gaji </label>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend" id="">
                                  <span class="input-group-text" id="mata_uang1">{{$lowongan->mata_uang}}</span>
                                </div>
                                <input type="number" required name="gaji_minimum" value="{{$lowongan->gaji_minimum}}" id="" placeholder="Gaji Minimum" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="mata_uang2">{{$lowongan->mata_uang}}</span>
                                </div>
                                <input type="number" required name="gaji_maksimum" value="{{$lowongan->gaji_maksimum}}" id="" placeholder="Gaji Maksimum" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Benefit Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="libur mingguan" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Libur Mingguan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="libur tahunan" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Libur Tahunan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="uang lembur" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Uang Lembur</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="cuti sakit" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Cuti Sakit</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="asuransi" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Asuransi</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="tiket pulang" aria-label="Checkbox for following text input">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Tiket Pulang Sehabis Kontrak</span>
                            </div>
                            @foreach ($benefit as $item)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <input type="checkbox" name="benefit[]" value="{{$item->benefit}}" aria-label="Checkbox for following text input">
                                    </div>
                                    </div>
                                    <span class="selectgroup-button">{{$item->benefit}}</span>
                                </div>    
                            @endforeach
                            <div class="">
                                <button class="btn btn-primary" type="button" onclick="btnTambahBenefit()" id="tambahBenefit">Tambah Benefit</button>
                                <div class="" id="benefitTambah">
                                    <input type="text" name="" class="form-control mb-2" id="inputBenefit">
                                    <button class="btn btn-primary" type="button" onclick="opsiBenefit()">Tambah</button>
                                    <button class="btn btn-danger" type="button" onclick="batalBenefit()">Batal</button>                                        
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>                  
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Kode Undangan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="" disabled class="form-control" value="{{$perusahaan->referral_code}}" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" required name="ttp_lowongan" value="{{$lowongan->ttp_lowongan}}" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Awal Interview</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tgl_interview_awal" value="{{$lowongan->tgl_interview_awal}}" placeholder="Tanggal Interview Awal" required class="form-control" id="">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Akhir Interview</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tgl_interview_akhir" value="{{$lowongan->tgl_interview_akhir}}" placeholder="Tanggal Interview Akhir" required class="form-control" id="">
                        </div>
                    </div>
                    <a href="/perusahaan/list/lowongan/{{$type}}" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection