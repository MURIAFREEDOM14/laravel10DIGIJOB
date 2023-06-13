@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Pembayaran Kandidat
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kandidat</th>
                                <th>No telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->nama_pembayaran }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>
                                    <a class="btn btn-success" href="/manager/cek_pembayaran/kandidat/{{$item->id_pembayaran}}">Cek Pembayaran</a>
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