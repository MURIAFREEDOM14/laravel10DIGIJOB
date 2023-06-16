@extends('layouts.akademi')
@section('content')
<div class="container mt-5">
    <hr>
    <div class="card">
        <div class="card-header">
            Semua Notifikasi
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-head-bg-info table-bordered-bd-primary">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Dari</th>
                            <th>Isi Pesan</th>
                            <th>URL</th>
                            <th>Waktu Pesan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notif as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->pengirim}}</td>
                            <td>{{$item->isi}}</td>
                            <td>
                                @if ($item->url == null)
                                    <a>---</a>
                                @else
                                    <a href="{{$item->url}}" class="btn btn-primary">Shorcut</a>                                    
                                @endif
                            </td>
                            <td>{{date('d-M-Y | H:m',strtotime($item->created_at)) }}</td>
                        </tr>                                
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="">Notifikasi akan terhapus dalam 2 minggu</div>
        </div>
    </div>
</div>
@endsection