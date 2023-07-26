@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="">
            <h3><b class="" style="text-transform: uppercase;">Pembuatan ID PMI</b></h3>
        </div>
        <hr>
        <div class="card mb-3">
            <div class="card-header">
                <h4><b style="text-transform: uppercase;">Cari Kandidat</b></h4>
            </div>
            <div class="card-body">
                <form action="/perusahaan/pembuatan_pmi_id" method="post">                
                    @csrf
                    <div class="input-group mb-3">
                        <select class="form-control" required name="id_kandidat" id="selectKandidat">
                            <option value="">-- Pilih Kandidat --</option>
                            @foreach ($kandidat as $item)
                                <option value="{{$item->id_kandidat}}">{{$item->nama}}</option>                            
                            @endforeach
                        </select>
                        <div class="input-group-append">
                            <button class="btn btn-outline-primary" type="submit" id="">Pilih</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @if ($id_kandidat !== null)
            <div class="card">
                <div class="card-header">

                </div>
                <div class="card-body">                    
                    <form action="/perusahaan/simpan_pembuatan_pmi_id" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama TKI</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->nama}}" name="" id="">
                                <input type="text" hidden name="id_kandidat" value="{{$id_kandidat->id_kandidat}}" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Ibu</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->nama_ibu}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Ayah</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->nama_ayah}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Jenis Kelamin</label>
                            </div>
                            <div class="col-md-8">
                                @if ($id_kandidat->jenis_kelamin == "M")
                                    <input type="text" name="" class="form-control" disabled placeholder="Laki-laki" id="">
                                @else
                                    <input type="text" name="" class="form-control" disabled placeholder="Perempuan" id="">
                                @endif
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Tempat / Tanggal Lahir</label>
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->tmp_lahir}}" name="" id="">
                            </div>
                            <div class="col-md-4">
                                <input type="" class="form-control" disabled value="{{$tgl}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">No. KTP CTKI</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->nik}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Alamat CTKI</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="" id="" style="text-transform:uppercase" disabled class="form-control">DS. {{$id_kandidat->dusun}} RT {{$id_kandidat->rt}} RW {{$id_kandidat->rw}}, Kec {{$id_kandidat->kecamatan}}, {{$id_kandidat->kabupaten}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Provinsi</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->provinsi}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Kota Asal CTKI</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" disabled value="{{$id_kandidat->tmp_lahir}}" name="" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Alamat Orang Tua</label>
                            </div>
                            <div class="col-md-8">
                                <textarea name="" id="" style="text-transform:uppercase" disabled class="form-control">DS. {{$id_kandidat->dusun_parent}} RT {{$id_kandidat->rt_parent}} RW {{$id_kandidat->rw_parent}}, Kec {{$id_kandidat->kecamatan_parent}}, {{$id_kandidat->kabupaten_parent}}, Provinsi {{$id_kandidat->provinsi_parent}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Kota Orang Tua</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="" class="form-control" disabled value="{{$id_kandidat->kabupaten_parent}}" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Status Perkawinan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" disabled name="" class="form-control" value="{{$id_kandidat->stats_nikah}}" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Agama</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" disabled name="" class="form-control" value="{{$id_kandidat->agama}}" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Pendidikan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" disabled name="" class="form-control" value="{{$id_kandidat->pendidikan}}" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Agency</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="agency" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Mata Uang</label>
                            </div>
                            <div class="col-md-8">
                                <select name="negara_id" required class="form-control" id="">
                                    <option value="">-- Pilih Mata Uang --</option>
                                    @foreach ($negara as $item)
                                        <option value="{{$item->negara_id}}">{{$item->mata_uang}} - {{$item->negara}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Jabatan</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="jabatan" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Sektor Usaha</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" name="sektor_usaha" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nominal</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" name="nominal" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">No. Passport</label>
                            </div>
                            <div class="col-md-8">
                                <input type="number" disabled name="" value="{{$id_kandidat->no_paspor}}" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Berlaku</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" required name="berlaku" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Habis Berlaku</label>
                            </div>
                            <div class="col-md-8">
                                <input type="date" required name="habis_berlaku" class="form-control" id="">
                            </div>
                        </div>
                        <hr>
                        <a href="/perusahaan/list/pmi_id" class="btn btn-danger">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
            </div>    
        @endif
    </div>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change','#selectKandidat',function() {
                console.log("ditekan");
                var getID = $(this).val();
                console.log(getID);
                var div = $(this).parent();
                var op = "";
                $.ajax({
                    type:'get',
                    url:'{!!URL::to('/perusahaan/pembuatan_pmi_id')!!}',
                    data:{'id':getID},
                success:function(id_kandidat) {
                    console.log(id_kandidat);
                }
                });
            })
        });
    </script> --}}
@endsection