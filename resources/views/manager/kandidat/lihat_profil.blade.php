@extends('layouts.manager')
@section('content')
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ProyekPortal</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="text-center"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">PERSONAL BIO DATA</b></div>
                            <h6 class="text-center" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="line-height:20px">
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-4"><b class="bold">NO. REGISTER</b></div>
                                <div class="col-md-6"><b class="bold">: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>                
                            </div>
                        </div>
                    </div>
                    <div class="row ml-5 mt-3 mb-2"><b class="bold">PERSONAL BIO DATA</b></div>
                    <div class ="row" style="line-height:20px">
                        <div class="col-md-10">
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">NAMA LENGKAP</b>
                                </div>
                                <div class="col-md-6">
                                    <b class="bold">: {{$kandidat->nama}}</b>
                                </div>        
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">JENIS KELAMIN</b>
                                </div>
                                <div class="col-md-5">: 
                                    @if ($kandidat->jenis_kelamin == "M")
                                        <b class="bold">Laki-Laki</b>
                                    @else
                                        <b class="bold">Perempuan</b>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                                </div>
                                <div class="col-md-5">
                                    <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">Usia</b>
                                </div>
                                <div class="col-md-5">
                                    <b class="bold">: {{$kandidat->usia}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">Tinggi / Berat Badan</b>
                                </div>
                                <div class="col-md-6">
                                    <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">Pendidikan</b>
                                </div>
                                <div class="col-md-5">
                                    <b class="bold">: {{$kandidat->pendidikan}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-md-4">
                                    <b class="bold">Asal</b>
                                </div>
                                <div class="col-md-6">
                                    <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                                </div>
                            </div>                                
                        </div>
                        <div class="col-md-2">
                            <img class=" float-end img" src="/gambar/default_user.png" width="120px" height="150px" alt="">
                            {{-- <img class=" float-end img" src="/gambar/4x6/{{$kandidat->foto_4x6}}" width="120px" height="150px" alt=""> --}}
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
                                                <table class="table table-bordered-bd-default text-center">
                                                    <thead>
                                                    <tr class="" style="font-size:10px;">
                                                        <th style="width: 1px;"><b class="bold">No</b></th>
                                                        <th style="width: 1px;"><b class="bold">Nama Majikan/Perusahaan</b></th>
                                                        <th style="width: 1px;"><b class="bold">Alamat Majikan/Perusahaan</b></th>
                                                        <th style="width: 1px;"><b class="bold">Jabatan</b></th>
                                                        <th><b class="bold">Periode</b></th>
                                                        <th style="width: 1px"><b class="bold">Alasan Berhenti</b></th>
                                                        <th><b class="bold">Pratinjau Video</b></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th><b class="bold">1st</b></th>
                                                            <td><b class="bold">{{$kandidat->nama_perusahaan1}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alamat_perusahaan1}}</b></td>
                                                            <td><b class="bold">{{$kandidat->jabatan1}}</b></td>
                                                            <td><b class="bold">{{$periode_awal1}} - {{$periode_akhir1}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alasan1}}</b></td>
                                                            @if ($kandidat->video_kerja1 !== null)
                                                                <td>
                                                                    <button type="button" style="font-size: 10px; font-weight:bold;" class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja1">
                                                                        See Video
                                                                    </button>
                                                                </td>                                                    
                                                            @else
                                                                <td>---</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th><b class="bold">2nd</b></th>
                                                            <td><b class="bold">{{$kandidat->nama_perusahaan2}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alamat_perusahaan2}}</b></td>
                                                            <td><b class="bold">{{$kandidat->jabatan2}}</b></td>
                                                            <td><b class="bold">{{$periode_awal2}} - {{$periode_akhir2}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alasan2}}</b></td>
                                                            @if ($kandidat->video_kerja2 !== null)
                                                                <td>
                                                                    <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja2">
                                                                        See Video
                                                                    </button>
                                                                </td>
                                                            @else
                                                                <td>---</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th><b class="bold">3rd</b></th>
                                                            <td><b class="bold">{{$kandidat->nama_perusahaan3}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alamat_perusahaan3}}</b></td>
                                                            <td><b class="bold">{{$kandidat->jabatan3}}</b></td>
                                                            <td><b class="bold">{{$periode_awal3}} - {{$periode_akhir3}}</b></td>
                                                            <td><b class="bold">{{$kandidat->alasan3}}</b></td>
                                                            @if ($kandidat->video_kerja3 !== null)
                                                            <td>
                                                                <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja3">
                                                                    See Video
                                                                </button>
                                                            </td>    
                                                            @else
                                                                <td>---</td>
                                                            @endif
                                                        </tr>
                                                        <tr>
                                                            <th colspan="2"><b class="bold">Pengalaman Kerja Keseluruhan</b></th>
                                                            @if ($pengalamanKerja == null)
                                                            <td colspan="5"></td>
                                                            @else
                                                                <td colspan="5">{{$pengalamanKerja->pengalaman_kerja}}</td>                                                                
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <p>Pengalaman kerja</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-success" href="/manager/kandidat/cetak_surat/{{$kandidat->id_kandidat}}">Cetak Surat Izin & Ahli waris</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_kandidat">
                                        Edit Kandidat
                                    </button>                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>        
            </div>
        </div>        
        <!-- Modal -->
        <div class="modal fade" id="video_kerja1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="ratio ratio-4x3">
                            <iframe class="object-fit-contain border rounded" src="video/Pengalaman Kerja1/{{$kandidat->video_kerja1}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="video_kerja2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <div class="ratio ratio-4x3">
                            <iframe class="object-fit-contain border rounded" src="video/Pengalaman Kerja2/{{$kandidat->video_kerja2}}" frameborder="0"></iframe>
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
                            <iframe class="object-fit-contain border rounded" src="video/Pengalaman Kerja3/{{$kandidat->video_kerja3}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Kirim Pesan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/kirim_pesan">
                    @csrf
                        <div class="mb-3">
                            <input type="text" name="id_kandidat" hidden value="{{$kandidat->id_kandidat}}">
                            <label for="recipient-name" class="col-form-label">Nama Pengirim</label>
                            <input type="text" value="{{$manager->name}}" name="nama" class="form-control" id="recipient-name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Isi Pesan:</label>
                            <textarea class="form-control" name="pesan" id="message-text"></textarea>
                        </div>
                            <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>                    
                        </form>
                </div>
                <div class="modal-footer">
                </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="edit_kandidat" tabindex="-1" aria-labelledby="edit_kandidat" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Pilih Bagian Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <a href="/manager/edit/kandidat/personal/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Personal</a>
                            <a href="/manager/edit/kandidat/document/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Document</a>
                            <a href="/manager/edit/kandidat/vaksin/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Vaksin</a>
                            <a href="/manager/edit/kandidat/family/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Family</a>        
                        </p>
                        <p>
                            <a href="/manager/edit/kandidat/parent/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Parent</a>
                            <a href="/manager/edit/kandidat/permission/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Permission</a>
                            <a href="/manager/edit/kandidat/placement/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Placement</a>
                            <a href="/manager/edit/kandidat/job/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Job</a>        
                        </p>
                        <p>
                            <a href="/manager/edit/kandidat/company/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Company</a>
                            <a href="/manager/edit/kandidat/paspor/{{$kandidat->id_kandidat}}" class="btn btn-warning">Edit Paspor</a>        
                        </p>
                    </div>
                </div>
            </div>
        </div>        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
</html>
@endsection