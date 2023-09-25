@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="multi-filter-select" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>No. Telp</th>
                                <th>Alamat</th>
                                <th>Lihat Bio Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kandidat as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->no_telp }}</td>
                                <td>{{ $item->kabupaten }}</td>
                                <td>
                                    <a href="/manager/kandidat/lihat_profil/{{$item->id_kandidat}}">Lihat Profil</a>
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