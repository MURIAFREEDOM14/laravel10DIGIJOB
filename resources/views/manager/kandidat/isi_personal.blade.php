@extends('layouts.manager')
@section('content')
    @include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="mx-auto">PERSONAL BIO DATA</h4>
                </div>
                <div class="row">
                    <h6 class="mx-auto mb-4">Indonesia</h6>
                </div>
                <div class="">
                    <!-- form(post) ManagerKandidatController => simpan_personal -->
                    <form action="" method="POST">
                        @csrf
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ml-5">PERSONAL BIO DATA</h6> 
                                </div>
                            </div>
                            <!-- input kandidat nama -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->nama}}" name="nama" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input nama panggilan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Panggilan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_panggilan}}" placeholder="Maksimal 20 kata" name="nama_panggilan" id="inputPassword6" class="form-control @error('nama_panggilan') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nama_panggilan')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- pilihan jenis kelamin -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Jenis Kelamin</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="jenis_kelamin" required class="form-control" id="">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="M" @if ($kandidat->jenis_kelamin == "M") selected @endif>Laki-laki</option>
                                        <option value="F" @if ($kandidat->jenis_kelamin == "F") selected @endif>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input tempat & tanggal lahir -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tempat & Tanggal Lahir</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" placeholder="Masukkan Tempat Lahir" value="{{$kandidat->tmp_lahir}}" name="tmp_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    @if ($kandidat->tgl_lahir !== null)
                                        <input type="date" required value="{{$kandidat->tgl_lahir}}" name="tgl_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    @else
                                        <input type="date" required value="{{date('Y-m-d')}}" name="tgl_lahir" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    @endif
                                </div>
                            </div>
                            <!-- input no telp -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$kandidat->no_telp}}" name="no_telp" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- pilihan agama -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Agama</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="agama" class="form-control" id="">
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
                            <!-- input berat & tinggi -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Berat & Tinggi Badan</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" value="{{$kandidat->berat}}" placeholder="Masukkan berat badan" name="berat" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" value="{{$kandidat->tinggi}}" placeholder="Masukkan tinggi badan" name="tinggi" class="form-control">
                                </div>
                            </div>
                            <!-- input email -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" value="{{$kandidat->email}}" name="email" value="" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input status penempatan kerja -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Status Tempat Kerja</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="penempatan" class="form-control" id="">
                                        <option value="dalam negeri" @if ($kandidat->penempatan == "dalam negeri")
                                            selected
                                        @endif>Dalam Negeri</option>
                                        <option value="luar negeri" @if ($kandidat->penempatan == "luar negeri")
                                            selected
                                        @endif>Luar Negeri</option>
                                    </select>
                                </div>
                            </div>
                        <button class="btn btn-primary my-3" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection