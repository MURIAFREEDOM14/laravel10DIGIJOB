@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-header">
                Edit Pengalaman Kerja
            </div>
            <div class="card-body">
                <!-- form(post) KandidatController => updatePengalamanKerja -->
                <form action="/update_kandidat_pengalaman_kerja/{{$pengalaman_kerja->pengalaman_kerja_id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="">
                        <!-- input nama perusahaan -->
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                            <input type="text" name="nama_perusahaan" class="form-control" value="{{$pengalaman_kerja->nama_perusahaan}}" id="nama_perusahaan" aria-describedby="emailHelp" required>
                        </div>
                        <!-- input alamat perusahaan -->
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Alamat Perusahaan</label>
                            <input type="text" name="alamat_perusahaan" class="form-control" value="{{$pengalaman_kerja->alamat_perusahaan}}" id="alamat_perusahaan" aria-describedby="emailHelp" required>
                        </div>
                        <!-- jabatan -->
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Jabatan</label>
                            <input type="text" name="jabatan" class="form-control" value="{{$pengalaman_kerja->jabatan}}" id="jabatan" aria-describedby="emailHelp" required>
                        </div>
                        <!-- input periode -->
                        <div class="row mb-2">
                            <label for="">Periode</label>
                            <div class="col-6">
                                <input type="date" required class="form-control" value="{{$pengalaman_kerja->periode_awal}}" name="periode_awal" id="periode_awal">
                            </div>
                            <div class="col-6">
                                <input type="date" required class="form-control" value="{{$pengalaman_kerja->periode_akhir}}" name="periode_akhir" id="periode_akhir">
                            </div>
                        </div>
                        <!-- input email -->
                        <div class="mb-2">
                            <label for="exampleInputEmail1" class="form-label">Alasan Berhenti</label>
                            <input type="text" required name="alasan_berhenti" value="{{$pengalaman_kerja->alasan_berhenti}}" class="form-control" id="alasan_berhenti" aria-describedby="emailHelp">
                        </div>
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