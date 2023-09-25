@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <b class="bold">Kandidat Yang Sesuai</b>
        </div>
        <div class="card-body">
            <!-- form(post) PerusahaanRecruitmentController => confirmPermohonanLowongan -->
            <form action="/perusahaan/terima_permohonan_lowongan/{{$id}}" method="POST">
                @csrf
                <div class="row">
                    <!-- menampilkan data kandidat -->
                    @foreach ($kandidat as $item)
                        <!-- melakukan proses filterisasi yang sesuai dengan syarat kandidat -->
                        <!-- apabila jenis kelamin kandidat sama dengan syarat lowongan atau syarat lowongan bisa laki & perempuan -->
                        @if ($item->jenis_kelamin == $lowongan->jenis_kelamin || $lowongan->jenis_kelamin == "MF")
                            <!-- apabila alamat kandidat sama dengan syarat lowongan atau syarat lowongan untuk "se-indonesia" -->
                            @if ($item->kabupaten == $lowongan->pencarian_tmp || $item->provinsi == $lowongan->pencarian_tmp || $lowongan->pencarian_tmp == "Se-indonesia")
                                <div class="col-md-3">
                                    <!-- mengambil data id kandidat -->
                                    <input type="checkbox" name="id_kandidat[]" value="{{$item->id_kandidat}}" id="">
                                    <div class="card">
                                        <a class="btn" style="border: 2px solid #1269DB; border-top-left-radius:10%;border-bottom-right-radius:10%" href="/perusahaan/lihat/kandidat/{{$item->id_kandidat}}">
                                            <div class="card-header text-center my-1">
                                                <div class="avatar avatar-xxl" style="width: 100%; height: 50%;">
                                                    @if ($item->foto_4x6 == null)
                                                        <img src="/gambar/default_user.png" alt="" class="img2">                                            
                                                    @else
                                                        <img src="/gambar/Kandidat/{{$item->nama}}/4x6/{{$item->foto_4x6}}" alt="" class="img2">                                            
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="text-center mb-2" style="background-color: #1269DB">
                                                <div class="mt-2" style="color: white; text-transform:uppercase;">
                                                    {{$item->nama_panggilan}}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endif                                    
                        @endif
                    @endforeach
                </div>
                <hr>
                <a href="/perusahaan/list_permohonan_lowongan" class="btn btn-danger mt-2">Kembali</a>    
                <button class="btn btn-success mt-2">Pilih Kandidat</button>
            </form>
        </div>
    </div>
</div>
@endsection