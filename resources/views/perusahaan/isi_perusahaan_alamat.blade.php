@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PERUSAHAAN BIO DATA</h4>
                </div>
                <form action="/perusahaan/isi_perusahaan_alamat" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="">Alamat Perusahaan</label>
                    </div>
                    @if ($perusahaan->tmp_negara == "Dalam negeri")
                        @livewire('company-location')                        
                    @else
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="">Masukkan alamat</label>
                            </div>
                            <div class="col-8">
                                <textarea name="" id="" class="form-control"></textarea>
                            </div>
                        </div>    
                    @endif
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">Email Perusahaan</label>
                        </div>
                        <div class="col-8">
                            <input type="email" class="form-control" name="email_perusahaan" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <label for="">No. Telp Perusahaan</label>
                        </div>
                        <div class="col-8">
                            <input type="number" class="form-control" name="no_telp_perusahaan" id="">
                        </div>
                    </div>
                    <a class="btn btn-danger" href="/perusahaan/isi_perusahaan_data">Kembali</a>
                    <button class="btn btn-primary float-end" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection