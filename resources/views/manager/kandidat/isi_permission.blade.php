@extends('layouts.manager')

@section('content')
    <div class="container mt-5">        
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <h4 class="mx-auto">PERSONAL BIO DATA</h4>                    
                </div>
                <div class="">
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="" id="perizin">
                            <div class="row mb-1">
                                <div class="col-md-4">
                                    <h6 class="ms-5">Surat Izin OrangTua / Suami / Istri / Wali</h6> 
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Nama Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->nama_perizin}}" name="nama_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">NIK Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"   value="{{$kandidat->nik_perizin}}" name="nik_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">No. Telp / HP</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->no_telp_perizin}}" name="no_telp_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tempat Lahir Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text"  value="{{$kandidat->tmp_lahir_perizin}}" name="tmp_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Tanggal Lahir Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="date"  value="{{$kandidat->tgl_lahir_perizin}}" name="tgl_lahir_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Alamat Lengkap Perizin</label>
                                </div>
                                <div class="col-md-8">
                                    <input name="alamat_perizin"  value="{{$kandidat->alamat_perizin}}" class="form-control" id="" cols="" rows=""></input>
                                </div>
                            </div>
                            @livewire('manager.location-permission')
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Dusun</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" value="{{$kandidat->dusun_perizin}}" name="dusun_perizin"  placeholder="Masukkan Alamat Dusun">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">RT / RW</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number"  value="{{$kandidat->rt_perizin}}" placeholder="Masukkan RT" name="rt_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                                <div class="col-md-4">
                                    <input type="number"  value="{{$kandidat->rw_perizin}}" placeholder="Masukkan RW" name="rw_perizin" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline">
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Foto KTP Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    @if ($kandidat->foto_ktp_izin == "")
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @elseif ($kandidat->foto_ktp_izin !== null)
                                        <img src="/gambar/Kandidat/{{$kandidat->nama}}/KTP Perizin/{{$kandidat->foto_ktp_izin}}" width="120" height="150" alt="">
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @else
                                        <input type="file" class="form-control"  name="foto_ktp_izin" value="{{$kandidat->foto_ktp_izin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">                                        
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3 g-3 align-items-center">
                                <div class="col-md-4">
                                    <label for="inputPassword6" class="col-form-label">Hubungan Pemberi Izin</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" class="form-control"  name="hubungan_perizin" placeholder="Masukkan hubungan. contoh: ayah, ibu, suami, anak, dll." value="{{$kandidat->hubungan_perizin}}" id="inputPassword6" class="form-control" aria-labelledby="passwordHelpInline" accept="image/*">
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
@endsection