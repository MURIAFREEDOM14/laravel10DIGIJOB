@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header rounded-top bg-primary">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center text-light"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">bio data Profil</b></div>
                        <div class="text-center text-light mt-1"><b class="bold" style="font-size: 15px;">{{$negara->negara}}</b></div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" style="line-height:20px">
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-sm-4"><b class="bold">NO. REGISTER</b></div>
                            <div class="col-sm-6"><b class="bold">: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>                
                        </div>
                    </div>
                </div>
                <div class="ml-5 mt-2 mb-2"><b class="bold">PERSONAL BIO DATA</b></div>
                <div class ="row" style="line-height:20px">
                    <div class="col-md-9">
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">NAMA LENGKAP</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->nama}}</b>
                            </div>        
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">JENIS KELAMIN</b>
                            </div>
                            <div class="col-sm-5">: 
                                @if ($kandidat->jenis_kelamin == "M")
                                    <b class="bold">Laki-Laki</b>
                                @else
                                    <b class="bold">Perempuan</b>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Usia</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$usia}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Tinggi / Berat Badan</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Pendidikan</b>
                            </div>
                            <div class="col-sm-5">
                                <b class="bold">: {{$kandidat->pendidikan}}</b>
                            </div>
                        </div>
                        <div class="row" style="line-height:20px">
                            <div class="col-sm-4">
                                <b class="bold">Asal</b>
                            </div>
                            <div class="col-sm-6">
                                <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : {{$kandidat->rt}} / {{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                            </div>
                        </div>                                
                    </div>
                    <div class="col-md-3">
                        <div class="float-right">
                            @if ($kandidat->foto_set_badan !== null)
                                <img class="img" src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" alt="">
                            @else
                                <img class="img" src="/gambar/default_user.png" alt="">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row mt-5" style="line-height:15px">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <b class="bold">Pengalaman Kerja</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info text-center">
                                                <thead>
                                                <tr class="" style="font-size:10px;">
                                                    <th style="width: 1px;"><b class="bold">No</b></th>
                                                    <th style="width: 1px;"><b class="bold">Nama Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Alamat Perusahaan</b></th>
                                                    <th style="width: 1px;"><b class="bold">Jabatan</b></th>
                                                    <th><b class="bold">Periode</b></th>
                                                    <th style="width: 1px"><b class="bold">Alasan Berhenti</b></th>
                                                    <th><b class="bold">Pratinjau Video</b></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($pengalaman_kerja as $item)
                                                        <tr>
                                                            <th><b class="bold">{{$loop->iteration}}</b></th>
                                                            <td><b class="bold">{{$item->nama_perusahaan}}</b></td>
                                                            <td><b class="bold">{{$item->alamat_perusahaan}}</b></td>
                                                            <td><b class="bold">{{$item->jabatan}}</b></td>
                                                            <td><b class="bold">{{date('d-M-Y',strtotime($item->periode_awal))}} - {{date('d-M-Y',strtotime($item->periode_akhir))}}</b></td>
                                                            <td><b class="bold">{{$item->alasan_berhenti}}</b></td>
                                                            <td>
                                                                <a href="/galeri_pengalaman_kerja/{{$item->pengalaman_kerja_id}}" class="btn btn-primary">Lihat Galeri</a>
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
                    </div>
                </div>
                @if ($kandidat->id_perusahaan !== null && $kandidat->stat_pemilik == "diterima")
                    <a class="btn btn-success" href="/output_izin_waris">Cetak Surat Izin & Ahli waris</a>                    
                @endif
            </div>        
        </div>
    </div>        
    <!-- Modal -->
    <div class="modal fade" id="video_kerja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal fade" id="video_kerja2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja2/{{$kandidat->video_kerja2}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="video_kerja3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <div class="ratio ratio-4x3">
                        <video width="400" controls>
                            <source src="/gambar/Kandidat/{{$kandidat->nama}}/Pengalaman Kerja/Pengalaman Kerja3/{{$kandidat->video_kerja3}}" type="video/mp4">
                        </video>
                    </div>
                </div>
            </div>
        </div>
    </div>         --}}
    <script>
        
    </script>
@endsection