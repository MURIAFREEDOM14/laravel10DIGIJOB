@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="">
        <div class="">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <form action="/isi_kandidat_permission" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="" id="perizin">
                        <div class="row mb-1">
                            <div class="col-md-12">
                                <h6 class="ms-5">Kontak Darurat</h6> 
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Hubungan Kontak Darurat</label>
                            </div>
                            <div class="col-md-4">
                                @if ($kandidat->stats_nikah == "Menikah" || $kandidat->stats_nikah == "Cerai hidup" || $kandidat->stats_nikah == "Cerai mati")
                                    <select name="hubungan_perizin" required class="form-select" id="hubKontakDarurat">
                                        <option value="">-- Masukkan Hubungan Kontak Darurat --</option>
                                        <option value="pasangan" @if ($kandidat->hubungan_perizin == "pasangan")
                                            selected
                                        @endif>Pasangan</option>
                                        <option value="wali">Wali</option>
                                        @if ($anak)
                                            <option value="anak">Anak</option>
                                        @endif
                                    </select>
                                @else
                                    <select name="hubungan_perizin" required class="form-select" id="hubKontakDarurat">
                                        <option value="">-- Masukkan Hubungan Kontak Darurat --</option>
                                        <option value="ayah">Ayah</option>
                                        <option value="ibu">Ibu</option>
                                        <option value="wali">Wali</option>
                                    </select>    
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Kontak Darurat</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required value="{{$kandidat->nama_perizin}}" name="nama_perizin" id="namaHubungan" class="form-control" aria-labelledby="passwordHelpInline">  
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">NIK Kontak Darurat</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" required value="{{$kandidat->nik_perizin}}" name="nik_perizin" id="NIKHubungan" class="form-control @error('nik_perizin') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('nik_perizin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Harap isi no. nik 16 digit</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">No. Telp / HP</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" value="{{$kandidat->no_telp_perizin}}" name="no_telp_perizin" id="telpHubungan" class="form-control" aria-labelledby="passwordHelpInline">
                                @error('no_telp_perizin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Harap isi no. telp min 10 digit dan max 13 digit</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tempat Lahir Kontak Darurat</label>
                            </div>
                            <div class="col-md-6">
                                <input type="text" value="{{$kandidat->tmp_lahir_perizin}}" name="tmp_lahir_perizin" id="tmpLahirHubungan" class="form-control" aria-labelledby="passwordHelpInline">
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tanggal Lahir Kontak Darurat</label>
                            </div>
                            <div class="col-md-6">
                                <input type="date" value="{{$kandidat->tgl_lahir_perizin}}" name="tgl_lahir_perizin" id="tglLahirHubungan" class="form-control" aria-labelledby="passwordHelpInline">                                        
                            </div>
                        </div>
                        <div class="row g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Alamat Lengkap Kontak Darurat</label>
                            </div>
                        </div>
                        @livewire('location-permission')
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">RT</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rt_perizin}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rt_perizin" id="rtHubungan" class="form-control @error('rt_perizin') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rt_perizin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RT harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <label for="" class="col-form-label">RW</label>
                            </div>
                            <div class="col-md-2">
                                <input type="number" required value="{{$kandidat->rw_perizin}}" placeholder="maks 3 digit" pattern="[0-3]{3}" name="rw_perizin" id="rwHubungan" class="form-control @error('rw_perizin') is-invalid @enderror" aria-labelledby="passwordHelpInline">
                                @error('rw_perizin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>No. RW harus berisi 3 digit</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Foto KTP Kontak Darurat</label>
                            </div>
                            <div class="col-md-8">
                                @if ($kandidat->foto_ktp_izin == "")
                                    <input type="file" required class="form-control @error('foto_ktp_izin') is-invalid @enderror"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="f_ktpHubungan" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @error('foto_ktp_izin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @elseif ($kandidat->foto_ktp_izin !== null)
                                    <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP Perizin/{{$kandidat->foto_ktp_izin}}" width="150" height="150" alt="" class="img mb-1">
                                    <input type="file" class="form-control @error('foto_ktp_izin') is-invalid @enderror"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    <input type="text" name="" hidden id="f_ktpHubungan" value="foto_ktp_hubungan">
                                    @error('foto_ktp_izin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @else
                                    <input type="file" class="form-control @error('foto_ktp_izin') is-invalid @enderror" required name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="f_ktpHubungan" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @error('foto_ktp_izin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Apakah anda memiliki Paspor</label>
                            </div>
                            <div class="col-md-3">
                                <select name="confirm" class="form-select" id="">
                                    <option value="tidak" @if ($kandidat->no_paspor == null)
                                        selected
                                    @endif>Tidak</option>
                                    <option value="ya" @if ($kandidat->no_paspor !== null)
                                        selected
                                    @endif>Ya</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    {{-- <a class="btn btn-warning" href="{{route('paspor')}}">Lewati</a> --}}
                    <button class="btn btn-primary float-end" type="submit" onclick="processing()" id="btn">Selanjutnya</button>
                    <button type="button" class="btn btn-primary float-end mr-2" id="btnload"><div class="spinner-border text-light" role="status"></div></button>
                </form>
            </div>
            <hr>
        </div>
    </div>
</div>
<script>
    function processing() {
        var namaHubungan = document.getElementById('namaHubungan').value;
        var NIKHubungan = document.getElementById('NIKHubungan').value;
        var telpHubungan = document.getElementById('telpHubungan').value;
        var tmpLahirHubungan = document.getElementById('tmpLahirHubungan').value;
        var tglLahirHubungan = document.getElementById('tglLahirHubungan').value;
        var provinsi = document.getElementById('provinsi').value;
        var kota = document.getElementById('kota').value;
        var kecamatan = document.getElementById('kecamatan').value;
        var kelurahan = document.getElementById('kelurahan').value;
        var dusun = document.getElementById('dusun').value;
        var rtHubungan = document.getElementById('rtHubungan').value;
        var rwHubungan = document.getElementById('rwHubungan').value;
        var fktpHubungan = document.getElementById('f_ktpHubungan').value;
        if (namaHubungan !== '' &&
            NIKHubungan !== '' &&
            telpHubungan !== '' &&
            tmpLahirHubungan !== '' &&
            tglLahirHubungan !== '' &&
            provinsi !== '' &&
            kota !== '' &&
            kecamatan !== '' &&
            kelurahan !== '' &&
            dusun !== '' &&
            rtHubungan !== '' &&
            rwHubungan !== '' &&
            fktpHubungan !== '') {
            var submit = document.getElementById('btn').style.display = 'none';
            var btnLoad = document.getElementById('btnload').style.display = 'block';
        }
    }
</script>
@endsection