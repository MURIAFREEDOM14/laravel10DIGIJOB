@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <!-- form(post) KandidatController => simpan_kandidat_vaksin -->
                <form action="/isi_kandidat_vaksin" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="" id="vaksinasi">
                        <div class="row mb-1">
                            <div class="col-md-4">
                                <h6 class="ms-5">VAKSINASI COVID-19</h6> 
                            </div>
                        </div>
                        <div class="" id="vaksin1">
                            <!-- pilihan nama vaksin 1 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Vaksin Pertama</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="vaksin1" class="form-select" id="">
                                        <option value="">-- Pilih Nama Vaksin --</option>
                                        <option value="ASTRA ZENECA" @if ($kandidat->vaksin1 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                        <option value="PFIZER" @if ($kandidat->vaksin1 == "PFIZER") selected @endif>PFIZER</option>
                                        <option value="SINOVAC" @if ($kandidat->vaksin1 == "SINOVAC") selected @endif>SINOVAC</option>
                                        <option value="SINOPHARM" @if ($kandidat->vaksin1 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                        <option value="CORONAVAC" @if ($kandidat->vaksin1 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                        <option value="MODERNA" @if ($kandidat->vaksin1 == "MODERNA") selected @endif>MODERNA</option>
                                        <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin1 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input batch ID 1 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Batch ID Pertama</label>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1 img" src="/gambar/batch_id.jpg" alt="">
                                    <input type="text" value="{{$kandidat->no_batch_v1}}" name="no_batch_v1" class="form-control">
                                </div>
                            </div>
                            <!-- input tanggal vaksin 1 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tanggal Vaksin Pertama</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" value="{{$kandidat->tgl_vaksin1}}" name="tgl_vaksin1" class="form-control" autofocus>
                                </div>
                            </div>
                            <!-- input sertifikat vaksin 1 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Sertifikat Vaksin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->sertifikat_vaksin1 == "")
                                        <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                    @elseif ($kandidat->sertifikat_vaksin1 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Pertama/{{$kandidat->sertifikat_vaksin1}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                    @else
                                        <input type="file" value="{{$kandidat->sertifikat_vaksin1}}" name="sertifikat_vaksin1" class="form-control" accept="image/*">                                            
                                    @endif
                                </div>
                            </div>
                        </div>
                        <hr class="">    
                        <div class="" id="vaksin2">
                            <!-- pilihan nama vaksin 2 -->
                            <div class="row my-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Vaksin Kedua</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="vaksin2" class="form-select" id="">
                                        <option value="">-- Pilih Nama Vaksin --</option>
                                        <option value="ASTRA ZENECA" @if ($kandidat->vaksin2 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                        <option value="PFIZER" @if ($kandidat->vaksin2 == "PFIZER") selected @endif>PFIZER</option>
                                        <option value="SINOVAC" @if ($kandidat->vaksin2 == "SINOVAC") selected @endif>SINOVAC</option>
                                        <option value="SINOPHARM" @if ($kandidat->vaksin2 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                        <option value="CORONAVAC" @if ($kandidat->vaksin2 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                        <option value="MODERNA" @if ($kandidat->vaksin2 == "MODERNA") selected @endif>MODERNA</option>
                                        <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin2 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input batch ID 2 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Batch ID Kedua</label>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1 img" src="/gambar/batch_id.jpg" alt="">
                                    <input type="text" value="{{$kandidat->no_batch_v2}}" name="no_batch_v2" class="form-control">
                                </div>
                            </div>
                            <!-- input tanggal vaksin 2 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tanggal Vaksin Kedua</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" value="{{$kandidat->tgl_vaksin2}}" name="tgl_vaksin2" class="form-control">
                                </div>
                            </div>
                            <!-- input sertifikat vaksin 2 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Sertifikat Vaksin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->sertifikat_vaksin2 == "")
                                        <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                    @elseif ($kandidat->sertifikat_vaksin2 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Kedua/{{$kandidat->sertifikat_vaksin2}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                    @else
                                        <input type="file" name="sertifikat_vaksin2" class="form-control" accept="image/*">                                            
                                    @endif
                                </div>
                            </div>
                            <hr>    
                        </div>
                        <div class="" id="vaksin3">
                            <!-- pilihan nama vaksin 3 -->
                            <div class="row my-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Vaksin Ketiga</label>
                                </div>
                                <div class="col-md-8">
                                    <select name="vaksin3" class="form-select" id="">
                                        <option value="">-- Pilih Nama Vaksin --</option>
                                        <option value="ASTRA ZENECA" @if ($kandidat->vaksin3 == "ASTRA ZENECA") selected @endif>ASTRA ZENECA</option>
                                        <option value="PFIZER" @if ($kandidat->vaksin3 == "PFIZER") selected @endif>PFIZER</option>
                                        <option value="SINOVAC" @if ($kandidat->vaksin3 == "SINOVAC") selected @endif>SINOVAC</option>
                                        <option value="SINOPHARM" @if ($kandidat->vaksin3 == "SINOPHARM") selected @endif>SINOPHARM</option>
                                        <option value="CORONAVAC" @if ($kandidat->vaksin3 == "CORONAVAC") selected @endif>CORONAVAC</option>
                                        <option value="MODERNA" @if ($kandidat->vaksin3 == "MODERNA") selected @endif>MODERNA</option>
                                        <option value="JOHNSONS & JOHNSONS" @if ($kandidat->vaksin3 == "JOHNSONS & JOHNSONS") selected @endif>JOHNSONS & JOHNSONS</option>
                                    </select>
                                </div>
                            </div>
                            <!-- input batch ID 3 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Batch ID Ketiga</label>
                                </div>
                                <div class="col-md-8">
                                    <label for="">Berikut contoh nomor Batch ID yang terdapat di sertifikat vaksin anda : </label><img class="mb-1 img" src="/gambar/batch_id.jpg" alt="">
                                    <input type="text" value="{{$kandidat->no_batch_v3}}" name="no_batch_v3" class="form-control">
                                </div>
                            </div>
                            <!-- input tanggal vaksin 3 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Tanggal Vaksin Ketiga</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date" value="{{$kandidat->tgl_vaksin3}}" name="tgl_vaksin3" class="form-control">
                                </div>
                            </div>
                            <!-- input sertifikat vaksin 3 -->
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Sertifikat Vaksin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->sertifikat_vaksin3 == "")
                                        <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                    @elseif ($kandidat->sertifikat_vaksin3 !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/Vaksin Ketiga/{{$kandidat->sertifikat_vaksin3}}" width="150" height="150" alt="" class="img mb-1">
                                        <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                    @else
                                        <input type="file" name="sertifikat_vaksin3" class="form-control" accept="image/*">                                            
                                    @endif
                                </div>
                            </div>    
                        </div>
                    </div>
                    <small>Catatan : Pastikan sudah vaksin minimal 2 kali</small>
                    <hr>
                    <a class="btn btn-warning" href="{{route('parent')}}">Lewati</a>
                    <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                    <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                </form>
            </div>
            <hr>
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