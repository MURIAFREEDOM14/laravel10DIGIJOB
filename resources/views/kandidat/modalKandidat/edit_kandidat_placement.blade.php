@extends('layouts.input')
@section('content')
@include('sweetalert::alert')
<div class="container mt-5">        
    <div class="card mb-5">
        <div class="card-body">
            <div class="row">
                <h4 class="text-center">PROFIL BIO DATA</h4>
                <h6 class="text-center mb-5" style="text-transform: uppercase">
                    @if ($kandidat->penempatan == null)
                    @else
                        {{$kandidat->penempatan}}
                    @endif
                </h6>
                <div class="" id="perizin">
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <h6 class="ms-5">Data Penempatan Kerja</h6> 
                        </div>
                    </div>
                    <form action="/isi_kandidat_placement" method="post">
                        @csrf
                        <div class="row my-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Status Tempat Kerja</label>
                            </div>
                            <div class="col-md-6">
                                <select name="penempatan" required class="form-select" id="placement">
                                    <option value="">-- Pilih penempatan tempat kerja --</option>
                                    <option value="dalam negeri" @if ($kandidat->penempatan == "dalam negeri")
                                        selected
                                    @endif>Dalam Negeri</option>
                                    <option value="luar negeri" @if ($kandidat->penempatan == "luar negeri")
                                        selected
                                    @endif>Luar Negeri</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3 g-3 align-items-center">
                            <div class="col-md-4">
                                <label for="inputPassword6" class="col-form-label">Pilih Penempatan Negara</label>
                            </div>
                            <div class="col-md-8">
                                <div class="input-group">
                                    <select name="negara" class="negara" id="negara">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
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
                        op+='<option value="" selected> Pilih </option>';
                        for(var i = 0; i < data.length; i++){
                            op+='<option value="'+data[i].negara_id+'">"'+data[i].negara+'"</option>';
                        }
                        div.find('negara').html(" ");
                        div.find('negara').append(op);
                        console.log(op);
                    },
                });
            } else {
                op+='<option value="2" selected> Indonesia </option>';
                div.find('#negara').html(" ");
                div.find("#negara").append(op);
                console.log(op);
            }
        })
    });
</script>

@endsection