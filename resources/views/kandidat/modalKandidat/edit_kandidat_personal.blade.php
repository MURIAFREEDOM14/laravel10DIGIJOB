@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5" id="container">
        <div class="">
            <div class="">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <!-- form(post) KandidatController => simpan_kandidat_personal -->
                    <form action="/isi_kandidat_personal" method="POST">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">PROFIL BIO DATA</h6> 
                                </div>
                            </div>
                            <!-- input nama -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Lengkap</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$user->name}}" name="nama" id="nama" class="form-control" disabled aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input nama panggilan -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Panggilan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" disabled value="{{$kandidat->nama_panggilan}}" placeholder="Maksimal 10 kata" name="nama_panggilan" id="panggilan" class="form-control @error('nama_panggilan') is-invalid @enderror" aria-labelledby="passwordHelpInline">
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
                                    <select name="jenis_kelamin" required class="form-select" id="jenis_kelamin">
                                        <option value="">-- Pilih Jenis Kelamin --</option>
                                        <option value="M" @if ($kandidat->jenis_kelamin == "M") selected @endif>Laki-laki</option>
                                        <option value="F" @if ($kandidat->jenis_kelamin == "F") selected @endif>perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input tempat lahir -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tempat Lahir</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" required placeholder="Masukkan Tempat Lahir" value="{{$kandidat->tmp_lahir}}" name="tmp_lahir" id="tmp_lahir" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input tanggal lahir -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tanggal Lahir</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" required value="{{$kandidat->tgl_lahir}}" name="tgl_lahir" id="tgl_lahir" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- input no. telp -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">No Telepon</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="number" disabled value="{{$user->no_telp}}" name="no_telp" id="telp" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                            </div>
                            <!-- pilihan agama -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Agama</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="agama" required class="form-select" id="agama">
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
                                    <div class="input-group">
                                        <input type="number" required value="{{$kandidat->berat}}" placeholder="Masukkan berat badan" name="berat" class="form-control" id="berat">
                                        <span class="input-group-text" id="basic-addon2">Kg</span> 
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="number" required value="{{$kandidat->tinggi}}" placeholder="Masukkan tinggi badan" name="tinggi" class="form-control" id="tinggi">
                                        <span class="input-group-text" id="basic-addon2">Cm</span>                                     
                                    </div>
                                </div>
                            </div>
                            <!-- input email -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" disabled required value="{{$user->email}}" name="email" id="email" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <!-- link ubah password -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <a href="/edit_kandidat_password" class="btn btn-primary">Edit Password</a>
                                </div>
                            </div>
                        </div>
                        <hr>
                        {{-- <a class="btn btn-warning" href="{{route('document')}}">Lewati</a> --}}
                        <button class="btn btn-primary float-end" id="btn" type="submit" onclick="processing()">Selanjutnya</button>
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
        var jenis_kelamin = document.getElementById('jenis_kelamin').value;
        var tmp_lahir = document.getElementById('tmp_lahir').value;
        var tgl_lahir = document.getElementById('tgl_lahir').value;
        var agama = document.getElementById('agama').value;
        var berat = document.getElementById('berat').value;
        var tinggi = document.getElementById('tinggi').value;
        if (jenis_kelamin !== '' &&
            tmp_lahir !== '' &&
            tgl_lahir !== '' &&
            agama !== '' &&
            berat !== '' &&
            tinggi !== '') {
            var submit = document.getElementById('btn').style.display = 'none';
            var btnLoad = document.getElementById('btnload').style.display = 'block';
        }
    }
    
</script>   
@endsection