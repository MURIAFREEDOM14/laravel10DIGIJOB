@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                {{-- <h6 class="text-center mb-5" style="text-transform: uppercase">
                    {{$negara}}
                </h6> --}}
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
                                        <input type="text" value="{{$kandidat->umur_anak_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
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
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Cerai/{{$kandidat->foto_cerai}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_cerai" accept="image/*">                                        
                                    @else
                                        <input type="file" required class="form-control" name="foto_cerai" accept="image/*">
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
                                        <input type="text" value="{{$kandidat->umur_anak_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
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
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Kematian Pasangan/{{$kandidat->foto_kematian_pasangan}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" class="form-control" name="foto_kematian_pasangan" accept="image/*">
                                    @else
                                        <input type="file" required class="form-control" name="foto_kematian_pasangan" accept="image/*">
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
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Buku Nikah/{{$kandidat->foto_buku_nikah}}" width="150" height="150" alt="" class="img mb-1">
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
                                        <input type="text" value="{{$kandidat->umur_anak_lk}}" name="umur_anak_lk" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
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
                    <a class="btn btn-warning" href="{{route('vaksin')}}">Lewati</a>
                    <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>    
@endsection