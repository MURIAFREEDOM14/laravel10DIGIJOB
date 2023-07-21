@extends('layouts.contact_service')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 style="font-weight: 700">Lihat Verifikasi Kandidat</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Nama Kandidat</label>
                    </div>
                    <div class="col-8">
                        <div class="">{{$verification->nama}}</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">No. NIK</label>
                    </div>
                    <div class="col-8">
                        <div class="">{{$verification->nik}}</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <label for="" class="col-form-label">Email</label>
                    </div>
                    <div class="col-8">
                        <div class="">{{$verification->email}}</div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <div class="my-2 text-center">Gambar Verifikasi Diri</div>
                        <img src="/gambar/Kandidat/{{$verification->nama}}/Verifikasi Diri/{{$verification->foto_diri_ktp}}" class="img" alt="">
                    </div>
                    <div class="col-6">
                        <div class="my-2 text-center">Data Kandidat</div>
                        @if ($verification->foto_4x6 !== null)
                        <img src="/gambar/Kandidat/{{$verification->nama}}/4x6/{{$verification->foto_4x6}}" class="img" alt="">                    
                        @else
                        <div class="">Maaf Kandidat belum menggunggah foto profil</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-header">
                <h3 style="font-weight: 700">Kirim Email</h3>
            </div>
            <div class="card-body">
                <input type="text" name="" id="">
            </div>
        </div> --}}
    </div>
@endsection