@extends('layouts.perusahaan')
@section('content')
<div class="container mt-5">
    <hr>
    <div class="card">
        <div class="card-header">
            Semua Notifikasi
        </div>
        <div class="card-body">
            <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Dari</th>
                        <th>Isi Pesan</th>
                        <th>Waktu Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notif as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->pengirim_notifikasi}}</td>
                        <td>{{$item->isi}}</td>
                        <td>{{date('d-m-Y | h:m:sa',strtotime($item->created_at)) }}</td>
                    </tr>                                
                    @endforeach
                </tbody>
            </table>
            <div class="">Notifikasi akan terhapus dalam 2 minggu</div>
        </div>
    </div>
</div>
@endsection