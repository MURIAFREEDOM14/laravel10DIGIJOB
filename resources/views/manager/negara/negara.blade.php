@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                List Negara Tujuan
                <a class="btn btn-primary float-right" href="/manager/tambah_negara">Tambah Negara</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th><b class="bold">No</b></th>
                                <th><b class="bold">Nama Negara</b></th>
                                <th><b class="bold">Kode Negara</b></th>
                                <th><b class="bold">Syarat Umur</b></th>
                                <th><b class="bold">Mata Uang</b></th>
                                <th><b class="bold">Deskripsi</b></th>
                                <th><b class="bold">Aksi</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($negara as $item)
                                <tr class="text-center">
                                    <td><b class="bold">{{$loop->iteration}}</b></td>
                                    <td><b class="bold">{{$item->negara}}</b></td>
                                    <td><b class="bold">{{$item->kode_negara}}</b></td>
                                    <td><b class="bold">{{$item->syarat_umur}}</b></td>
                                    <td><b class="bold">{{$item->mata_uang}}</b></td>
                                    <td class="text1"><b class="bold">{{$item->deskripsi}}</b></td>
                                    <td>
                                        <a class="" href="/manager/lihat_negara/{{$item->negara_id}}"><i class="fas fa-eye" style="color:green"></i></a>
                                        <a class="mx-3" href="/manager/edit_negara/{{$item->negara_id}}"><i class="fa fa-edit" style="color:#ffad46"></i></a>
                                        <a class="" href="/manager/hapus_negara/{{$item->negara_id}}" onclick="hapusNegara(event)"><i class="fa fa-times" style="color:red"></i></a>
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