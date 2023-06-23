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
                        <a class="nav-link active" href="{{route('parent')}}">Orang tua</a>
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
                    <h6 class="text-center mb-5" style="text-transform: uppercase">
                        @if ($kandidat->penempatan == null)
                        @else
                            {{$kandidat->penempatan}}
                        @endif
                    </h6>
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
                                    <label for="inputPassword6" class="col-form-label">Tanggal Lahir Ayah</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" value="{{$kandidat->tgl_lahir_ayah}}" name="tgl_lahir_ayah" class="form-control" id="">
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
                                    <label for="inputPassword6" class="col-form-label">Tanggal Lahir Ibu</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" value="{{$kandidat->tgl_lahir_ibu}}" name="tgl_lahir_ibu" class="form-control" id="">
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
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Laki-laki</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jumlah Saudara Perempuan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Anak Ke</label>
                                </div>
                                <div class="col-md-2">
                                    @if ($kandidat->anak_ke == null)
                                        <input type="number" value="{{1}}" class="form-control" name="anak_ke" required>
                                    @else
                                        <input type="number" value="{{$kandidat->anak_ke}}" name="anak_ke" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">                                        
                                    @endif
                                </div>
                            </div>
                            <hr>
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
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection