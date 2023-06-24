@extends('layouts.manager')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">Beta Tester</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover" >
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Nama Beta</th>
                                <th>Referral Code</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($beta as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->referral_code}}</td>
                                </tr>    
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Nama</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">NIK</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nik" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">No. Telp</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="no_telp" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Tanggal Lahir</label>
                        </div>
                        <div class="col-md-8">
                            <input type="date" name="tgl_lahir" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Username</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="nama_panggilan" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Email</label>
                        </div>
                        <div class="col-md-8">
                            <input type="email" name="email" class="form-control" id="">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="" class="col-form-label">Password</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" name="password" class="form-control" id="">
                        </div>
                    </div>
                    <a href="{{route('manager')}}" class="btn btn-outline-danger">Kembali</a>
                    <button type="submit" class="btn btn-outline-success">+ Tambah</button>
                </form>
            </div>
        </div>
    </div>
@endsection