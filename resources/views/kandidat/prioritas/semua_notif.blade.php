@extends('layouts.prioritas')
@section('content')
<div class="container mt-5">
    <hr>
    <div class="card">
        <div class="card-header">
            Semua Notifikasi
        </div>
        <div class="card-body">
            <table class="table table-bordered table-head-bg-primary table-bordered-bd-primary text-center">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Pengirim</th>
                        <th>Isi Pesan</th>
                        <th>Waktu Pesan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notif as $item)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$item->pengirim}}</td>
                        <td>{{$item->pesan}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>                                
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection