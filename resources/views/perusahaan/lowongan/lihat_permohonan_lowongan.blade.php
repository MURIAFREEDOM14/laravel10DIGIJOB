@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
@php
    $jml_interview = $interview->count();
@endphp
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Pelamar Lowongan Pekerjaan</b></h4>
            </div>
            <div class="card-body">
                <form action="/perusahaan/terima_permohonan_lowongan/{{$id}}" method="POST">
                    @csrf    
                    <div class="row">
                        @foreach ($permohonan as $item)
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="id_kandidat[]" value="{{$item->id_kandidat}}">
                                            <input type="text" hidden name="id_lowongan" id="" value="{{$id}}">
                                        </div>
                                    </div>                        
                                    <div class="card-header">
                                        <b class="float-left">{{$item->nama_panggilan}}</b>
                                        <b class="float-right">{{$item->usia}}thn</b>
                                    </div>
                                    <div class="card-body text-center">
                                        <div class="avatar-sm float-left">
                                            @if ($item->foto_4x6 == null)
                                                <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                            @else
                                                <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                            @endif
                                        </div>
                                        <div class="float-right">
                                            <a href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}" class="btn btn-primary">
                                                lihat profil
                                            </a> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    @if ($isi !== 0)
                        <button class="btn btn-success float-right" type="submit">Pilih Kandidat</button>                    
                    @endif
                    <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger">Kembali</a>    
                </form>
            </div>
        </div>
    </div>
@endsection