@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-header">
                Edit Pengalaman Kerja
            </div>
            <div class="card-body">
                <form action="/update_kandidat_pengalaman_kerja/{{$pengalaman_kerja->pengalaman_kerja_id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control" value="{{$pengalaman_kerja->nama_perusahaan}}" id="nama_perusahaan" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Alamat Perusahaan</label>
                            <input type="text" name="alamat_perusahaan" class="form-control" value="{{$pengalaman_kerja->alamat_perusahaan}}" id="alamat_perusahaan" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{$pengalaman_kerja->jabatan}}" id="jabatan" aria-describedby="emailHelp" required>
                        </div>
                        <div class="row mb-2">
                            <label for="">Periode</label>
                            <div class="col-6">
                                <input type="date" required class="form-control" value="{{$pengalaman_kerja->periode_awal}}" name="periode_awal" id="periode_awal">
                            </div>
                            <div class="col-6">
                                <input type="date" required class="form-control" value="{{$pengalaman_kerja->periode_akhir}}" name="periode_akhir" id="periode_akhir">
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Alasan Berhenti</label>
                            <input type="text" required name="alasan_berhenti" value="{{$pengalaman_kerja->alasan_berhenti}}" class="form-control" id="alasan_berhenti" aria-describedby="emailHelp">
                        </div>
                        {{-- <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Video Kerja</label>
                            <div class="">
                                @if ($pengalaman_kerja->video_pengalaman_kerja !== null)
                                    <video width="400" class="" id="video">
                                        <source src="/gambar/Kandidat/{{$pengalaman_kerja->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman_kerja->video_pengalaman_kerja}}">
                                    </video>
                                    <button class="btn btn-success mb-2" type="button" onclick="playPause()">Mulai/Jeda</button>
                                    <input type="file" name="video" class="form-control" id="video" aria-describedby="emailHelp" accept="video/*">
                                    <small>Usahakan untuk ukuran video 3mb</small>                                
                                @else
                                    <input type="file" name="video" class="form-control" id="video" aria-describedby="emailHelp" accept="video/*">
                                    <small>Usahakan untuk ukuran video 3mb</small>                                
                                @endif
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="" class="form-label">Foto Kerja</label>
                            <div class="">
                                @if ($pengalaman_kerja->foto_pengalaman_kerja !== null)
                                    <img src="/gambar/Kandidat/{{$pengalaman_kerja->nama_kandidat}}/Pengalaman Kerja/{{$pengalaman_kerja->foto_pengalaman_kerja}}" class="img mb-1">
                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                @else
                                    <input type="file" class="form-control" name="foto" accept="image/*">                
                                @endif
                            </div>
                        </div> --}}
                        <div class="mb-2">
                            <a href="/isi_kandidat_company" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-warning">Ubah</button>
                        </div>    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection