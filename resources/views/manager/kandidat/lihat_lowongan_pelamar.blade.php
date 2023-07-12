@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Lihat Lowongan</b>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="">Negara Tujuan</label>
                            </div>
                            <div class="col-md-6">
                                <div class=""><b class="bold">: {{$lowongan->negara}}</b></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="">Jabatan</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Jenis Kelamin</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Pendidikan</label>
                            </div>
                            <div class="col-md-6">
                                <div class=""><b class="bold">: {{$lowongan->pendidikan}}</b></div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="">Usia</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Pengalaman Bekerja</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Berat Badan</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Tinggi Badan</label>
                            </div>
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label>Kriteria Lokasi</label>
                            </div>  
                            <div class="col-md-6">
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
                            <div class="col-md-6">
                                <label for="" class="">Tanggal Tutup Lowongan</label>
                            </div>
                            <div class="col-md-6">
                                <div class=""><b class="bold">: {{date('d-M-Y',strtotime($lowongan->ttp_lowongan))}}</b></div>
                            </div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="">Kode Undangan</label>
                            </div>
                            <div class="col-md-6">
                                <div class=""><b class="bold">: {{$lowongan->referral_code}}</b></div>
                            </div>
                        </div>
                        <hr>
                        <a class="btn btn-danger" href="/perusahaan/list/lowongan">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <b class="bold">Kandidat Melamar</b>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover" >
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th></th>
                                        <th>Lihat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($kandidat !== null)
                                        @foreach ($kandidat as $item)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$item->nama}}</td>
                                                <td></td>
                                                <td>
                                                    <a href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}">Lihat</a>
                                                </td>
                                            </tr>    
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection