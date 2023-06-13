@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">        
        <div class="card mb-5">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal')}}">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('document')}}">Documen</a>
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
                        <a class="nav-link active" href="{{route('permission')}}">Izin Keluarga</a>
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
                    <h6 class="text-center mb-5" style="text-transform: uppercase">
                        @if ($kandidat->penempatan == null)
                        @else
                            {{$kandidat->penempatan}}
                        @endif
                    </h6>
                    <form action="/isi_kandidat_permission" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perizin">
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <h6 class="ms-5">Surat Izin OrangTua / Suami / Istri / Wali</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nama_perizin}}" name="nama_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIK Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$kandidat->nik_perizin}}" name="nik_perizin" id="inputPassword6" class="form-control @error('nik_perizin') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                    @error('nik_perizin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Harap isi no. nik 16 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp / HP</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->no_telp_perizin}}" name="no_telp_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    @error('no_telp_perizin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>Harap isi no. telp min 10 digit dan max 13 digit</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat / Tanggal Lahir Perizin</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" value="{{$kandidat->tmp_lahir_perizin}}" name="tmp_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="date" value="{{$kandidat->tgl_lahir_perizin}}" name="tgl_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                                </div>
                            </div>
                            <div class="row g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Lengkap Perizin</label>
                                </div>
                            </div>
                            @livewire('location-permission')
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">RT / RW</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rt_perizin}}" placeholder="Masukkan RT" name="rt_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="number" required value="{{$kandidat->rw_perizin}}" placeholder="Masukkan RW" name="rw_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto KTP Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp_izin == "")
                                        <input type="file"  class="form-control @error('foto_ktp_izin') is-invalid @enderror"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @error('foto_ktp_izin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @elseif ($kandidat->foto_ktp_izin !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP Perizin/{{$kandidat->foto_ktp_izin}}" width="150" height="150" alt="">
                                        <input type="file" class="form-control @error('foto_ktp_izin') is-invalid @enderror"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @error('foto_ktp_izin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @else
                                        <input type="file"  class="form-control @error('foto_ktp_izin') is-invalid @enderror"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @error('foto_ktp_izin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Hubungan Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" required name="hubungan_perizin" placeholder="Masukkan hubungan. contoh: ayah, ibu, suami, anak, dll." value="{{$kandidat->hubungan_perizin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
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