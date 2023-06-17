<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> --}}
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    </head>
    <body>
        <select name="" class="select1" id="select1">
            <option value="">pilih</option>
            @foreach ($prov as $item)
                <option value="{{$item->id}}">{{$item->provinsi}}</option>                
            @endforeach
        </select>
        <select class="select2" name="select2" id="select2">
            <option value=""></option>
        </select>

        
        <div class="row">
            <div class="col">
                <select name="negara_id" class="form-select" id="negara_tujuan">
                    <option value="">-- Pilih negara tujuan --</option>
                </select>
            </div>
        </div>
        <select name="penempatan" required class="form-select" id="placement">
            <option value="">-- Pilih penempatan tempat kerja --</option>
            <option value="dalam negeri">Dalam Negeri</option>
            <option value="luar negeri">Luar Negeri</option>
        </select>
        {{-- <div class="" id="deskripsi"> --}}
            <textarea id="textDeskripsi"></textarea>
        {{-- </div> --}}

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $(document).on('change','.select1',function(){
                console.log("berubah");
                var getID = $(this).val();
                console.log(getID);
                var div = $(this).parent();
                var op = "";
                $.ajax({
                    type:'get',
                    url: '{!!URL::to('select1')!!}',
                    data:{'id':getID},
                    success:function (data) {
                        console.log('success');
                        // console.log(data);
                        console.log(data.length);
                        op+='<option value="" selected> pilih </option>';
                        for(var i = 0; i < data.length; i++){
                            op+='<option value="'+data[i].id+'">"'+data[i].kota+'"</option>';
                        }
                        div.find('#select2').html(" ");
                        div.find('#select2').append(op);
                        console.log(op);
                    },
                    error:function() {

                    }
                });
            });
        });
        </script>

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

                $(document).on('change','#negara_tujuan',function() {
                    var getNegara = $(this).val();
                    console.log(getNegara);
                    var div = $(this).parent();
                    var dks = " ";
                    $.ajax({
                        type:'get',
                        url:'{!!URL::to('/deskripsi')!!}',
                        data:{'dks':getNegara},
                        success:function (data) {
                            console.log(data.deskripsi);
                            $("textDeskripsi").val(data.deskripsi)
                        }
                    })
                })
            });
        </script>
    </body>
</html>