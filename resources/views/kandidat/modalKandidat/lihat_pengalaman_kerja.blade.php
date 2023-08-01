@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 class="float-start" style="font-weight: 600">Lihat Pengalaman Kerja</h5>
                <a class="float-end btn btn-warning" href="/edit_kandidat_pengalaman_kerja/{{$id}}">Edit Pengalaman Kerja</a>
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
                                <a class="btn btn-primary" href="/tambah_kandidat_pengalaman_kerja/{{$id}}">Tambah Portofolio</a>
                            </div>
                        </div>
                        <div class="my-3" style="border-bottom:1px solid black "></div>
                        <div class="card">
                            <div class="card-header">
                                <h5 style="font-weight: 600">Video Pengalaman Kerja</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($portofolio as $item)
                                        @if ($item->video_pengalaman_kerja !== null)
                                            <div class="col-6">
                                                <div class="card">
                                                    <div class="card-header">
                                                    </div>
                                                    <div class="card-body">
                                                        <video id="video">
                                                            <source class="" src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman->video_pengalaman_kerja}}">
                                                        </video>
                                                        <div class="">
                                                            <button class="btn btn-success mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                                                            <a class="btn btn-warning mb-2" href="/edit_portofolio/{{$item->portofolio_id}}">Edit</a>
                                                            <a class="btn btn-danger mb-2" onclick="" href="/hapus_portofolio/{{$item->portofolio_id}}">Hapus</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="my-3" style="border-bottom:1px solid black "></div>
                        <div class="card">
                            <div class="card-header">
                                <h5 style="font-weight: 600">Foto Pengalaman Kerja</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($portofolio as $item)
                                        @if ($item->foto_pengalaman_kerja !== null)
                                            <div class="col-4">
                                                <div class="card">
                                                    <div class="card-header">
                                                    </div>
                                                    <div class="card-body">
                                                        <img src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman->foto_pengalaman_kerja}}" class="img2 mb-1">
                                                        <a class="btn btn-warning mb-2" href="/edit_portofolio/{{$item->portofolio_id}}">Edit</a>
                                                        <a class="btn btn-danger mb-2" href="/hapus_portofolio/{{$item->portofolio_id}}">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection