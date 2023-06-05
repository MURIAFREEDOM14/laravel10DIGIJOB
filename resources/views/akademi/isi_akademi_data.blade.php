@extends('layouts.script')
@section('content')
    <div class="container">        
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">AKADEMI BIO DATA</h4>
                    <form action="/isi_akademi_data" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">AKADEMI BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Akademi</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$akademi->nama}}" required name="nama" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No Telepon Akademi</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$akademi->no_telp_akademi}}" name="no_telp_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. NIS</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$akademi->no_nis}}" name="no_nis" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Surat Izin </label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" value="{{$akademi->no_surat_izin}}" name="no_surat_izin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Email</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" value="{{$akademi->email}}" name="email" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Akademi</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$akademi->alamat_akademi}}" name="alamat_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Akademi/Sekolah</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($akademi->foto_akademi == "")
                                        <input type="file" name="foto_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($akademi->foto_akademi !== null)
                                        <img src="/gambar/Akademi/Foto{{$akademi->foto_akademi}}" width="150" height="170" alt="">
                                        <input type="file" name="foto_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" name="foto_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Logo Akademi/Sekolah</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($akademi->logo_akademi == "")
                                        <input type="file" name="logo_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($akademi->logo_akademi !== null)
                                        <img src="/gambar/Akademi/Logo/{{$akademi->logo_akademi}}" width="150" height="170" alt="">
                                        <input type="file" name="logo_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" name="logo_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Lanjut</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection