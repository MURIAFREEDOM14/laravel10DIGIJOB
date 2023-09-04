@extends('layouts.kandidat')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<style>
    /* CSS List */
    a:visited {
        background-color: #ffffff;
        text-decoration: none;
        color: #212529;
    }
    a:hover{
        background-color: #f2f2f2;
        text-decoration: none;
        color: #212529;
    }
    .link-list{
        border-top:0.1px solid #dfdfdf;
        border-bottom:0.1px solid #dfdfdf;
        color: #212529;
    }
</style>
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Semua Pesan
        </div>
        <div class="card-body">
            @foreach ($semua_pesan as $item)
                @if ($item->check_click == "y")
                    <div class="list-group">                        
                        <a href="/kirim_balik/{{$item->id}}" class="link-list">
                            <div class="mx-1">
                                <h5 class="">{{$item->pengirim}}</h5>
                            </div>
                            <div class="mx-1">{{$item->pesan}}</div>
                            <div class="float-right mx-1">{{date('d-m-Y',strtotime($item->created_at))}}</div>
                        </a>
                    </div>
                @else
                    <div class="list-group">                        
                        <a href="/kirim_balik/{{$item->id}}" class="link-list" style="font-weight:bold;background-color: #F1F0E8;">
                            <div class="mx-1">
                                <h5 class="">{{$item->pengirim}}</h5>
                            </div>
                            <div class="mx-1">{{$item->pesan}}</div>
                            <div class="float-right mx-1">{{date('d-m-Y',strtotime($item->created_at))}}</div>
                        </a>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection