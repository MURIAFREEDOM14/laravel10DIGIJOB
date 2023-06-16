@extends('layouts.input')
@section('content')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                    <form action="/perusahaan/isi_perusahaan_data" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perusahaan_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">PERUSAHAAN BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_perusahaan}}" name="nama_perusahaan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIB Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required value="{{$perusahaan->no_nib}}" name="no_nib" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pemimpin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_pemimpin}}" name="nama_pemimpin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat Perusahaan</label>
                                </div>
                                <div class="col-md-3">
                                    <select name="tmp_negara" required class="form-select" id="">
                                        <option value="Dalam negeri" @if ($perusahaan->tmp_negara == "Dalam negeri")
                                            selected                                            
                                        @endif>Dalam Negeri</option>
                                        <option value="Luar negeri" @if ($perusahaan->tmp_negara == "Luar negeri")
                                            selected
                                        @endif>Luar Negeri</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->foto_perusahaan == "")
                                        <input type="file" required class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->foto_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/Perusahaan/{{$perusahaan->foto_perusahaan}}" width="120" height="150" alt="">
                                        <input type="file" class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" required class="form-control"  name="foto_perusahaan" value="{{$perusahaan->foto_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Logo Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->logo_perusahaan == "")
                                        <input type="file" required class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->logo_perusahaan !== null)
                                        <img src="/gambar/Perusahaan/Logo/{{$perusahaan->logo_perusahaan}}" width="120" height="150" alt="">
                                        <input type="file" class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" required class="form-control"  name="logo_perusahaan" value="{{$perusahaan->logo_perusahaan}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
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