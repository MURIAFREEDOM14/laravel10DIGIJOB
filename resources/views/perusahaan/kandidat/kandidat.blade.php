@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4 class="float-left"><b class="bold">Kandidat Dalam Perusahaan Anda</b></h4>
        </div>
        <div class="card-body">
            <form action="/perusahaan/pilih/kandidat" method="POST">
                @csrf
                <div class="row">
                    @if ($isi == 0)
                        <div class="col-md-12 text-center">
                            <b>Maaf perusahaan anda masih belum punya kandidat</b>
                        </div>
                    @else
                        @foreach ($kandidat as $item)
                            <div class="col-md-3">
                                <div class="card" style="width: 100%; height:auto">
                                    <a class="btn" style="border: 2px solid #1269DB; border-top-left-radius:10%;border-bottom-right-radius:10%" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">
                                        <div class="card-header text-center mt--5">
                                            <div class="avatar avatar-xl">
                                                @if ($item->foto_4x6 == null)
                                                    <img src="/gambar/default_user.png" alt="/Atlantis/examples." class="avatar-img rounded-circle">                                            
                                                @else
                                                    <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="avatar-img rounded-circle">                                            
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-center" style="background-color: #1269DB; padding-bottom:3px; ">
                                            <div class="mt-2" style="color: white; text-transform:uppercase;">
                                                {{$item->nama_panggilan}}
                                                <input hidden type="text" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </form>
            <hr>
            <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger">Kembali</a>
        </div>
    </div>
</div>
@endsection