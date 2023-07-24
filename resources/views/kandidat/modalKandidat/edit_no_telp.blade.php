@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <form action="/edit_kandidat_no_telp" method="POST">
                        @csrf
                        <div class="" id="personal_biodata">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">PROFIL BIO DATA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">+62</span>
                                        <input type="text" name="no_telp" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                      </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <button class="btn btn-warning float-end" type="submit">Ubah</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection