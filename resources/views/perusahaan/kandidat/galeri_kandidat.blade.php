@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight:600; text-transform:uppercase">galeri Kandidat</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <b class="bold">Nama Pengalaman Kerja</b>    
                    </div>
                    <div class="col-8">
                        : {{$pengalaman_kandidat->nama_perusahaan}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <b class="bold">Alamat Pengalaman Kerja</b>
                    </div>
                    <div class="col-8">
                        : {{$pengalaman_kandidat->alamat_perusahaan}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <b class="bold">Jabatan</b>
                    </div>
                    <div class="col-8">
                        : {{$pengalaman_kandidat->jabatan}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <b class="bold">Periode</b>
                    </div>
                    <div class="col-8">
                        : {{date('d-M-Y',strtotime($pengalaman_kandidat->periode_awal))}} Sampai {{date('d-M-Y',strtotime($pengalaman_kandidat->periode_akhir))}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4">
                        <b class="bold">Alasan Berhenti</b>
                    </div>
                    <div class="col-8">
                        : {{$pengalaman_kandidat->alasan_berhenti}}
                    </div>
                </div>
                <hr>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @foreach ($video as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/perusahaan/lihat/galeri_kandidat/{{$item->video_kerja_id}}/{{"video"}}">
                                    <div class="card-body">
                                        <video id="video">
                                            <source class="" src="/gambar/Kandidat/{{$pengalaman_kandidat->nama}}/Pengalaman Kerja/{{$item->video}}">
                                        </video>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($foto as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/perusahaan/lihat/galeri_kandidat/{{$item->foto_kerja_id}}/{{"foto"}}">
                                    <div class="card-body">
                                        <img src="/gambar/Kandidat/{{$pengalaman_kandidat->nama_kandidat}}/Pengalaman Kerja/{{$item->foto}}" class="img2 mb-2" alt="">
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection