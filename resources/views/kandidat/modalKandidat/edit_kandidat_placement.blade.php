@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">        
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                {{-- <h6 class="text-center mb-5" style="text-transform: uppercase">
                    {{$negara}}
                </h6> --}}
                <div class="" id="perizin">
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <h6 class="ms-5">Data Penempatan Kerja</h6> 
                        </div>
                    </div>
                    <form action="/isi_kandidat_placement" method="post">
                        @csrf
                        {{-- <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label"></label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select name="negara_id" class="form-select" id="negara">
                                        <option value="">-- Pilih negara tujuan --</option>
                                        @foreach ($semua_negara as $item)
                                            <option value="{{$item->negara_id}}">{{$item->negara}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                        </div> --}}
                        <label for="" class="col-form-label">Penempatan</label>
                        <select name="penempatan" required class="form-select" id="placement">
                            <option value="">-- Pilih penempatan tempat kerja --</option>
                            <option value="dalam negeri">Dalam Negeri</option>
                            <option value="luar negeri">Luar Negeri</option>
                        </select>
                            <label for="" class="col-form-label">Status Negara Tujuan</label>
                            <select name="negara_id" class="form-select" id="negara_tujuan">
                                <option value="">-- Pilih negara tujuan --</option>
                            </select>
                            <div class="" id="dekskripsi_show">

                            </div>
                        <hr>
                        <a class="btn btn-warning" href="{{route('permission')}}">Lewati</a>
                        <button type="submit" class="btn btn-primary float-end">Selanjutnya</button>
                    </form>
                </div>
            </div>
            <hr>
        </div>
    </div>        
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('change','#placement',function() {
                    console.log("ditekan");
                    var getID = $(this).val();
                    console.log(getID);
                    var div = $(this).parent();
                    var op = "";
                    if (getID == "luar negeri") {
                        $.ajax({
                            type:'get',
                            url:'{!!URL::to('/penempatan')!!}',
                            data:{'stats':getID},
                            success:function (data) {
                                console.log(data.length);
                                op+='<option value="" selected> -- Pilih Negara Tujuan -- </option>';
                                for(var i = 0; i < data.length; i++){
                                    op+='<option value="'+data[i].negara_id+'">'+data[i].negara+'</option>';
                                }
                                div.find('#negara_tujuan').html(" ");
                                div.find('#negara_tujuan').append(op);
                                console.log(op);
                            },
                            error:function() {

                            }
                        });
                    } else {
                        op+='<option value="2" selected> Indonesia </option>';
                        div.find('#negara_tujuan').html(" ");
                        div.find('#negara_tujuan').append(op);
                        console.log(op);
                    }
                })

                $(document).on('change','#negara_tujuan', function() {
                    var getNegara = $(this).val();
                    console.log(getNegara);
                    var div = $(this).parent();
                    var dks = "";
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('/deskripsi')!!}',
                        data: {'dks':getNegara},
                        success:function(data) {
                            console.log(data);
                            dks+='<textarea name="" id="deskripsi" class="form-control">'+data.deskripsi+'</textarea>'
                            div.find('#deskripsi_show').html(" ");
                            div.find('#deskripsi_show').append(dks);
                            console.log(dks);
                        }
                    })
                })
            });
        </script>
@endsection