@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Jadwal Interview
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">                        
                            <div class="form-group">
                                <label for="">Nama Kandidat</label>
                                <input type="text" disabled class="form-control mb-2" name="nama" value="{{$interview->nama_kandidat}}" id="">
                            </div>
                            <div class="form-group">
                                <label for="">Jadwal Interview</label>
                                <input type="datetime-local" name="jadwal" value="{{$interview->jadwal_interview}}" required class="form-control" id="">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Catatan :</label>
                            <div class="">Anda hanya dapat mengubah jadwal interview anda sekali. Untuk lebih lanjut anda bisa menghubungi admin.</div>
                        </div>                            
                    </div>
                    <a href="/perusahaan/interview" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn text-white" style="background-color: green">Simpan</button>
                </form>                
            </div>
        </div>
    </div>
@endsection