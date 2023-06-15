@extends('layouts.laman')
@section('content')
@include('sweetalert::alert')
    <div class="container">
        {{-- <div class="card mb-5">
            <div class="card-header">
                <h5>Hubungi Kami</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="/contact_us" method="POST">
                        @csrf       
                        <div class="row mb-3">
                            <div class="col-6">
                                <h6 class="bold">Hai, Apa yang bisa kami bantu?</h6>
                                <div class="row">
                                    <div class="col-4">
                                        <label for="">Nama Pengirim</label>
                                    </div>
                                    <div class="col-8">
                                        <input type="text" placeholder="Masukkan nama anda" class="form-control" name="dari" id="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-2">
                                    <div class="mx-auto">Jelaskan apa kendalamu</div>
                                    <textarea required name="isi" class="form-control" id=""></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row float-end">
                            <div class="">
                                <button type="submit" class="btn btn-primary">Kirim</button>        
                            </div>
                        </div>    
                    </form>
                </div>
            </div>
        </div> --}}
        <div class="card">
            <div class="card-header">
                <h5>Call Center</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="text-center">
                            <h6>WhatsApp</h6>
                            <hr>
                            <div class=""></div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-center">
                            <h6>Email</h6>
                            <hr>
                            <div class="">xxxxxxxxxxxxxxxgmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="height: 11rem;"></div>
    </div>
@endsection
