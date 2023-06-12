@extends('layouts.akademi')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header rounded-top bg-primary">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="text-center text-light"><b class="bold" style="font-size: 25px; text-transform:uppercase; border-bottom:2px solid white">bio data Profil</b></div>
                        <h6 class="text-center text-light" style="line-height:20px; text-transform:uppercase;">{{$negara->negara}}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row" style="line-height:20px">
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4"><b class="bold">NO. REGISTER</b></div>
                            <div class="col-sm-6"><b class="bold">: {{$kandidat->jenis_kelamin.$negara->kode_negara}}_{{$kandidat->id_kandidat+800}}</b></div>                
                        </div>
                    </div>
                </div>
                <div class="row ml-5 mt-3 mb-3"><b class="bold">PERSONAL BIO DATA</b></div>
                <div class ="row" style="line-height:20px">
                    <div class="col-sm-9">
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
                                <b class="bold">: {{$kandidat->usia}}</b>
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
                                <b class="bold">: Dsn. {{$kandidat->dusun}}, RT/RW : 0{{$kandidat->rt}}/0{{$kandidat->rw}}, Kel/Desa : {{$kandidat->kelurahan}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</b>
                            </div>
                        </div>                                
                    </div>
                    <div class="col-md-3">
                        @if ($kandidat->foto_set_badan !== null)
                            <img class="float-right img" src="/gambar/Kandidat/{{$kandidat->nama}}/Set_badan/{{$kandidat->foto_set_badan}}" width="150" height="150" alt="">
                        @else
                            <img class="float-right img" src="/gambar/default_user.png" width="150" height="150" alt="">
                        @endif
                    </div>
                </div>
                <hr>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit_kandidat">
                    Edit Kandidat
                </button>
            </div>        
        </div>
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
                            <a href="/akademi/isi_kandidat_personal/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Personal</a>
                            <a href="/akademi/isi_kandidat_document/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Document</a>
                            <a href="/akademi/isi_kandidat_vaksin/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Vaksin</a>
                        </p>
                        <p>
                            <a href="/akademi/isi_kandidat_parent/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Parent</a>
                            <a href="/akademi/isi_kandidat_permission/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Permission</a>
                            @if ($kandidat->negara_id !== 2)
                                <a href="/akademi/isi_kandidat_placement/{{$kandidat->nama}}/{{$kandidat->id}}" class="btn btn-warning">Edit Placement</a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection