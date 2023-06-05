<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <style>
            .bold{
                font-size: 11px;
                text-transform: uppercase;
                line-height:1px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">PERSONAL BIO DATA</b></div>
                            <h6 class="text-center" style="line-height:20px">{{$negara->negara}}</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row" style="line-height:20px">
                        <div class="col-11">
                            <div class="row" style="line-height:20px">
                                <div class="col-4"><b class="bold">NO. REGISTER</b></div>
                                <div class="col-7"><b class="bold">{{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>        
                            </div>
                        </div>
                    </div>
                    <div class="row ms-5 my-3"><b class="bold">PERSONAL BIO DATA</b></div>
                    <div class ="row" style="line-height:20px">
                        <div class="col-11">
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">NAMA LENGKAP</b>
                                </div>
                                <div class="col-7">
                                    <b class="bold">: {{$kandidat->nama}}</b>
                                </div>        
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">JENIS KELAMIN</b>
                                </div>
                                <div class="col-5">: 
                                    @if ($kandidat->jenis_kelamin == "M")
                                        <b class="bold">Laki-Laki</b>
                                    @else
                                        <b class="bold">Perempuan</b>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">TEMPAT / TANGGAL LAHIR</b>
                                </div>
                                <div class="col-5">
                                    <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">Tinggi / Berat Badan</b>
                                </div>
                                <div class="col-7">
                                    <b class="bold">: {{$kandidat->tinggi}} cm, {{$kandidat->berat}} kg</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">Pendidikan</b>
                                </div>
                                <div class="col-5">
                                    <b class="bold">: {{$kandidat->pendidikan}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-4">
                                    <b class="bold">Asal</b>
                                </div>
                                <div class="col-7">
                                    <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                                </div>
                            </div>                                
                        </div>
                        <div class="col-1">
                            <img class="float-end" src="/gambar/4x6/{{$kandidat->foto_4x6}}" width="120px" height="150px" alt="">
                        </div>
                    </div>
                    <div class="row mt-5" style="line-height:20px">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <b class="bold">Pengalaman Kerja</b>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered border-black text-center">
                                        <thead>
                                        <tr class="" style="line-height:20px; font-size:12px;">
                                            <th scope="col">No</th>
                                            <th scope="col" style="width: 9rem;">Nama Majikan/Perusahaan</th>
                                            <th scope="col" style="width: 10rem;">Alamat Majikan/Perusahaan</th>
                                            <th scope="col">Jabatan</th>
                                            <th scope="col">Periode</th>
                                            <th scope="col">Alasan Berhenti</th>
                                            <th scope="col">Pratinjau video</th>
                                        </tr>
                                        </thead>
                                        <tbody style="line-height: 13px; font-size:11px; font-weight:bold;">
                                            <tr>
                                                <th scope="row">1</th>
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
                                                <th scope="row">2</th>
                                                <td>{{$kandidat->nama_perusahaan2}}</td>
                                                <td>{{$kandidat->alamat_perusahaan2}}</td>
                                                <td>{{$kandidat->jabatan2}}</td>
                                                <td>{{$periode_awal2}} - {{$periode_akhir2}}</td>
                                                <td>{{$kandidat->alasan2}}</td>
                                                @if ($kandidat->video_kerja2 !== null)
                                                    <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja2">
                                                        See Video
                                                    </button>
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>
                                            <tr>
                                                <th scope="row">3</th>
                                                <td>{{$kandidat->nama_perusahaan3}}</td>
                                                <td>{{$kandidat->alamat_perusahaan3}}</td>
                                                <td>{{$kandidat->jabatan3}}</td>
                                                <td>{{$periode_awal3}} - {{$periode_akhir3}}</td>
                                                <td>{{$kandidat->alasan3}}</td>
                                                @if ($kandidat->video_kerja3 !== null)
                                                    <button type="button" style="font-size: 10px; font-weight:bold; " class="btn" data-bs-toggle="modal" data-bs-target="#video_kerja3">
                                                        See Video
                                                    </button>
                                                @else
                                                    <td></td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>            
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
                            <iframe class="object-fit-contain border rounded" src="video/Pengalaman Kerja2/{{$kandidat->video_kerja3}}" frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
    <Script>
        // window.print();
    </Script>
</html>