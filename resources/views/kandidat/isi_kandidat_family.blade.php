@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
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
                            <a class="nav-link active" href="{{route('family')}}">Keluarga</a>                          
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
                        <a class="nav-link" href="{{route('company')}}">Pengalaman Kerja</a>
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
                    {{-- @if ($kandidat->negara_id == 2)
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
                    @endif --}}
                    <li class="nav-item">
                        <a class="nav-link" href="/">Selesai</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-5" style="text-transform: uppercase">
                        @if ($kandidat->penempatan == null)
                        @else
                            {{$kandidat->penempatan}}
                        @endif
                    </h6>
                    <form action="/isi_kandidat_family" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="family_background">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Data Berkeluarga</h6> 
                                </div>
                            </div>
                            @if ($kandidat->stats_nikah == "Cerai hidup")
                                {{-- <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Foto Buku Nikah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_buku_nikah !== null)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="">
                                            <input type="file" name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                        @else
                                            <input type="file" disabled name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" disabled value="{{$kandidat->nama_pasangan}}" required name="nama_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Umur Pasangan</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="number" disabled min="0" value="{{$kandidat->umur_pasangan}}" name="umur_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Pekerjaan Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" disabled value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="" id="punya_anak">
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_lk}}" name="jml_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_angka_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_pr}}" name="jml_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_anak_pr}}" name="umur_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Surat Keterangan Cerai</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_cerai)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Cerai/{{$kandidat->foto_cerai}}" width="150" height="150" alt="">
                                            <input type="file" class="form-control" name="foto_cerai" accept="image/*">                                        
                                        @else
                                            <input type="file" class="form-control" name="foto_cerai" accept="image/*">
                                        @endif
                                    </div>
                                </div>
                            @elseif ($kandidat->stats_nikah == "Cerai mati") 
                                <div class="row mb-3 g-3 align-items-center">
                                    {{-- <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Foto Buku Nikah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_buku_nikah !== null)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="">
                                            <input type="file" name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                        @else
                                            <input type="file" disabled name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @endif
                                    </div> --}}
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" disabled value="{{$kandidat->nama_pasangan}}" name="nama_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Umur Pasangan</label>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($kandidat->umur_pasangan !== null)
                                            <input type="number" disabled value="{{$kandidat->umur_pasangan}}" name="umur_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        @else
                                            <input type="number" disabled min="0" name="umur_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Pekerjaan Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" disabled value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="" id="punya_anak">
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_lk}}" name="jml_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_angka_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_pr}}" name="jml_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_anak_pr}}" name="umur_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Akta Kematian Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_kematian_pasangan !== null)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" width="150" height="150" alt="">
                                            <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                        @else
                                            <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Foto Buku Nikah</label>
                                    </div>
                                    <div class="col-md-8">
                                        @if ($kandidat->foto_buku_nikah !== null)
                                            <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="">
                                            <input type="file" name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
                                        @else
                                            <input type="file" required name="foto_buku_nikah" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Nama Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" required value="{{$kandidat->nama_pasangan}}" name="nama_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Tanggal Lahir Pasangan</label>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="date" required class="form-control" name="tgl_lahir_pasangan" value="{{$kandidat->tgl_lahir_pasangan}}" id="">
                                    </div>
                                </div>
                                <div class="row mb-3 g-3 align-items-center">
                                    <div class="col-md-4">
                                        <label for="inputPassword6" class="col-form-label">Pekerjaan Pasangan</label>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" required value="{{$kandidat->pekerjaan_pasangan}}" name="pekerjaan_pasangan" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                    </div>
                                </div>
                                <div class="" id="punya_anak">
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_lk}}" name="jml_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Laki-laki</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_angka_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Jumlah Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="number" value="{{$kandidat->jml_anak_pr}}" name="jml_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                    <div class="row mb-3 g-3 align-items-center">
                                        <div class="col-md-4">
                                            <label for="inputPassword6" class="col-form-label">Umur Anak Perempuan</label>
                                        </div>
                                        <div class="col-md-8">
                                            <small class="col">Tuliskan umur anak dari paling besar sampai paling kecil, Contoh: 15, 12, 10, dst</small>
                                            <input type="text" value="{{$kandidat->umur_anak_pr}}" name="umur_anak_pr" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                        </div>
                                    </div>
                                </div>                                
                            @endif
                        </div>
                        <hr>
                        <button class="btn btn-primary my-3 float-end" type="submit">Simpan</button>
                    </form>
                </div>
                <hr>
            </div>
        </div>
    </div>
@endsection