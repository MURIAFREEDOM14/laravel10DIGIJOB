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
    a:hover {
        background-color: #f2f2f2;
        text-decoration: none;
        color: #212529;
    }
    .link-list {
        border-top:0.1px solid #dfdfdf;
        border-bottom:0.1px solid #dfdfdf;
        color: #212529;
    }
</style>
<div class="mx-3 mt-5 my-5">
    <div class="card">
        <div class="card-header">
            Semua Pesan
        </div>
        <div class="card-body">
            <!-- menampilkan semua pesan -->
            @foreach ($semua_pesan as $item)
                <!-- apabila pesan telah dibaca -->
                @if ($item->check_click == "y")
                    <!-- apabila pesan akademi ada -->
                    @if ($item->id_akademi !== null)
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list">
                                <div class="mx-1">
                                    <h5 class="" style="background-color:#8CC0DE; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    <!-- apabila pesan perusahaan ada -->
                    @elseif($item->id_perusahaan !== null)
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list">
                                <div class="mx-1">
                                    <h5 class="" style="background-color:#CCEEBC; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    <!-- apabila pesan dari admin -->
                    @else
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list">
                                <div class="mx-1">
                                    <h5 class="" style="background-color:#BC7AF9; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    @endif 
                @else
                    <!-- apabila pesan akademi ada --> 
                    @if ($item->id_akademi !== null)
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list" style="font-weight:bold;">
                                <div class="mx-1">
                                    <h5 class="" style="font-weight: bold; background-color:#8CC0DE; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    <!-- apabila pesan perusahaan ada -->
                    @elseif($item->id_perusahaan !== null)
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list" style="font-weight:bold;">
                                <div class="mx-1">
                                    <h5 class="" style="font-weight: bold; background-color:#CCEEBC; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    <!-- apabila pesan dari admin -->
                    @else
                        <div class="list-group">                        
                            <a href="/kirim_balik/{{$item->id}}" class="link-list" style="font-weight:bold;">
                                <div class="mx-1">
                                    <h5 class="" style="font-weight: bold; background-color:#BC7AF9; padding-top:2px; padding-bottom:2px; padding-left:15px; color:black;text-transform:uppercase;">{{$item->pengirim}}</h5>
                                </div>
                                <div class="mx-1">{{$item->pesan}}</div>
                                @php
                                    $dayNow = date('Y-m-d');
                                @endphp
                                <!-- apabila tanggal pesan dibuat sama dengan tanggal hari itu -->
                                @if (date('Y-m-d',strtotime($item->created_at)) == $dayNow)
                                    <div class="float-right mx-1">{{date('h:i A',strtotime($item->created_at))}}</div>                                
                                @else
                                    <div class="float-right mx-1">{{date('d-M',strtotime($item->created_at))}}</div>
                                @endif
                            </a>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection