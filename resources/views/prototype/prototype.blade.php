<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="/moving.css">
    </head>
    <body>
        @include('sweetalert::alert')
        <div class="container mt-3">
            
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
            <div class="" id="deskripsi_show">

            </div>
            
            <textarea name="" id="textarea" cols="30" rows="10"></textarea>

            <table>
                <thead>
                    <tr>
                        <th>Cek</th>
                        <th>Cek</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>helo</td>
                        <td>helo</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="text">
                    <div class="moving">
                        <div class="place">Heloo world</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button class="btn btn-primary" onclick="create()">
            Launch demo modal
        </button>    

        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="proto-create" class="p-2"></div>
                    </div>
                </div>
            </div>
        </div>

        <form action="/proto_mail" method="POST">
            @csrf
            <input type="text" name="email" id="">
            <input type="text" name="isi" id="">
            <button type="submit">Kirim</button>
        </form>

        <div class="mb-5">
            <form action="/video/accept-call" method="POST">
                @csrf
                <label for="">Pengecekan</label>
                <button type="submit">Check</button>
            </form>
        </div>

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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
                        op+='<option value="" selected> Pilih </option>';
                        op+='<option value="2" > Indonesia </option>';
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
                            $('#textarea').val(data.kode_negara);
                        }
                    })
                })
            });
        </script>

        <script>
            $(document).ready(function() {
                
            });

            // Untuk create //
            function create(){
                $.get("{{url('/proto_create')}}",{},function(data,status){
                    $('#exampleModalLabel').html("Buat Data");
                    $('#proto-create').html(data);
                    $('#exampleModal').modal('show');
                });
            }

            function store(){
                
            }
        </script>
    </body>
</html>