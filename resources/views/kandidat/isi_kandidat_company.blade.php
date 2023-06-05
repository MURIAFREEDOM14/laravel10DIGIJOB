@extends('layouts.script')
@section('content')
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-header mx-auto">
                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('personal')}}">Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('document')}}">Document</a>
                    </li>
                    <li class="nav-item">
                        @if($kandidat->stats_nikah == null)
                            <a class="nav-link disabled" href="{{route('family')}}">Family</a>
                        @elseif($kandidat->stats_nikah !== "Single")
                            <a class="nav-link" href="{{route('family')}}">Family</a>                          
                        @else
                            <a class="nav-link disabled" href="{{route('family')}}">Family</a>                          
                        @endif
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('vaksin')}}">Vaksin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('parent')}}">Parent</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('company')}}">Company</a>
                    </li>                          
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('permission')}}">Permission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('paspor')}}">Paspor</a>
                    </li>
                    @if ($kandidat->penempatan == "luar negeri")
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('placement')}}">Placement</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link disabled" href="{{route('placement')}}">Placement</a>
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

                        {{-- pengalaman kerja1 --}}
                        <div class="" id="pengalaman_kerja1">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ml-5">PENGALAMAN KERJA</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->nama_perusahaan1}}" name="nama_perusahaan1" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->alamat_perusahaan1}}" name="alamat_perusahaan1" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jabatan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->jabatan1}}" name="jabatan1" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Periode</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" value="{{$kandidat->periode_awal1}}" name="periode_awal1" class="form-control" placeholder="Periode Awal">
                                        <span class="input-group-text bg-primary text-white">Sampai</span>
                                        <input type="date" value="{{$kandidat->periode_akhir1}}" name="periode_akhir1" class="form-control" placeholder="Periode Akhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alasan Berhenti</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="alasan1" value="{{$kandidat->alasan1}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Video Pengalaman Bekerja</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->video_kerja1 == "")
                                        <input type="file" name="video_kerja1" id="inputPassword6" class="form-control @error('video_kerja1') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @elseif ($kandidat->video_kerja1 !== null)
                                        <video width="400" controls>
                                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja1/{{$kandidat->video_kerja1}}" type="video/mp4">
                                        </video>
                                        <input type="file" name="video_kerja1" id="inputPassword6" class="form-control @error('video_kerja1') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">
                                    @else
                                        <input type="file" name="video_kerja1" id="inputPassword6" class="form-control @error('video_kerja1') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @endif
                                    @error('video_kerja1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                        </div>

                        {{-- pengalaman kerja2 --}}
                        <div class="hidden" id="pengalamanKerja2">
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->nama_perusahaan2}}" name="nama_perusahaan2" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->alamat_perusahaan2}}" name="alamat_perusahaan2" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jabatan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->jabatan2}}" name="jabatan2" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Periode</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" value="{{$kandidat->periode_awal2}}" name="periode_awal2" class="form-control" placeholder="Periode Awal">
                                        <span class="input-group-text bg-primary text-white">Sampai</span>
                                        <input type="date" value="{{$kandidat->periode_akhir2}}" name="periode_akhir2" class="form-control" placeholder="Periode Akhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alasan Berhenti</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="alasan2" value="{{$kandidat->alasan2}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Video Pengalaman Bekerja</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->video_kerja2 == "")
                                        <input type="file" name="video_kerja2" id="inputPassword6" class="form-control @error('video_kerja2') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @elseif ($kandidat->video_kerja2 !== null)
                                        <video width="400" controls>
                                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja2/{{$kandidat->video_kerja2}}" type="video/mp4">
                                        </video>
                                        <input type="file" name="video_kerja2" id="inputPassword6" class="form-control @error('video_kerja2') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">
                                    @else
                                        <input type="file" name="video_kerja2" id="inputPassword6" class="form-control @error('video_kerja2') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @endif
                                    @error('video_kerja2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <hr>
                            {{-- <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Apakah Anda Memiliki Pengalaman Kerja Lagi?</label>
                                </div>
                                <div class="col-md-2">
                                    <select name="" class="form-select" id="">
                                        <option value=""><button type="button" onclick="cancelKerja3()">Tidak</button></option>
                                        <option value=""><button type="button" onclick="Kerja3()">Ya</button></option>                                        
                                    </select>
                                </div>
                            </div> --}}
                        </div>
                        
                        {{-- pengalaman kerja3 --}}
                        <div class="hidden" id="pengalamanKerja3">
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->nama_perusahaan3}}" name="nama_perusahaan3" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Perusahaan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->alamat_perusahaan3}}" name="alamat_perusahaan3" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Jabatan</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" value="{{$kandidat->jabatan3}}" name="jabatan3" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Periode</label>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group">
                                        <input type="date" value="{{$kandidat->periode_awal3}}" name="periode_awal3" class="form-control" placeholder="Periode Awal">
                                        <span class="input-group-text bg-primary text-white">Sampai</span>
                                        <input type="date" value="{{$kandidat->periode_akhir3}}" name="periode_akhir3" class="form-control" placeholder="Periode Akhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alasan Berhenti</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" name="alasan3" value="{{$kandidat->alasan3}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Video Pengalaman Bekerja</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->video_kerja3 == "")
                                        <input type="file" name="video_kerja3" id="inputPassword6" class="form-control @error('video_kerja3') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @elseif ($kandidat->video_kerja3 !== null)
                                        <video width="400" controls>
                                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja3/{{$kandidat->video_kerja3}}" type="video/mp4">
                                        </video>
                                        <input type="file" name="video_kerja3" id="inputPassword6" class="form-control @error('video_kerja3') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">
                                    @else
                                        <input type="file" name="video_kerja3" id="inputPassword6" class="form-control @error('video_kerja3') is-invalid @enderror" aria-labelledby="passwordHelpInline" accept="video/*">                                        
                                    @endif
                                    @error('video_kerja3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
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