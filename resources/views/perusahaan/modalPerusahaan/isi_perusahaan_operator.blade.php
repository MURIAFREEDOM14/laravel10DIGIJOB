@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">        
        <div class="mb-4">
            <div class="">
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
                                    <label for="" class="col-form-label">Nama Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required value="{{$perusahaan->nama_operator}}" name="nama_operator" id="operator" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">No. Telp Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="number" required value="{{$perusahaan->no_telp_operator}}" name="no_telp_operator" id="telp" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for=""  class="col-form-label">Email Operator</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" required value="{{$perusahaan->email_operator}}" name="email_operator" id="email" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Company Profile</label>
                                </div>
                                <div class="col-md-8">
                                    <textarea name="company_profile" required class="form-control" id="profile" cols="" rows="">{{$perusahaan->company_profile}}</textarea>
                                </div>
                            </div>
                        </div>
                        <a href="/perusahaan/isi_perusahaan_alamat" class="btn btn-danger">Kembali</a>
                        <button class="btn btn-primary my-3 float-end" type="submit" onclick="processing()" id="btn">Simpan</button>
                        <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
    <script>
        function processing() {
            var operator = document.getElementById('operator').value;
            var telp = document.getElementById('telp').value;
            var email = document.getElementById('email').value;
            var profile = document.getElementById('profile').value;
            if (operator !== '' &&
                telp !== '' &&
                email !== '' &&
                profile !== '') {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    </script>
@endsection