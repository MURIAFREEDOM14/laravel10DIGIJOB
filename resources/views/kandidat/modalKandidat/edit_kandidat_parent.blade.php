@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                {{-- <h6 class="text-center mb-5" style="text-transform: uppercase">
                    {{$negara}}
                </h6> --}}
                <form action="/isi_kandidat_parent" method="POST">
                    @csrf
                    <div class="" id="parent">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <h6 class="ms-5">Data Orang Tua / Wali</h6> 
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Nama Ayah</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->nama_ayah}}" name="nama_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Tempat / Tanggal Lahir Ayah</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" placeholder="Masukkan Tempat Lahir" required value="{{$kandidat->tmp_lahir_ayah}}" name="tmp_lahir_ayah" class="form-control" id="">
                            </div>
                            <div class="col-md-4">
                                <input type="date" required value="{{$kandidat->tgl_lahir_ayah}}" name="tgl_lahir_ayah" class="form-control" id="">
                            </div>
                        </div>
                        {{-- <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Umur Ayah</label>
                            </div>
                            <div class="col-md-4">
                                <select name="umur_ayah" class="form-select" id="pilihanAyah">
                                    <option value="">-- tentukan umur --</option>
                                    <option value="ayah1">Umur</option>
                                    <option value="wafat">Sudah Wafat</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="" id="inputAyah">
                                    <input type="text" id="ayah1" style="display: none;" value="{{$kandidat->umur_ayah}}" name="umur_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Nama Ibu</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->nama_ibu}}" name="nama_ibu" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Tempat / Tanggal Lahir Ibu</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" placeholder="Masukkan Tempat Lahir" required value="{{$kandidat->tmp_lahir_ibu}}" name="tmp_lahir_ibu" class="form-control" id="">
                            </div>
                            <div class="col-md-4">
                                <input type="date" required value="{{$kandidat->tgl_lahir_ibu}}" name="tgl_lahir_ibu" class="form-control" id="">
                            </div>
                        </div>
                        @livewire('kandidat.parent-location')
                        {{-- <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Umur Ibu</label>
                            </div>
                            <div class="col-md-4">
                                <select name="umur_ibu" class="form-select" id="pilihanIbu">
                                    <option value="">-- tentukan umur --</option>
                                    <option value="ibu1">Umur</option>
                                    <option value="wafat">Sudah Wafat</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="" id="inputIbu">
                                    <input type="text" id="ibu1" style="display: none;" value="{{$kandidat->umur_ayah}}" name="umur_ayah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                        </div> --}}
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">RT</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rt_parent}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rt" id="inputPassword6" class="form-control @error('rt') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RT harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="inputPassword6" class="col-form-label">RW</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rw_parent}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rw" id="inputPassword6" class="form-control @error ('rw') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RW harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Jumlah Saudara Laki-laki</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Jumlah Saudara Perempuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Anak Ke</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->anak_ke}}" name="anak_ke" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                            </div>
                        </div>
                        {{-- <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Apakah Anda Pernah memiliki Pengalaman Kerja?</label>
                            </div>
                            <div class="col-md-2">
                                <select name="confirm" class="form-select" id="">
                                    <option value="0">Tidak</option>
                                    <option value="1" @if ($kandidat->nama_perusahaan1 !== null)
                                        selected
                                    @endif>Ya</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                    <hr>
                    <a class="btn btn-warning" href="{{route('company')}}">Lewati</a>
                    <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>
@endsection