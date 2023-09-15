@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <!-- form(post) KandidatController => simpan_kandidat_company -->
                <form action="/isi_kandidat_company" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="ml-5 float-start">PENGALAMAN KERJA</h6> 
                                    <!-- Tombol modal tambah pengalaman pekerjaan -->
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#buatPengalamanKerja" onclick="create()">
                                        Tambah
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="font-size:12;">
                                                    <th style="width: 1">No.</th>
                                                    <th style="width: 1">Nama Perusahaan</th>
                                                    <th style="width: 1">Alamat Perusahaan</th>
                                                    <th style="width: 1">Jabatan</th>
                                                    <th style="width: 1">Periode</th>
                                                    <th style="width: 1">Alasan Berhenti</th>
                                                    <th style="width: 1">Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengalaman_kerja as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$item->nama_perusahaan}}</td>
                                                        <td>{{$item->alamat_perusahaan}}<input hidden name="lama_kerja[]" value="{{$item->lama_kerja}}" id=""></td>
                                                        <td>{{$item->jabatan}}<input hidden name="jabatan[]" value="{{$item->jabatan}}" id=""></td>
                                                        <td>{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</td>
                                                        <td>{{$item->alasan_berhenti}}</td>
                                                        <td>
                                                            <a class="btn btn-primary mb-1" href="/lihat_kandidat_pengalaman_kerja/{{$item->pengalaman_kerja_id}}">Lihat</a>
                                                            {{-- <a class="btn btn-warning mb-1" href="/edit_kandidat_pengalaman_kerja/{{$item->pengalaman_kerja_id}}">Edit</a> --}}
                                                            <a class="btn btn-danger mb-1" href="/hapus_kandidat_pengalaman_kerja/{{$item->pengalaman_kerja_id}}" onclick="hapusData(event)">Hapus</a>
                                                        </td>
                                                    </tr>                                    
                                                @endforeach
                                            </tbody>
                                        </table>    
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-warning" href="{{route('permission')}}">Lewati</a>                        
                    <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                     <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                </form>
            </div>
            <hr>
        </div>
        <!-- Modal -->        
        <!-- Buat data -->
        <div class="modal fade" id="buatPengalamanKerja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <!-- form(post) KandidatController => tambahPengalamanKerja -->
                <form action="/simpan_kandidat_pengalaman_kerja" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengalaman Kerja</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- input nama perusahaan -->
                            <div class="mb-2">
                                <label for="" class="form-label">Nama Perusahaan / Majikan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <!-- input alamat perusahaan -->
                            <div class="mb-2">
                                <label for="" class="form-label">Alamat Perusahaan / Majikan</label>
                                <input type="text" name="alamat_perusahaan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <!-- input jabatan -->
                            <div class="mb-2">
                                <label for="" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <!-- input deskripsi -->
                            <div class="row mb-2">
                                <label for="" class="form-label">Deskripsi Pekerjaan</label>
                                <textarea name="deskripsi" id="" class="form-control" cols="5" rows="3"></textarea>
                            </div>
                            <!-- input periode awal & akhir -->
                            <div class="row mb-2">
                                <label for="">Periode</label>
                                <div class="col-6">
                                    <input type="date" required class="form-control" name="periode_awal" id="">
                                </div>
                                <div class="col-6">
                                    <input type="date" required class="form-control" name="periode_akhir" id="">
                                </div>
                            </div>
                            <!-- input alasan berhenti -->
                            <div class="mb-2">
                                <label for="" class="form-label">Alasan Berhenti</label>
                                <input type="text" required name="alasan_berhenti" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <!-- input pilihan tambah foto / video -->
                            <div class="mb-2">
                                <label for="" class="form-label">Galeri Pengalaman Kerja</label>
                                <select name="type" class="form-select" id="data_pengalaman">
                                    <option value="">-- Tentukan Tipe Inputan --</option>
                                    <option value="video">Video</option>
                                    <option value="foto">Foto</option>
                                </select>
                            </div>
                            <!-- input video -->
                            <div class="mb-2" id="video_pengalaman">
                                <label for="" class="form-label">Video Pengalaman Kerja</label>
                                <input type="file" name="video" class="form-control" id="" aria-describedby="emailHelp" accept="video/*">
                            </div> 
                            <!-- input foto -->   
                            <div class="mb-2" id="foto_pengalaman">
                                <label for="" class="form-label">Foto Pengalaman Kerja</label>
                                <input type="file" name="foto" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" accept="image/*">
                            </div>    
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- fungsi tombol loading -->
<script>
    function processing() {
        var submit = document.getElementById('btn').style.display = 'none';
        var btnLoad = document.getElementById('btnload').style.display = 'block';
    }
</script>
@endsection