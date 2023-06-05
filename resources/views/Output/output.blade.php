<!doctype html>
<html lang="in">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="print.css" media="print" />
        <title>&nbsp;</title>
        <style>
            .bold{
                font-size: 11px;
                text-transform: uppercase;
                line-height:1px;
            }
            .img{
                border: 1px solid black;
                border-radius: 2%;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {{-- Personal Biodata --}}
            <hr>
            <div class="row">
                <div class="col">
                    <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">PERSONAL BIO DATA</b></div>
                </div>
            </div>
            <h6 class="text-center" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6>
            <div class="row" style="line-height:20px">
                <div class="col-8"></div>
                <div class="col-4">
                    <b class="bold float-start">NO: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b>
                </div>
            </div>
            <div class="row"><b class="" style="font-size: 1rem; line-height:1px;">A. PERSONAL BIO DATA</b></div>
            <div class="row mt-3" style="line-height:20px">
                <div class="col-9">
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">NAMA</b>
                        </div>
                        <div class="col-7">
                            <b class="bold">: {{$kandidat->nama}}</b>
                        </div>        
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">JK</b>
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
                        <div class="col-3">
                            <b class="bold">TANGGAL LAHIR</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$tgl_user}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">TEMPAT LAHIR</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->tmp_lahir}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">ALAMAT LENGKAP</b>
                        </div>
                        <div class="col-8">
                            <b class="bold">: {{$kandidat->alamat}}</b>
                        </div>
                    </div>
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">NO. KTP</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->nik}}</b>
                        </div>
                    </div>                
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">Warga Negara</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->stats_negara}}</b>
                        </div>
                    </div>                
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">Tinggi/Berat</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->tinggi}}cm/{{$kandidat->berat}}kg</b>
                        </div>
                    </div>                
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">Pendidikan</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->pendidikan}}</b>
                        </div>
                    </div>                
                    <div class="row" style="line-height:20px">
                        <div class="col-3">
                            <b class="bold">NO. TELP/HP</b>
                        </div>
                        <div class="col-5">
                            <b class="bold">: {{$kandidat->no_telp}}</b>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    @if ($kandidat->foto_4x6 !== null)
                        <img class="float-end img" src="/gambar/4x6/{{$kandidat->foto_4x6}}" width="210" height="230" alt="">                        
                    @else
                        <img class="float-end img" src="/gambar/default_user.png" width="210" height="230" alt="">
                    @endif
                </div>
            </div>

            {{-- Family --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-12"> --}}
                    <div class="row mt-3"><b class="" style="font-size:1rem;">B. FAMILY BACKGROUND</b></div>
                    <div class="row">
                        <div class="col-12">
                            <div class="row" style="line-height:20px">
                                <div class="col-3">
                                    <b class="bold">NAMA AYAH</b>
                                </div>
                                <div class="col-2">
                                    <b class="bold">: {{$kandidat->nama_ayah}}</b>
                                </div>
                                <div class="col-3">
                                    <b class="bold">Umur Ayah</b>
                                </div>
                                <div class="col-2">
                                    @if ($kandidat->umur_ayah == 0)
                                        <b class="bold">: ALM</b>
                                    @else
                                        <b class="bold">: {{$kandidat->umur_ayah}}</b>
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-3">
                                    <b class="bold">NAMA IBU</b>
                                </div>
                                <div class="col-2">
                                    <b class="bold">: {{$kandidat->nama_ibu}}</b>
                                </div>
                                <div class="col-3">
                                    <b class="bold">Umur Ibu</b>
                                </div>
                                <div class="col">
                                    @if ($kandidat->umur_ibu == 0)
                                        <b class="bold">: ALM</b>
                                    @else
                                        <b class="bold">: {{$kandidat->umur_ibu}}</b>                            
                                    @endif
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-3">
                                    <b class="bold">Jml Sdr Kandung</b>
                                </div>
                                <div class="col-2">
                                    <b class="bold">: {{$kandidat->jml_sdr_lk + $kandidat->jml_sdr_pr}}</b>
                                </div>
                                <div class="col-3">
                                    <b class="bold">ANAK KE</b>
                                </div>
                                <div class="col-2">
                                    <b class="bold">: {{$kandidat->anak_ke}}</b>
                                </div>
                            </div>
                            <div class="row" style="line-height:20px">
                                <div class="col-3">
                                    <b class="bold">NAMA Suami/Istri</b>
                                </div>
                                <div class="col-2">: 
                                    @if ($kandidat->nama_pasangan !== null)
                                        <b class="bold">{{$kandidat->nama_pasangan}}</b>
                                    @else
                                        <b class="bold">-</b>                                    
                                    @endif
                                </div>
                                <div class="col-3">
                                    <b class="bold">PEKERJAAN PASANGAN</b>
                                </div>
                                <div class="col">: 
                                    @if ($kandidat->nama_pasangan !== null)
                                        <b class="bold">{{$kandidat->pekerjaan_pasangan}}</b>
                                    @else
                                    <b class="bold">-</b>
                                    @endif
                                </div>
                            </div>                    
                            <div class="row" style="line-height:20px">
                                <div class="col-3">
                                    <b class="bold">Jumlah anak</b>
                                </div>
                                <div class="col-2">: 
                                    @if ($kandidat->anak_lk !== null || $kandidat->anak_pr !== null)
                                        <b class="bold">{{$kandidat->anak_lk + $kandidat->anak_pr}}</b>
                                    @else
                                        <b class="bold">0</b>
                                    @endif
                                </div>
                                <div class="col-3">
                                    <b class="bold">Umur</b>
                                </div>
                                <div class="col-4">: 
                                    @if ($kandidat->anak_lk !== null || $kandidat->anak_pr !== null)
                                        <b class="bold">{{$kandidat->umur_anak_pr}}, {{$kandidat->umur_anak_lk}}</b>
                                    @else
                                        <b class="bold">0</b>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                                        
                {{-- </div> --}}
            {{-- </div> --}}

            {{-- Interview --}}

            <div class="row">
                <div class="mt-3"><b class="" style="font-size: 1rem;">C. interview Appraisal</b></div>
                <div class="col-8 mt-3">
                    <div class="row">
                        <div class="col-4">
                            <table class="table table-borderer border-white">
                                <thead>
                                    <tr style="line-height: 9px;">
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">A. EXPERIENCE</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">B. PERSONALITY</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">C. POLITENESS</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">D. APPEREANCE</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">E. SPEAK MALAY</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">F. SPEAK ENGLISH</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">G. SPEAK MANDARIN</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">H. SPEAK CANTONESE</b></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td><b class="bold">I. REMARK</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-5">
                            <table class="table table-bordered border-black text-center">
                                <thead>
                                    <tr style="line-height: 9px;">
                                        <th scope="col" style="width: 10px; font-size:12px;">Good</th>
                                        <th scope="col" style="width: 10px; font-size:12px;">Average</th>
                                        <th scope="col" style="width: 10px; font-size:12px;">Fair</th>
                                        <th scope="col" style="width: 80px; font-size:12px;">No.EXP</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr style="line-height: 9px">
                                        <td>&nbsp;</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>    
                    </div>
                    <div class="col-9" style="border-bottom:1px solid black;"></div>
                    <br>
                    <div class="col-9" style="border-bottom:1px solid black;"></div>
                    <br>
                    <div class="col-9" style="border-bottom:1px solid black;"></div>
                </div>
                <div class="col-4 mt-3">
                    @if ($kandidat->foto_set_badan !== null)
                        <img class="float-end img" src="/gambar/Set_badan/{{$kandidat->foto_set_badan}}" width="270" height="300" alt="">                    
                    @else
                        <img class="float-end img" src="/gambar/default_user.png" width="270" height="300" alt="">
                    @endif
                </div>
            </div>
            <div class="" style="height: 15rem;"></div>
        </div>

        {{-- Experience --}}
        <div class="container">
            <div class="row mt-5"><b class="bold">D. Pengalaman Bekerja</b></div>
            <div class="row my-3">
                <table class="table table-bordered border-black text-center">
                    <thead>
                    <tr style="line-height: 8px;">
                        <th scope="col text-center" style="width: 3px; font-size:12px;">No</th>
                        <th scope="col text-center" style="font-size:12px;">Nama Majikan/Perusahaan</th>
                        <th scope="col text-center" style="font-size:12px;">Alamat Majikan/Perusahaan</th>
                        <th scope="col text-center" style="font-size:12px;">Jabatan</th>
                        <th scope="col text-center" style="font-size:12px;">Periode</th>
                        <th scope="col text-center" style="font-size:12px;">Alasan Berhenti</th>
                    </tr>
                    </thead>
                    <tbody style="line-height: 15px; font-size:12px; font-weight:bold;">
                    <tr>
                        <th>1st</th>
                        <td>{{$kandidat->nama_perusahaan1}}</td>
                        <td>{{$kandidat->alamat_perusahaan1}}</td>
                        <td>{{$kandidat->jabatan1}}</td>
                        <td>{{$periode_awal1}} - {{$periode_akhir1}}</td>
                        <td>{{$kandidat->alasan1}}</td>
                    </tr>
                    <tr>
                        <th>2nd</th>
                        <td>{{$kandidat->nama_perusahaan2}}</td>
                        <td>{{$kandidat->alamat_perusahaan2}}</td>
                        <td>{{$kandidat->jabatan2}}</td>
                        <td>{{$periode_awal2}} - {{$periode_akhir2}}</td>
                        <td>{{$kandidat->alasan2}}</td>
                    </tr>
                    <tr>
                        <th>3nd</th>
                        <td>{{$kandidat->nama_perusahaan3}}</td>
                        <td>{{$kandidat->alamat_perusahaan3}}</td>
                        <td>{{$kandidat->jabatan3}}</td>
                        <td>{{$periode_awal3}} - {{$periode_akhir3}}</td>
                        <td>{{$kandidat->alasan3}}</td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <div class=""><b class="bold">Saat keadaan darurat, dapat menghubungi Ayah/Ibu/Damto*, No. Telp/HP {{$kandidat->no_telp_perizin}}</b></div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <div class="row mb-5" style="line-height:20px">
                   
                    <div class="">Semua data yang saya tulis adalah benar adanya. Jika kemudian hari terdapat perbedaan, saya bersedia di proses secara hukum yang berlaku.</div>
                    <div class="my-3"> Malang, {{$tgl_print}}</div>
                    <div class="" style="height: 50px;">Tandatangan dan Nama Lengkap</div>
                    <div class="mt-5"><b  style="text-transform: uppercase;">( {{$kandidat->nama}} )</b></div>
                </div>        
            </div>    
        </div>

        <div class="" style="height:30rem;"></div>
        
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">Surat Izin OrangTua / Suami / Istri / Wali</b></div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col">
                            <div class="" style="border-bottom:2px solid black"><b class="bold">No. Register : </b></div>
                        </div>
                        <div class="col"></div>
                    </div> 
                </div>
            </div>
            <b class="bold">Yang bertanda tangan dibawah ini</b>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Nama</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nama_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">NIK</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nik_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold">Alamat</b>
                </div>
                <div class="col-2">
                    <b class="bold">: Dusun</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->dusun_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: RT/RW</b>
                </div>
                <div class="col-8">
                    <b class="bold">: 0{{$kandidat->rt_perizin}} / 0{{$kandidat->rw_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Desa</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kelurahan_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Kecamatan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kecamatan_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Kabupaten</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kabupaten_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">No Telepon / HP</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->no_telp_perizin}}</b>
                </div>
            </div>
            <div class="my-2"><b class="bold">Dengan ini memberikan izin kepada Suami / Istri / Anak / Wali saya yang bernama :</b></div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Nama</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nama}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">NIK</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nik}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Tempat, Tanggal Lahir</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->tmp_lahir}}, {{$tgl_user}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Jenis Kelamin</b>
                </div>
                <div class="col-8">
                    @if ($kandidat->jenis_kelamin == "M")
                        <b class="bold">: Laki-laki</b>
                    @else
                        <b class="bold">: Perempuan</b>
                    @endif
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold">Alamat</b>
                </div>
                <div class="col-2">
                    <b class="bold">: Dusun</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->dusun_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: RT/RW</b>
                </div>
                <div class="col-8">
                    <b class="bold">: 0{{$kandidat->rt}} / 0{{$kandidat->rw}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Desa</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kelurahan}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Kecamatan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kecamatan}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-1">
                    <b class="bold"></b>
                </div>
                <div class="col-2">
                    <b class="bold">: Kabupaten</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kabupaten}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">No Telepon / HP</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->no_telp}}</b>
                </div>
            </div>
            <div class="mt-3"><b class="bold">yang akan ditempatkan melalui Perusahaan penempatan pekerja migran Indonesia / Perorangan (Mandiri / perorangan) dengan :</b></div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Negara Tujuan</b>
                </div>
                <div class="col-8">
                    <b class="bold">
                        : {{$negara->negara}}
                    </b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Jabatan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->jabatan_kandidat}}</b> 
                    <div class="col-4 ms-2" style="border-bottom: 2px dotted black;"></div>
                </div>
            </div>
            <b class="bold">Surat Izin Keluarga ini digunakan sebagai persyaratan untuk mendaftar sebagai CPMI melalui Siapkerja Kemnaker R.I.</b>
            <div class="my-2"><b class="bold">Demikian surat ini saya buat dengan sebenarnya untuk dipergunakan sebagaimana mestinya.</b></div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center">
                    <b style="font-size: 11px; font-weight:bold; text-transform:uppercase; font-family:serif">{{$kandidat->kabupaten}}, {{$tgl_print}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-5">
                    <div class="text-center"><b class="bold">Yang diberi izin</b></div>
                </div>
                <div class="col-2"></div>
                <div class="col-5">
                    <div class="text-center"><b class="bold">Yang memberi izin</b></div>
                </div>
            </div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center">
                    <div class=""><b class="bold">Materai Rp. 10.000</b></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-5 text-center"><b class="bold">( {{$kandidat->nama}} )</b></div>
                <div class="col-2 text-center"><b class="bold">Mengetahui</b></div>
                <div class="col-5 text-center">
                    <b class="bold">( {{$kandidat->nama_perizin}} )</b></div>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-4"></div>
                <div class="col-4 text-center"><div class="bold mt-3" style="font-weight:bold;">Kepala Desa...........................</div></div>
                <div class="col-4"></div>
            </div>
            <div class="row my-5">
                <div class="col-4"></div>
                (
                <div class="col-4"><div class="text-center bold mt-3" style="border-bottom: 2px dotted black;"></div></div>
                )
                <div class="col-4"></div>
            </div>
        </div>
        <div class="" style="height: 80px;"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">Surat kuasa ahli waris</b></div>
                </div>
            </div>
            <br>
            <div class="row">
                <b class="bold my-2">Yang bertanda tangan di bawah ini saya: calon PMI dari PT. Sukses Mandiri Utama:</b>
                <div class="col-2">
                    <b class="bold">Nama</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nama}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Tempat Lahir</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->tmp_lahir}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Tanggal Lahir</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$tgl_user}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Status</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->stats_nikah}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Alamat</b>
                </div>
                <div class="col-8">
                    <b class="bold">: DSN {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                </div>
            </div>
            <br>
            <b class="bold">Sebagai Pihak ke 1 (satu) memberikan kuasa kepada: Keluarga saya :</b>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Nama</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nama_perizin}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">NIK</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->nik_perizin}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Tempat Lahir</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->tmp_lahir_perizin}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Tanggal Lahir</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$tgl_perizin}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Hubungan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->hubungan_perizin}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-2">
                    <b class="bold">Alamat</b>
                </div>
                <div class="col-8">
                    <b class="bold">: DSN {{$kandidat->dusun_perizin}}, RT/RW : 0{{$kandidat->rt_perizin}}/0{{$kandidat->rw_perizin}}, Kel/Desa : {{$kandidat->kelurahan_perizin}}, Kec. {{$kandidat->kecamatan_perizin}}, {{$kandidat->kabupaten_perizin}}, {{$kandidat->provinsi_perizin}}</b>
                </div>
            </div>
            <br>
            <p class="my-2"><b class="bold">Sebagai pihak ke II (dua) yang selanjutnya diberi kuasa</b></p>
            <div class=""><b class="bold">pihak ke I (satu) akan bekerja ke luar negeri dengan negara tujuan {{$negara->negara}} selama kontrak...{{$kandidat->kontrak}}...(..........) tahun melalui PT. Sukses Mandiri Utama.</b></div>
            <div><b class="bold">apabila selama masa kontrak kerja terjadi kecelakaan/ sakit/ meninggal dunia, maka untuk selanjutnya segala urusan tentang hak dan kewajiban saya berikan kepada pihak ke II (dua) untuk mengurus, menerima hak dan kewajiban saya sesuai dengan aturan yang berlaku</b></div>
            <div class="my-2"><b class="bold">demikian surat pernyataan keterangan ahli waris ini saya buat dengan sadar tanpa paksaan dari pihak manapun dan dipergunakan sebagaimana mestinya.</b></div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center"><b class="" style="font-size: 11px; font-weight:bold; text-transform:uppercase; font-family:serif"> {{$kandidat->kabupaten}}, {{$tgl_print}}</b></div>
            </div>
            <div class="row">
                <div class="col-5 text-center"><b class="bold">Yang diberi kuasa</b></div>
                <div class="col-2 text-center"><b class="bold">Saksi</b></div>
                <div class="col-5 text-center"><b class="bold">Yang memberi kuasa/calon PMI</b>
                    <div class=""><b class="bold">Materai 10.000</b></div>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-5 text-center"><b class="bold">( {{$kandidat->nama_perizin}} )</b></div>
                <div class="col-2 text-center" style="border-bottom:1px solid black;"><b class="bold"></b></div>                
                <div class="col-5 text-center"><b class="bold">( {{$kandidat->nama}} )</b></div>
            </div>
            <div class="row mt-3">
                <div class="col-4"><b class="bold"></b></div>
                <div class="col-4 text-center"><b class="bold">Mengetahui :</b></div>
                <div class="text-center"><b class="bold">Kepala desa/Lurah</b></div>                
                <div class="col-4"><b class="bold"></b></div>
            </div>
            <br>
            <div class="row mt-3">
                <div class="col-4"></div>
                (
                <div class="col-4 text-center" style="border-bottom: 2px dotted black;"></div>
                )
                <div class="col-4"></div>
            </div>
        </div>
        <br>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
    <Script>
        window.print();
    </Script>
</html>