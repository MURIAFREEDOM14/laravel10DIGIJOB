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
                        <a class="nav-link" href="{{route('permission')}}">Izin Keluarga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('paspor')}}">Paspor</a>
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
                    <form action="/isi_kandidat_paspor" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perizin">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Paspor</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Paspor</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->no_paspor}}" name="no_paspor" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal Terbit</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date"  value="{{$kandidat->tgl_terbit_paspor}}" name="tgl_terbit_paspor" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal Akhir</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" value="{{$kandidat->tgl_akhir_paspor}}" name="tgl_akhir_paspor" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat Penerbitan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->tmp_paspor}}" name="tmp_paspor" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Paspor</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_paspor == "")
                                        <input type="file" class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($kandidat->foto_paspor !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Paspor/{{$kandidat->foto_paspor}}" width="120" height="150" alt="">
                                        <input type="file" class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
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