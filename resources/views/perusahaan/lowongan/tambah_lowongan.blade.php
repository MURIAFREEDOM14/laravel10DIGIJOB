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
                <!-- form(post) perusahaanRecruitmentController => simpanLowongan -->
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- pilihan penempatan pekerja -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Penempatan Kerja</label>
                        </div>
                        <div class="col-md-9">
                            <select name="penempatan" required class="form-control" id="negara_tujuan">
                                <!-- apabila lowongan dalam negeri -->
                                @if ($type == "dalam")
                                    <option value="">-- Pilih Provinsi --</option>
                                    @foreach ($provinsi as $item)
                                        <option value="{{$item->provinsi}}">{{$item->provinsi}}</option>                                        
                                    @endforeach
                                @else
                                    <option value="">-- Pilih Negara Penempatan --</option>                                    
                                    @foreach ($negara as $item)
                                        <option value="{{$item->negara}}">{{$item->negara}}</option>                                                                        
                                    @endforeach    
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- input judul pekerjaan -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Judul Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" required name="jabatan" value="{{old('jabatan')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- pilihan jenis pekerja -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Jenis Pekerja</label>
                        </div>
                        <div class="col-md-6">
                            <!-- apabila lowongan dalam negeri -->
                            @if ($type == "dalam")
                                <select name="lvl_pekerjaan" required class="form-control" id="">
                                    <option value="">-- Tentukan Jenis Pekerja --</option>
                                    <option value="magang">Magang</option>
                                    <option value="karyawan">Karyawan / Staff</option>
                                    <option value="manager">Manager</option>
                                    <option value="direktur">Direktur</option>
                                    <option value="ceo">CEO</option>
                                </select>
                            <!-- apabila perusahaan menempatkan pekerja ke luar negeri -->
                            @elseif($perusahaan->penempatan_kerja == "Luar negeri")
                                <!-- pilihan jenis pekerja -->
                                <select name="lvl_pekerjaan" required class="form-control" id="jenisPekerjaan">
                                    <option value="">-- Tentukan Jenis Pekerja --</option>
                                    @foreach ($jenis_pekerjaan as $item)
                                        <option value="{{$item->judul}}">{{$item->judul}}</option>
                                    @endforeach
                                    <option value="lainnya">Lainnya</option>
                                </select>
                                <!-- input tambah pilihan jenis pekerja -->
                                <input type="text" name="judul_jenis_pekerja" class="form-control mt-2" placeholder="Judul jenis pekerja" id="judulJenisPekerja">
                                <input type="text" name="nama_jenis_pekerja" class="form-control mt-2" placeholder="Keterangan jenis pekerja" id="namaJenisPekerja">
                                <button id="btnJenisPekerja" class="btn btn-primary mt-2" type="button">Tambah</button>
                            @endif  
                        </div>
                    </div>
                    <!-- input deskripsi -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Deskripsi Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <textarea name="deskripsi" required id="" class="form-control">{{old('deskripsi')}}</textarea>
                        </div>
                    </div>
                    <!-- input gambar flyer -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Flyer (jika ada)</label>
                        </div>
                        <div class="col-md-9">
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
                    <!-- pilihan syarat jenis kelamin -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-5">
                            <select name="jenis_kelamin" required class="form-control" id="">
                                <option value="">-- Pilih jenis kelamin --</option>
                                <option value="M">Laki-laki</option>
                                <option value="F">Perempuan</option>
                                <option value="MF">Laki-laki & Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <!-- pilihan tingkat pendidikan -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Pendidikan Minimal</label>
                        </div>
                        <div class="col-md-5">
                            <select name="pendidikan" required class="form-control" id="">
                                <option value="">-- Pilih Tingkatan Pendidikan --</option>
                                <option value="Tidak_sekolah">Tanpa Ijazah</option>
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
                    <!-- input syarat usia min & maks -->
                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Syarat Usia</label>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <input type="number" required placeholder="Usia Minimal" name="usia_min" value="{{old('usia_min')}}" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-2">
                            <div class="input-group">
                                <input type="number" required placeholder="Usia Maksimal" name="usia_maks" value="{{old('usia_maks')}}" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Tahun</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- apabila lowongan luar negeri -->
                    @if ($type == "luar")
                        <!-- input pengalaman kerja -->
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="" class="col-form-label">Pengalaman Bekerja</label>
                            </div>
                            <div class="col-md-9">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="pengalaman_kerja[]" value="non" checked>
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">Non</span>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="pengalaman_kerja[]" value="ex">
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">Ex</span>
                                </div>
                            </div>
                        </div>    
                    @endif
                    <!-- input tinggi badan -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tinggi Badan Minimal</label>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="number" required name="tinggi" value="{{old('tinggi')}}" placeholder="Masukkan Tinggi Badan" class="form-control" id="">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">Cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- pilihan syarat berat badan min & maks -->  
                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Syarat Berat Badan</label>
                        </div>
                        <div class="col-md-4">
                            <select name="berat_badan" id="ideal" class="form-control">
                                <option value="ideal">Ideal</option>
                                <option value="kustom">Kustom</option>
                            </select>
                            <!-- input apabila meng-kustom berat badan min & maks -->
                            <div class="mt-2" id="random">
                                <div class="mb-2">
                                    <div class="input-group">
                                        <input type="number" name="berat_min" value="{{old('berat_min')}}" placeholder="Berat Badan Minimal" class="form-control" id="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <div class="input-group">
                                        <input type="number" name="berat_maks" value="{{old('berat_maks')}}" placeholder="Berat Badan Maksimal" class="form-control" id="">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="basic-addon2">Kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- input area rekrut pekerja -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="col-form-label">Area Rekrut Pekerja</label>
                        </div>
                        <div class="col-md-9">
                            <div class="form-check">                               
                                <!-- apabila lowongan dalam negeri -->
                                @if ($type == "dalam")
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-radio-label">
                                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->kota}}"  checked="">
                                                <span class="form-radio-sign">Se-Kabupaten /  Kota</span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="{{$perusahaan->provinsi}}">
                                                <span class="form-radio-sign">Se-Provinsi</span>
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-radio-label ml-3">
                                                <input class="form-radio-input" type="radio" name="pencarian_tmp" value="Se-indonesia">
                                                <span class="form-radio-sign">Se-Indonesia</span>
                                            </label>
                                        </div>
                                    </div>
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
                    <!-- input fasilitas yang disediakan oleh perusahaan -->
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="form-label">Fasilitas Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="komunikasi">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Komunikasi</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="makanan">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Makanan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                  <div class="input-group-text">
                                    <input type="checkbox" name="fasilitas[]" value="tempat tinggal">
                                  </div>
                                </div>
                                <span class="selectgroup-button">Tempat Tinggal</span>
                            </div>
                            <!-- menampilkan data fasilitas dari perusahaan -->
                            @foreach ($fasilitas as $item)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="fasilitas[]" value="{{$item->fasilitas}}">
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">{{$item->fasilitas}}</span>
                                </div>    
                            @endforeach
                            <!-- input tambah fasilitas dari perusahaan -->
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
                    <!-- input benefit yang didapat dari perusahaan -->
                    <div class="row mb-3">
                        <div class="col-md-3 mb-2">
                            <label for="" class="col-form-label">Informasi Gaji </label>
                        </div>
                        <!-- input gaji min -->
                        <div class="col-md-4 mb-2">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend" id="">
                                  <span class="input-group-text" id="mata_uang1"></span>
                                </div>
                                <input type="number" required name="gaji_minimum" value="{{old('gaji_minimum')}}" id="" placeholder="Gaji Minimum" class="form-control">
                            </div>
                        </div>
                        <!-- input gaji maks -->
                        <div class="col-md-4 mb-2">
                            <div class="input-group flex-nowrap">
                                <div class="input-group-prepend">
                                  <span class="input-group-text" id="mata_uang2"></span>
                                </div>
                                <input type="number" required name="gaji_maksimum" value="{{old('gaji_maksimum')}}" id="" placeholder="Gaji Maksimum" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!-- input benefit lainnya yang didapat dari perusahaan -->
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Benefit Pekerjaan</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="libur mingguan">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Libur Mingguan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="libur tahunan">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Libur Tahunan</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="uang lembur">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Uang Lembur</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="cuti sakit">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Cuti Sakit</span>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                    <input type="checkbox" name="benefit[]" value="asuransi">
                                    </div>
                                </div>
                                <span class="selectgroup-button">Asuransi</span>
                            </div>
                            <!-- apabila lowongan luar negeri -->
                            @if ($type == "luar")
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                        <input type="checkbox" name="benefit[]" value="tiket pulang">
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">Tiket Pulang Sehabis Kontrak</span>
                                </div>    
                            @endif
                            <!-- menampilkan data benefit dari perusahaan -->
                            @foreach ($benefit as $item)
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" name="benefit[]" value="{{$item->benefit}}">
                                        </div>
                                    </div>
                                    <span class="selectgroup-button">{{$item->benefit}}</span>
                                </div>    
                            @endforeach
                            <!-- menambah data benefit dari perusahaan -->
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
                    <!-- kode undangan perusahaan -->                  
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Kode Undangan</label>
                        </div>
                        <div class="col-md-9">
                            <input type="text" name="" disabled class="form-control" value="{{$perusahaan->referral_code}}" id="">
                        </div>
                    </div>
                    <hr>
                    <!-- input tanggal tutup lowongan -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" required name="ttp_lowongan" value="{{old('ttp_lowongan')}}" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <!-- input tanggal inteview awal & interview akhir -->
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Awal Interview</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tgl_interview_awal" value="{{old('tgl_interview_awal')}}" placeholder="Tanggal Interview Awal" required class="form-control" id="">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="col-form-label">Tanggal Akhir Interview</label>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tgl_interview_akhir" value="{{old('tgl_interview_akhir')}}" placeholder="Tanggal Interview Akhir" required class="form-control" id="">
                        </div>
                    </div>
                    <a href="/perusahaan/list/lowongan/{{$type}}" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection