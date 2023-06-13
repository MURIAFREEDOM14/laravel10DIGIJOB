@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Data Akademi
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Akademi</th>
                                <th>Alamat</th>
                                <th>No. NIS</th>
                                <th>No. Telp</th>
                                <th>Lihat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($akademi as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>                                    
                                    <td>{{$item->nama_akademi}}</td>                                    
                                    <td>{{$item->alamat_akademi}}</td>                                    
                                    <td>{{$item->no_nis}}</td>                                    
                                    <td>{{$item->no_telp_akademi}}</td>                                    
                                    <td>
                                        <a class="btn btn-primary" href="/manager/akademi/lihat_profil/{{$item->id_akademi}}"><i class="fas fa-eye"></i></a>
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