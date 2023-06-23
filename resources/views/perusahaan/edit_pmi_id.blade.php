@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="">
            <h3><b class="" style="text-transform: uppercase;">Edit Pembuatan ID PMI</b></h3>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">                    
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama TKI</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{$pmi_id->nama}}" name="" id="">
                            <input type="text" hidden name="id_kandidat" value="{{$pmi_id->id_kandidat}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama Ibu</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{$pmi_id->nama_ibu}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama Ayah</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{$pmi_id->nama_ayah}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jenis Kelamin</label>
                        </div>
                        <div class="col-md-8">
                            @if ($pmi_id->jenis_kelamin == "M")
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
                            <input type="text" class="form-control" disabled value="{{$pmi_id->tmp_lahir}}" name="" id="">
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
                            <input type="text" class="form-control" disabled value="{{$pmi_id->nik}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Alamat CTKI</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="" id="" style="text-transform:uppercase" disabled class="form-control">DS. {{$pmi_id->dusun}} RT {{$pmi_id->rt}} RW {{$pmi_id->rw}}, Kec {{$pmi_id->kecamatan}}, {{$pmi_id->kabupaten}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Provinsi</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{$pmi_id->provinsi}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Kota Asal CTKI</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" class="form-control" disabled value="{{$pmi_id->tmp_lahir}}" name="" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Alamat Orang Tua</label>
                        </div>
                        <div class="col-md-8">
                            <textarea name="" id="" style="text-transform:uppercase" disabled class="form-control">DS. {{$pmi_id->dusun_parent}} RT {{$pmi_id->rt_parent}} RW {{$pmi_id->rw_parent}}, Kec {{$pmi_id->kecamatan_parent}}, {{$pmi_id->kabupaten_parent}}, Provinsi {{$pmi_id->provinsi_parent}}</textarea>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Kota Orang Tua</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="" class="form-control" disabled value="{{$pmi_id->kabupaten_parent}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Status Perkawinan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" disabled name="" class="form-control" value="{{$pmi_id->stats_nikah}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Agama</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" disabled name="" class="form-control" value="{{$pmi_id->agama}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Pendidikan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" disabled name="" class="form-control" value="{{$pmi_id->pendidikan}}" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Agency</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="agency" value="{{$pmi_id->agency}}" class="form-control" id="">
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
                                    <option value="{{$item->negara_id}}" @if ($pmi_id->negara_id == $item->negara_id)
                                        selected
                                    @endif>{{$item->mata_uang}} - {{$item->negara}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Jabatan</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="jabatan" value="{{$pmi_id->jabatan}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Sektor Usaha</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="sektor_usaha" value="{{$pmi_id->sektor_usaha}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nominal</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="nominal" value="{{$pmi_id->nominal}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">No. Passport</label>
                        </div>
                        <div class="col-md-8">
                            <input type="number" name="" disabled value="{{$pmi_id->no_paspor}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Berlaku</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" required name="berlaku" value="{{$pmi_id->berlaku}}" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Habis Berlaku</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" required name="habis_berlaku" value="{{$pmi_id->habis_berlaku}}" class="form-control" id="">
                        </div>
                    </div>
                    <hr>
                    <a href="/perusahaan/list/pmi_id" class="btn btn-danger">Kembali</a>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>            
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