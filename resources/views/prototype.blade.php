@extends('layouts.script')
@section('content')
    <div class="container">
        <form action="/prototype" method="POST">
            @csrf
            <input type="date" name="tgl" id="">
            <button type="submit">Cari</button>
        </form>
        {{$umur}}
    </div>    
@endsection