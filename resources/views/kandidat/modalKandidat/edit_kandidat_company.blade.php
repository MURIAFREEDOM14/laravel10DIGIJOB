@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5">
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <h6 class="text-center mb-5" style="text-transform: uppercase">
                    @if ($kandidat->penempatan == null)
                    @else
                        {{$kandidat->penempatan}}
                    @endif
                </h6>
                <form action="/isi_kandidat_company" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="ml-5 float-start">PENGALAMAN KERJA</h6> 
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#buatPengalamanKerja" onclick="create()">
                                        Tambah
                                    </button>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr style="font-size:12px;">
                                                    <th>No.</th>
                                                    <th>Nama Perusahaan</th>
                                                    <th>Alamat Perusahaan</th>
                                                    <th>Jabatan</th>
                                                    <th>Periode</th>
                                                    <th>Alasan Berhenti</th>
                                                    <th>Video</th>
                                                    <th>Opsi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pengalaman_kerja as $item)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$item->nama_perusahaan}}</td>
                                                        <td>{{$item->alamat_perusahaan}}</td>
                                                        <td>{{$item->jabatan}}<input hidden name="jabatan[]" value="{{$item->jabatan}}" id=""></td>
                                                        <td>{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</td>
                                                        <td>{{$item->alasan_berhenti}}</td>
                                                        <td>
                                                            @if ($item->video_pengalaman_kerja !== null)
                                                                <video width="200" controls>
                                                                    <source src="/gambar/Kandidat/{{$item->nama}}/Pengalaman Kerja/{{$item->video_pengalaman_kerja}}">
                                                                </video>    
                                                            @else
                                                            ---
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <a class="btn btn-warning mb-1" href="/edit_kandidat_pengalaman_kerja/{{$item->pengalaman_kerja_id}}"><i class=""></i>Edit</a>
                                                            <a class="btn btn-danger mb-1" href="/hapus_kandidat_pengalaman_kerja/{{$item->pengalaman_kerja_id}}" onclick="hapusData(event)"><i class=""></i>Hapus</a>
                                                            {{-- <button onclick="destroy({{$item->pengalaman_kerja_id}})">Hapus</button> --}}
                                                        </td>
                                                    </tr>                                    
                                                @endforeach
                                            </tbody>
                                        </table>    
                                    </div>  
                                </div>
                            </div>
                            <div class="row my-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Status Tempat Kerja</label>
                                </div>
                                <div class="col-md-6">
                                    <select name="penempatan" required class="form-select" id="">
                                        <option value="">-- Pilih penempatan tempat kerja --</option>
                                        <option value="dalam negeri" @if ($kandidat->penempatan == "dalam negeri")
                                            selected
                                        @endif>Dalam Negeri</option>
                                        <option value="luar negeri" @if ($kandidat->penempatan == "luar negeri")
                                            selected
                                        @endif>Luar Negeri</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a class="btn btn-warning" href="{{route('placement')}}">Lewati</a>                        
                    <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                </form>
            </div>
            <hr>
        </div>
        <!-- Modal -->
        <!-- Create -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/tambah_kandidat_pengalaman_kerja" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengalaman Kerja</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="" id="page"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- EndCreate -->
        
        <!-- Edit -->
        <div class="modal fade" id="buatPengalamanKerja" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="/simpan_kandidat_pengalaman_kerja" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengalaman Kerja</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Nama Perusahaan</label>
                                <input type="text" name="nama_perusahaan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Alamat Perusahaan</label>
                                <input type="text" name="alamat_perusahaan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Jabatan</label>
                                <input type="text" name="jabatan" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                            </div>
                            <div class="row mb-2">
                                <label for="">Periode</label>
                                <div class="col-6">
                                    <input type="date" required class="form-control" name="periode_awal" id="">
                                </div>
                                <div class="col-6">
                                    <input type="date" required class="form-control" name="periode_akhir" id="">
                                </div>
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Alasan Berhenti</label>
                                <input type="text" required name="alasan_berhenti" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            </div>
                            <div class="mb-2">
                                <label for="exampleInputEmail1" class="form-label">Video Kerja</label>
                                <input type="file" name="video" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" accept="video/*">
                                <small>Usahakan untuk ukuran video 3mb</small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- EndEdit -->
    </div>
</div>
@endsection