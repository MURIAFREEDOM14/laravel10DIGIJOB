@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-header background-color-success">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                    <form action="/perusahaan/isi_perusahaan_operator" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perusahaan_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">OPERATOR BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_operator}}" name="nama_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->no_telp_operator}}" name="no_telp_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6"  class="col-form-label">Email Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" required value="{{$perusahaan->email_operator}}" name="email_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            {{-- <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto Operator</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($perusahaan->foto_operator == "")
                                        <input type="file" required class="form-control"  name="foto_operator" value="{{$perusahaan->foto_operator}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($perusahaan->foto_operator !== null)
                                        <img src="/gambar/Perusahaan/Operator/{{$perusahaan->foto_operator}}" width="150" class="img" height="150" alt="">
                                        <input type="file" class="form-control"  name="foto_operator" value="{{$perusahaan->foto_operator}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" required class="form-control"  name="foto_operator" value="{{$perusahaan->foto_operator}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div> --}}
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Company Profile</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="company_profile" required class="form-control" id="" cols="" rows="">{{$perusahaan->company_profile}}</textarea>
                                </div>
                            </div>
                        </div>
                        <a href="/perusahaan/isi_perusahaan_alamat" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection