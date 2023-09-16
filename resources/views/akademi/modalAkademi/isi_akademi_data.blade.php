@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
            <div class="mb-4">
                <div class="">
                    <div class="row">
                        <h4 class="text-center">AKADEMI BIO DATA</h4>
                        <!-- form(post) AkademiController => simpan_akademi_data -->
                        <form action="/akademi/isi_akademi_data" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="" id="personal_biodata">
                                <div class="row mb-1">
                                    <div class="col-md">
                                        <h6 class="ms-4">AKADEMI BIO DATA</h6> 
                                    </div>
                                </div>
                                <!-- input nama akademi -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Nama Akademi</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" value="{{$akademi->nama_akademi}}" disabled name="nama_akademi" id="akademi" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input No. NIS -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">No. NIS</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" disabled value="{{$akademi->no_nis}}" name="no_nis" id="NIS" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input No. Surat Izin -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">No. Surat Izin </label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" required value="{{$akademi->no_surat_izin}}" name="no_surat_izin" id="suratIzin" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input telp akademi -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">No Telepon Akademi</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" required value="{{$akademi->no_telp_akademi}}" name="no_telp_akademi" id="telp" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input email -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Email</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="email" disabled value="{{$akademi->email}}" name="email" id="email" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <!-- input alamat akademi -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Alamat Akademi</label>
                                    </div>
                                </div>
                                <!-- menggunakan livewire -->
                                <!-- lokasi livewire : app/Http/Livewire/Akademi/Location -->
                                <!-- lokasi livewire view : resources/views/livewire/akademi/location -->
                                <div class="row mb-3 g-3 align-items-center">
                                    @livewire('akademi.location')
                                </div>
                                <!-- input foto akademi / sekolah -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Foto Akademi/Sekolah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($akademi->foto_akademi == "")
                                            <input type="file" required name="foto_akademi" id="f_akademi" class="form-control @error('foto_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                            @error('foto_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @elseif ($akademi->foto_akademi !== null)
                                            <img src="/gambar/Akademi/{{$akademi->nama_akademi}}/Foto Akademi/{{$akademi->foto_akademi}}" width="150" height="150" alt="" class="img mb-1">
                                            <input type="file" name="foto_akademi" id="inputPassword6" class="form-control @error('foto_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                            <input type="text" hidden name="" value="foto_akademi" id="f_akademi">
                                            @error('foto_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @else
                                            <input type="file" required name="foto_akademi" id="f_akademi" class="form-control @error('foto_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">
                                            @error('foto_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                                <!-- input logo akademi / sekolah -->
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="" class="col-form-label">Logo Akademi/Sekolah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($akademi->logo_akademi == "")
                                            <input type="file" required name="logo_akademi" id="l_akademi" class="form-control @error('logo_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                            @error('logo_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @elseif ($akademi->logo_akademi !== null)
                                            <img src="/gambar/Akademi/{{$akademi->nama_akademi}}/Logo Akademi/{{$akademi->logo_akademi}}" width="150" height="150" alt="" class="img mb-1">
                                            <input type="file" name="logo_akademi" id="inputPassword6" class="form-control @error('logo_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                            <input type="text" hidden value="logo_akademi" name="" id="l_akademi">
                                            @error('logo_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @else
                                            <input type="file" required name="logo_akademi" id="l_akademi" class="form-control @error('logo_akademi') is_invalid @enderror" aria-labelledby="passwordHelpInline" accept="image/*">
                                            @error('logo_akademi')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary my-3 float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                            <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                        </form>
                    </div>
                    <hr>
                </div>
            </div>
        </div>        
    </div>
    <script>
        function processing() {
            var suratIzin = document.getElementById('suratIzin').value;
            var telp = document.getElementById('telp').value;
            var provinsi = document.getElementById('provinsi').value;
            var kota = document.getElementById('kota').value;
            var kecamatan = document.getElementById('kecamatan').value;
            var kelurahan = document.getElementById('kelurahan').value;
            var fakademi = document.getElementById('f_akademi').value;
            var lakademi = document.getElementById('l_akademi').value;
            if (suratIzin !== '' &&
                telp !== '' &&
                provinsi !== '' &&
                kota !== '' &&
                kecamatan !== '' &&
                kelurahan !== '' &&
                fakademi !== '' &&
                lakademi !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    </script>
@endsection