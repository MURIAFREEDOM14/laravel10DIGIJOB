@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight:600">Laporan Kerja Kandidat</h5>
            </div>
            <div class="card-body">
                <table id="add-row" class="display table table-striped table-hover" >
                    <thead>
                        <tr class="text-center">
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Asal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->kabupaten}}</td>
                                <td>
                                    <a class="btn" href="/manager/kandidat/confirm_penghapusan/{{$item->id_kandidat}}" onclick="hapusData(event)">Hapus Kandidat</a>
                                </td>
                            </tr>    
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection