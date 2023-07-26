@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<style>
    #dalam_n{
        display: none;
    }
    #luar_n{
        display: none;
    }
</style>
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
                    @if ($perusahaan->tmp_perusahaan == "Dalam negeri")
                        @livewire('company-location')                                                
                    @else
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="">Pilih Nama Negara</label>
                            </div>
                            <div class="col-md-8">
                                <select name="negara_id" class="form-control" required id="">
                                    <option value="">-- Pilih Negara --</option>
                                    @foreach ($negara as $item)
                                        <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>    
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="">Masukkan alamat</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="alamat" id="" class="form-control"></textarea>
                            </div>
                        </div>
                    @endif
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="">Email Perusahaan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" disabled value="{{$perusahaan->email_perusahaan}}" class="form-control" name="email_perusahaan" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="">No. Telp Perusahaan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$perusahaan->no_telp_perusahaan}}" class="form-control" name="no_telp_perusahaan" id="">
                            </div>
                        </div>
                    <a class="btn btn-danger" href="/perusahaan/isi_perusahaan_data">Kembali</a>
                    <button class="btn btn-primary float-end" type="submit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection