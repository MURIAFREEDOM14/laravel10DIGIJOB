@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="text-center">Verifikasi</h5>
                    </div>
                    <div class="card-body">
                        @if(auth()->user()->token == null)
                            <div class="text-center">
                                <div class="mb-3"> Verifikasi diri anda</div>
                                <a href="/ulang_verifikasi">Kirim email verifikasi</a>
                            </div>
                        @else
                            <div class="mb-3">cek email anda untuk verifikasi</div>
                            <div class="mb-1">Email Anda : {{auth()->user()->email}}</div>
                            <div class="mb-3">Apakah alamat email anda salah? Harap untuk hubungi admin</div>
                            <div class="">Apakah anda belum mendapatkan pesan verifikasi? <a href="/ulang_verifikasi">tekan untuk kirim ulang</a></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection