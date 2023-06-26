@extends('layouts.manager')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4><b class="bold">Contact Us</b></h4>
        </div>
        <div class="card-body">
            <div class="mb-5">
                @if ($manager->type == 3)
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                    Tambah Admin CS
                </button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus">
                    Hapus Admin CS
                </button>                            
                @endif
            </div>
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admin as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->name}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Nama Admin</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required name="admin" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Email</label>
                            </div>
                            <div class="col-md-8">
                                <input type="email" required name="email" class="form-control" id="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="" class="col-form-label">Password</label>
                            </div>
                            <div class="col-md-8">
                                <input type="text" required name="password" class="form-control" id="">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="hapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hapus Admin CS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/manager/hapus_contact_us_admin" method="GET">
                        <select name="referral_code" class="form-control mb-3" id="">
                            <option value="">Pilih Nama admin</option>
                            @foreach ($admin as $item)
                                <option value="{{$item->referral_code}}">{{$item->name}}</option>
                            @endforeach    
                        </select>
                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda ingin menghapus data ini?')">Hapus</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection