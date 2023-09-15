@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="">
            <div class="">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <!-- form(post) KandidatController => simpan_kandidat_document -->
                    <form action="/isi_kandidat_document" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="document">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-4">DOCUMENT BIO DATA</h6> 
                                </div>
                            </div>
                            <!-- input nik -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">NIK</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" disabled placeholder="Masukkan NIK 16 digit angka" required name="nik" pattern="[0-9]{16}" value="{{$kandidat->nik}}" id="nik" class="form-control @error('nik') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>NIK harus berisi 16 digit angka</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- input pendidikan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Pendidikan Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pendidikan" required class="form-select" id="pendidikan">
                                        <option value="">-- Pilih Pendidikan --</option>
                                        <option value="SD" @if ($kandidat->pendidikan == "SD") selected @endif>SD</option>
                                        <option value="SMP" @if ($kandidat->pendidikan == "SMP") selected @endif>SMP</option>
                                        <option value="SMA" @if ($kandidat->pendidikan == "SMA") selected @endif>SMA</option>
                                        <option value="Diploma" @if ($kandidat->pendidikan == "Diploma") selected @endif>Diploma</option>
                                        <option value="Sarjana" @if ($kandidat->pendidikan == "Sarjana") selected @endif>Sarjana</option>
                                        <option value="Tidak_sekolah" @if ($kandidat->pendidikan == "Tidak_sekolah") selected @endif>Tidak Sekolah</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input alamat -->
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Alamat Lengkap</label>
                                </div>
                            </div>
                            <!-- menggunakan livewire -->
                            <!-- lokasi livewire : app/Http/Livewire/Kandidat/location -->
                            <!-- lokasi livewire view : resources/views/livewire/kandidat/location -->
                            @livewire('kandidat.location')
                            <!-- input rt & rw -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">RT</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" required value="{{$kandidat->rt}}" pattern="[0-3]{3}" placeholder="maks 3 digit" name="rt" id="rt" class="form-control @error('rt') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('rt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>No. RT harus berisi 3 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="col-form-label">RW</label>
                                </div>
                                <div class="col-md-2">
                                    <input type="number" required value="{{$kandidat->rw}}" pattern="[0-3]{3}" placeholder="maks 3 digit" name="rw" id="rw" class="form-control @error('rw') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('rw')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>No. RW harus berisi 3 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto ktp -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto KTP</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp == "")
                                        <input type="file" required name="foto_ktp" id="f_ktp" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ktp !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP/{{$kandidat->foto_ktp}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ktp" id="" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        <input type="text" name="" hidden id="f_ktp" value="foto_ktp">
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ktp" id="f_ktp" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input foto kk -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Kartu Keluarga</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_kk == "")
                                        <input type="file" required name="foto_kk" id="f_kk" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_kk !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KK/{{$kandidat->foto_kk}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_kk" id="" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">
                                        <input type="text" name="" hidden id="f_kk" value="foto_kk">
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_kk" id="f_kk" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input foto set. badan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Setengah Badan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_set_badan == "")
                                        <input type="file" required name="foto_set_badan" id="f_setBadan" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif($kandidat->foto_set_badan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_set_badan" id="" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">
                                        <input type="text" name="" hidden id="f_setBadan" value="foto_set_badan">
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_set_badan" id="f_setBadan" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input foto 4x6 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto 4x6</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_4x6 == "")
                                        <input type="file" required name="foto_4x6" id="f_4x6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_4x6 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_4x6" id="" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">
                                        <input type="text" name="" hidden id="f_4x6" value="foto_4x6">
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_4x6" id="f_4x6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input foto ket. lahir -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">
                                        Foto Akta Kelahiran / <br>
                                        Keterangan Lahir
                                    </label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ket_lahir == "")
                                        <input type="file" required name="foto_ket_lahir" id="f_ketLahir" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ket_lahir !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ket_lahir/{{$kandidat->foto_ket_lahir}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ket_lahir" id="" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">
                                        <input type="text" name="" hidden id="f_ketLahir" value="foto_ket_lahir">
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ket_lahir" id="f_ketLahir" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input foto ijazah -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Ijazah Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ijazah == "")
                                        <input type="file" required name="foto_ijazah" id="f_ijazah" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ijazah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ijazah/{{$kandidat->foto_ijazah}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ijazah" id="" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">
                                        <input type="text" name="" hidden id="f_ijazah" value="foto_ijazah">
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ijazah" id="f_ijazah" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <!-- input status nikah / perkawinan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Status Pernikahan</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="stats_nikah" class="form-select" id="stats_nikah">
                                        <option value="Single" @if ($kandidat->stats_nikah == "Single") selected @endif>Belum Kawin</option>
                                        <option value="Menikah" @if ($kandidat->stats_nikah == "Menikah") selected @endif>Kawin</option>
                                        <option value="Cerai hidup" @if ($kandidat->stats_nikah == "Cerai hidup") selected @endif>Cerai Hidup</option>
                                        <option value="Cerai mati" @if ($kandidat->stats_nikah == "Cerai mati") selected @endif>Cerai Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- <a class="btn btn-warning" href="{{route('family')}}">Lewati</a> --}}
                        <button class="btn btn-primary float-end" type="submit" id="btn" onclick="processing()">Selanjutnya</button>
                        <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <!-- fungsi tombol loading -->
    <script>
        function processing() {
            var pendidikan = document.getElementById('pendidikan').value;
            var provinsi = document.getElementById('provinsi').value;
            var kota = document.getElementById('kota').value;
            var kecamatan = document.getElementById('kecamatan').value;
            var kelurahan = document.getElementById('kelurahan').value;
            var dusun = document.getElementById('dusun').value;
            var rt = document.getElementById('rt').value;
            var rw = document.getElementById('rw').value;
            var stats_nikah = document.getElementById('stats_nikah').value;
            var fktp = document.getElementById('f_ktp').value;
            var fkk = document.getElementById('f_kk').value;
            var fsetBadan = document.getElementById('f_setBadan').value;
            var f4x6 = document.getElementById('f_4x6').value;
            var fketLahir = document.getElementById('f_ketLahir').value;
            var fijazah = document.getElementById('f_ijazah').value;
            if (pendidikan !== '' &&
                provinsi !== '' &&
                kota !== '' &&
                kecamatan !== '' &&
                kelurahan !== '' &&
                dusun !== '' &&
                rt !== '' &&
                rw !== '' &&
                stats_nikah !== '' &&
                fktp !== '' &&
                fkk !== '' &&
                fsetBadan !== '' &&
                f4x6 !== '' &&
                fketLahir !== '' &&
                fijazah !== '') {       
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    </script> 
@endsection