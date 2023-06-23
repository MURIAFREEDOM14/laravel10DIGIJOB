<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title></title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row text-center">
                <h6>BIO DATA Calon PMI / PEMBUATAN ID</h6>
            </div>
            <table class="table table-bordered table-bordered-bd-dark mt-4">
                <tbody>
                    <div class="">
                        <tr style="line-height:7px;">
                            <td style="width: 0%;">1</td>
                            <td style="width:10rem">Nama TKI</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->nama}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">2</td>
                            <td style="width:10rem">Nama Ibu</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->nama_ibu}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">3</td>
                            <td style="width:10rem">Nama Ayah</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->nama_ayah}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">4</td>
                            <td style="width:10rem">Jenis Kelamin</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->jenis_kelamin}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">5</td>
                            <td style="width:10rem">Tempat Lahir</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->tmp_lahir}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">6</td>
                            <td style="width:10rem">Tanggal Lahir</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->tgl_lahir}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">7</td>
                            <td style="width:10rem">No. KTP CTKI</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->nik}}</td>
                        </tr>
                        <tr  style="line-height:14px;">
                            <td style="width: 0%;">8</td>
                            <td style="width:10rem">Alamat CTKI</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">DS. {{$pmi_id->dusun}} RT {{$pmi_id->rt}} RW {{$pmi_id->rw}}, Kec {{$pmi_id->kecamatan}}, {{$pmi_id->kabupaten}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">9</td>
                            <td style="width:10rem">Provinsi</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->provinsi}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">10</td>
                            <td style="width:10rem">Kota Asal CTKI</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->tmp_lahir}}</td>
                        </tr>
                        <tr  style="line-height:14px;">
                            <td style="width: 0%;">11</td>
                            <td style="width:10rem">Alamat Orang Tua</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">DS. {{$pmi_id->dusun_parent}} RT {{$pmi_id->rt_parent}} RW {{$pmi_id->rw_parent}}, Kec {{$pmi_id->kecamatan_parent}}, {{$pmi_id->kabupaten_parent}}, Provinsi {{$pmi_id->provinsi_parent}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">12</td>
                            <td style="width:10rem">Kota orang tua</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->kabupaten_parent}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">13</td>
                            <td style="width:10rem">status Perkawinan</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->stats_nikah}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">14</td>
                            <td style="width:10rem">Agama</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->agama}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">15</td>
                            <td style="width:10rem">Pendidikan</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->pendidikan}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">16</td>
                            <td style="width:10rem">Agency</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->agency}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">17</td>
                            <td style="width:10rem">Mata Uang</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->mata_uang}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">18</td>
                            <td style="width:10rem">Jabatan</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->jabatan}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">19</td>
                            <td style="width:10rem">Sektor Usaha</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->sektor_usaha}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">20</td>
                            <td style="width:10rem">Nominal</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->mata_uang}} {{$pmi_id->nominal}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">21</td>
                            <td style="width:10rem">No. Passport</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$pmi_id->no_paspor}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">22</td>
                            <td style="width:10rem">Berlaku</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$berlaku}}</td>
                        </tr>
                        <tr  style="line-height:7px;">
                            <td style="width: 0%;">23</td>
                            <td style="width:10rem">Habis Berlaku</td>
                            <td style="width: 0%">: </td>
                            <td style="font-size: 13px; text-transform:uppercase">{{$habis_berlaku}}</td>
                        </tr>
                    </div>
                </tbody>
                <script>
                    window.print();
                </script>
            </table>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </body>
</html>