@extends('layouts.input')
@section('content')
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal')}}">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('document')}}">Documen</a>
                    </li>
                    <li class="nav-item">
                        @if($kandidat->stats_nikah == null)
                            <a class="nav-link disabled" href="{{route('family')}}">Keluarga</a>
                        @elseif($kandidat->stats_nikah !== "Single")
                            <a class="nav-link" href="{{route('family')}}">Keluarga</a>                          
                        @else
                            <a class="nav-link disabled" href="{{route('family')}}">Keluarga</a>                          
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaksin')}}">Vaksin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('parent')}}">Orang tua</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('company')}}">Pengalaman Kerja</a>
                    </li>                          
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permission')}}">Izin Keluarga</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('paspor')}}">Paspor</a>
                    </li>
                    @if ($kandidat->penempatan == "luar negeri")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('placement')}}">Penempatan</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('placement')}}">Penempatan</a>
                        </li>
                    @endif
                    @if ($kandidat->negara_id == 2)
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('job')}}">Job</a>
                        </li>                        
                    @else
                        @if ($kandidat->negara_id == null)
                            <li class="nav-item">
                                <a class="nav-link disabled" href="{{route('job')}}">Job</a>
                            </li>    
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{route('job')}}">Job</a>
                            </li>                            
                        @endif
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="/">Selesai</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="/isi_kandidat_company" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <div class="card-header">
                                        <h6 class="ml-5 float-start">PENGALAMAN KERJA</h6> 
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                            Tambah
                                        </button>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>No.</th>
                                                        <th>Nama Perusahaan</th>
                                                        <th>Alamat Perusahaan</th>
                                                        <th>Jabatan</th>
                                                        <th>Periode</th>
                                                        <th>Alasan Berhenti</th>
                                                        <th>Video</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengalaman_kerja as $item)
                                                        <tr>
                                                            <td>{{$loop->iteration}}</td>
                                                            <td>{{$item->nama_perusahaan}}</td>
                                                            <td>{{$item->alamat_perusahaan}}</td>
                                                            <td>{{$item->jabatan}}</td>
                                                            <td>{{$item->periode_awal}} - {{$item->periode_akhir}}</td>
                                                            <td>{{$item->alasan_berhenti}}</td>
                                                            <td>
                                                                <video width="200" controls>
                                                                    <source src="/gambar/Kandidat/{{$item->nama}}/Pengalaman Kerja/{{$item->video_pengalaman_kerja}}">
                                                                </video>
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
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
            <!-- Modal -->
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
        </div>
    </div>
    <script>
        function Kerja2(){
            document.getElementById('kerja2').style.display = "block";
        }
        function Kerja3(){
            document.getElementById('kerja3').style.display = "block";
        }
        function cancelKerja2(){
            document.getElementById('kerja2').style.display = "none";
        }
        function cancelKerja3(){
            document.getElementById('kerja3').style.display = "none";
        }
    </script>
@endsection