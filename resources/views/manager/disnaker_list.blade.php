@extends('layouts.manager')
@section('content')
@include('flash_message')
@include('sweetalert::alert')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4 style="text-transform:uppercase; font-weight:600" class="float-left">List Disnaker</h4>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#exampleModal">
                    Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Disnaker</th>
                                <th>Email Disnaker</th>
                                <th>Alamat Disnaker</th>
                                <th>Hapus Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disnaker as $item)
                                <tr class="text-center">
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama_disnaker}}</td>
                                    <td>{{$item->email_disnaker}}</td>
                                    <td>{{$item->alamat_disnaker}}</td>
                                    <td>
                                        <a href="/manager/hapus_disnaker/{{$item->disnaker_id}}" onclick="hapusData(event)">Hapus</a>
                                    </td>
                                </tr>                                        
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>  
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Disnaker</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Nama Disnaker</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="text" required class="form-control" name="nama" id="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Email Disnaker</label>
                                </div>
                                <div class="col-md-8">
                                    <input type="email" required class="form-control" name="email" id="">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-4">
                                    <label for="" class="col-form-label">Alamat Disnaker</label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-12">
                                    @livewire('manager.disnaker-locate')
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection