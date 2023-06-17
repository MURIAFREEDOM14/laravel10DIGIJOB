@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card mb-5">
            <div class="card-body">
                <div class="row">
                    <h4 class="text-center">PROFIL BIO DATA</h4>
                    <h6 class="text-center mb-5">Indonesia</h6>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="" class="col-form-label">Penempatan</label>
                        <select name="penempatan" required class="form-select" id="placement">
                            <option value="">-- Pilih Penempatan Tempat Kerja --</option>
                            <option value="dalam negeri">Dalam Negeri</option>
                            <option value="luar negeri">Luar Negeri</option>
                        </select>
                        <label for="" class="col-form-label">Status Negara Tujuan</label>
                        <select name="negara_id" class="form-select" id="negara_tujuan">
                            <option value="">-- Harap Tentukan Penempatan Tempat Kerja --</option>
                        </select>
                        <hr>
                        <a class="btn btn-warning" href="/akademi/list_kandidat">Lewati</a>
                        <button class="btn btn-primary float-end" type="submit">Selanjutnya</button>
                    </form>
                </div>
                <hr>
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
                            div.find('#deskripsi').html(" ");
                            div.find('#deskripsi').append(dks);
                            console.log(dks);
                        }
                    })
                })
            });
        </script>
    </div>
@endsection