@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="row">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h4><b class="bold">Data Kandidat</b></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <label for="" style="text-transform: uppercase">Nama Kandidat</label>
                        </div>
                        <div class="col-8">
                            <label for="" style="text-transform: uppercase">: {{$kandidat->nama}}</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label for="" style="text-transform: uppercase">Jenis Kelamin</label>
                        </div>
                        <div class="col-8">
                            <label for="" style="text-transform: uppercase">: 
                                @if ($kandidat->jenis_kelamin == "M")
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label for="" style="text-transform: uppercase">Tempat / tanggal lahir</label>
                        </div>
                        <div class="col-8">
                            <label for="" style="text-transform: uppercase">: {{$kandidat->tmp_lahir}} / {{date('d M Y',strtotime($kandidat->tgl_lahir))}}</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label for="" style="text-transform: uppercase">Usia</label>
                        </div>
                        <div class="col-8">
                            <label for="" style="text-transform: uppercase">: {{$kandidat->usia}}</label>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <label for="" style="text-transform: uppercase">Alamat</label>
                        </div>
                        <div class="col-8">
                            <label for="" style="text-transform: uppercase">: Dsn. {{$kandidat->kelurahan}}, RT {{$kandidat->rt}} / RW {{$kandidat->rw}}, Kec. {{$kandidat->kecamatan}}, {{$kandidat->kabupaten}}, {{$kandidat->provinsi}}</label>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-4">

        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <img src="/" alt="">
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <b class="bold">Data Perusahaan</b>
                </div>
                @if ($perusahaan == null)
                    <div class="card-body">
                        <form action="/manager/kandidat/cari_penerimaan_perusahaan/{{$id}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-4">
                                    <label for="" class="col-form-label" style="text-transform: uppercase">Cari perusahaan</label>
                                </div>
                                <div class="col-8">
                                    <div class="input-group">
                                        <select name="id_perusahaan" class="form-control" style="text-transform: uppercase" required id="">
                                            <option value="">-- Pilih Perusahaan --</option>
                                            @foreach ($semua_perusahaan as $item)
                                                <option value="{{$item->id_perusahaan}}">{{$item->nama_perusahaan}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="btn btn-primary">Pilih</button>
                                    </div>  
                                </div>
                            </div>
                        </form>    
                    </div>  
                @else
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form action="/manager/kandidat/cari_penerimaan_perusahaan/{{$id}}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-4">
                                            <label for="" class="col-form-label" style="text-transform: uppercase">Cari perusahaan</label>
                                        </div>
                                        <div class="col-8">
                                            <div class="input-group">
                                                <select name="id_perusahaan" class="form-control" style="text-transform: uppercase" required id="">
                                                    <option value="">-- Pilih Perusahaan --</option>
                                                    @foreach ($semua_perusahaan as $item)
                                                        <option value="{{$item->id_perusahaan}}" @if ($perusahaan->id_perusahaan == $item->id_perusahaan)
                                                            selected
                                                        @endif>{{$item->nama_perusahaan}}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary">Pilih</button>
                                            </div>  
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="" style="text-transform: uppercase">Nama Perusahaan</label>
                            </div>
                            <div class="col-8">
                                <label for="" style="text-transform: uppercase">: {{$perusahaan->nama_perusahaan}}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="" style="text-transform: uppercase">No NIB</label>
                            </div>
                            <div class="col-8">
                                <label for="" style="text-transform: uppercase">: {{$perusahaan->no_nib}}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="" style="text-transform: uppercase">Nama Pemimpin</label>
                            </div>
                            <div class="col-8">
                                <label for="" style="text-transform: uppercase">: {{$perusahaan->nama_pemimpin}}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="" style="text-transform: uppercase">Nama Operator</label>
                            </div>
                            <div class="col-8">
                                <label for="" style="text-transform: uppercase">: {{$perusahaan->nama_operator}}</label>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <label for="" style="text-transform: uppercase">Alamat</label>
                            </div>
                            <div class="col-8">
                                <label for="" style="text-transform: uppercase">: {{$perusahaan->provinsi}}, {{$perusahaan->kota}}</label>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @if ($perusahaan !== null)
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="/manager/kandidat/lihat_penerimaan_perusahaan/{{$id}}" method="POST">
                            @csrf
                            <input type="text" value="{{$perusahaan->id_perusahaan}}" name="id_perusahaan" hidden id="">
                            <h3 class="">Dengan ini kandidat diatas telah terbukti sudah diterima pada perusahaan yang tertera diatas.</h3>
                            <br>
                            <h3>Apakah Data sudah valid dan benar adanya?</h3>
                            <button type="submit" class="btn btn-secondary">Konfirmasi Penerimaan</button>    
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    @endif   
</div>
@endsection