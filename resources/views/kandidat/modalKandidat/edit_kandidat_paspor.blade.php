@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
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
                                <label for="" class="col-form-label">No. Paspor</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->no_paspor}}" name="no_paspor" id="noPasport" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Pemilik Paspor</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" disabled value="{{$kandidat->nama}}" name="pemilik_paspor" id="" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Terbit</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" required value="{{$kandidat->tgl_terbit_paspor}}" name="tgl_terbit_paspor" id="tglTerbit" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Akhir</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" required value="{{$kandidat->tgl_akhir_paspor}}" name="tgl_akhir_paspor" id="tglAkhirPasport" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tempat Penerbitan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->tmp_paspor}}" name="tmp_paspor" id="tmpTerbit" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Foto Paspor</label>
                            </div>
                            <div class="col-md-8">
                                @if ($kandidat->foto_paspor == "")
                                    <input type="file" required class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="f_pasport" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                @elseif ($kandidat->foto_paspor !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/Paspor/{{$kandidat->foto_paspor}}" width="150" height="150" alt="" class="img mb-1">
                                    <input type="file" class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    <input type="text" name="" hidden id="f_pasport" value="foto_paspor">
                                @else
                                    <input type="file" required class="form-control"  name="foto_paspor" value="{{$kandidat->foto_paspor}}" id="f_pasport" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                @endif
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- <a class="btn btn-warning" href="{{route('kandidat')}}">Lewati</a> --}}
                    <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                    <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>
<script>
    function processing() {
        var noPasport = document.getElementById('noPasport').value;
        var tglTerbit = document.getElementById('tglTerbit').value;
        var tglAkhirPasport = document.getElementById('tglAkhirPasport').value;
        var tmpTerbit = document.getElementById('tmpTerbit').value;
        var fpasport = document.getElementById('f_pasport').value;
        if (noPasport !== '' &&
            tglTerbit !== '' &&
            tglAkhirPasport !== '' &&
            tmpTerbit !== '' &&
            fpasport !== '') {
            var submit = document.getElementById('btn').style.display = 'none';
            var btnLoad = document.getElementById('btnload').style.display = 'block';
        }
    }
</script>
@endsection