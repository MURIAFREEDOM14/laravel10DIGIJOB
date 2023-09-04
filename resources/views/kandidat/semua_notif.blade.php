@extends('layouts.kandidat')
@section('content')
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
            Semua Notifikasi
        </div>
        <div class="card-body">
            @foreach ($semua_notif as $item)
                @if ($item->check_click == "y")
                    <div class="list-group">
                        <a href="/lihat_notif_kandidat/{{$item->id_notify}}" class="link-list">
                            <div class="mx-1">
                                <div class="" style="font-weight:bold;">{{$item->pengirim}}</div>
                            </div>
                            <div class="mx-1">{{$item->isi}}</div>
                            <div class="float-right mx-1">{{date('d-m-Y',strtotime($item->created_at))}}</div>
                        </a>
                    </div>    
                @else
                    <div class="list-group">
                        <a href="/lihat_notif_kandidat/{{$item->id_notify}}" class="link-list" style="font-weight: bold;">
                            <div class="mx-1">
                                <div class="" style="font-weight: bold;">{{$item->pengirim}}</div>
                            </div>
                            <div class="mx-1">{{$item->isi}}</div>
                            <div class="float-right mx-1">{{date('d-m-Y',strtotime($item->created_at))}}</div>
                        </a>
                    </div>
                @endif
            @endforeach
            <div class="">Notifikasi akan terhapus dalam 2 minggu</div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
@endsection