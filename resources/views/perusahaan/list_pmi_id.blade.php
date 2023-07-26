@extends('layouts.perusahaan')
@section('content')
@include('sweetalert::alert')
@include('flash_message')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 class="float-left"><b class="">List Pembuatan ID PMI</b></h4>
                <a href="/perusahaan/pembuatan_pmi_id" class="btn btn-primary float-right">Buat ID PMI</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama TKI</th>
                                <th>Agency</th>
                                <th>Jabatan</th>
                                <th>Sektor Usaha</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pmi_id as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->agency}}</td>
                                    <td>{{$item->jabatan}}</td>
                                    <td>{{$item->sektor_usaha}}</td>
                                    <td class="text-center">
                                        <a class="btn btn-success" href="/perusahaan/lihat_pmi_id/{{$item->pmi_id}}">Lihat</a>
                                        <a class="btn btn-warning" href="/perusahaan/edit_pmi_id/{{$item->pmi_id}}">Edit</a>
                                        <a class="btn btn-danger" href="/perusahaan/hapus_pmi_id/{{$item->pmi_id}}" onclick="hapusData(event)">Hapus</a>
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