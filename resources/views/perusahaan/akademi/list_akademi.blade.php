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
                                    <th>ID Akademi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr class="text-center">
                                    <th>No.</th>
                                    <th>Nama Akademi</th>
                                    <th>ID Akademi</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($akademi as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->id_akademi}}</td>
                                        <td>
                                            <div class="form-button-action float-right">
                                                <a href="" class="btn btn-success mr-2">L<i></i></a>
                                                <a href="" class="btn btn-warning mr-2">E<i></i></a>
                                                <a href="" class="btn btn-danger">H<i></i></a>
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