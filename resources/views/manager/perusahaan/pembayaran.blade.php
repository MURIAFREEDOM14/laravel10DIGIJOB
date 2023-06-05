@extends('layouts.manager')
@section('content')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Pembayaran Perusahaan
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Perusahaan</th>
                                <th>No telp</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pembayaran as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->nama_perusahaan }}</td>
                                <td>{{ $item->no_telp_perusahaan }}</td>
                                <td>
                                    <a class="btn btn-success" href="/manager/cek_pembayaran/perusahaan/{{$item->id_pembayaran}}">Cek Pembayaran</a>
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