<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    </head>
    <body>
        <select name="" class="select1" id="select1">
            @foreach ($prov as $item)
                <option value="{{$item->id}}">{{$item->provinsi}}</option>                
            @endforeach
        </select>
        <select name="select2" id="select2">
        </select>
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
                        console.log(data);
                        console.log(data.length);
                        op+='<option value="0" selected disabled> pilih </option>';
                        for(var i = 0; i < data.length; i++){
                            op+='<option value="'+data[i].id+'">+data[i].kota+</option>';
                        }
                    },
                    div.find('.select2').html("");
                    div.find('.select2').append("");
                    error:function() {

                    }
                });
            });
        });
        </script>
    </body>
</html>