@extends('layouts.manager')

@section('content')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="mx-auto">PERSONAL BIO DATA</h4>
                </div>
                <div class="">                    
                    <h6 class="text-center mb-4">Indonesia</h6>
                    <!-- form(post) ManagerKandidatController => simpan_document -->
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-4">DOCUMENT BIO DATA</h6> 
                                </div>
                            </div>
                            <!-- input NIK -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">NIK</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required name="nik" maxlength="16" value="{{$kandidat->nik}}" id="inputPassword6" class="form-control @error('nik') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pilihan pendidikan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Pendidikan Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pendidikan" class="form-control" id="">
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
                            <div class="row my-3 g-3 align-items-center">
                                <div class="col">
                                    <label for="" aria-colcount="col-form-label">Alamat</label>
                                </div>
                            </div>
                            <!-- menggunakan livewire -->
                            <!-- lokasi livewire : app/Http/Livewire/Manager/Location -->
                            <!-- lokasi livewire lokasi : resources/views/livewire/manager/location -->
                            @livewire('manager.location')
                            <!-- input rt & rw -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">RT / RW</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rt}}" placeholder="Masukkan RT" name="rt" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rw}}" placeholder="Masukkan RW" name="rw" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input foto ktp -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto KTP</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp == "")
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                    @elseif ($kandidat->foto_ktp !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP/{{$kandidat->foto_ktp}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                    @else
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_ktp')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto kk -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Kartu Keluarga</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_kk == "")
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                    @elseif ($kandidat->foto_kk !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KK/{{$kandidat->foto_kk}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">
                                    @else
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_kk')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto set badan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Setengah Badan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_set_badan == '')
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                    @elseif($kandidat->foto_set_badan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">
                                    @else
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_set_badan')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto 4x6 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto 4x6</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_4x6 == '')
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                    @elseif ($kandidat->foto_4x6 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">
                                    @else
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_4x6')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto ket lahir -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Akta Kelahiran / Keterangan Lahir</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ket_lahir == "")
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                    @elseif ($kandidat->foto_ket_lahir !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ket_lahir/{{$kandidat->foto_ket_lahir}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">
                                    @else
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_ket_lahir')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- input foto ijazah -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Foto Ijazah Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ijazah == "")
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                    @elseif ($kandidat->foto_ijazah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/ijazah/{{$kandidat->foto_ijazah}}" width="120px" height="150px" alt="">
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">
                                    @else
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                    @endif
                                    @error('foto_ijazah')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <!-- pilihan status nikah -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Status Pernikahan</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="stats_nikah" class="form-control" id="">
                                        <option value="Single" @if ($kandidat->stats_nikah == "Single") selected @endif>Single</option>
                                        <option value="Menikah" @if ($kandidat->stats_nikah == "Menikah") selected @endif>Menikah</option>
                                        <option value="Cerai hidup" @if ($kandidat->stats_nikah == "Cerai hidup") selected @endif>Cerai Hidup</option>
                                        <option value="Cerai mati" @if ($kandidat->stats_nikah == "Cerai mati") selected @endif>Cerai Mati</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    
@endsection