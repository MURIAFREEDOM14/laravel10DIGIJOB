@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    {{-- <h6 class="text-center mb-4" style="text-transform: uppercase">
                        @if ($negara == null)
                        @else
                            {{$negara}}
                        @endif
                    </h6> --}}
                    <form action="/isi_kandidat_personal" method="POST">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">PROFIL BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$user->name}}" name="nama" id="inputPassword6" class="form-control" disabled aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Panggilan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled value="{{$kandidat->nama_panggilan}}" placeholder="Maksimal 10 kata" name="nama_panggilan" id="inputPassword6" class="form-control @error('nama_panggilan') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nama_panggilan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="jenis_kelamin" required class="form-select" id="">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="M" @if ($kandidat->jenis_kelamin == "M") selected @endif>Laki-laki</option>
                                        <option value="F" @if ($kandidat->jenis_kelamin == "F") selected @endif>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat & Tanggal Lahir</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" required placeholder="Masukkan Tempat Lahir" value="{{$kandidat->tmp_lahir}}" name="tmp_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" required value="{{$kandidat->tgl_lahir}}" name="tgl_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" disabled value="{{$user->no_telp}}" name="no_telp" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        {{-- <div class="input-group-append">
                                            <a class="btn btn-warning" href="/edit_kandidat_no_telp" id="button-addon2">Ubah</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Agama</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="agama" required class="form-select" id="">
                                        <option value="">-- Pilih Agama --</option>
                                        <option value="islam" @if ($kandidat->agama == "islam") selected @endif>Islam</option>
                                        <option value="kristen" @if ($kandidat->agama == "kristen") selected @endif>Kristen</option>
                                        <option value="katolik" @if ($kandidat->agama == "katolik") selected @endif>Katolik</option>
                                        <option value="hindu" @if ($kandidat->agama == "hindu") selected @endif>Hindu</option>
                                        <option value="buddha" @if ($kandidat->agama == "buddha") selected @endif>Buddha</option>
                                        <option value="konghucu" @if ($kandidat->agama == "konghucu") selected @endif>Konghucu</option>
                                        <option value="aliran_kepercayaan" @if ($kandidat->agama == "aliran_kepercayaan") selected @endif>Aliran Kepercayaan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Berat & Tinggi Badan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->berat}}" placeholder="Masukkan berat badan" name="berat" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->tinggi}}" placeholder="Masukkan tinggi badan" name="tinggi" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" disabled required value="{{$user->email}}" name="email" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-primary" onclick="passwordBtn()">Ganti Password Baru</button>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" id="newPassword1" class="col-form-label">Password baru</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="password" placeholder="Harap ingat password anda" id="newPassword2" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <a class="btn btn-warning" href="{{route('document')}}">Lewati</a>
                        <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>    
@endsection