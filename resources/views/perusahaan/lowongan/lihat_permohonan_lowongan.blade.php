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
                <!-- form(post) PerusahaanRecruitmentController => confirmPermohonanLowongan -->
                <form action="/perusahaan/terima_permohonan_lowongan/{{$id}}" method="POST">
                    @csrf    
                    <div class="row">
                        <!-- menampilkan data permohonan lowongan / kandidat yang melamar -->
                        @foreach ($permohonan as $item)
                            <div class="col-md-3">
                                <!-- mengambil data id kandidat -->
                                <input type="checkbox" aria-label="Checkbox for following text input" name="id_kandidat[]" value="{{$item->id_kandidat}}">
                                <div class="card">
                                    <a class="btn" style="border: 2px solid #1269DB; border-top-left-radius:10%;border-bottom-right-radius:10%" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">
                                        <div class="card-header text-center mt--5">
                                            <div class="avatar avatar-xxl" style="width: 100%; height:auto;">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="" class="img2">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="img2">                                            
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card-body text-center" style="background-color: #1269DB">
                                            <div class="mt-2" style="color: white; text-transform:uppercase">
                                                {{$item->nama_panggilan}}
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <!-- apabila data permohonan lowongan ada / tidak kosong -->
                    @if ($isi !== 0)
                        <button class="btn btn-success float-right" type="submit">Pilih Kandidat</button>                    
                    @endif
                    <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger">Kembali</a>    
                </form>
            </div>
        </div>
    </div>
@endsection