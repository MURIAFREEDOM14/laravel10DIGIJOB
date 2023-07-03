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
                        <div class="mb-3">cek email anda untuk verifikasi</div>
                        {{-- <form action="/verifikasi" method="POST">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" name="verification_code" class="form-control" placeholder="Masukkan Kode verifikasi" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <button class="input-group-text" type="submit" id="basic-addon2">Masuk</button>
                            </div>
                        </form> --}}
                        <div class="">apakah anda belum mendapatkan pesan verifikasi? <a href="/ulang_verifikasi">tekan untuk kirim ulang</a></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection