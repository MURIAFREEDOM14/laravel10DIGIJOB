@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">        
        <div class="card mb-4">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">AKADEMI BIO DATA</h4>
                    <form action="/akademi/isi_akademi_operator" method="POST">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md">
                                    <h6 class="ms-4">AKADEMI BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Kepala Akademi/Sekolah</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$akademi->nama_kepala_akademi}}" name="nama_kepala_akademi" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$akademi->nama_operator}}" required name="nama_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Email Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" required value="{{$akademi->email_operator}}" name="email_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required value="{{$akademi->no_telp_operator}}" name="no_telp_operator" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                        </div>
                        <a href="/akademi/isi_akademi_data" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection