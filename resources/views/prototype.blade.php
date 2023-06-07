<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
    </head>
    <body>
        <div class="container">
            <select name="" id="">
                <option value=""></option>
                @foreach ($data as $item)
                    <option value="{{$item->id}}">{{$item}}</option>
                @endforeach
            </select>
            <select name="" id="">
            </select>
        </div>
    </body>
</html>    