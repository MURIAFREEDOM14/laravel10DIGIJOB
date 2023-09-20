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