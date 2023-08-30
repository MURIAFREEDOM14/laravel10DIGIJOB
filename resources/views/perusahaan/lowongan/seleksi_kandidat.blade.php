@extends('layouts.perusahaan')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Seleksi Kandidat</b>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    @foreach ($kandidat as $item)
                        <div class="row" style="border-top: 0.1px solid #dfdfdf; padding: 10px; border-bottom:0.1px solid #dfdfdf">
                            <div class="col-md-1">
                                <input type="checkbox" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                            </div>
                            <div class="col-md-7">
                                <label for="" style="font-weight: 600; text-transform:uppercase;" class="">{{$item->nama}}</label>
                            </div>
                            <div class="col-md-4">
                                <label for="" style="font-weight: 600; text-transform:uppercase;">| {{$item->usia}} Tahun | 
                                    @if ($item->jenis_kelamin == "M")
                                        Laki-laki
                                    @else 
                                        Perempuan   
                                    @endif|
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <hr>
                    <button class="btn btn-outline-success float-right" type="submit">Terima Kandidat</button>
                    <a class="btn btn-outline-danger float-right mx-1" href="/perusahaan/tolak_seleksi_kandidat/{{$id}}" onclick="tolakData(event)">Tolak semua</a>
                </form>
            </div>
        </div>
    </div>
@endsection