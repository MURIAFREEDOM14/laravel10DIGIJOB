@extends('layouts.perusahaan')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h5 style="font-weight: bold" class="float-left">List Lowongan Pekerjaan</h5>
                <a class="btn btn-primary float-right" href="/perusahaan/buat_lowongan">Tambah</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Tema Lowongan</th>
                                <th>Tanggal Lowongan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowongan as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_lowongan}}</td>
                                    <td>{{date('d-M-Y|H:m',strtotime($item->created_at))}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/perusahaan/lihat_lowongan/{{$item->id_lowongan}}">Lihat</a>
                                        <a class="btn btn-warning" href="/perusahaan/edit_lowongan/{{$item->id_lowongan}}">Edit</a>
                                        <a class="btn btn-danger" href="/perusahaan/hapus_lowongan/{{$item->id_lowongan}}" onclick="hapusData(event)">Hapus</a>
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
