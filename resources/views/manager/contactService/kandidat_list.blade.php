@extends('layouts.contact_service')
@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4><b class="bold">List Kandidat</b></h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="basic-datatables" class="display table table-striped table-hover" >
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pengirim</th>
                                <th>Tanggal Kirim</th>
                                <th>Isi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($semua_kandidat as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$item->dari}}</td>
                                    <td>{{date('d-M-Y',strtotime($item->created_at))}}</td>
                                    <td>{{$item->isi}}</td>
                                    <td>
                                        <a href="/manager/lihat/contact_kandidat/{{$item->id_contact_kandidat}}" class="btn btn-success"><i class="fab fa-rocketchat"></i></a>
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