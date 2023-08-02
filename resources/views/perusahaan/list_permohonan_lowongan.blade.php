@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Pelamar Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                @foreach ($lowongan as $item)
                    <div class="row">
                        <div class="col-12">
                            <div class="card" style="border:1px solid green">
                                <div class="card-body">
                                    <label for="" class="">{{$item->jabatan}}</label>
                                    <a class="btn btn-primary float-right" href="/perusahaan/lihat_permohonan_lowongan/{{$item->id_lowongan}}">Lihat</a>
                                </div>
                            </div>
                        </div>
                    </div>    
                @endforeach
            </div>
        </div>
    </div>
@endsection