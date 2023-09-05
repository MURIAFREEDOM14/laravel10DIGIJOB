@extends('layouts.input')
@section('content')
    <div class="container">
        <div class="row">
            <h4 class="text-center">Profil Biodata</h4>
            @if ($password == null)    
                <form action="" method="POST">
                    @csrf
                    <div id="password">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <h6 class="ms-5">Ubah Password</h6>
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Masukkan Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required name="email" id="">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Masukkan Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required name="password" id="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Konfirmasi</button>
                    </div>
                </form>
            @elseif ($password !== null)
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Masukkan Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="passwordNew" id="">
                        </div>
                    </div>
                    <div class="row mb-3 g-3 align-items-center">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Konfirmasi Password Baru</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" required name="passwordConfirm" id="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-warning">Ubah Password</button>
                </form>
            @endif            
        </div>
    </div>
@endsection