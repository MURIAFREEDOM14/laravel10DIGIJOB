@extends('layouts.akademi')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Contact Us
            </div>
            <div class="card-body">
                <!-- form(post) AkademiController => sendContactUsAkademi -->
                <form action="/akademi/contact_us_akademi" method="POST">
                    @csrf       
                    <div class="row mb-3">
                        <div class="col-6">
                            <b class="bold">Hai {{$akademi->nama_akademi}}, Apa yang bisa kami bantu?</b>
                            <div class="row my-3">
                                <div class="col-4">
                                    <label class="form-label" for="">Nama Pengirim</label>
                                </div>
                                <!-- input nama akademi -->
                                <div class="col-8">
                                    <input type="text" class="form-control" disabled name="" value="{{$akademi->nama_akademi}}" id="">
                                    <input type="text" hidden name="dari" value="{{$akademi->nama_akademi}}" id="">    
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <!-- input pesan -->
                            <div class="row">
                                <div class="mx-auto">Jelaskan apa kendalamu</div>
                                <input type="text" hidden name="id_akademi" value="{{$akademi->id_akademi}}" id="">
                                <textarea required name="isi" class="form-control" id=""></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mx-auto">
                            <a class="btn btn-danger" href="/akademi">Kembali</a>
                            <button type="submit" class="btn btn-primary">Kirim</button>        
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection