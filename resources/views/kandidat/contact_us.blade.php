@extends('layouts.kandidat')
@section('content')
    <div class="container mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    Contact Us
                </div>
                <div class="card-body">
                    <form action="/manager/contact_us" method="POST">
                        @csrf       
                        <div class="row mb-3">
                            <div class="col-6">
                                <b class="bold">Hai {{$kandidat->nama}}, Apa yang bisa kami bantu?</b>
                                <div class="row my-3">
                                    <div class="col-4">
                                        <label class="form-label" for="">Nama Pengirim</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" class="form-control" disabled name="" value="{{$kandidat->nama}}" id="">
                                        <input type="text" hidden name="dari" value="{{$kandidat->nama}}" id="">    
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row">
                                    <div class="mx-auto">Jelaskan apa kendalamu</div>
                                    <input type="text" hidden name="id_kandidat" value="{{$kandidat->id_kandidat}}" id="">
                                    <textarea required name="isi" class="form-control" id=""></textarea>
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