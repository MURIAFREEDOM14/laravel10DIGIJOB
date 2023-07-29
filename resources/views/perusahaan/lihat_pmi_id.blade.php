@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header text-center">
                <h4 style="text-transform:uppercase;"><b>Bio data Calon PMI / Pembuatan ID</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-bordered-bd-dark mt-4">
                        <tbody>
                            <div class="">
                                <tr>
                                    <td style="width: 0%;">1</td>
                                    <td style="width:13rem">Nama TKI</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->nama}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">2</td>
                                    <td style="width:13rem">Nama Ibu</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->nama_ibu}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">3</td>
                                    <td style="width:13rem">Nama Ayah</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->nama_ayah}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">4</td>
                                    <td style="width:13rem">Jenis Kelamin</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->jenis_kelamin}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">5</td>
                                    <td style="width:13rem">Tempat Lahir</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->tmp_lahir}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">6</td>
                                    <td style="width:13rem">Tanggal Lahir</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{date('d-M-Y',strtotime($pmi_id->tgl_lahir))}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">7</td>
                                    <td style="width:13rem">No. KTP CTKI</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->nik}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">8</td>
                                    <td style="width:13rem">Alamat CTKI</td>
                                    <td style="width: 0%">: </td>
                                    <td>DS. {{$pmi_id->dusun}} RT {{$pmi_id->rt}} RW {{$pmi_id->rw}}, Kec {{$pmi_id->kecamatan}}, {{$pmi_id->kabupaten}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">9</td>
                                    <td style="width:13rem">Provinsi</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->provinsi}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">10</td>
                                    <td style="width:13rem">Kota Asal CTKI</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->tmp_lahir}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">11</td>
                                    <td style="width:13rem">Alamat Orang Tua</td>
                                    <td style="width: 0%">: </td>
                                    <td>DS. {{$pmi_id->dusun_parent}} RT {{$pmi_id->rt_parent}} RW {{$pmi_id->rw_parent}}, Kec {{$pmi_id->kecamatan_parent}}, {{$pmi_id->kabupaten_parent}}, Provinsi {{$pmi_id->provinsi_parent}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">12</td>
                                    <td style="width:13rem">Kota orang tua</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->kabupaten_parent}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">13</td>
                                    <td style="width:13rem">status Perkawinan</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->stats_nikah}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">14</td>
                                    <td style="width:13rem">Agama</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->agama}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">15</td>
                                    <td style="width:13rem">Pendidikan</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->pendidikan}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">16</td>
                                    <td style="width:13rem">Agency</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->agency}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">17</td>
                                    <td style="width:13rem">Mata Uang</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->mata_uang}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">18</td>
                                    <td style="width:13rem">Jabatan</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->jabatan}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">19</td>
                                    <td style="width:13rem">Sektor Usaha</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->sektor_usaha}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">20</td>
                                    <td style="width:13rem">Nominal</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->mata_uang}} {{$pmi_id->nominal}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">21</td>
                                    <td style="width:13rem">No. Passport</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$pmi_id->no_paspor}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">22</td>
                                    <td style="width:13rem">Berlaku</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$berlaku}}</td>
                                </tr>
                                <tr>
                                    <td style="width: 0%;">23</td>
                                    <td style="width:13rem">Habis Berlaku</td>
                                    <td style="width: 0%">: </td>
                                    <td>{{$habis_berlaku}}</td>
                                </tr>
                            </div>
                        </tbody>
                    </table>
                </div>
                <a href="/perusahaan/list/pmi_id" class="btn btn-danger">Kembali</a>
                <a class="btn btn-primary" href="/perusahaan/cetak_pmi_id/{{$pmi_id->pmi_id}}">Cetak</a>            
            </div>
        </div>
    </div>
@endsection