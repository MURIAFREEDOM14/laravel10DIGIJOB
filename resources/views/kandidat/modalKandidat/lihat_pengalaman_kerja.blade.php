@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="float-start" style="font-weight: 600">Lihat Pengalaman Kerja</h5>
                <a class="float-end btn btn-primary" href="/tambah_portofolio_pengalaman_kerja/{{$id}}">Tambah Portofolio</a>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Nama Perusahaan</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="">: {{$pengalaman->nama_perusahaan}}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Alamat Perusahaan</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="">: {{$pengalaman->alamat_perusahaan}}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Jabatan</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="">: {{$pengalaman->jabatan}}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Periode</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="">: {{date('d-M-Y',strtotime($pengalaman->periode_awal))}} Sampai {{date('d-M-Y',strtotime($pengalaman->periode_akhir))}}</div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="" class="">Alasan Berhenti</label>
                                    </div>
                                    <div class="col-6">
                                        <div class="">: {{$pengalaman->alasan_berhenti}}</div>
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>
                        <div class="my-3" style="border-bottom:1px solid black "></div>
                        <div class="card">
                            <div class="card-header">
                                <h5 style="font-weight: 600">Video Pengalaman Kerja</h5>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                        <div class="my-3" style="border-bottom:1px solid black "></div>
                        <div class="card">
                            <div class="card-header">
                                <h5 style="font-weight: 600">Foto Pengalaman Kerja</h5>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($portofolio as $item)
                        @if ($item->video_pengalaman_kerja !== null)
                            <div class="col-md-4">
                                <video width="400" class="img" id="video">
                                    <source src="/gambar/Kandidat/{{$pengalaman_kerja->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman_kerja->video_pengalaman_kerja}}">
                                </video>
                                <button class="btn btn-success mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                            </div>    
                        @endif
                    @endforeach
                </div>
                <div class="row">
                    @foreach ($portofolio as $item)
                        @if ($item->foto_pengalaman_kerja !== null)
                            <img src="/gambar/Kandidat/{{$pengalaman_kerja->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman_kerja->foto_pengalaman_kerja}}" class="img mb-1">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection