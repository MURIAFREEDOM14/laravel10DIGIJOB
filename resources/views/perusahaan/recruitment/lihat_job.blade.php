@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <b class="bold">Pekerjaan {{$nama}}</b>
                <a class="btn btn-primary float-right" href="/perusahaan/tambah/pekerjaan/{{$id}}/{{$nama}}">Tambah Pekerjaan</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Pekerjaan</th>
                                <th>Syarat Umur</th>
                                <th>Syarat Kelamin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pekerjaan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_pekerjaan}}</td>
                                    <td>{{$item->syarat_umur}}</td>
                                    <td>
                                        @if ($item->syarat_kelamin == "M")
                                            Laki-laki
                                        @elseif($item->syarat_kelamin == "F")
                                            Perempuan
                                        @else
                                            Laki-laki & Perempuan
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning" href="/perusahaan/edit/pekerjaan/{{$item->id_pekerjaan}}/{{$id}}">Edit</a>
                                        <a class="btn btn-danger" href="/perusahaan/hapus/pekerjaan/{{$item->id_pekerjaan}}" onclick="hapusData(event)" >Hapus</a>
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