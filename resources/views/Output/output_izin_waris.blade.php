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
            <div class="row">
                <div class="col">
                    <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">Surat Izin Keluarga</b></div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="" style="border-bottom:2px solid black"><b class="bold">No. Register : </b></div>
                        </div>
                        <div class="col-4"></div>
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
                <div class="col-12 ms-3 my-1">
                    <b class="bold">Alamat Pemberi Izin</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Dusun</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->dusun_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">RT / RW</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->rt_perizin}} / {{$kandidat->rw_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Desa</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kelurahan_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Kecamatan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kecamatan_perizin}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Kabupaten</b>
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
            {{-- <div class="my-2"><b class="bold">Dengan ini memberikan izin kepada {{$kandidat->hubungan_perizin}} saya yang bernama :</b></div> --}}
            <div class="my-2"><b class="bold">Saya sebagai {{$kandidat->hubungan_perizin}}, Dengan ini memberikan izin kepada CPMI dibawah ini:</b></div>
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
                    <b class="bold">: {{$kandidat->tmp_lahir}}, 
                        @if ($kandidat->tgl_lahir == null)
                        @else
                        {{$tgl_user}}
                        @endif
                    </b>
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
                <div class="col-12 ms-3 my-1">
                    <b class="bold">Alamat Penerima Izin</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Dusun</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->dusun}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">RT/RW</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->rt}} / {{$kandidat->rw}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Desa</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kelurahan}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Kecamatan</b>
                </div>
                <div class="col-8">
                    <b class="bold">: {{$kandidat->kecamatan}}</b>
                </div>
            </div>
            <div class="row" style="line-height: 20px;">
                <div class="col-3">
                    <b class="bold">Kabupaten</b>
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
                        : {{$kandidat->negara}}
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
                    <b style="font-size: 11px; font-weight:bold; text-transform:uppercase; font-family:serif">
                        {{$kandidat->kabupaten}}, 
                        {{$tgl_print}}</b>
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
            <div class="row" style="height: 50px">
                <div class="col-5"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center">
                    <div class=""><b class="bold">Materai Rp. 10.000</b></div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-5 text-center">
                    <b class="bold" style="border-bottom:1px solid black">
                        ( {{$kandidat->nama}} )
                    </b>
                    <p style="font-weight:600">CPMI</p>
                </div>
                <div class="col-2 text-center"><b class="bold">Mengetahui</b></div>
                <div class="col-5 text-center">
                    <b class="bold" style="border-bottom:1px solid black">( 
                        @if ($kandidat->nama_perizin == null)
                            ....................
                        @else
                            {{$kandidat->nama_perizin}}
                        @endif )
                    </b>
                    <p style="font-weight:600">{{$kandidat->hubungan_perizin}}</p>
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
        <div class="" style="height: 40px;"></div>

        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="text-center"><b class="" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid black">Surat kuasa ahli waris</b></div>
                </div>
            </div>
            <br>
            <div class="row">
                <b class="bold my-2">Yang bertanda tangan di bawah ini saya:</b>
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
                    <b class="bold">: 
                        @if ($kandidat->tgl_lahir == null)
                        @else
                        {{$tgl_user}}
                        @endif
                    </b>
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
                    <b class="bold">: DSN {{$kandidat->dusun}}, RT/RW : {{$kandidat->rt}} / {{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                </div>
            </div>
            <br>
            <b class="bold">Sebagai CPMI, saya memberikan kuasa kepada {{$kandidat->hubungan_perizin}} saya :</b>
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
                    <b class="bold">: 
                        @if ($kandidat->tgl_lahir_perizin == null)
                        @else
                            {{$tgl_perizin}}
                        @endif
                    </b>
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
                    <b class="bold">: DSN {{$kandidat->dusun_perizin}}, RT / RW : {{$kandidat->rt_perizin}} / {{$kandidat->rw_perizin}}, Kel/Desa : {{$kandidat->kelurahan_perizin}}, Kec. {{$kandidat->kecamatan_perizin}}, {{$kandidat->kabupaten_perizin}}, {{$kandidat->provinsi_perizin}}</b>
                </div>
            </div>
            <p class="my-2"><b class="bold">Sebagai {{$kandidat->hubungan_perizin}} CPMI di atas yang selanjutnya sebagai penerima kuasa</b></p>
            <div class=""><b class="bold">Saya (CPMI) akan bekerja ke luar negeri dengan negara tujuan {{$negara->negara}}, selama kontrak...{{$kandidat->kontrak}}...(..........) tahun melalui {{$perusahaan->nama_perusahaan}} </b></div>
            <div><b class="bold">apabila selama masa kontrak kerja di negara {{$kandidat->negara}} terjadi kecelakaan/ sakit/ meninggal dunia atas saya pribadi, maka untuk selanjutnya segala urusan tentang hak dan kewajiban saya, saya berikan kepada {{$kandidat->hubungan_perizin}} untuk mengurus, menerima hak dan kewajiban saya sesuai dengan aturan perundang - undangan yang berlaku</b></div>
            <div class="my-2"><b class="bold">demikian surat kuasa ahli waris ini saya buat dengan sadar tanpa paksaan dari pihak manapun dan dapat dipergunakan sebagaimana mestinya.</b></div>
            <div class="row">
                <div class="col-5"></div>
                <div class="col-2"></div>
                <div class="col-5 text-center"><b class="" style="font-size: 11px; font-weight:bold; text-transform:uppercase; font-family:serif"> 
                    {{$kandidat->kabupaten}}, 
                    {{$tgl_print}}</b></div>
            </div>
            <div class="row" style="height: 50px">
                <div class="col-5 text-center"><b class="bold">Yang diberi kuasa</b></div>
                <div class="col-2 text-center"><b class="bold">Saksi</b></div>
                <div class="col-5 text-center"><b class="bold">Yang memberi kuasa/calon PMI</b>
                    <div class=""><b class="bold">Materai 10.000</b></div>
                </div>
            </div>
            <br>
            <div class="row mt-4">
                <div class="col-5 text-center">
                    <b class="bold" style="border-bottom:1px solid black;">( 
                        @if ($kandidat->nama_perizin == null)
                            ....................
                        @else
                            {{$kandidat->nama_perizin}}
                        @endif )
                    </b>
                    <p class="" style="font-weight:600">{{$kandidat->hubungan_perizin}}</p>
                </div>
                <div class="col-2 text-center" style="border-bottom:1px solid black;"><b class="bold"></b></div>                
                <div class="col-5 text-center">
                    <b class="bold" style="border-bottom:1px solid black;">( {{$kandidat->nama}} )</b>
                    <p class="" style="font-weight:600">CPMI</p>
                </div>
            </div>
            <div class="row">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    </body>
    <Script>
        window.print();
    </Script>
</html>