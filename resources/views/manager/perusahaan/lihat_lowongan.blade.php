@extends('layouts.manager')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h5 style="font-weight: bold">Lihat Lowongan</h5>
        </div>
        <div class="card-body">
            {{-- <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Tema Lowongan</label>
                </div>
                <div class="col-md-8">
                    <div class=""><b class="bold">: {{$lowongan->nama_lowongan}}</b></div>
                </div>
            </div> --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Negara Tujuan</label>
                </div>
                <div class="col-md-8">
                    <div class=""><b class="bold">: {{$lowongan->negara}}</b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Jabatan</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: {{$lowongan->jabatan}}</b></div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <hr>
                    <h5 style="font-weight:bold">Persyaratan</h5>
                    <hr>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Jenis Kelamin</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->jenis_kelamin == "M")
                            Laki-laki
                        @elseif($lowongan->jenis_kelamin == "F")
                            Perempuan
                        @else
                            Laki-laki & Perempuan
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Pendidikan</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: {{$lowongan->pendidikan}}</b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Usia</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->usia == null)
                            Tidak ada batasan
                        @else
                            {{$lowongan->usia}}
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Pengalaman Bekerja</label>
                </div>
                <div class="col-md-8">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->pengalaman_kerja == null)
                            Tidak ada batasan
                        @else
                            {{$lowongan->pengalaman_kerja}}
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Berat Badan</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->berat == null)
                            Tidak ada batasan
                        @else
                            {{$lowongan->berat}}
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="" class="col-form-label">Tinggi Badan</label>
                </div>
                <div class="col-md-4">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->tinggi == null)
                            Tidak ada batasan
                        @else
                            {{$lowongan->tinggi}}
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">   
                <div class="col-4">
                    <label>Kriteria Lokasi</label>
                </div>  
                <div class="col-8">
                    <div class=""><b class="bold">: 
                        @if ($lowongan->pencarian_tmp == null)
                            Se-Indonesia
                        @else
                            {{$lowongan->pencarian_tmp}}
                        @endif
                    </b></div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="" class="col-form-label">Tanggal Tutup Lowongan</label>
                </div>
                <div class="col-8">
                    <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->ttp_lowongan))}}</b></div>
                </div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="" class="col-form-label">Kode Undangan</label>
                </div>
                <div class="col-8">
                    <div class=""><b class="bold">: {{$perusahaan->referral_code}}</b></div>
                </div>
            </div>
            <hr>
            <a class="btn btn-danger" href="/manager/perusahaan/lihat_profil/{{$perusahaan->id_perusahaan}}">Kembali</a>
        </div>
    </div>
</div>
@endsection