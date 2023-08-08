@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight:600">Pengalaman Kerja</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-4">
                                <b class="bold">Nama Pengalaman Kerja</b>
                            </div>
                            <div class="col-8">
                                : {{$pengalaman->nama_perusahaan}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <b class="bold">Alamat Pengalaman Kerja</b>
                            </div>
                            <div class="col-8">
                                : {{$pengalaman->alamat_perusahaan}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <b class="bold">Jabatan</b>
                            </div>
                            <div class="col-8">
                                : {{$pengalaman->jabatan}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <b class="bold">Periode</b>
                            </div>
                            <div class="col-8">
                                : {{date('d-M-Y',strtotime($pengalaman->periode_awal))}} Sampai {{date('d-M-Y',strtotime($pengalaman->periode_akhir))}}
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <b class="bold">Alasan Berhenti</b>
                            </div>
                            <div class="col-8">
                                : {{$pengalaman->alasan_berhenti}}
                            </div>
                        </div>
                        <hr>
                        <a class="btn btn-danger" href="/profil_kandidat">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: 600">Galeri Pengalaman Kerja</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($video as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/manager/kandidat/lihat_galeri_kandidat/{{$item->video_kerja_id}}/{{"video"}}">
                                    <div class="card-body">
                                        <video id="video" height="auto">
                                            <source class="" src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->video}}">
                                        </video>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($foto as $item)
                        <div class="col-3">
                            <div class="card" style="border:2px solid #1269db">
                                <a href="/manager/kandidat/lihat_galeri_kandidat/{{$item->foto_kerja_id}}/{{"foto"}}">
                                    <div class="card-body">
                                        <img src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->foto}}" style="width: 100%; height:auto;" class="" alt="">
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