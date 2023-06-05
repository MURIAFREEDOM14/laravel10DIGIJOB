@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Contact Us
                </div>
                <div class="card-body">
                    <form action="/contact_us" method="POST">
                        @csrf       
                        <div class="row mb-3">
                            <div class="col-6">
                                <b class="bold">Hello {{$kandidat->nama}}, Apa yang bisa kami bantu?</b>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="mx-auto">Jelaskan apa kendalamu</div>
                                    <textarea required name="isi_pesan_kandidat" class="form-control" id=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="mx-auto">
                                <a class="btn btn-danger" href="/kandidat">Kembali</a>
                                <button type="submit" class="btn btn-primary">Kirim</button>        
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection