@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <!-- form(post) KandidatController => simpan_kandidat_parent -->
                <form action="/isi_kandidat_parent" method="POST">
                    @csrf
                    <div class="" id="parent">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <h6 class="ms-5">Data Orang Tua / Wali</h6> 
                            </div>
                        </div>
                        <!-- input nama ayah kandung-->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Ayah Kandung</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->nama_ayah}}" name="nama_ayah" id="namaAyah" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <!-- input tempat lahir ayah -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tempat Lahir Ayah Kandung</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Masukkan Tempat Lahir" required value="{{$kandidat->tmp_lahir_ayah}}" name="tmp_lahir_ayah" class="form-control" id="tmpLahirAyah">
                            </div>
                        </div>
                        <!-- input tanggal lahir ayah -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Lahir Ayah Kandung</label>
                            </div>
                            <div class="col-md-6">
                                <!-- pilihan ket. keadaan ayah -->
                                <select name="ket_keadaan_ayah" class="form-select mb-3" id="ket_keadaan_ayah">
                                    <option value="hidup" @if ($kandidat->tgl_lahir_ayah !== null && $kandidat->nama_ayah !== null)
                                        selected
                                    @endif>Hidup</option>
                                    <option value="meninggal" @if ($kandidat->tgl_lahir_ayah == null && $kandidat->nama_ayah !== null)
                                        selected
                                    @endif>Meninggal</option>
                                </select>
                                <!-- input tanggal lahir ayah -->
                                <input type="date" placeholder="Masukkan Tanggal Lahir" value="{{$kandidat->tgl_lahir_ayah}}" name="tgl_lahir_ayah" class="form-control" id="ket_hidup_ayah">
                            </div>
                        </div>
                        <!-- input nama ibu kandung -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Ibu Kandung</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->nama_ibu}}" name="nama_ibu" class="form-control" id="namaIbu">
                            </div>
                        </div>
                        <!-- input tempat lahir ibu kandung -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tempat Lahir Ibu Kandung</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Masukkan Tempat Lahir" required value="{{$kandidat->tmp_lahir_ibu}}" name="tmp_lahir_ibu" class="form-control" id="tmpLahirIbu">
                            </div>
                        </div>
                        <!-- input tanggal lahir ibu -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Lahir Ibu Kandung</label>
                            </div>
                            <div class="col-md-6">
                                <!-- pilihan ket. keadaan ibu -->
                                <select name="ket_keadaan_ibu" class="form-select mb-3" id="ket_keadaan_ibu">
                                    <option value="hidup" @if ($kandidat->tgl_lahir_ibu !== null && $kandidat->nama_ibu !== null)
                                        selected
                                    @endif>Hidup</option>
                                    <option value="meninggal" @if ($kandidat->tgl_lahir_ibu == null && $kandidat->nama_ibu !== null)
                                        selected
                                    @endif>Meninggal</option>
                                </select>
                                <!-- input tanggal lahir ibu -->
                                <input type="date" placeholder="Masukkan Tanggal Lahir" value="{{$kandidat->tgl_lahir_ibu}}" name="tgl_lahir_ibu" class="form-control" id="ket_hidup_ibu">
                            </div>
                        </div>
                        <!-- menggunakan livewire -->
                        <!-- lokasi livewire : app/Http/Livewire/Kandidat/ParentLocation -->
                        <!-- lokasi livewire view : resources/views/livewire/kandidat/parent-location -->
                        @livewire('kandidat.parent-location')
                        <!-- input rt & rw -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">RT</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rt_parent}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rt" id="rtKeluarga" class="form-control @error('rt') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rt')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RT harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="" class="col-form-label">RW</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rw_parent}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rw" id="rwKeluarga" class="form-control @error ('rw') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rw')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RW harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!-- input jumlah saudara laki2 -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Jumlah Saudara Laki-laki</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_lk" id="jmlSdrLk" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <!-- input jumlah saudara perempuan -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Jumlah Saudara Perempuan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$kandidat->jml_sdr_lk}}" name="jml_sdr_pr" id="jmlSdrPr" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <!-- input anak ke -->
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Anak Ke</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->anak_ke}}" name="anak_ke" id="anakKe" class="form-control" aria-labelledby="passwordHelpInline">                                        
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- <a class="btn btn-warning" href="{{route('company')}}">Lewati</a> --}}
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
        var namaAyah = document.getElementById('namaAyah').value;
        var tmpLahirAyah = document.getElementById('tmpLahirAyah').value;
        var ketKeadaanAyah = document.getElementById('ket_keadaan_ayah').value;
        var tglLahirAyah = document.getElementById('ket_hidup_ayah').value;
        var namaIbu = document.getElementById('namaIbu').value;
        var tmpLahirIbu = document.getElementById('tmpLahirIbu').value;
        var ketKeadaanIbu = document.getElementById('ket_keadaan_ibu').value;
        var tglLahirIbu = document.getElementById('ket_hidup_ibu').value;
        var provinsi = document.getElementById('provinsi').value;
        var kota = document.getElementById('kota').value;
        var kecamatan = document.getElementById('kecamatan').value;
        var kelurahan = document.getElementById('kelurahan').value;
        var dusun = document.getElementById('dusun').value;
        var rt = document.getElementById('rtKeluarga').value;
        var rw = document.getElementById('rwKeluarga').value;
        var jmlSdrLk = document.getElementById('jmlSdrLk').value;
        var jmlSdrPr = document.getElementById('jmlSdrPr').value;
        var anakKe = document.getElementById('anakKe').value;
        if (namaAyah !== '' &&
            tmpLahirAyah !== '' &&
            namaIbu !== '' &&
            tmpLahirIbu !== '' &&
            provinsi !== '' &&
            kota !== '' &&
            kecamatan !== '' &&
            kelurahan !== '' &&
            dusun !== '' &&
            rt !== '' &&
            rw !== '' &&
            jmlSdrLk !== '' &&
            jmlSdrPr !== '' &&
            anakKe !== '') {
            if (ketKeadaanAyah == "hidup") {
                if (tglLahirAyah !== '') {
                    var submit = document.getElementById('btn').style.display = 'none';
                    var btnLoad = document.getElementById('btnload').style.display = 'block';
                }
            } else {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
            if (ketKeadaanIbu == "hidup") {
                if (tglLahirIbu !== '') {
                    var submit = document.getElementById('btn').style.display = 'none';
                    var btnLoad = document.getElementById('btnload').style.display = 'block';       
                }
            } else {
                var submit = document.getElementById('btn').style.display = 'none';
                var btnLoad = document.getElementById('btnload').style.display = 'block';
            }
        }
    }
</script>
@endsection