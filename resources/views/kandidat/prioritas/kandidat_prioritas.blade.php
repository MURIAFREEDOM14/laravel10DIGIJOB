@extends('layouts.prioritas')
@section('content')
    <div class="container mt-5">
        <hr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card bg-info">
                            <div class="card-body mx-auto">
                                <div class="avatar-xxl">
                                    <img src="/gambar/Kandidat/4x6/{{$kandidat->foto_4x6}}" alt="/Atlantis/examples." class="avatar-img rounded-circle">
                                </div>
                            </div>
                            <hr style="color: white">
                            <div class="text-white mx-1">
                                <b style="text-transform: uppercase; font-size:13px;">No. Register :</b>
                                <p>
                                    <b style="text-transform: uppercase; font-size:13px;">{{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b>
                                </p>
                                <b style="text-transform: uppercase; font-size:13px;">Nama :</b>
                                <p>
                                    <b style="text-transform: uppercase; font-size:13px;">{{$kandidat->nama}}</b>
                                </p>
                                <b style="text-transform: uppercase; font-size:13px;">Email :</b>
                                <p>
                                    <b style="text-transform: uppercase; font-size:13px;">{{$kandidat->email}}</b>
                                </p>                  
                                <b style="text-transform: uppercase; font-size:13px;">No. Telp :</b>
                                <p>
                                    <b style="text-transform: uppercase; font-size:13px;">{{$kandidat->no_telp}}</b>
                                </p>                  
                                <b style="text-transform: uppercase; font-size:13px;">Alamat :</b>
                                <p>
                                    <b style="text-transform: uppercase; font-size:13px;">Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                                </p>                  
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="card" style="background-color:blue">
                            <div class="card-body">
                                <div class="text-center text-white"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">PERSONAL BIO DATA</b></div>
                                <h6 class="text-center text-white" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8">
                                        <b style="text-transform: uppercase;">Nama Lengkap</b>
                                        <p><b style="text-transform: uppercase;">{{$kandidat->nama}}</b></p>                                                
                                        <hr>
                                        <b style="text-transform: uppercase;">Jenis Kelamin</b>
                                        <p>
                                            @if ($kandidat->jenis_kelamin == "M")
                                                <b class="" style="text-transform: uppercase">Laki-Laki</b>
                                            @else
                                                <b class="" style="text-transform: uppercase">Perempuan</b>
                                            @endif
                                        </p>                                                
                                        <hr>
                                        <b style="text-transform: uppercase;">Tempat / Tanggal Lahir</b>
                                        <p><b style="text-transform: uppercase;">{{$kandidat->tmp_lahir}}, {{$tgl_user}}</b></p>                                                
                                        <hr>
                                        <b style="text-transform: uppercase;">Usia</b>
                                        <p><b style="text-transform: uppercase;">{{$usia}}</b></p>                                                
                                        <hr>
                                        <b style="text-transform: uppercase;">Tinggi / Berat badan</b>
                                        <p><b style="text-transform: uppercase;">{{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b></p>                                                
                                        <hr>
                                        <b style="text-transform: uppercase;">Pendidikan</b>
                                        <p><b style="text-transform: uppercase;">{{$kandidat->pendidikan}}</b></p>                                                
                                        <hr>
                                    </div>
                                    <div class="col-4">
                                        <img class=" float-end img" src="/gambar/default_user.png" width="120px" height="150px" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card border-primary">
                            <div class="card-header">
                                <b class="bold">Pengalaman Kerja</b>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-head-bg-info table-bordered-bd-primary text-center">
                                                <thead>
                                                <tr class="" style="font-size:10px;">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Nama Majikan/Perusahaan</th>
                                                    <th scope="col">Alamat Majikan/Perusahaan</th>
                                                    <th scope="col">Jabatan</th>
                                                    <th scope="col">Periode</th>
                                                    <th scope="col">Alasan Berhenti</th>
                                                    <th scope="col">Pratinjau video</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>1st</th>
                                                        <td>{{$kandidat->nama_perusahaan1}}</td>
                                                        <td>{{$kandidat->alamat_perusahaan1}}</td>
                                                        <td>{{$kandidat->jabatan1}}</td>
                                                        <td>{{$periode_awal1}} - {{$periode_akhir1}}</td>
                                                        <td>{{$kandidat->alasan1}}</td>
                                                        @if ($kandidat->video_kerja1 !== null)
                                                            <td>
                                                                <button type="button" style="font-size: 10px; font-weight:bold;" class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja1">
                                                                    See Video
                                                                </button>
                                                            </td>                                                    
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th>2nd</th>
                                                        <td>{{$kandidat->nama_perusahaan2}}</td>
                                                        <td>{{$kandidat->alamat_perusahaan2}}</td>
                                                        <td>{{$kandidat->jabatan2}}</td>
                                                        <td>{{$periode_awal2}} - {{$periode_akhir2}}</td>
                                                        <td>{{$kandidat->alasan2}}</td>
                                                        @if ($kandidat->video_kerja2 !== null)
                                                            <td>
                                                                <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja2">
                                                                    See Video
                                                                </button>
                                                            </td>
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th>3rd</th>
                                                        <td>{{$kandidat->nama_perusahaan3}}</td>
                                                        <td>{{$kandidat->alamat_perusahaan3}}</td>
                                                        <td>{{$kandidat->jabatan3}}</td>
                                                        <td>{{$periode_awal3}} - {{$periode_akhir3}}</td>
                                                        <td>{{$kandidat->alasan3}}</td>
                                                        @if ($kandidat->video_kerja3 !== null)
                                                        <td>
                                                            <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja3">
                                                                See Video
                                                            </button>
                                                        </td>    
                                                        @else
                                                            <td></td>
                                                        @endif
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <a class="btn text-white" style="background-color: green;" href="/output_izin_waris">Cetak Surat Izin & Ahli waris</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection