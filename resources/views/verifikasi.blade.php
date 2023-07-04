@extends('layouts.input')
@section('content')
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
                                <div class="mb-3"> verifikasi diri anda</div>
                                <a href="/ulang_verifikasi">kirim email verifikasi</a>
                            </div>
                        @else
                            <div class="mb-3">cek email anda untuk verifikasi</div>
                            <div class="">apakah anda belum mendapatkan pesan verifikasi? <a href="/ulang_verifikasi">tekan untuk kirim ulang</a></div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection