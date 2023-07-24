@extends('layouts.contact_service')
@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h3 style="font-weight:700">List Verifikasi Akun Email Kandidat</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($verification as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="/manager/lihat/verifikasi_kandidat/{{$item->verify_id}}" class="btn btn-success"><i class="fab fa-rocketchat"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h5 style="font-weight: 600">Riwayat Verifikasi Akun Email Kandidat</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="basic-datatables" class="display table table-striped table-hover" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kandidat</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($riwayat as $item)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->email}}</td>
                                <td>
                                    <a href="/manager/lihat/verifikasi_kandidat/{{$item->verify_id}}" class="btn btn-success"><i class="fab fa-rocketchat"></i></a>
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