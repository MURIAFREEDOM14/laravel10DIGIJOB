@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-4">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="document">
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
                                    <input type="number" disabled placeholder="Masukkan NIK 16 digit angka" required name="nik" pattern="[0-9]{16}" value="{{$kandidat->nik}}" id="inputPassword6" class="form-control @error('nik') is-invalid @enderror" aria-labelledby="passwordHelpInline">
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
                                    <select name="pendidikan" required class="form-select" id="">
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
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Lengkap</label>
                                </div>
                                {{-- <div class="col-md-8">
                                    <input name="dusun" value="{{$kandidat->dusun}}" class="form-control" id="" cols="" rows="">
                                </div> --}}
                            </div>
                            @livewire('akademi.location')
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Dusun</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="dusun" value="{{$kandidat->dusun}}" class="form-control" id="" cols="" rows="">
                                </div>
                            </div>
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
                                        <input type="file" required name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ktp !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP/{{$kandidat->foto_ktp}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ktp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ktp" id="inputPassword6" class="form-control @error('foto_ktp') is_invalid @enderror" accept="image/*">                                        
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
                                    <label for="inputPassword6" class="col-form-label">Foto Setengah Badan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_set_badan == "")
                                        <input type="file" required name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif($kandidat->foto_set_badan !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">
                                        @error('foto_set_badan')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_set_badan" id="inputPassword6" class="form-control @error('foto_set_badan') is_invalid @enderror" accept="image/*">                                        
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
                                        <input type="file" required name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_4x6 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/4x6/{{$kandidat->foto_4x6}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">
                                        @error('foto_4x6')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_4x6" id="inputPassword6" class="form-control @error('foto_4x6') is_invalid @enderror" accept="image/*">                                        
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
                                        <input type="file" required name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ket_lahir !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Ket_lahir/{{$kandidat->foto_ket_lahir}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">
                                        @error('foto_ket_lahir')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ket_lahir" id="inputPassword6" class="form-control @error('foto_ket_lahir') is_invalid @enderror" accept="image/*">                                        
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
                                        <input type="file" required name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ijazah !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/ijazah/{{$kandidat->foto_ijazah}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file" required name="foto_ijazah" id="inputPassword6" class="form-control @error('foto_ijazah') is_invalid @enderror" accept="image/*">                                        
                                        @error('foto_ijazah')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <a class="btn btn-warning" href="/akademi/isi_kandidat_vaksin/{{$kandidat->nama}}/{{$kandidat->id}}">Lewati</a>
                            <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                        </div>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection