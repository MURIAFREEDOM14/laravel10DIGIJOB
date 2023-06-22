@extends('layouts.perusahaan')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p>List Akademi</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="add-row" class="display table table-striped table-hover" >
                            <thead>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama Akademi</th>
                                    <th>Alamat Akademi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($akademi as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->nama_akademi}}</td>
                                        <td>{{$item->alamat_akademi}}</td>
                                        <td>
                                            <div class="form-button-action float-right">
                                                <a href="/perusahaan/lihat/akademi/{{$item->id_akademi}}" class="btn btn-success mr-2"><i class="far fa-eye"></i></a>
                                            </div>
                                        </td>
                                    </tr>    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection