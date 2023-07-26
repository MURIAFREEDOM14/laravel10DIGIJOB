@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Data Kandidat Luar Negeri</h4>
            </div>
            <div class="card-body">
                <form action="/perusahaan/luar_negeri" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <select name="nama" class="form-control" id="">
                            <option value="">-- Semua Kandidat --</option>
                            @foreach ($semua_kandidat as $item)
                                <option value="{{$item->nama}}" @if ($nama == $item->nama)
                                    selected                                    
                                @endif>{{$item->nama}}</option>
                            @endforeach
                        </select>
                        <select name="negara_id" class="form-control" id="">
                            <option value="">-- Semua Negara --</option>
                            @foreach ($semua_negara as $item)
                                <option value="{{$item->negara_id}}" @if ($negara == $item->negara_id)
                                    selected                                    
                                @endif>{{$item->negara}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </form>
                <div class="row">
                    @foreach ($kandidat as $item)
                    <div class="col-3">
                        <a href="" class="">
                            <div class="card border border-dark">
                                <div class="card-body">
                                    <span class="cicrlegreen float-right"></span>                                        
                                    <img src="/gambar/Welcome.jpg" width="50" height="60" alt="">
                                    <b class="bold ml-2">{{$item->nama}}</b>
                                    <p>Biaya $1</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
