@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal')}}">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('document')}}">Documen</a>
                    </li>
                    <li class="nav-item">
                        @if($kandidat->stats_nikah == null)
                            <a class="nav-link disabled" href="{{route('family')}}">Keluarga</a>
                        @elseif($kandidat->stats_nikah !== "Single")
                            <a class="nav-link" href="{{route('family')}}">Keluarga</a>                          
                        @else
                            <a class="nav-link disabled" href="{{route('family')}}">Keluarga</a>                          
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaksin')}}">Vaksin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('parent')}}">Orang tua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('company')}}">Pengalaman Kerja</a>
                    </li>                          
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permission')}}">Izin Keluarga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('paspor')}}">Paspor</a>
                    </li>
                    @if ($kandidat->penempatan == "luar negeri")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('placement')}}">Penempatan</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('placement')}}">Penempatan</a>
                        </li>
                    @endif
                    {{-- @if ($kandidat->negara_id == 2)
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('job')}}">Job</a>
                        </li>                        
                    @else
                        @if ($kandidat->negara_id == null)
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{route('job')}}">Job</a>
                            </li>    
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('job')}}">Job</a>
                            </li>                            
                        @endif
                    @endif --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/">Selesai</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-4" style="text-transform: uppercase">
                        @if ($kandidat->penempatan == null)
                        @else
                            {{$kandidat->penempatan}}
                        @endif
                    </h6>
                    <form action="/isi_kandidat_document" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-4">DOCUMENT BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIK</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" placeholder="Masukkan NIK 16 digit angka" required name="nik" pattern="[0-9]{16}" value="{{$kandidat->nik}}" id="inputPassword6" class="form-control @error('nik') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nik')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>NIK harus berisi 16 digit angka</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Pendidikan Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="pendidikan" class="form-select" id="">
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
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Lengkap</label>
                                </div>
                                {{-- <div class="col-md-8">
                                    <input name="alamat" value="{{$kandidat->alamat}}" class="form-control" id="" cols="" rows="">
                                </div> --}}
                            </div>
                            @livewire('location')
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">RT / RW</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rt}}" placeholder="Masukkan RT" name="rt" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rw}}" placeholder="Masukkan RW" name="rw" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto KTP</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp == "")
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ktp !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP/{{$kandidat->foto_ktp}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Kartu Keluarga</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_kk == "")
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_kk !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KK/{{$kandidat->foto_kk}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_kk" id="inputPassword6" class="form-control @error('foto_kk') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_kk')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Setengah Badan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_set_badan == "")
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif($kandidat->foto_set_badan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto 4x6</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_4x6 == "")
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_4x6 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Akta Kelahiran / Keterangan Lahir</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ket_lahir == "")
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ket_lahir !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ket_lahir/{{$kandidat->foto_ket_lahir}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Ijazah Terakhir</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ijazah == "")
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ijazah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/ijazah/{{$kandidat->foto_ijazah}}" width="150" height="150" alt="">
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Status Pernikahan</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="stats_nikah" class="form-select" id="">
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