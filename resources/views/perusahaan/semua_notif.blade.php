@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <hr>
    <div class="card">
        <div class="card-header">
            Semua Notifikasi
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary">
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
                                <a class="btn btn-primary" href="{{$item->url}}">Shorcut</a>
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