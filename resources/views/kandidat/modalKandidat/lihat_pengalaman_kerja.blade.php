@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
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
                                <a class="btn btn-danger" href="/isi_kandidat_company">Kembali</a>
                            </div>
                        </div>
                        <div class="my-3" style="border-bottom:1px solid black "></div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="float-start" style="font-weight: 600">Galeri</h5>
                                <button class="btn btn-primary dropdown-toggle float-end" type="button" data-bs-toggle="dropdown" aria-expanded="false">+ Tambah</button>
                                <ul class="dropdown-menu">
                                    <li>
                                      <a class="dropdown-item" href="/tambah_portofolio_pengalaman_kerja/{{$id}}/{{"video"}}">Video</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="/tambah_portofolio_pengalaman_kerja/{{$id}}/{{"foto"}}">Foto</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($video as $item)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-body">
                                                    <video id="video">
                                                        <source class="" src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->video}}">
                                                    </video>
                                                    <div class="text-center">
                                                        <button class="btn btn-success" id="play" type="button" onclick="play()">Mulai</button>
                                                        <button class="btn btn-warning" id="jeda" type="button" onclick="pause()">Jeda</button>
                                                        <a class="btn btn-warning" href="/edit_portofolio_pengalaman_kerja/{{$item->video_kerja_id}}/{{"video"}}">Edit</a>
                                                        <a class="btn btn-danger" onclick="hapusData(event)" href="/hapus_portofolio_pengalaman_kerja/{{$item->video_kerja_id}}/{{"video"}}">Hapus</a>
                                                    </div>                                                            
                                                </div>
                                            </div>
                                        </div>    
                                    @endforeach
                                    @foreach ($foto as $item)
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="card-header">
                                                </div>
                                                <div class="card-body">
                                                    <img src="/gambar/Kandidat/{{$pengalaman->nama_kandidat}}/Pengalaman Kerja/{{$item->foto}}" class="img2 mb-1" alt="">
                                                    <div class="text-center">
                                                        <a class="btn btn-warning mb-2" href="/edit_portofolio_pengalaman_kerja/{{$item->foto_kerja_id}}/{{"foto"}}">Edit</a>
                                                        <a class="btn btn-danger mb-2" onclick="hapusData(event)" href="/hapus_portofolio_pengalaman_kerja/{{$item->foto_kerja_id}}/{{"foto"}}">Hapus</a>
                                                    </div>                                                            
                                                </div>
                                            </div>
                                        </div>
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