@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Buat Surat Izin
            </div>
            <div class="card-body">
                <!-- form(post) ManagerController => simpanSuratIzin -->
                <form action="" method="POST">
                    @csrf
                    <!-- input nama lengkap -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nama Lengkap</b>
                        </div>
                        <div class="col-8">
                            <input type="text" required name="nama" value="{{old('nama')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input nama panggilan -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nama Panggilan</b>
                        </div>
                        <div class="col-8">
                            <input type="text" required name="nama_panggilan" value="{{old('nama_panggilan')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- pilihan jenis kelamin -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Jenis Kelamin</b>
                        </div>
                        <div class="col-8">
                            <select name="jk" required class="form-control" id="">
                                <option value="">-- Masukkan Jenis Kelamin --</option>
                                <option value="M">Laki - laki</option>
                                <option value="F">Perempuan</option>
                            </select>
                        </div>
                    </div>
                    <!-- input tempat & tanggal lahir -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Tempat / Tanggal Lahir</b>
                        </div>
                        <div class="col-4">
                            <input type="text" required name="tmp_lahir" value="{{old('tmp_lahir')}}" class="form-control" id="">
                        </div>
                        <div class="col-4">
                            <input type="date" required name="tgl_lahir" value="{{old('tgl_lahir')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input no. telp -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">No. Telp</b>
                        </div>
                        <div class="col-8">
                            <input type="number" name="no_telp" value="{{old('no_telp')}}" class="form-control @error('no_telp') is-invalid @enderror" id="">
                        </div>
                        @error('no_telp')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- pilihan agama -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Agama</b>
                        </div>
                        <div class="col-8">
                            <select name="agama" required class="form-control" id="">
                                <option value="">-- Pilih Agama --</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="katolik">Katolik</option>
                                <option value="hindu">Hindu</option>
                                <option value="buddha">Buddha</option>
                                <option value="konghucu">Konghucu</option>
                                <option value="aliran_kepercayaan">Aliran Kepercayaan</option>
                            </select>
                        </div>
                    </div>
                    <!-- input email -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Email</b>
                        </div>
                        <div class="col-8">
                            <input type="text" required name="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" id="">
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- pilihan status nikah -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="" class="col-form-label">Status Pernikahan</label>
                        </div>
                        <div class="col-4">
                            <select name="stats_nikah" class="form-control" id="">
                                <option value="Single">Single</option>
                                <option value="Menikah">Menikah</option>
                                <option value="Cerai hidup">Cerai Hidup</option>
                                <option value="Cerai mati">Cerai Mati</option>
                            </select>
                        </div>
                    </div>
                    <!-- plihan penempatan negara -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Penempatan Kerja</b>
                        </div>
                        <div class="col-8">
                            <select name="negara_id" required class="form-control" id="">
                                <option value="">-- Pilih Negara --</option>
                                @foreach ($negara as $item)
                                    <option value="{{$item->negara_id}}">{{$item->negara}}</option>                                    
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!-- input NIK -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">NIK</b>
                        </div>
                        <div class="col-8">
                            <input type="number" name="nik" value="{{old('nik')}}" class="form-control @error('nik') is-invalid @enderror" id="">
                        </div>
                        @error('nik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                        @enderror
                    </div>
                    <!-- menggunakan livewire -->
                    <!-- lokasi livewire : app/Http/Livewire/Manager/Permission -->
                    <!-- lokasi livewire view : resources/views/livewire/manager/permission -->
                    @livewire('permission')
                    <!-- input rt & rw -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">RT / RW</b>
                        </div>
                        <div class="col-4">
                            <input type="number" placeholder="Masukkan RT" name="rt" value="{{old('rt')}}" class="form-control" id="">
                        </div>
                        <div class="col-4">
                            <input type="number" placeholder="Masukkan RW" name="rw" value="{{old('rw')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input nama pemberi izin /  kontak darurat -->
                    <div class="row mb-3">
                        <div class="col-4">
                            <b class="bold">Nama Pemberi Izin</b>
                        </div>
                        <div class="col-8">
                            <input type="text" name="nama_perizin" value="{{old('nama_perizin')}}" class="form-control" id="">
                        </div>
                    </div>
                    <!-- input NIK Perizin / NIK kontak darurat -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">NIK Perizin</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik_perizin" value="{{old('nik_perizin')}}" id="inputPassword6" class="form-control @error('nik_perizin') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                            @error('nik_perizin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Harap isi no. nik 16 digit</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- input no. telp perizin / kontak darurat -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">No. Telp / HP</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="no_telp_perizin" value="{{old('no_telp_perizin')}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                            @error('no_telp_perizin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Harap isi no. telp min 10 digit dan max 13 digit</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- input tempat & tanggal lahir perizin / kontak darurat -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tempat / Tanggal Lahir Perizin</label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="tmp_lahir_perizin" value="{{old('tmp_lahir_perizin')}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                        </div>
                        <div class="col-md-4">
                            <input type="date" name="tgl_lahir_perizin" value="{{old('tgl_lahir_perizin')}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                        </div>
                    </div>
                    <!-- input alamat perizin / kontak darurat -->
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Alamat Lengkap Perizin</label>
                        </div>
                    </div>
                    <!-- menggunakan livewire -->
                    <!-- lokasi livewire : app/Http/Livewire/Manager/PermissionKandidat -->
                    <!-- lokasi livewire view : resources/views/livewire/manager/permission-kandidat -->
                    @livewire('permission-kandidat')
                    <!-- input rt & rw -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">RT / RW</label>
                        </div>
                        <div class="col-md-4">
                            <input type="number" required placeholder="Masukkan RT" name="rt_perizin" value="{{old('rt_perizin')}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                        </div>
                        <div class="col-md-4">
                            <input type="number" required placeholder="Masukkan RW" name="rw_perizin" value="{{old('rw_perizin')}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                        </div>
                    </div>
                    <!-- input hubungan pemberi izin -->
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Hubungan Pemberi Izin</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="hubungan_perizin" value="{{old('hubungan_perizin')}}" placeholder="Masukkan hubungan. contoh: ayah, ibu, suami, anak, dll." id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/manager/surat_izin">Kembali</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection