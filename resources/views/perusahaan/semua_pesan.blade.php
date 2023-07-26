@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Semua Pesan
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama Pengirim</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Isi Pesan</th>
                            <th scope="col">balas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($semua_pesan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->pengirim}}</td>
                                <td>{{date('d-M-Y | H:m',strtotime($item->created_at))}}</td>
                                <td>{{$item->pesan}}</td>
                                <td>
                                    <a href="/perusahaan/kirim_balik/{{$item->id}}" class="btn btn-primary">Balas</a>
                                </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection